<?php

namespace App\Http\Controllers;

use App\Imports\DonHangImport;
use App\TokenRecordGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Maatwebsite\Excel\Facades\Excel;
use Memcached;

class TokerController extends Controller
{
    public function index(){
//    public function voyagerIndex(){
        return view('vendor.voyager-frontend.layouts.default');
    }
    public function memcache()
    {
        $memcache = new Memcached;
        $memcache->addServer('localhost', 11211) or die ("Could not connect");
        $memcache->set('k', 'ok');
        $user = $memcache->get('k');
        return view('linkhay.toker.list', ['user' => $user]);
    }

    public function index3(Request $request)
    {
        if ($request->post('excell_name')) {
            dd($request->excell_name);
            $excell_name = $request->input('excell_name');
            Excel::import(new DonHangImport(), $excell_name);
            return redirect('/')->with('success', 'All good!');
        }
        return view('excell_name');
    }

    public function redis()
    {
//        $redis = Redis::connection();
//        $redis->set('redis-key2','redis-connection');
//        echo "res-connection ".$redis->get('redis-key2');
//        echo "############";
        Cache::store("redis")->put('redis-key2', 'redis-l');
        echo "res-laravel ";
        echo Cache::store("redis")->get('redis-key2');
//        Cache::store('redis')->flush();

//        return view('linkhay.toker.list',['user' => $user]);
    }

}
