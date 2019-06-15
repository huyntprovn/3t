<?php

namespace App\Http\Controllers;

use App\DonHang;
use App\Http\Transformers\NguoiGiaoTransformer;
use App\NguoiGiao;
use Illuminate\Http\Request;

/**
 * Class ApiMobile
 * @package App\Http\Controllers
 * @version 1
 */
class ApiMobile extends BaseController
{
    public function getNguoiGiao($id = 0)
    {
        if ($id) {
            $nguoigiao = NguoiGiao::findOrFail($id);
            return $this->response->array($nguoigiao->toArray());
        }
        $nguoigiaos = NguoiGiao::query()->paginate(2);
        return $this->response->paginator($nguoigiaos, new NguoiGiaoTransformer);
    }

    public function getDonHangForNguoiGiao($nguoigiao_id = 0)
    {
        if ($nguoigiao_id) {
            $nguoigiaos = NguoiGiao::query()->where('id', $nguoigiao_id)->get();
            return $this->response->array($nguoigiaos->toArray());
        }
        return DonHang::all();
    }

    public function changeStatusDonHang($donhang_id = 0)
    {
        if ($donhang_id) {
            /**
             * @var DonHang $donghang_update
             */
            $donghang_update = DonHang::find($donhang_id);
            $donghang_update->trangThai = ($donghang_update->trangThai==0)? 1 : 0;
            $donghang_update->save();
            return $this->response->noContent()->setStatusCode(200);
        }
        return $this->response->noContent()->setStatusCode(402);

    }
}
