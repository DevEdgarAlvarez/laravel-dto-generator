<?php

namespace DevEdgarAlvarez\LaravelDtoGenerator\Dtos;

use Illuminate\Contracts\Support\Arrayable;

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

    public static function collection(iterable $items): array
    {
        return collect($items)
            ->map(fn($item) => (new static($item))->toArray())
            ->toArray();
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
}
