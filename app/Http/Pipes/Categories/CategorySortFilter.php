<?php

namespace App\Http\Pipes\Categories;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class CategorySortFilter
{
    public function handle(Builder $query, Closure $next)
    {
        $query->when(request()->has('sort'), function($query){
            $sort = request()->sort;
            if(str($sort)->startsWith('-')){
                $sort = str($sort)->substr(1);
                if(Schema::hasColumn('categories',$sort)){
                    $query->orderByDesc($sort);
                }
            }
            else{
                if(Schema::hasColumn('categories',$sort)){
                    $query->orderBy($sort);
                }
            }
        });

        return $next($query);
    }
}