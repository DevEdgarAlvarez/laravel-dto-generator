<?php

namespace DevEdgarAlvarez\LaravelDtoGenerator\Dtos;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Carbon;

abstract class BaseDto implements Arrayable
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function __get($key)
    {
        return $this->model->{$key};
    }

    public static function collection(iterable $items): \Illuminate\Support\Collection
    {
        return collect($items)->map(fn($item) => new static($item));
    }

    protected function whenLoaded(string $relation, string $dtoClass)
    {
        $related = $this->model->{$relation};

        if (!$this->model->relationLoaded($relation)) {
            return null;
        }

        return $related instanceof \Illuminate\Support\Collection
            ? $dtoClass::collection($related)
            : new $dtoClass($related);
    }

    protected function asCurrency(float $value, string $symbol = '$'): string
    {
        return $symbol . number_format($value, 2);
    }

    protected function asDate(?string $date, string $format = 'd/m/Y'): ?string
    {
        return $date ? Carbon::parse($date)->format($format) : null;
    }

    protected function asBool(bool $value): string
    {
        return $value ? 'Sí' : 'No';
    }
}
