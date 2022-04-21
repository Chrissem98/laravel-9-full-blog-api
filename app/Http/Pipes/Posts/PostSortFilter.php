<?php

namespace App\Http\Pipes\Posts;

use App\Http\Pipes\SortFilter;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class PostSortFilter extends SortFilter
{

    protected string $tableName = 'posts';

}
