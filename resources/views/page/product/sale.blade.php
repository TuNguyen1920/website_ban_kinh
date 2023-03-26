@extends('page.layouts.page')
@section('title', 'Sản phẩm khuyến mại')
@section('style')
@stop
@section('content')
    <div class="bg0 m-t-23 p-b-140">
        {{--<div class="container">--}}
            {{--<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">--}}
                {{--<a href="{{ route('page.home') }}" class="stext-109 cl8 hov-cl1 trans-04">--}}
                    {{--Trang chủ--}}
                    {{--<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>--}}
                {{--</a>--}}

                {{--<span class="stext-109 cl4">--}}
                    {{--Sản phẩm--}}
                {{--</span>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="container">
            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m m-tb-10 m-t-30 m-b-15">
                    <a href="{{ route('page.product') }}">
                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 {{ Request::get('id') == null ? 'how-active1' : '' }}">
                            All Products
                        </button>
                    </a>
                    @if (isset($categories) && count($categories) > 0)
                        @foreach($categories as $key => $category)
                            <a href="{{ route('page.product') }}?id={{ $category->id }}">
                                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 {{ Request::get('id') == $category->id ? 'how-active1' : '' }}" data-filter=".{{ $category->c_slug }}" >
                                    {{ $category->c_name }}
                                </button>
                            </a>
                        @endforeach
                    @endif
                </div>
                <div class="flex-w flex-c-m m-tb-10">
                    {{--<div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter show-filter">--}}
                    {{--<i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>--}}
                    {{--<i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>--}}
                    {{--Filter--}}
                    {{--</div>--}}

                    {{--<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">--}}
                        {{--<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>--}}
                        {{--<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>--}}
                        {{--Tìm kiếm--}}
                    {{--</div>--}}
                </div>

                <!-- Search product -->
                {{--<div class="dis-none panel-search w-full p-t-10 p-b-15" style="display: none;">--}}
                    {{--<div class="bor8 dis-flex p-l-15">--}}
                        {{--<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">--}}
                            {{--<i class="zmdi zmdi-search"></i>--}}
                        {{--</button>--}}
                        {{--<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>

            <div class="row list-product-category">
                @foreach($products as $key => $product)
                    @include('page.common.itemProduct', ['product' => $product])
                @endforeach
            </div>

            @if ($loadMore)
                <div class="flex-c-m flex-w w-full p-t-45">
                    <a href="{{ route('page.product.sale') }}{{ isset($id) ? '?id='.$id : '' }}"
                       numberPage="{{ $numberPage }}"
                       class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04 load-more">
                        Xem thêm
                    </a>
                </div>
            @endif
        </div>
    </div>
@stop
@section('script')
@stop
