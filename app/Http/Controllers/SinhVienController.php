<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SinhVienController extends Controller
{
    public function index(){
        $listSinhVien = DB::table('sinhviens')->orderByDesc('id')->paginate(10);
        if ($key = request()->key) {
            $listSanPham = DB::table('sinhviens')->orderByDesc('id')->where('ten_sinh_vien', 'like', '%' . $key . '%')->paginate(2);
            $listSanPham = DB::table('sinhviens')->orderByDesc('id')->where('ma_sinh_vien', 'like', '%' . $key . '%')->paginate(2);
        }
        return view('admins.sanphams.listSV', compact('listSinhVien'));
    }

    // public function create(){
    //     return view('admins.sanphams.createSV');
    // }

    // public function store(){
    //     DB::table('sinhviens')->insert();

    //         DB::commit();
    // }
} 
