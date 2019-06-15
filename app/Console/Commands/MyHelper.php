<?php
/**
 * @author huynt
 * extend php artisan commands
 * use for create Model file
 */
namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;

class MyHelper extends GeneratorCommand
{
    use MyCommand;
}