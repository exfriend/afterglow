<?php

namespace App\Commands;

use App\Recipes\AddHelpersFile;
use App\Recipes\AddMustHavePackages;
use App\Recipes\ScaffoldFrontend;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Init extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'ignite';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Scaffold Laravel Installation';

    protected $recipes = [
        AddHelpersFile::class,
        AddMustHavePackages::class,
        ScaffoldFrontend::class,
    ];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach ( $this->recipes as $recipe )
        {
            ( new $recipe( $this ) )->handle();
        }

        $this->line( '' );
        $fire = '🔥';
        $this->line( $fire . '   Scaffolding Done!   ' . $fire );
        $this->line( '' );
    }

    /**
     * Define the command's schedule .
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule( Schedule $schedule ) : void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
