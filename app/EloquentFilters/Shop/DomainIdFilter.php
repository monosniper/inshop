<?php

namespace App\EloquentFilters\Shop;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class DomainIdFilter extends Filter
{
    /**
     * Apply the age condition to the query.
     */
    public function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->where('domain_id', $value);
    }
}
