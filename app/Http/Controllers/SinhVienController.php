<?php

namespace App\Http\Controllers;

use PDOException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Http\Controllers\Controller;
use App\Http\Requests\SinhVienRequest;
use Illuminate\Support\Facades\Storage;

class SinhVienController extends Controller
{
    public function index()
    {
        $listSV = DB::table('sinh_viens')->orderByDesc('id')->paginate('10');
        return view('admins.sinhviens.index', compact('listSV'));
    }


    public function create()
    {
        return view('admins.sinhviens.create');
    }

    public function store(SinhVienRequest $request)
    {

        DB::beginTransaction();
        try {
            //Xử lý hình ảnh
            $filePath = null;
            if ($request->hasFile('hinh_anh')) {
                $filePath = $request->file('hinh_anh')->store('upload/sinhVien', 'public');
            }

            //Xử lý thêm dữ liệu
            $dataSinhVien = [
                'ma_sinh_vien'       =>  $request->input('ma_sinh_vien'),
                'ten_sinh_vien'     =>  $request->input('ten_sinh_vien'),
                'ngay_sinh'         =>  $request->input('ngay_sinh'),
                'so_dien_thoai'     =>  $request->input('so_dien_thoai'),
                'hinh_anh'          =>  $filePath,
                'trang_thai'        =>  $request->input('trang_thai'),
                'created_at'        =>  now(),
                'updated_at'        =>  null,
            ];

            DB::table('sinh_viens')->insert($dataSinhVien);

            DB::commit();

            // Chuyển hướng về trang danh sách hiển thị thông báo
            return redirect()->route('sinhviens.index')
                ->with('success', 'Thêm sinh viên thành công');
        } catch (PDOException $e) {
            DB::rollBack();
            return redirect()->route('sinhviens.index')
                ->with('error', 'Có lỗi thử lại sau');
        }
    }

    public function show(string $id)
    {
        $sinhVien = DB::table('sinh_viens')->find($id);
        if (!$sinhVien) {
            return redirect()->route('sinhviens.index')
                ->with('error', 'Sinh viên không tồn tại');
        }

        //Hiển thị giao diện sửa dữ liệu
        return view('admins.sinhviens.show', compact('sinhVien'));
    }



    public function edit(string $id)
{
    $sinhVien = DB::table('sinh_viens')->find($id); // Correct table name
    if (!$sinhVien) {
        return redirect()->route('sinhviens.index')
            ->with('error', 'Sinh viên không tồn tại'); // Fix message
    }

    return view('admins.sinhviens.edit', compact('sinhVien'));
}

public function update(SinhVienRequest $request, string $id)
{
    DB::beginTransaction();

    try {
        $sinhVien = DB::table('sinh_viens')->find($id);
        if (!$sinhVien) {
            return redirect()->route('sinhviens.index')
                ->with('error', 'Sinh viên không tồn tại');
        }

        $filePath = $sinhVien->hinh_anh;
        if ($request->hasFile('hinh_anh')) {
            $filePath = $request->file('hinh_anh')->store('upload/sinhVien', 'public');
            if ($sinhVien->hinh_anh && Storage::disk('public')->exists($sinhVien->hinh_anh)) {
                Storage::disk('public')->delete($sinhVien->hinh_anh);
            }
        }

        $dataSinhVien = [
            'ma_sinh_vien'          => $request->input('ma_sinh_vien'),
            'ten_sinh_vien'         => $request->input('ten_sinh_vien'),
            'ngay_sinh'             => $request->input('ngay_sinh'),
            'so_dien_thoai'         => $request->input('so_dien_thoai'),
            'hinh_anh'              => $filePath,
            'trang_thai'            => $request->input('trang_thai'),
            'updated_at'            => now(), 
        ];

        dd($dataSinhVien);

        DB::table('sinh_viens')->where('id', $id)->update($dataSinhVien);

        DB::commit();
        return redirect()->route('sinhviens.index') 
            ->with('success', 'Cập nhật sinh viên thành công');
    } catch (PDOException $e) {
        DB::rollBack();
        return redirect()->route('sinhviens.index')
            ->with('error', 'Cập nhật thất bại');
    }
}


public function destroy(string $id)
    {
       
            
            //Lấy lại thông tin sinh viên cần xóa
            $sinhVien = DB::table('sinh_viens')->find($id);
            if (!$sinhVien) {
                return redirect()->route('sinhviens.index')
                                 ->with('error', 'sinh viên không tồn tại');
            }

            //Xử lý hình ảnh
            $filePath = $sinhVien->hinh_anh;             //giữ nguyên hình ảnh cũ nếu có 
            $deletesinhVien = DB::table('sinh_viens')->where('id',$id)->delete();

            //Nếu xóa thành công thì xóa ảnh
            if($deletesinhVien){
                if(isset($filePath) && Storage::disk('public')->exists($filePath)){
                    Storage::disk('public')->delete($filePath);
                }

                return redirect()->route('sinhviens.index')
                                 ->with('success','Xóa sinh viên thành công');                                               
            }

                return redirect()->route('sinhviens.index')
                                 ->with('error','Có lỗi xảy ra khi xóa sinh viên. Vui lòng thử lại sai !');
    }

}
