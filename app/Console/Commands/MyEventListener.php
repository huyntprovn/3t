<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MyEventListener extends Command
{
    const NAME_SPACE_ROOT = "D:\\Users\\Documents\\code\\laravel\\packages\\linkhay\\templates\\src\\desktop\\default\\views\\";
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'my:eventlistener {name : format is FolderName_ModelName => path is FolderName\\FolderNameModelName}' ;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed`
     */
    public function handle()
    {
        list($containFolder, $name) = explode("_",$this->argument('name'));
//        $this->call("event:generate");
        $this->call("my:events",['name' => "$containFolder\\$containFolder" . $name, "prefix" => true]);
        $this->call("my:listeners",['name' => "$containFolder\\$containFolder" . $name,"prefix" => true]);
        $this->info("Copy line Event class => Listener above to \$listen array in EventServiceProvider class: ");
    }

    public function testDebug()
    {
        $this->call("my:observers",['name' => "Test", "prefix" => true]);
    }
}
