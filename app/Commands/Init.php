<?php

namespace App\Commands;

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

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $fire = '🔥';
        $this->line( $fire );
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
