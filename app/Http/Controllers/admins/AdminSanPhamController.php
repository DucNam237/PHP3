<?php

namespace App\Http\Controllers\admins;

use PDOException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Http\Requests\SanPhamRequest;

class AdminSanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listSanPham = DB::table('san_phams')->orderByDesc('id')->paginate(10);
        // dd($listSanPham);
        if ($key = request()->key) {
            $listSanPham = DB::table('san_phams')->orderByDesc('id')->where('ten_san_pham', 'like', '%' . $key . '%')->paginate(2);
            $listSanPham = DB::table('san_phams')->orderByDesc('id')->where('ma_san_pham', 'like', '%' . $key . '%')->paginate(2);
            $listSanPham = DB::table('san_phams')->orderByDesc('id')->where('trang_thai', '=', $key)->paginate(1);
        }
        return view('admins.sanphams.index', compact('listSanPham'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.sanphams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SanPhamRequest $request)
    {

        DB::beginTransaction();
        try {
            //Xử lý hình ảnh
            $filePath = null;
            if($request->hasFile('hinh_anh')){
                $filePath = $request->file('hinh_anh')->store('upload/sanpham','public');
            }

            //Xử lý thêm dữ liệu
            $dataSanPham = [
                'ma_san_pham'       =>  $request->input('ma_san_pham'),
                'ten_san_pham'      =>  $request->input('ten_san_pham'),
                'gia'               =>  $request->input('gia'),
                'gia_khuyen_mai'    =>  $request->input('gia_khuyen_mai'),
                'so_luong'          =>  $request->input('so_luong'),
                'ngay_nhap'         =>  $request->input('ngay_nhap'),
                'mo_ta'             =>  $request->input('mo_ta'),
                'hinh_anh'          =>  $filePath,
                'trang_thai'        =>  $request->input('trang_thai'),
                'created_at'        =>  now(),
                'updated_at'        =>  null,
            ];
        
            DB::table('san_phams')->insert($dataSanPham);

            DB::commit();

            // Chuyển hướng về trang danh sách hiển thị thông báo
            return redirect()->route('sanphams.index')
                            ->with('success','Thêm sản phẩm thành công');
        } catch (PDOException $e) {
            DB::rollBack();
            return redirect()->route('sanphams.index')
                            ->with('error','Có lỗi thử lại sau');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
