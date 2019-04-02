<?php


namespace App\Recipes;


use LaravelZero\Framework\Commands\Command;

abstract class Recipe
{
    /**
     * @var Command
     */
    protected $command;

    abstract public function handle();

    public function __construct( Command $command )
    {
        $this->command = $command;
    }

}