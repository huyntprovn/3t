<?php
/**
 * @author huynt
 * extend php artisan commands
 * use for create Test file
 */
namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;

class MyTest extends GeneratorCommand
{
    use MyCommand;

//    private $path_root_namespace;

    public function __construct(Filesystem $files)
    {
        $this->init_common();
        parent::__construct($files);
        $this->path_root_namespace = '\\linkhay\\stream\\tests';
        $this->folder_contain = '';
        $this->suffix = 'Test';
    }

}