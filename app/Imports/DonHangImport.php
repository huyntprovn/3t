<?php

namespace App\Imports;

use App\DonHang;
use Maatwebsite\Excel\Concerns\ToModel;

class DonHangImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DonHang([
            'stt' => $row[0],
            'NguoiNhan' => $row[1],
            'sdt' => $row[2],
            'DiaChi' => $row[3],
        ]);
    }
}
