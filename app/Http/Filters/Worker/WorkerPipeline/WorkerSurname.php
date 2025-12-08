<?php

namespace App\Http\Filters\Worker\WorkerPipeline;

use Illuminate\Database\Eloquent\Builder;

class WorkerSurname
{
    public function handle(Builder $builder, \Closure $next)
    {
        //если запрошен surname в filter и оно НЕ пустое, то в query builder попадает условие где surname = то что запрошено в request
        if (request()->filled('surname')) {
            $builder->where('surname', 'LIKE', '%' . request()->input('surname') . '%');
        }
        return $next($builder);
    }
}
