<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    //Danh sách
    public function index()
    {
        return view('admins.list');
    }

    //Thêm sản phẩm
    public function create()
    {
        return view('admins.create');
    }

    //Sửa sản phẩm
    public function edit($id)
    {
        return view('admins.edit');
    }
}
