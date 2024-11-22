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
                                <li class="breadcrumb-item active">Danh sách sinh viên</li>
                            </ol>
                        </div>  

                    </div>
            
                    <form action="" class="form-inline" role="form">
                        <div class="form-group col-3">
                            <input type="text" class="form-control" name="key" placeholder="Tìm kiếm ...">                   
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i>Tìm kiếm
                        </button>
                    </form>
            <hr>

                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col">

                    <div class="h-100">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Danh sách sinh viên</h4>
                                <a href="{{ route('sinhviens.create') }}" class="btn btn-soft-success material-shadow-none">
                                    <i class="ri-add-circle-line align-middle me-1"></i>
                                    Thêm sinh viên
                                </a>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="live-preview">
                                    <div class="table-responsive">
                                        @if (session("success"))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session("success") }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            @if (session("error"))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session("error") }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                                        
                                        <table class="table table-striped table-nowrap align-middle mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">STT</th>
                                                    <th scope="col">Mã sinh viên</th>
                                                    <th scope="col">Hình ảnh</th>
                                                    <th scope="col">Tên sinh viên</th>
                                                    <th scope="col">Ngày sinh</th>
                                                    <th scope="col">Số điện thoại</th>
                                                    <th scope="col">Trạng thái</th>
                                                    <th scope="col">Chức năng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($listSV as $index => $item)
                                                    <tr>
                                                        <td>{{ $index + 1}}</td>
                                                        <td>{{ $item->ma_sinh_vien }}</td>
                                                        <td> 
                                                            <img src="{{ Storage::url($item->hinh_anh) }}" alt="" class="img-thumbnail" width="150px" height="150px">
                                                         </td>
                                                        <td>{{ $item->ten_sinh_vien }}</td>
                                                        <td>{{ $item->ngay_sinh }}</td>
                                                        <td>{{ $item->so_dien_thoai }}</td>
                                                        
                                                        <td>
                                                            {{-- {{ $item->trang_thai}} --}}
                                                            @if ($item->trang_thai == 1)
                                                                <span class="badge bg-success-subtle text-success text-uppercase">Còn hàng</span>
                                                            @else
                                                                <span class="badge bg-danger-subtle text-success text-uppercase">Hết hàng</span>                                                           
                                                            @endif
                                                        
                                                        </td>
                                                        <td>
                                                            <a href="{{route('sinhviens.show', $item->id)}}" class="btn btn-sm btn-primary">Xem</a>

                                                            <a href="{{route('sinhviens.edit', $item->id)}}" class="btn btn-sm btn-warning">Sửa</a>

                                                            <form action="{{route('sinhviens.destroy', $item->id)}}" method="POST" 
                                                                onclick="return confirm('Xác nhận xóa sinh viên')" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">Xóa</button>    
                                                            </form>  

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            
                                            </tbody>
                                        </table>
                                        <div class="mt-3">
                                            {{$listSV->links("pagination::bootstrap-5")}}  
                                        </div>
                                        
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
    @endsection