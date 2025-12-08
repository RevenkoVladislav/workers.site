<?php

namespace App\Http\Filters\Worker\WorkerPipeline;

use Illuminate\Database\Eloquent\Builder;

class WorkerName
{
    public function handle(Builder $builder, \Closure $next)
    {
        //если запрошен name в filter и оно НЕ пустое, то в query builder попадает условие где name = то что запрошено в request
        if (request()->filled('name')) {
            $builder->where('name', 'LIKE', '%' . request()->input('name') . '%');
        }
        return $next($builder);
    }
}
