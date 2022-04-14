<?php

namespace App\Http\Pipes\Categories;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class CategoryFieldsFilter
{
    public function handle(Builder $query, Closure $next)
    {
        $query->when(request()->has('fields'), function($query){

            foreach(explode(',' ,request()->fields) as $col){

                if(Schema::hasColumn('categories', $col)){
                    $query->addSelect($col);
                }

            }
        });

        return $next($query);
    }
}