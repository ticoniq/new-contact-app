<?php

namespace App\Scopes;
 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
 
class SearchScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    protected $searchColumns = [];

    public function apply(Builder $builder, Model $model)
    {
        if ($search = request()->query('search')) 
        {
            $columns = property_exists($model, 'searchColumns') ? $model->searchColumns : $this->searchColumns;
            foreach ($columns as $index => $column) 
            {
                $arr = explode('.', $column);
                $method = $index === 0 ? "where" : "orWhere";
                if (count($arr) == 2) {
                    list($relationship, $col) = $arr;
                    $method .= "Has";
                    $builder->$method($relationship, function ($query) use ($search, $col) {
                        $query->where($col, 'LIKE', "%{$search}%");
                    });
                } else {
                    $builder->$method($column, 'LIKE', "%{$search}%");
                }
            }
        }
    }
}