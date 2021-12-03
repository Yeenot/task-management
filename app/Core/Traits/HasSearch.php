<?php

namespace App\Core\Traits;

Trait HasSearch {

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $columns
     * @param string $value
     * @param string $mode
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $columns = [], $value, $mode = 'AND')
    {
        if (isset($value)) {
            $method = $mode === 'AND' ? 'where' : 'orWhere';

            $query->{$method}(function($query) use ($columns, $value) {
                foreach($columns as $column) {
                    $query->orWhere($column, 'LIKE', "%{$value}%");
                }
                return $query;
            });
        }
        return $query;
    }
}