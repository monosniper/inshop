<?php

namespace App\EloquentFilters\LayoutOption;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class ParentIdFilter extends Filter
{
    /**
     * Apply the age condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->where('parent_id', $value);
    }
}
