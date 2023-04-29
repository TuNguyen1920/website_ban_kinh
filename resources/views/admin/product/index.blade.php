@extends('admin.layouts.main')
@section('title', '')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Thuộc tính</a></li>
                        <li class="breadcrumb-item active">Danh sách</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h3 class="card-title">From tìm kiếm</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="">
                            <div class="row">
                                <div class="col-sm-12 col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="pro_name" class="form-control mg-r-15" placeholder="Tên sản phẩm">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <div class="form-group">
                                        <select class="custom-select" name="pro_category_id">
                                            <option value="">Chọn danh mục</option>
                                            @foreach($categories as $category)
                                                @if (isset($category->children) && count($category->children) > 0)
                                                    <optgroup label="{{ $category->c_name }}">
                                                        @foreach($category->children as $children)
                                                            <option value="{{$children->id}}">
                                                                {{$children->c_name}}
                                                            </option>
                                                        @endforeach
                                                    </optgroup>
                                                @else
                                                    <option value="{{$category->id}}">
                                                        {{$category->c_name}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-success " style="margin-right: 10px"><i class="fas fa-search"></i> Tìm kiếm </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                <div class="btn-group">
                                    <a href="{{ route('product.create') }}"><button type="button" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Tạo mới</button></a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th width="4%" class=" text-center">STT</th>
                                        <th>Ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Danh mục</th>
                                        <th>Nhãn hiệu</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Đã bán</th>
                                        <th class=" text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$products->isEmpty())
                                        @php $i = $products->firstItem(); @endphp
                                        @foreach($products as $product)
                                            <tr>
                                                <td class=" text-center" style="vertical-align: middle;">{{ $i }}</td>
                                                <td style="vertical-align: middle;">
                                                    <div class="product-img">
                                                        <img src="{{ !empty($product->pro_avatar) ? asset(pare_url_file($product->pro_avatar)) : asset('admin/dist/img/no-image.png') }}" alt="Product Image" class="img-size-50">
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">{{ $product->pro_name }}</td>
                                                <td style="vertical-align: middle;">{{ isset($product->category) ? $product->category->c_name : '' }}</td>
                                                <td style="vertical-align: middle;">{{ isset($product->trademark) ? $product->trademark->td_name : '' }}</td>
                                                <td style="vertical-align: middle;">
                                                    @if ($product->pro_sale)
                                                        <span style="text-decoration: line-through;">{{ number_format($product->pro_price,0,',','.') }} vnđ</span><br>
                                                        @php
                                                            $price = ((100 - $product->pro_sale) * $product->pro_price)  /  100 ;
                                                        @endphp
                                                        <span>{{ number_format($price,0,',','.') }} vnđ</span>
                                                    @else
                                                        {{ number_format($product->pro_price,0,',','.') }} vnđ
                                                    @endif
                                                </td>
                                                <td  style="vertical-align: middle;">
                                                    {{ $product->pro_number > 0 ? $product->pro_number : 'Hết hàng' }}
                                                </td>
                                                <td  style="vertical-align: middle;">
                                                    {{ $product->pro_pay }}
                                                </td>
                                                <td class="text-center" style="vertical-align: middle;">
                                                    <a class="btn btn-primary btn-sm" href="{{ route('product.update', $product->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm btn-delete btn-confirm-delete" href="{{ route('product.delete', $product->id) }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @php $i++ @endphp
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if($products->hasPages())
                                <div class="pagination float-right margin-20">
                                    {{ $products->appends($query = '')->links() }}
                                </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@stop
