<?php
/**
 * @author huynt
 * extend php artisan commands
 */

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;

trait MyEventListenerTrait
{
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
    public function __construct(Filesystem $files)
    {
        $class_name = get_class($this);
        $this->type = str_replace("My", "", substr($class_name, strrpos($class_name, '\\') + 1));
        $type = strtolower($this->type);
        $this->description = "Create a new $type class";
        $this->name = "my:$type";
        parent::__construct($files);
        $this->folder_contain = "\\" . $this->type;
        $this->root_namespace_prefix .= $this->folder_contain;
    }

    /**
     * get path of stub file
     * @return string
     */
    protected function getStub()
    {
        $type = $this->type;
        $name = $this->argument('name');
        return app_path() . "\\$type\\Linkhay\\Stream\\App\\$type\\$name.php";

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
        $type = $this->type;
        $stub = preg_replace('/namespace App\\\\' . $this->type . '\\\\/', '', $stub, 2);
        $stub = preg_replace('/use App\\\\' . $this->type . '\\\\/', '', $stub, 2);
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
        if ($this->root_namespace_prefix) {
            $DummyNamespace = $this->getNamespace($this->argument('name'));
            $stub = str_replace('DummyNamespace',
                $this->root_namespace_prefix . ($DummyNamespace ? '\\' . $DummyNamespace : ''),
                $stub);
        } else {
            parent::replaceNamespace();
        }

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
        return self::$path_package . $this->path_root_namespace . $this->folder_contain . '\\' . $this->argument('name') . ".php";
    }
}