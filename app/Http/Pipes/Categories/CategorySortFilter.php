<?php

namespace App\Http\Pipes\Categories;

use App\Http\Pipes\SortFilter;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class CategorySortFilter extends SortFilter
{

    protected string $tableName = 'categories';
    
}
