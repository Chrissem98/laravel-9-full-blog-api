<?php

namespace App\Http\Pipes\Categories;

use App\Http\Pipes\FieldsFilter;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class CategoryFieldsFilter extends FieldsFilter
{
    
    protected string $tableName = 'categories';

}
