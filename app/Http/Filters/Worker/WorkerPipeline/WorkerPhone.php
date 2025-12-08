<?php

namespace App\Http\Filters\Worker\WorkerPipeline;

use Illuminate\Database\Eloquent\Builder;

class WorkerPhone
{
    public function handle(Builder $builder, \Closure $next)
    {
        //если запрошен phone в filter и оно НЕ пустое, то в query builder попадает условие где phone = то что запрошено в request
        if (request()->filled('phone')) {
            $builder->where('phone', 'LIKE', '%' . request()->input('phone') . '%');
        }
        return $next($builder);
    }
}
