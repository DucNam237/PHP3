<?php

namespace App\Http\Controllers\admins;

use PDOException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Http\Requests\SanPhamRequest;
use Illuminate\Support\Facades\Storage;

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
            if ($request->hasFile('hinh_anh')) {
                $filePath = $request->file('hinh_anh')->store('upload/sanpham', 'public');
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
                ->with('success', 'Thêm sản phẩm thành công');
        } catch (PDOException $e) {
            DB::rollBack();
            return redirect()->route('sanphams.index')
                ->with('error', 'Có lỗi thử lại sau');
        }
    }

   
    public function show(string $id)
    {
        $sanPham = DB::table('san_phams')->find($id);
        if (!$sanPham) {
            return redirect()->route('sanphams.index')
                             ->with('error', 'Sản phẩm không tồn tại');
        }

        //Hiển thị giao diện sửa dữ liệu
        return view('admins.sanphams.show', compact('sanPham'));
    }

    
    public function edit(string $id)
    {
        //Lấy ra dữ liệu cho sp cần sửa
        $sanPham = DB::table('san_phams')->find($id);
        if (!$sanPham) {
            return redirect()->route('sanphams.index')
                             ->with('error', 'Sản phẩm không tồn tại');
        }

        //Hiển thị giao diện sửa dữ liệu
        return view('admins.sanphams.edit', compact('sanPham'));
    }

    
    public function update(SanPhamRequest $request, string $id)
    {
        DB::beginTransaction();

        try {
            
            //Lấy lại thông tin sản phẩm cần sửa
            $sanPham = DB::table('san_phams')->find($id);
            if (!$sanPham) {
                return redirect()->route('sanphams.index')
                                 ->with('error', 'Sản phẩm không tồn tại');
            }

            //Xử lý hình ảnh
            $filePath = $sanPham->hinh_anh;             //giữ nguyên hình ảnh cũ nếu có
            if ($request->hasFile('hinh_anh')) {
                $filePath = $request->file('hinh_anh')->store('upload/sanpham', 'public');

            //Xóa hình ảnh cũ nếu có hình ảnh mới đẩy lên
            if($sanPham->hinh_anh && Storage::disk('public')->exists($sanPham->hinh_anh)){
                Storage::disk('public')->delete($sanPham->hinh_anh);
                }
            }

            //Xử lý thêm dữ liệu
            $dataSanPham = [
                'ten_san_pham'      =>  $request->input('ten_san_pham'),
                'gia'               =>  $request->input('gia'),
                'gia_khuyen_mai'    =>  $request->input('gia_khuyen_mai'),
                'so_luong'          =>  $request->input('so_luong'),
                'ngay_nhap'         =>  $request->input('ngay_nhap'),
                'mo_ta'             =>  $request->input('mo_ta'),
                'hinh_anh'          =>  $filePath,
                'trang_thai'        =>  $request->input('trang_thai'),
                'updated_at'        =>  now(),
            ];
            
            dd($dataSanPham);
            DB::table('san_phams')->where('id',$id)->update($dataSanPham);

            DB::commit();

            // Chuyển hướng về trang danh sách hiển thị thông báo
            return redirect()->route('sanphams.index')
                ->with('success', 'Cập nhật sản phẩm thành công');
        } catch (PDOException $e) {
            DB::rollBack();

            return redirect()->route('sanphams.index')
                ->with('error', 'Cập nhật thất bại');
        }
    }

  

    public function destroy(string $id)
    {
       
            
            //Lấy lại thông tin sản phẩm cần xóa
            $sanPham = DB::table('san_phams')->find($id);
            if (!$sanPham) {
                return redirect()->route('sanphams.index')
                                 ->with('error', 'Sản phẩm không tồn tại');
            }

            //Xử lý hình ảnh
            $filePath = $sanPham->hinh_anh;             //giữ nguyên hình ảnh cũ nếu có 
            $deleteSanPham = DB::table('san_phams')->where('id',$id)->delete();

            //Nếu xóa thành công thì xóa ảnh
            if($deleteSanPham){
                if(isset($filePath) && Storage::disk('public')->exists($filePath)){
                    Storage::disk('public')->delete($filePath);
                }

                return redirect()->route('sanphams.index')
                                 ->with('success','Xóa sản phẩm thành công');                                               
            }

                return redirect()->route('sanphams.index')
                                 ->with('error','Có lỗi xảy ra khi xóa sản phẩm. Vui lòng thử lại sai !');
    }
}
