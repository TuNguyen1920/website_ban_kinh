@extends('page.layouts.page')
@section('title', '')
@section('style')
@stop
@section('content')
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('page.home') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{ route('page.category.index', ['id' => $product->category->id, 'slug' => $product->category->c_slug]) }}" class="stext-109 cl8 hov-cl1 trans-04">
                {{ $product->category->c_name }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
				{{ $product->pro_name }}
			</span>
        </div>
    </div>
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                <div class="item-slick3" data-thumb="{{ !empty($product->pro_avatar) ? asset(pare_url_file($product->pro_avatar)) : asset('admin/dist/img/no-image.png') }}" alt="{{ $product->pro_name }}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="{{ !empty($product->pro_avatar) ? asset(pare_url_file($product->pro_avatar)) : asset('admin/dist/img/no-image.png') }}" alt="{{ $product->pro_name }}" alt="{{ $product->pro_name }}">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ !empty($product->pro_avatar) ? asset(pare_url_file($product->pro_avatar)) : asset('admin/dist/img/no-image.png') }}" alt="{{ $product->pro_name }}">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>
                                @if (isset($product->images) && $product->images->count() > 0)
                                    @foreach($product->images as $key -> $image)
                                    <div class="item-slick3" data-thumb="{{ asset(pare_url_file($product->pi_link)) }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ asset(pare_url_file($product->pi_link)) }}" alt="{{ $product->pro_name }}">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset(pare_url_file($product->pi_link)) }}">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-10">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{ $product->pro_name }}
                        </h4>

                        @if ($product->pro_sale)
                            <span class="stext-105 cl3 current-price-sale" style="text-decoration: line-through; margin-right: 10px">{{ number_format($product->pro_price,0,',','.') }} vnđ</span>
                            @php
                                $price = ((100 - $product->pro_sale) * $product->pro_price)  /  100 ;
                            @endphp
                            <span class="stext-105 cl3 current-price" >{{ number_format($price,0,',','.') }} vnđ</span>
                        @else
                            <span class="stext-105 cl3 current-price">{{ number_format($product->pro_price,0,',','.') }} vnđ </span>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <p  class="stext-105 cl3" style="margin-top: 15px">Tình trạng : {!! $product->pro_number > 0 ? 'Còn <b>'.$product->pro_number.'</b> sản phẩm' : 'Hết hàng' !!}</p>
                            </div>
                        </div>


                        <!--  -->
                        <div class="p-t-5">
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    {{--Áo hoặc bộ --}}
                                </div>
                                <div class="size-204 respon6-next">

                                </div>
                            </div>
                            @if (isset($product->attributes) && $product->attributes->count() > 0)
                                @foreach($product->attributes as $key => $attribute)
                                    @if ($attribute->v_attribute_id == 2)

                                    @endif
                                @endforeach
                            @endif
                            @php
                                $numberSize = 0;
                                $numberColor = 0;
                                $numberClothes = 0;

                                if (isset($product->attributes) && $product->attributes->count() > 0) {
                                    foreach($product->attributes as $key => $attribute) {
                                        if ($attribute->v_attribute_id == 1) {
                                            $numberColor = $numberSize + 1;
                                        } elseif ($attribute->v_attribute_id == 2) {
                                            $numberSize = $numberColor + 1;
                                        } elseif($attribute->v_attribute_id == 3) {
                                            $numberClothes = $numberClothes + 1;
                                        }
                                    }
                                }
                            @endphp
                            @if ($numberSize > 0)
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Size
                                </div>

                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2 size_product" name="size">
                                            <option value="">Chọn size</option>
                                            @if (isset($product->attributes) && $product->attributes->count() > 0)
                                                @foreach($product->attributes as $key => $attribute)
                                                    @if ($attribute->v_attribute_id == 2)
                                                    <option value="{{ $attribute->v_name }}">{{ $attribute->v_name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($numberColor > 0)
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Color
                                </div>

                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2 color_product" name="time">
                                            <option value="">Chọn mẫu</option>
                                            @if (isset($product->attributes) && $product->attributes->count() > 0)
                                                @foreach($product->attributes as $key => $attribute)
                                                    @if ($attribute->v_attribute_id == 1)
                                                        <option value="{{ $attribute->v_name }}">{{ $attribute->v_name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if ($numberClothes > 0)
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Áo hoặc bộ
                                </div>

                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="js-select2 clothes_product" name="time" url="{{ route('get.price.product', $product->id) }}">
                                            <option value="">Lựa chọn</option>
                                            @if (isset($product->attributes) && $product->attributes->count() > 0)
                                                @foreach($product->attributes as $key => $attribute)
                                                    @if ($attribute->v_attribute_id == 3)
                                                        <option value="{{ $attribute->id }}">{{ $attribute->v_name }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <input type="hidden" class="price_product">
                            <input type="hidden" class="name_clothes">
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">
                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>

                                        <input class="mtext-104 cl3 txt-center num-product" min="1" type="number" name="num-product" value="1">

                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>

                                    <button class="flex-c-m stext-101 cl0 size-121 bg1 bor1 hov-btn1 p-lr-15 trans-04 mg-bt-10 js-add-to-cart" type="add_cart" id_produt= "{{ $product->id }}" url="{{ route('add.product.cart') }}">
                                        Thêm vào giỏ
                                    </button>
                                    <button class="flex-c-m stext-101 cl0 size-121 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-add-to-cart" type="buy_now" id_produt="{{ $product->id }}" url="{{ route('add.product.cart') }}">
                                        Mua ngay
                                    </button>
                                </div>

                            </div>
                            <div class="flex-w flex-r-m p-b-10" style="text-align: justify">
                                <p class="stext-105 cl3 p-t-23">
                                    {!! $product->pro_description !!}
                                </p>
                            </div>
{{--                            <div class="col-md-12">--}}
{{--                                <div class="flex-w flex-r-m p-b-10">--}}
{{--                                    <img src="{{ asset('page/images/size.jpg') }}" alt="" style="width: 150%;padding-top: 40px; display: block; margin-left:0; margin-right:240px">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>

                        <!--  -->
                        {{--<div class="flex-w flex-m p-l-100 p-t-40 respon7">--}}
                            {{--<div class="flex-m bor9 p-r-10 m-r-11">--}}
                                {{--<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">--}}
                                    {{--<i class="zmdi zmdi-favorite"></i>--}}
                                {{--</a>--}}
                            {{--</div>--}}

                            {{--<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">--}}
                                {{--<i class="fa fa-facebook"></i>--}}
                            {{--</a>--}}

                            {{--<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">--}}
                                {{--<i class="fa fa-twitter"></i>--}}
                            {{--</a>--}}

                            {{--<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">--}}
                                {{--<i class="fa fa-google-plus"></i>--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Bình luận</a>
                        </li>

                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#information" role="tab">Thông tin</a>
                        </li>

                        {{--<li class="nav-item p-b-10">--}}
                            {{--<a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Bình luận</a>--}}
                        {{--</li>--}}
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    <div id="fb-root"></div>
                                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0" nonce="jyYgKKgU"></script>
                                    <div class="fb-comments" data-href="{{ route('product.detail', ['id' => $product->id, 'slug' => $product->pro_slug ]) }}" data-width="100%" data-numposts="5"></div>
                                </p>
                            </div>
                        </div>

                        <!-- - -->
                        <div class="tab-pane fade" id="information" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 m-lr-auto">
                                    <div class="how-pos2 p-lr-15-md">
                                        {!! $product->pro_content !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--<!-- - -->--}}
                        {{--<div class="tab-pane fade" id="reviews" role="tabpanel">--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-sm-12 col-md-12 col-lg-12 m-lr-auto">--}}
                                    {{--<div class="how-pos2 p-lr-15-md">--}}
                                        {{--<div id="fb-root"></div>--}}
                                        {{--<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0" nonce="jyYgKKgU"></script>--}}
                                        {{--<div class="fb-comments" data-href="http://shopquanaonu.abc/" data-width="100%" data-numposts="5"></div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (isset($products) && $products->count() > 0)
    <section class="sec-product bg0 p-t-15 p-b-50">
        <div class="container">
            <div>
                <h3 class="ltext-105 cl5 txt-center respon1">
                    SẢN PHẨM LIÊN QUAN
                </h3>
            </div>

            <!-- Tab01 -->
            <div class="tab01">
                <!-- Tab panes -->
                <div class="tab-content p-t-50">
                    <!-- - -->
                    <div class="tab-pane fade show active" id="best-seller" role="tabpanel">
                        <!-- Slide2 -->
                        <div class="wrap-slick2">
                            <div class="slick2">
                                @foreach($products as $key => $item)
                                    @include('page.common.itemProduct', ['product' => $item, 'itemSlick2' => 'item-slick2'])
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <section class="sec-product bg0 p-t-50 p-b-50 viewed-products">
        <div class="container">
            <div class="p-b-32">
                <h3 class="ltext-105 cl5 txt-center respon1">
                    SẢN PHẨM ĐÃ XEM
                </h3>
            </div>
            <div class="row" id="list-viewed-products"></div>
        </div>
    </section>
@stop
@section('script')

@stop
