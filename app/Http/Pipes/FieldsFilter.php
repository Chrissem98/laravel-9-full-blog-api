<?php

namespace App\Http\Pipes;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

abstract class FieldsFilter
{
    // public function __construct(
    //     private string $tableName
    //     )
    // {}
    protected string $tableName;

    public function handle(Builder $query, Closure $next)
    {
        $query->when(request()->has('fields'), function($query){

            foreach(explode(',' ,request()->fields) as $col){

                if(Schema::hasColumn($this->tableName, $col)){
                    $query->addSelect($col);
                }


            }
        });

        return $next($query);
    }
}
