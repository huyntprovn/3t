<?php
/**
 * @author huynt
 * extend php artisan commands
 */

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;

trait MyCommand
{
    /**
     * name of class in name parameter
     * @var
     */
    private $name_class;

    /**
     * folder of class in name parameter
     * @var
     */
    private $name_folder;

    private static $path_package = "D:\\Users\\Documents\\code\\laravel\\packages";
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $name;
    /**
     * The console command description.
     *
     * @var string
     */

    protected $description;
    /**
     * The type of class being generated.
     *
     * @var string
     */

    protected $type;

    /**
     * Base namespace of package
     * @var string
     */
    private $root_namespace_prefix = 'Linkhay\\Stream\\App';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    private $dummy_file_path = '/Console/Commands/Stubs/Dummy';

    /**
     * Base path of package
     * @var string
     */
    private $path_root_namespace = '\\linkhay\\stream\\src\\app';

    /**
     * folder contain class file
     * @var string
     */
    private $folder_contain;

    /**
     * MyCommand constructor.
     * @param Filesystem $files
     * MyModel, MyHelper used
     */

    /**
     * suffix of class's name
     * @var
     */
    private $suffix;

    public function __construct(Filesystem $files)
    {
        $this->init_common();
        parent::__construct($files);
    }

    public function init_common()
    {
        $this->suffix = '';
        $class_name = get_class($this);
        $this->type = str_replace("My", "", $this->getNameClassInPath($class_name));
        $type = strtolower($this->type);
        $this->description = "Create a new $type class";
        $this->name = "my:$type";
        $this->folder_contain = "\\" . $this->type;
        $this->root_namespace_prefix .= $this->folder_contain;
    }

    /**
     * extract class name from path string
     * @return mixed
     */
    private function getNameClassInPath($path)
    {
        if (strrpos($path, '\\')===false){
            return $path;
        }else{
            return substr($path, strrpos($path, '\\') + 1);
        }

    }
    /**
     * extract class name from argument
     * @return mixed
     */
    private function getNameClassInArgument()
    {
        $path = $this->argument('name');
        return $this->getNameClassInPath($path);
    }

    /**
     * extract folder path from argument
     * @return mixed
     */
    private function getFolderInArgument()
    {
        $path = $this->argument('name');
        return $this->getNamespace($path);
    }
    /**
     * get path of stub file
     * @return string
     */
    protected function getStub()
    {
        $type = $this->type;
        return app_path() . $this->dummy_file_path . $type . '.stub';

    }

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
        return $stub;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     *
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of ' . $this->type . ' class'],
            ['prefix', InputArgument::OPTIONAL, 'The prefix of ' . $this->type . ' class'],
        ];
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param string $stub
     * @param string $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $name = $this->argument('name');
        if ($this->root_namespace_prefix) {
            $name_space_arg = $this->getNamespace($name);
            $stub = str_replace('DummyNamespace', $this->root_namespace_prefix . ($name_space_arg ? '\\' . $name_space_arg : ''), $stub);
            $stub = str_replace('DummyRootNamespace', $this->root_namespace_prefix, $stub);
        } else {
            parent::replaceNamespace();
        }
        $this->info("'" . $this->root_namespace_prefix . "\\" .  $this->getFolderInArgument() . '\\' . $this->getPrefix() . $this->getNameClassInArgument() . $this->suffix . "'");
        return $this;
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     * @return string
     */
    protected function getPath($name)
    {
        $ret = self::$path_package . $this->path_root_namespace . $this->folder_contain . '\\' .
             $this->getFolderInArgument() . '\\' . $this->getPrefix() . $this->getNameClassInArgument() . $this->suffix . ".php";
        return $ret;
    }

    /**
     * get prefix of class name dependence --prefix
     * @return string|string[]|null
     */
    private function getPrefix()
    {
        return ($this->argument('prefix') ? preg_replace('/s$/', '', $this->type) : '');
    }
}