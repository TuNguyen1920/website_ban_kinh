@extends('page.layouts.page')
@section('title', 'Giỏ hàng')
@section('style')
@stop
@section('content')
<form class="bg0 p-t-75 p-b-85">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-8 m-lr-auto m-b-50">
                <div class="m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tbody>
                                <tr class="table_head">
                                    <th class="column-1">Sản phẩm</th>
                                    <th class="column-2"></th>
                                    <th class="column-3 text-center">Giá</th>
                                    <th class="column-4 text-center">Số lượng</th>
                                    <th class="column-5 text-center">Tổng tiền</th>
                                    <th class="column-1 text-center">Xóa</th>
                                </tr>
                                @if (isset($cart->productCart))
                                <?php $total = 0; ?>
                                @foreach($cart->productCart as $product)
                                <tr class="table_row delete_product_{{ $product->id }}">
                                    <td class="column-1">
                                        <div class="how-itemcart1">
                                            <img src="{{ !empty($product->options) ? asset(pare_url_file($product->options)) : asset('admin/dist/img/no-image.png') }}" alt="IMG">
                                        </div>
                                    </td>
                                    <td class="column-2">
                                        {{$product->pc_name}}
                                        <span class="header-cart-item-info">
                                            Color : {{ $product->pc_color}}
                                        </span>
                                        <!-- <span class="header-cart-item-info">
                                                        Size : {{ $product->pc_size}}
                                                    </span>
                                                    <span class="header-cart-item-info">
                                                        Áo hoặc bộ : {{ $product->pc_clothes}}
                                                    </span> -->
                                    </td>
                                    <td class="column-3 text-center">
                                        <?php
                                        if ($product->pc_sale) {
                                            $price = ((100 - $product->pc_sale) * $product->pc_price)  /  100;
                                        } else {
                                            $price = $product->pc_price;
                                        }
                                        $total = $total + (intval($product->pc_qty) * $price);
                                        ?>
                                        {{ number_format($price,0,',','.') }} vnđ
                                    </td>
                                    <td class="column-4">
                                        <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                            <div class="cl8 hov-btn3 trans-04 flex-c-m btn-num-product-down-update" url="{{ route('update.product.cart', ['cartId' => $cart->id, 'productId' => $product->pc_product_id ]) }}" color="{{ $product->pc_color }}" size="{{ $product->pc_size}}" clothes="{{ $product->pc_clothes }}">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product1" value="{{ $product->pc_qty }}">

                                            <div class="cl8 hov-btn3 trans-04 flex-c-m btn-num-product-up-update" url="{{ route('update.product.cart', ['cartId' => $cart->id, 'productId' => $product->pc_product_id ]) }}" color="{{ $product->pc_color }}" size="{{ $product->pc_size}}" clothes="{{ $product->pc_clothes }}">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="column-5 text-center total_product_price_{{ $product->pc_product_id.'-'.safeTitle($product->pc_color).'-'.safeTitle($product->pc_size).'-'.safeTitle($product->pc_clothes) }}">{{ number_format($product->pc_qty * $price,0,',','.') }} vnđ</td>
                                    <td class="text-center">
                                        <a href="{{ route('delete.product.cart', $product->id) }}" class="delete-product-cart"><i class="fs-16 zmdi zmdi-delete icon-delete-product-cart"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-4 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-10 m-r-10 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Giỏ hàng
                    </h4>

                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Tạm tính:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2 total_cart">
                                {{ number_format($total, 0,',','.') }} vnđ
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('cart.payment') }}" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Thanh toán
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@stop
@section('script')
@stop