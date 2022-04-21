<?php

namespace App\Http\Pipes\Posts;

use App\Http\Pipes\FieldsFilter;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class PostFieldsFilter extends FieldsFilter
{

    protected string $tableName = 'posts';

}
