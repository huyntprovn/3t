<?php
/**
 * @author huynt
 * extend php artisan commands
 * use for create Model file
 */
namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;

class MyModel extends GeneratorCommand
{
    use MyCommand;
    /**
     * Replace the class name for the given stub.
     *
     * @param string $stub
     * @param string $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $stub = str_replace('DummyClass', $this->getPrefix() . $this->getNameClassInArgument(), $stub);
        $stub = str_replace('DummyTable', $this->argument('table'), $stub);
        return $stub;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of ' . $this->type . ' class'],
            ['table', InputArgument::OPTIONAL, 'The table of the model'],
            ['prefix', InputArgument::OPTIONAL, 'The prefix of the model'],
        ];
    }
}