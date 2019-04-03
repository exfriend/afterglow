<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class Workspace extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'workspace';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $project = json_decode( file_get_contents( '.afterglow.json' ), true )[ 'project' ];
        $process = new Process( 'afterglow exec ' . $project . '__workspace bash' );

        $process->setTty( Process::isTtySupported() );

        $process->run();

        // executes after the command finishes
        if ( !$process->isSuccessful() )
        {
            throw new ProcessFailedException( $process );
        }

        echo $process->getOutput();
    }

    /**
     * Define the command's schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule( Schedule $schedule ) : void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
