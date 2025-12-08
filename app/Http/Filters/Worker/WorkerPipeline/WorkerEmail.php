<?php

namespace App\Http\Filters\Worker\WorkerPipeline;

use Illuminate\Database\Query\Builder;

class WorkerEmail
{
    public function handle(Builder $builder, \Closure $next)
    {
        //если запрошен email в filter и оно НЕ пустое, то в query builder попадает условие где email = то что запрошено в request
        if (request()->filled('email')) {
            $builder->where('email', 'LIKE', '%' . request()->input('email') . '%');
        }
        return $next($builder);
    }
}
