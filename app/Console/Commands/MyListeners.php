<?php
/**
 * @author huynt
 * extend php artisan commands
 * use for create Model file
 */

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;

class MyListeners extends GeneratorCommand
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
        $stub = str_replace('DummyUseClass', $this->getPrefix() ? $DummyUseClass = "Event" . $this->name_class : $this->getPrefix().$this->name_class, $stub);
        $stub = str_replace('DummyClass', $this->getPrefix() . $this->name_class, $stub);
        return $stub;
    }
}