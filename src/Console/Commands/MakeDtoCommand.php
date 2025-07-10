<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class MakeDtoCommand extends GeneratorCommand
{
    protected $name = 'make:dto';
    protected $description = 'Create a new Data Transfer Object (DTO)';
    protected $type = 'DTO';

    protected function getStub()
    {
        return base_path('stubs/dto.stub');
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Dtos';
    }

    protected function getOptions()
    {
        return [
            ['model', null, InputOption::VALUE_OPTIONAL, 'The model the DTO is based on'],
        ];
    }

    protected function buildClass($name)
    {
        $class = parent::buildClass($name);

        $model = $this->option('model');

        if ($model) {
            $modelClass = $this->qualifyModel($model);
            $modelImport = "use {$modelClass};";
            $modelShortName = class_basename($modelClass);

            $class = str_replace('DummyModelImport', $modelImport, $class);
            $class = str_replace('DummyToArrayContent', $this->buildToArrayFromFillable($modelClass), $class);
        } else {
            $class = str_replace('DummyModelImport', '', $class);
            $class = str_replace('DummyToArrayContent', '// visible fields', $class);
        }

        return $class;
    }

    protected function buildToArrayFromFillable($modelClass)
    {
        if (!class_exists($modelClass)) return '// Model not found';

        $model = new $modelClass;

        if (!method_exists($model, 'getFillable')) return '// Model without attributes $fillable';

        $fields = $model->getFillable();

        $maxLength = collect($fields)->map('strlen')->max();

        return collect($fields)
            ->map(function ($field, $index) use ($maxLength) {
                $key = "'$field'";
                $paddedKey = str_pad($key, $maxLength + 2);
                $indent = $index === 0 ? '' : '            ';
                return "{$indent}{$paddedKey} => \$this->{$field},";
            })
            ->implode("\n");
    }
}
