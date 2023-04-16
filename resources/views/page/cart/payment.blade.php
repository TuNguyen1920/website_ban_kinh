@extends('page.layouts.page')
@section('title', 'Giới thiệu về chúng tôi')
@section('style')
@stop
@section('content')
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('page/images/f2.jpg') }}');">
    <h2 class="ltext-105 cl0 txt-center">
        Thanh toán
    </h2>
</section>
<section class="bg0 p-t-104 p-b-116">
    <div class="container">
        <form action="{{ route('post.payment') }}" method="POST" class="form_payment" data-url="{{ route('ajax.post.load.location') }}">
            <div class="row">
                @csrf
                <?php
                if (Auth::guard('users')->check()) {
                    $user = Auth::guard('users')->user();
                }
                ?>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <h3 class="mtext-111 cl2 p-b-16 text-info-payment">
                        Thông tin nhận hàng
                        @if (!Auth::guard('users')->check())
                        <a href="{{ route('page.user.account') }}" class="link-login"><i class="icon-header-item zmdi zmdi-account-circle zmd-fw icon-header-item-pay"></i> Đăng nhập</a>
                        @endif
                    </h3>
                    <div class="bor19 m-b-20">
                        <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="email" name="email" placeholder="Email của bạn*" value="{{ isset($user) ? $user->email : '' }}" required>
                    </div>
                    @if ($errors->first('email'))
                    <p class="text-danger m-b-20">{{ $errors->first('email') }}</p>
                    @endif
                    <div class="bor19 m-b-20">
                        <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="name" placeholder="Họ và tên *" value="{{ isset($user) ? $user->name : '' }}" required>
                    </div>
                    @if ($errors->first('name'))
                    <p class="text-danger m-b-20">{{ $errors->first('name') }}</p>
                    @endif
                    <div class="bor19 m-b-30">
                        <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="phone" placeholder="Số điện thoại *" value="{{ isset($user) ? $user->phone : '' }}" required>
                    </div>
                    @if ($errors->first('phone'))
                    <p class="text-danger m-b-20">{{ $errors->first('phone') }}</p>
                    @endif
                    <div class="bor19 m-b-30">
                        <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="address" placeholder="Địa chỉ *" value="{{ isset($user) ? $user->address : '' }}" required>
                    </div>
                    @if ($errors->first('address'))
                    <p class="text-danger m-b-20">{{ $errors->first('address') }}</p>
                    @endif
                    <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                        <select class="js-select2 address required" name="city_id" data-type="district" required>
                            <option value="">Chọn tỉnh / TP</option>
                            @if (isset($citys) && !empty($citys))
                            @foreach($citys as $city)
                            <option value="{{ $city->id }}">{{ $city->loc_name }}</option>
                            @endforeach
                            @endif
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                    <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                        <select class="js-select2 address district required" name="district_id" data-type="street" required>
                            <option value="">Chọn Quận / huyện</option>
                            @if (isset($district) && !empty($district))
                            @foreach($district as $di)
                            <option value="{{ $di->id }}">{{ $di->loc_name }}</option>
                            @endforeach
                            @endif
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                    <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                        <select class="js-select2 address street required" name="street_id" required>
                            <option value="">Chọn Xã / Phường</option>
                            @if (isset($street) && !empty($street))
                            @foreach($street as $st)
                            <option value="{{ $st->id }}">{{ $st->loc_name }}</option>
                            @endforeach
                            @endif
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                    <div class="bor19 m-b-20">
                        <textarea class="stext-111 cl2 plh3 size-124 p-lr-18 p-tb-15" name="note" placeholder="Ghi chú (tùy chọn)..."></textarea>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    {{--<h3 class="mtext-111 cl2 p-b-16 text-info-payment">--}}
                    {{--Vận chuyển--}}
                    {{--</h3>--}}
                    {{--<div class="content-box">--}}
                    {{--<div class="content-box__row">--}}
                    {{--<div class="radio-wrapper">--}}
                    {{--<div class="radio__input">--}}
                    {{--<input type="radio" class="input-radio" name="shippingMethod" id="shippingMethod-584082_0" value="35.000 VND">--}}
                    {{--</div>--}}
                    {{--<label class="radio__label">--}}
                    {{--<span class="radio__label__primary">Giao hàng tận nơi</span>--}}
                    {{--<span class="radio__label__accessory">--}}
                    {{--<span class="content-box__emphasis">--}}
                    {{--35.000₫--}}
                    {{--</span>--}}
                    {{--</span>--}}
                    {{--</label>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    {{--</div>--}}
                    <h3 class="mtext-111 cl2 p-b-16 text-info-payment">
                        Vận chuyển
                        <div class="flex-w flex-sb-m transport">
                            <lable class="stext-113 cl6">
                                <input type="radio" checked class="radio-transport"> Giao hàng tận nơi <span style="float: right">20.000 vnd</span>
                            </lable>
                        </div>
                    </h3>
                    <h3 class="mtext-111 cl2 p-b-16 text-info-payment">
                        Thanh toán
                        <div class="flex-w flex-sb-m transport">
                            <div>
                                <lable for="cash_payment" class="stext-113 cl6">
                                    <input id="cash_payment" type="radio" checked class="radio-transport" value="1" name="payment_methods"> Trả tiền mặt khi nhận hàng
                                </lable>
                            </div>
                            <div class="flex-w flex-t bor12 p-b-13"></div>
                            <div style="margin-top: 15px">
                                <lable for="transfer_payments" class="stext-113 cl6">
                                    <input id="transfer_payments" type="radio" class="radio-transport" value="2" name="payment_methods"> Chuyển khoản ngân hàng
                                </lable>
                                <p class="stext-113 cl6" style="font-size: 13px;padding: 15px;">
                                    Thực hiện thanh toán vào ngay tài khoản ngân hàng của chúng tôi sau khi nhấn nút đặt hàng.
                                    Vui lòng sử dụng mã đơn hàng của bạn trong phàn nội dung thanh toán. Đơn hàng sẽ được giao sau khi tiền đã chuyển.
                                </p>
                            </div>
                        </div>
                    </h3>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <h4 class="mtext-109 cl2 ">
                        Đơn hàng
                    </h4>
                    <div class="flex-w flex-t bor12 p-b-13 mg-bt-10"></div>
                    @if (isset($cart))
                    <ul class="header-cart-wrapitem w-full">
                        @if (isset($cart->productCart))
                        <?php $total = 0; ?>
                        @foreach($cart->productCart as $product)
                        <li class="header-cart-item flex-w flex-t">
                            <div class="header-cart-item-img">
                                <img src="{{ !empty($product->options) ? asset(pare_url_file($product->options)) : asset('admin/dist/img/no-image.png') }}" alt="{{$product->pc_name}}">
                            </div>
                            <div class="header-cart-item-txt p-t-8">
                                <a href="{{ route('product.detail', ['id' => $product->pc_product_id , 'slug' => safeTitle($product->pc_name) ]) }}" class="header-cart-item-name hov-cl1 trans-04">
                                    {{$product->pc_name}}
                                </a>
                                <span class="header-cart-item-info">
                                    Color : {{ $product->pc_color}}
                                </span>
                                <span class="header-cart-item-info">
                                    Size : {{ $product->pc_size}}
                                </span>
                                <span class="header-cart-item-info">
                                    <?php
                                    if ($product->pc_sale) {
                                        $price = ((100 - $product->pc_sale) * $product->pc_price)  /  100;
                                    } else {
                                        $price = $product->pc_price;
                                    }
                                    $total = $total + intval($product->pc_qty) * $price;
                                    ?>
                                    {{ $product->pc_qty }} x {{ number_format($price,0,',','.') }} vnđ
                                </span>
                            </div>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                    <div class="flex-w flex-t bor12 p-b-13"></div>

                    {{--<div class="flex-w flex-m m-r-20 m-tb-5">--}}
                    {{--<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-tb-5" type="text" name="coupon" placeholder="Nhập mã giảm giá">--}}
                    {{--<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5" style="min-width: 110px; margin-left: 10px">--}}
                    {{--Áp dụng--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="flex-w flex-t bor12 p-b-13"></div>--}}
                    <div class="w-full">
                        <div class="header-cart-total w-full p-tb-40">
                            <div class="flex-w flex-t bor12 p-b-13">
                                <div class="size-208">
                                    <span class="stext-110 cl2">
                                        Tạm tính:
                                    </span>
                                </div>

                                <div class="size-209">
                                    <span class="mtext-110 cl2">
                                        {{ number_format($total, 0,',','.') }} vnđ
                                    </span>
                                </div>
                            </div>
                            <div class="flex-w flex-t bor12 p-b-13" style="margin-top: 15px;">
                                <div class="size-208">
                                    <span class="stext-110 cl2">
                                        Phí vận chuyển :
                                    </span>
                                </div>

                                <div class="size-209">
                                    <span class="mtext-110 cl2">
                                        <?php $transport = 20000; ?>
                                        {{ number_format($transport, 0,',','.') }} vnđ
                                    </span>
                                </div>
                            </div>
                            <div class="flex-w flex-t bor12 p-b-13" style="margin-top: 15px;">
                                <div class="size-208">
                                    <span class="stext-110 cl2">
                                        Thuế :
                                    </span>
                                </div>

                                <div class="size-209">
                                    <span class="mtext-110 cl2">
                                        {{ $total > 0 ? number_format(($total * 5 / 100), 0,',','.') : 0 }} vnđ
                                    </span>
                                </div>
                            </div>
                            <div class="flex-w flex-t p-t-27 p-b-33">
                                <div class="size-208">
                                    <span class="mtext-101 cl2">
                                        Tổng cộng:
                                    </span>
                                </div>

                                <div class="size-209 p-t-1">
                                    <span class="mtext-110 cl2">
                                        {{ number_format($transport + $total + ($total * 5 / 100), 0,',','.') }} vnđ
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex-w flex-t bor12 p-b-13"></div>
                        <div class="header-cart-buttons flex-w w-full">
                            <a href="{{ route('view.cart') }}" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer mg-bt-10">
                                Quay về giỏ hàng
                            </a>

                            <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer mg-bt-10" type="submit" name="payment" value="1">
                                Đặt hàng
                            </button>
                            <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" name="payment" type="submit" value="2">
                                Thanh toán online
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </form>

    </div>
</section>
@stop
@section('script')
@stop