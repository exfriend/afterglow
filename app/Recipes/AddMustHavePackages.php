<?php

namespace App\Recipes;

use App\Recipes\Traits\ExecutesTasks;

class AddMustHavePackages extends Recipe
{
    use ExecutesTasks;

    protected $tasks = [
        'composer require --dev barryvdh/laravel-ide-helper doctrine/dbal',
        'composer require barryvdh/laravel-cors laracasts/flash laravel-frontend-presets/tailwindcss pyaesone17/active-state',
    ];

    public function handle()
    {
        if ( $this->command->confirm( 'Install must have composer packages?', true ) )
        {
            $this->execAll( $this->tasks, 'Configuring composer: ' );
        }
    }

}