<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuoiHoc4Controller extends Controller
{
    public function xinChao($a,$b){
        echo "Xin chào bahi";
        
        $tong = $a + $b;
        $title = "Trung Kính";
        $des   = 'abc';
        //Hiển thị views trong controller
        return view('buoi4',compact('b','a','tong'));

        //Tạo 1 route trỏ đến 1 hàm tính tổng
        // Truyền 2 số lên URL
        // Trong hàm tính tổng thực hiện tính giá trị và hiển thị 
    }
}
