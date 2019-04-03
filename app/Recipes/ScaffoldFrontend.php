<?php

namespace App\Recipes;

use App\Recipes\Traits\ExecutesTasks;

class ScaffoldFrontend extends Recipe
{
    use ExecutesTasks;

    protected $tasks = [
        'php artisan preset tailwindcss-auth',
        'npm install',
        'rm tailwind.js',
        'node_modules/.bin/tailwind init',
        'npm run dev && npm run dev',
        'npm install --save animate.css moment moment-timezone vee-validate',
    ];

    public function handle()
    {
        if ( $this->command->confirm( 'Scaffold frontend?', true ) )
        {
            return $this->execAll( $this->tasks, 'Scaffolding frontend: ' );
        }

    }

}