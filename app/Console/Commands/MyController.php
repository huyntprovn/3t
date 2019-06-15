<?php
/**
 * @author huynt
 * extend php artisan commands
 * use for create Model file
 */
namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;

class MyController extends GeneratorCommand
{
    use MyCommand;
    public function __construct(Filesystem $files)
    {
        $this->init_common();
        parent::__construct($files);
        $this->folder_contain = "\\Http\\".$this->type."s";
    }

}