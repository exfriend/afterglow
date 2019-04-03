<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Process\Process;

class Apply extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'apply {package} {--force}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Apply recipe';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line( 'Applying recipe: ' . $this->argument( 'package' ) );
        $proc = new Process( 'composer config --list --global' );
        $proc->run();
        $out = $proc->getOutput();


        if ( !preg_match( '~\[home] (.*?)\n~is', $out, $home ) )
        {
            dd( $out );
        }

        $home = $home[ 1 ];

        $package_root = $home . '/vendor/' . $this->argument( 'package' );

        if ( !file_exists( $package_root ) || $this->option( 'force' ) )
        {
            $this->task( 'Package not found locally. Pulling...', function () use ( $package_root )
            {
                ( new Process( 'composer global require ' . $this->argument( 'package' ) . ' dev-master' ) )->run();
                if ( !file_exists( $package_root ) )
                {
                    $this->error( 'Could not pull package ' . $this->argument( 'package' ) );
                }
            } );
        }

        $composerJson = json_decode( file_get_contents( $package_root . '/composer.json' ), true );

        $recipes = $composerJson[ 'extra' ][ 'afterglow' ][ 'recipes' ];

        foreach ( $recipes as $class => $file )
        {
            require_once( $package_root . '/' . $file );
            $recipe = new $class( $this );
            $recipe->handle();
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
