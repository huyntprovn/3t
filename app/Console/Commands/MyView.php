<?php
/**
 * @author huynt
 * extend php artisan commands
 * use for create view file
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;
use SebastianBergmann\Environment\Console;

class MyView extends Command
{
    const PATH = "D:\\Users\\Documents\\code\\laravel\\packages\\linkhay\\templates\\src\\desktop\\default\\views\\";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'my:view {view : path and name of view template} {default_folder? : default is templates\\src\\desktop\\default\\views\\ }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new blade template.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $view = $this->argument('view');

        $path = $this->viewPath($view);

        $this->createDir($path);

        if (File::exists($path)) {
            $this->error("File {$path} already exists!");
            return;
        }

        File::put($path, $path);

        $view_template = $this->argument('default_folder') ? $view : 'vendor.linkhay.' . str_replace('\\', '.', $view);
        $this->info("File {$path} created. Get view template: " . $view_template);
    }

    /**
     * Get the view full path.
     *
     * @param string $view
     *
     * @return string
     */
    public function viewPath($view)
    {
        $view = str_replace('.', '/', $view) . '.blade.php';

        $view = $this->argument('default_folder') ? $view : 'vendor\\linkhay\\' . $view;
        $path = self::PATH . "{$view}";

        return $path;
    }

    /**
     * Create view directory if not exists.
     *
     * @param $path
     */
    public function createDir($path)
    {
        $dir = dirname($path);

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
    }

}