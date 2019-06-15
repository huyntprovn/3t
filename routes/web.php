<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**
 * api route
 */
use Dingo\Api\Routing\Router as ApiRouter;
use App\Http\Controllers\ApiMobile;


$api = app(ApiRouter::class);
$api->version('v1', function ($api) {
    /**
     *@var  ApiRouter $api
     */
    $api->get('nguoigiao/{id?}', 'App\Http\Controllers\ApiMobile@getNguoiGiao');
    $api->get('change-status-donhang/{donhang_id?}', 'App\Http\Controllers\ApiMobile@changeStatusDonHang');
    $api->get('donhang-nguoigiao/{nguoigiao_id?}', 'App\Http\Controllers\ApiMobile@getDonHangForNguoiGiao');
});

/**
 * main route
 */
use TCG\Voyager\Voyager;
use App\Http\Controllers\ImageUploadController;
Route::get('/test/{nguoigiao}', function (\App\NguoiGiao $nguoigiao) {
    return $nguoigiao->toArray();
});
Route::get('/core/ticker/loadList',[\App\Http\Controllers\TokerController::class,"index"])->name('toker.list.index');

Route::get('image-upload', [ImageUploadController::class,'imageUpload'])->name('image.upload');
Route::post('image-upload', [ImageUploadController::class,'imageUploadPost'])->name('image.upload.post');

//Route::group(['prefix' => 'admin'], function () {
//    (new Voyager())->routes();
//});
