<?php

namespace App\Http\Filters\Worker\WorkerPipeline;

use Illuminate\Database\Eloquent\Builder;

class WorkerAge
{
    public function handle(Builder $builder, \Closure $next)
    {
        //если запрошен age в filter и оно НЕ пустое, то в query builder попадает условие где age = то что запрошено в request
        if(request()->filled('age')) {
            $builder->where('age', '%' . request()->input('age') . '%');
        }
        return $next($builder);
    }
}
