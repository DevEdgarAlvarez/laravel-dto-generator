<?php

namespace DevEdgarAlvarez\LaravelDtoGenerator;

use DevEdgarAlvarez\LaravelDtoGenerator\Console\Commands\MakeDtoCommand;
use Illuminate\Support\ServiceProvider;

class DtoGeneratorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeDtoCommand::class,
            ]);

            $this->publishes([
                __DIR__.'/../stubs/dto.stub' => $this->app->basePath('stubs/dto.stub'),
            ], 'dto-stubs');
        }
    }
}
