<?php

namespace Tests\Unit;

use App\NguoiGiao;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
//use Illuminate\Support\Facades\Redis;
use Memcache;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use TillKruss\LaravelPhpRedis\Repository;
use Exception;
//use Redis;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void0000
     */
    public function testBasicTest()
    {
        $t = \Redis::PIPELINE;
//        $redis = new Redis();
        $user = Redis::get('user:profile');
        $this->assertContains('vccorp', $user);
    }

    public function testMemcache()
    {
        $memcache = new \Memcache;
        $memcache->addServer('127.0.0.1', 11211) or die ("Could not connect");
        $memcache->set('k', 'okkk');
        $user = $memcache->get('k');
        $this->assertContains('okkk', $user);
    }

    public function testPython()
    {
        $t = file_get_contents('test.py');
        $command = escapeshellcmd($t); //Chuyển mã trong tập tin test.py thành các lệnh
        $output = shell_exec("dir"); // Lấy kết quả trả về biến $output
        echo $output; // Xuất kết quả
    }

    public function testGetOriginal()
    {
        $nguoigiao = NguoiGiao::query()->findOrFail(6);
        $arrAssert = $nguoigiao->getOriginal();
        $this->assertIsArray($arrAssert);
    }
    
}
