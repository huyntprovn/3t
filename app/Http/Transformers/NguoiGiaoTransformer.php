<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;

class NguoiGiaoTransformer extends TransformerAbstract {

    public function transform(\Illuminate\Database\Eloquent\Model $item) {
//        return $item->getOriginal();
        return [
          'name' => $item->name,
          'info' => $item->info,
        ];
    }

}
