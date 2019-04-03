<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class Compose extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'compose {argv=help}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'execute docker-compose command';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $process = new Process( 'sudo docker-compose ' . $this->argument( 'argv' ) );
        $process->setTty( Process::isTtySupported() );
        $process->run();
        // executes after the command finishes
        if ( !$process->isSuccessful() )
        {
//            throw new ProcessFailedException( $process );
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
