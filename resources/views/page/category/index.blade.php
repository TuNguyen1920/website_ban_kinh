@extends('page.layouts.page')
@section('title', $currentCategory->c_name)
@section('style')
@stop
@section('content')
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ isset($currentCategory->c_banner) && !empty($currentCategory->c_banner) ? asset(pare_url_file($currentCategory->c_banner)) : asset('page/images/Capture.PNG') }}');">
        <h2 class="ltext-105 cl0 txt-center">
            {{ $currentCategory->c_name }}
        </h2>
    </section>
    <div class="bg0 m-t-23 p-b-140">
        <div class="container">
            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m m-tb-10 m-t-30 m-b-15">
                    <a href="{{ route('page.category.index', ['id' => $category->id, 'slug' => $category->c_slug]) }}">
                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 {{ $currentId == $category->id ? 'how-active1' : '' }}">
                            {{ $category->c_name }}
                        </button>
                    </a>
                    @if (isset($category->children) && count($category->children) > 0)
                        @foreach($category->children as $key => $sub)
                            <a href="{{ route('page.category.index', ['id' => $sub->id, 'slug' => $sub->c_slug]) }}">
                                <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 {{ $currentId == $sub->id ? 'how-active1' : '' }}" data-filter=".{{ $sub->c_slug }}">
                                    {{ $sub->c_name }}
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
                <div class="dis-none panel-search w-full p-t-10 p-b-15" style="display: none;">
                    <div class="bor8 dis-flex p-l-15">
                        <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                        <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
                    </div>
                </div>

                <!-- Filter -->
                {{--<div class="dis-none panel-filter w-full p-t-10" style="display: none;">--}}
                    {{--<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">--}}
                        {{--<div class="filter-col1 p-r-15 p-b-27">--}}
                            {{--<div class="mtext-102 cl2 p-b-15">--}}
                                {{--Sort By--}}
                            {{--</div>--}}
                            {{--<ul>--}}
                                {{--@foreach($sortBy as $key => $sort)--}}
                                    {{--<li class="p-b-6">--}}
                                        {{--<a href="#" class="filter-link stext-106 trans-04">--}}
                                            {{--<label for="{{$key}}"><input type="radio" id="{{$key}}" name="sort_by" value="{{$key}}" class="checkboxFilter">  {{ $sort }}</label>--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                {{--@endforeach--}}
                            {{--</ul>--}}
                        {{--</div>--}}

                        {{--<div class="filter-col1 p-r-15 p-b-27">--}}
                            {{--<div class="mtext-102 cl2 p-b-15">--}}
                                {{--Price--}}
                            {{--</div>--}}

                            {{--<ul>--}}
                                {{--@foreach($sortPrice as $key => $price)--}}
                                    {{--<li class="p-b-6">--}}
                                        {{--<a href="#" class="filter-link stext-106 trans-04">--}}
                                            {{--<label for="{{$key}}"><input type="radio" id="{{$key}}" name="sort_price" value="{{$key}}" class="checkboxFilter">  {{ $price }}</label>--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                {{--@endforeach--}}
                            {{--</ul>--}}
                        {{--</div>--}}

                        {{--<div class="filter-col1 p-l-30 p-b-27">--}}
                            {{--<div class="mtext-102 cl2 p-b-15 p-l-30">--}}
                                {{--Size--}}
                            {{--</div>--}}

                            {{--<ul class="p-l-30">--}}
                                {{--@foreach($sizes as $key => $size)--}}
                                    {{--<li class="p-b-6">--}}
                                        {{--<a href="#" class="filter-link stext-106 trans-04">--}}
                                            {{--<label for="{{$size->v_slug}}"><input type="checkbox" id="{{$size->v_slug}}" name="sizes" value="{{$size->id}}" class="checkboxFilter">  {{ $size->v_name  }}</label>--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                {{--@endforeach--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="filter-col1 p-r-15 p-b-27 p-l-30">--}}
                            {{--<div class="mtext-102 cl2 p-b-15 p-l-30">--}}
                                {{--Color--}}
                            {{--</div>--}}

                            {{--<ul class="p-l-30">--}}
                                {{--@foreach($colors as $key => $color)--}}
                                    {{--<li class="p-b-6">--}}
                                        {{--<a href="#" class="filter-link stext-106 trans-04">--}}
                                            {{--<label for="{{$color->v_slug}}"><input type="checkbox" id="{{$color->v_slug}}" name="colors" value="{{$color->id}}" class="checkboxFilter">  {{ $color->v_name  }}</label>--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                {{--@endforeach--}}
                            {{--</ul>--}}
                        {{--</div>--}}

                        {{--<div class="filter-col1 p-b-27">--}}
                            {{--<div class="mtext-102 cl2 p-b-15">--}}
                                {{--Thương hiệu--}}
                            {{--</div>--}}
                            {{--<ul class="p-l-30">--}}
                                {{--@foreach($trademarks as $key => $trademark)--}}
                                    {{--<li class="p-b-6">--}}
                                        {{--<a href="#" class="filter-link stext-106 trans-04">--}}
                                            {{--<label for="{{$trademark->id}}"><input type="checkbox" id="{{$trademark->id}}" name="sizes" value="{{$trademark->id}}" class="checkboxFilter">  {{ $trademark->td_name  }}</label>--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                {{--@endforeach--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>

            <div class="row list-product-category">
                @foreach($products as $key => $product)
                    @include('page.common.itemProduct', ['product' => $product])
                @endforeach
            </div>

            <!-- Load more -->
            @if ($loadMore)
            <div class="flex-c-m flex-w w-full p-t-45">
                <a href="{{ route('page.category.index', ['id' => $currentCategory->id, 'slug' => $currentCategory->c_slug]) }}"
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
