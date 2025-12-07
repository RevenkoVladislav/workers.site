<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class WorkerFilter
{
    private array $params;
    const NAME = 'name';
    const SURNAME = 'surname';
    const EMAIL = 'email';
    const AGE = 'age';
    const AGE_FROM = 'age_from';
    const AGE_TO = 'age_to';
    const PHONE = 'phone';
    const DESCRIPTION = 'description';
    const IS_MARRIED = 'is_married';

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function getCallbacks(): array
    {
        return [
            self::NAME => 'name',
            self::SURNAME => 'surname',
            self::EMAIL => 'email',
            self::AGE => 'age',
            self::AGE_FROM => 'ageFrom',
            self::AGE_TO => 'ageTo',
            self::PHONE => 'phone',
            self::DESCRIPTION => 'description',
            self::IS_MARRIED => 'isMarried',
        ];
    }

    public function applyFilter()
    {
        foreach ($this->getCallbacks() as $key => $callback) {
            if (isset($this->params[$key])){
                $this->$callback();
            }
        }
    }

    public function name(Builder $builder, $value)
    {
        $builder->where('name', 'like', "%{$value}%");
    }

    public function surname(Builder $builder, $value)
    {
        $builder->where('surname', 'like', "%{$value}%");
    }

    public function email(Builder $builder, $value)
    {
        $builder->where('email', 'like', "%{$value}%");
    }

    public function age(Builder $builder, $value)
    {
        $builder->where('age', 'like', "%{$value}%");
    }

    public function ageFrom(Builder $builder, $value)
    {
        $builder->where('age', '>', "$value");
    }

    public function ageTo(Builder $builder, $value)
    {
        $builder->where('age', '<', "$value");
    }

    public function phone(Builder $builder, $value)
    {
        $builder->where('phone', 'like', "%{$value}%");
    }

    public function description(Builder $builder, $value)
    {
        $builder->where('description', 'like', "%{$value}%");
    }

    public function isMarried(Builder $builder)
    {
        $builder->where('is_married', true);
    }
}
