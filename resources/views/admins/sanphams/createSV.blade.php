{{-- Để kế thừa lại master layout ta sử dụng extends --}}
@extends('layouts.admin')
{{-- Một file chỉ được kế thừa 1 master layout --}}

@section('title')
    Quản lý sinh viên
@endsection

@section('CSS')
@endsection

{{-- @section: dùng để chị định phần nội dụng được hiển thị --}}
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Quản lý sinh viên</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                            <li class="breadcrumb-item active">Thêm mới sinh viên</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col">

                <div class="h-100">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Thêm mới sinh viên</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{ route('sanphams.store') }}" method="POST" enctype="multipart/form-data">
                                    {{-- Khi sử dụng form trong laravel bắt buộc phải có @csrf --}}
                                    @csrf

                                    <div class="row gy-4">
                                        <div class="col-md-4">
                                            <div class="mt-3">
                                                <label for="ma_san_pham" class="form-label">Mã sinh viên</label>
                                                <input type="text" class="form-control"  name="ma_san_pham" 
                                                    id="ma_san_pham" value="{{ strtoupper(Str::random('10')) }}" readonly>
                                            </div>

                                            <div class="mt-3">
                                                <label for="ten_san_pham" class="form-label">Tên sinh viên</label>
                                                <input type="text" class="form-control @error('ten_san_pham') is-invalid @enderror" name="ten_san_pham" id="ten_san_pham" placeholder="Nhập tên sinh viên" 
                                                
                                                    value="{{ old('ten_san_pham') }}">
                                                @error('ten_san_pham')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            

                                            <div class="mt-3">
                                                <label for="ngay_sinh" class="form-label">Ngày sinh</label>
                                                <input type="date" class="form-control @error('') is-invalid @enderror" name="ngay_sinh" id="ngay_sinh" 
                                             value="{{ old('ngay_sinh') }}">
                                            @error('ngay_sinh')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            </div>
                                            
                                            <div class="mt-3">
                                                <label for="so_dien_thoai" class="form-label">Số ddienj thoại</label>
                                                <input type="text" class="form-control @error('so_dien_thoai') is-invalid @enderror" name="so_dien_thoai" id="so_dien_thoai" placeholder="Nhập tên sinh viên" 
                                                
                                                    value="{{ old('so_dien_thoai') }}">
                                                @error('so_dien_thoai')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>


                                        </div>

                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="mt-3">
                                                    <label for="hinh_anh" class="form-label">Hình ảnh</label>
                                                    <input type="file" class="form-control @error('hinh_anh') is-invalid @enderror" name="hinh_anh" id="hinh_anh" 
                                                 value="{{ old('hinh_anh') }}">
                                                @error('hinh_anh')
                                                        <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                                </div>


                                            

                                                <div class="mt-3">
                                                    <label for="trang_thai" class="form-label">Trạng thái</label>
                                                    <div>
                                                        <input type="radio" name="trang_thai" id="trang_thai_hien_thi"
                                                            value="1" class="form-check-input">
                                                        <label for="trang_thai_hien_thi" class="form-check-label">
                                                            Hiển thị
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <input type="radio" name="trang_thai"
                                                            id="trang_thai_khong_hien_thi" value="0"
                                                            class="form-check-input">
                                                        <label for="trang_thai_khong_hien_thi" class="form-check-label">
                                                            Không hiển thị
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="mt-3 text-center">
                                                    <button class="btn btn-primary" type="submit">Thêm mới</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!--end col-->
                            </div>
                        </div>

                    </div><!-- end card-body -->
                </div><!-- end card -->

            </div> <!-- end .h-100-->

        </div> <!-- end col -->
    </div>

    </div>
@endsection

@section('JS')
    <script src="https:////cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('so_dien_thoai');
    </script>
@endsection