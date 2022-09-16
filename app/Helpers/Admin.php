<?php

namespace App\Helpers;

use EloquentBuilder;
use Illuminate\Support\Arr;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

class Admin
{
    static public function getCollection($query, $search_columns, $request, $resourceClass, $sort_convertors=[]) {
        $filter = (array) json_decode($request->filter);

        $sort = [];
        $range = null;

        if($request->sort) {
            $sort = json_decode($request->sort);
        }
        if($request->range) {
            $range = json_decode($request->range);
        }

        $sortBy = $sort ? !array_key_exists($sort[0], $sort_convertors) ? $sort[0] : $sort_convertors[$sort[0]] : false;

        if($sort) {
            $sortOrder = $sort[1];

            $custom_sorts = [
                'user' => function($orders) use($sortOrder) {
                    $sort = function ($order) use($sortOrder) {
                        return $order->user->fullName;
                    };

                    return $sortOrder === 'ASC' ? $orders->sortBy($sort) : $orders->sortByDesc($sort);
                },
                'freelancer' => function($orders) use($sortOrder) {
                    $sort = function ($order) use($sortOrder) {
                        return $order->freelancer->fullName;
                    };

                    return $sortOrder === 'ASC' ? $orders->sortBy($sort) : $orders->sortByDesc($sort);
                },
                'offers_count' => function($orders) use($sortOrder) {
                    $sort = function ($order) use($sortOrder) {
                        return $order->offers_count;
                    };

                    return $sortOrder === 'ASC' ? $orders->sortBy($sort) : $orders->sortByDesc($sort);
                },
                'category' => function($orders) use($sortOrder) {
                    $sort = function ($order) use($sortOrder) {
                        return $order->category->name;
                    };

                    return $sortOrder === 'ASC' ? $orders->sortBy($sort) : $orders->sortByDesc($sort);
                },
            ];

            if(!array_key_exists($sortBy, $custom_sorts)) {
                $query = $query->orderBy($sortBy, $sort[1]);
            }
        }

        $filters = EloquentBuilder::to($query, Arr::except($filter, ['q']));
        $search_results = Search::add($filters, $search_columns);
        $collection = $search_results->search($filter['q'] ?? '');

        if($sort && array_key_exists($sort[0], $custom_sorts)) {
            $collection = $custom_sorts[$sort[0]]($collection);
        }

        if(!$range || $range[1] === 0) {
            $range = [0, $collection->count()];
        }

        return response()->json($resourceClass::collection(
            $collection
                ->skip($range[0])
                ->take($range[1] - $range[0] + 1)
        ))
            ->header("X-Total-Count", $collection->count())
            ->header("Access-Control-Expose-Headers", "X-Total-Count");
    }
}
