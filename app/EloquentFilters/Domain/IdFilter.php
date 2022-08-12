<?php

namespace App\EloquentFilters\Domain;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class IdFilter extends Filter
{
    /**
     * Apply the age condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->whereIn('id', $value);
    }
}
