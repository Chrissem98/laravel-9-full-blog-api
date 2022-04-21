<?php

namespace App\Http\Pipes;

use Closure;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;

abstract class SortFilter
{
    protected string $tableName;

    public function handle(Builder $query, Closure $next)
    {
        $query->when(request()->has('sort'), function($query){
            $sort = request()->sort;
            if(str($sort)->startsWith('-')){
                $sort = str($sort)->substr(1);
                if(Schema::hasColumn($this->tableName, $sort)){
                    $query->orderByDesc($sort);
                }
            }
            else{
                if(Schema::hasColumn($this->tableName, $sort)){
                    $query->orderBy($sort);
                }
            }
        });

        return $next($query);
    }
}
