<?php


namespace Modules\CommonModule\Traits;


trait NormalSearch
{

    /**
     * Scope a query that matches a full text search of term.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $term)
    {
        $columns = $this->searchable;
        foreach ($columns as $column){
            $query = $query->where($column,'LIKE',"%$term%");
        }
        return $query;
    }
}
