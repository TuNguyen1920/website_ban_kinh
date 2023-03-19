@extends('page.layouts.page')
@section('title', 'Danh sách đơn hàng')
@section('style')
@stop
@section('content')
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('page/images/bg-02.jpg') }}');">
        <h2 class="ltext-105 cl0 txt-center">
            Danh sách đơn hàng
        </h2>
    </section>

    <section class="bg0 p-t-62 p-b-40">
        <div class="container">
            <div class="row">
                @include('page.common.sidebarAccount')
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="p-r-45 p-r-0-lg">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-hover text-nowrap table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="4%" class=" text-center">STT</th>
                                        <th>Sản phẩm</th>
                                        <th class=" text-center">Số lượng</th>
                                        <th>Giá tiền</th>
                                        <th>Tổng tiền</th>
                                        <th class=" text-center">Thời gian</th>
                                        <th class=" text-center">Trạng thái</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if (isset($products))
                                        <?php $total = 0; ?>
                                        @foreach($products as $key => $product)
                                            @if ($product->pc_qty > 0)
                                                <tr>
                                                    <td style="vertical-align: middle;">{{ $key + 1 }}</td>
                                                    <td style="vertical-align: middle;">
                                                        {{$product->pc_name}}
                                                        <ul class="list-invoice">
                                                            @if ($product->pc_color)
                                                                <li>Color : {{ $product->pc_color}}</li>
                                                            @endif
                                                            @if ($product->pc_size)
                                                                <li>Size : {{ $product->pc_size}}</li>
                                                            @endif
                                                        </ul>
                                                    </td>
                                                    <td style="vertical-align: middle;">{{ $product->pc_qty }}</td>
                                                    <td style="vertical-align: middle;">
                                                        <?php
                                                        if ($product->pc_sale) {
                                                            $price = ((100 - $product->pc_sale) * $product->pc_price)  /  100 ;
                                                        } else {
                                                            $price = $product->pc_price;
                                                        }
                                                        $total = $total + (intval($product->pc_qty) * $price);
                                                        ?>
                                                        {{ number_format($price,0,',','.') }} vnđ
                                                    </td>
                                                    <td style="vertical-align: middle;">{{ number_format($product->pc_qty * $price,0,',','.') }} vnđ</td>
                                                    <td style="vertical-align: middle;">{{ $product->created_at }}</td>
                                                    <td style="vertical-align: middle;">
                                                        @if($product->pc_status != 1)
                                                            <button type="button" class="btn btn-block {{ $classStatus[$product->pc_status] }} btn-sm btn-status-order">{{ $status[$product->pc_status]  }}</button>
                                                        @endif
                                                        @if($product->pc_status == 1)
                                                            <a class="btn btn-block btn-danger btn-sm btn-cancel-order" href="{{ route('post.cancel.order', $product->id) }}" >Hủy</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('script')
@stop
