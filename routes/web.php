<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\BuoiHoc4Controller;
use App\Http\Controllers\BuoiHoc5Controller;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\admins\AdminSanPhamController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Routing trong Laravel là chức năng khai báo các đường dẫn để đưa người dùng đến các chức năng có trên hệ thôngs
// Mỗi 1 route chỉ sử dụng để trỏ -> 1 chức năng cụ thể

// Loại 1 : route nạp trực tiếp views
// Route::view('/buoi4_1','buoi4',[
//     'title' => "Chào mừng bahi",
//     'des' => "8386"
// ]);

// // Loại 2 : Sử dụng views thông qua controller (thường dùng)
// Route::get('buoi4_2/{a}/{b}', [BuoiHoc4Controller::class,'xinChao']);
// Route::get('admins/buoi5',    [BuoiHoc5Controller::class,'buoiHoc5']);



// Route::get('admins/list',     [SanPhamController::class,'index']);

// Route::get('admins/edit/{id}',[SanPhamController::class,'edit']);

Route::resource('sanphams',                   AdminSanPhamController::class);
Route::resource('sinhviens',                  SinhVienController::class);