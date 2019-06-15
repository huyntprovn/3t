<?php

namespace App\Http\Controllers;

use App\Imports\DonHangImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImageUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function imageUpload()

    {
        return view('imageUpload');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function imageUploadPost()
    {
        request()->validate([
            'image' => 'required|file|mimes:xlsx|max:2048',
        ]);

        $imageName = time() . '.' . request()->image->getClientOriginalExtension();
        $excell_name = request()->image->store('');
        Excel::import(new DonHangImport(), $excell_name);

        return back()
            ->with('success', 'All good!')
            ->with('image', $imageName);

    }
}
