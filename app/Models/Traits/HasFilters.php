<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasFilters
{
    public function scopeFilter(Builder $query, array $filter): Builder
    {
        if (property_exists($this, 'searchable')) {
            foreach ($this->searchable as $column) {
                $query->when(
                    $filter['search'][$column] ?? null,
                    function ($query, $search) use ($column) {
                        if (str_contains($column, '.')) {
                            $parts = explode('.', $column);
                            $this->applyRelationSearch($query, $parts, $search);
                        } elseif (str_ends_with($column, '_id')) {
                            $query->where($column, $search);
                        } else {
                            $query->where($column, 'like', "%{$search}%");
                        }
                    }
                );
            }
        }

        $query->when($filter['sort'] ?? null, function ($query, $sort) {
            $query->orderBy($sort['field'], $sort['order']);
        });

        return $query;
    }

    private function applyRelationSearch(Builder $query, array $parts, string $search)
    {
        $relation = array_shift($parts);

        if (count($parts) == 1) {
            $column = $parts[0];
            $query->whereHas($relation, function ($q) use ($column, $search) {
                $q->where($column, 'like', "%{$search}%");
            });
        } else {
            $query->whereHas($relation, function ($q) use ($parts, $search) {
                $this->applyRelationSearch($q, $parts, $search);
            });
        }
    }
}
