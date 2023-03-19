@extends('page.layouts.page')
@section('title', 'Trang chủ')
@section('style')
@stop
@section('content')
    @include('page.common.slide', compact('slides'))
    <div class="sec-banner bg0">
        <div class="flex-w flex-c-m">
            @foreach($events as $key => $event)
                @include('page.common.itemEvent', ['event' => $event])
            @endforeach
        </div>
    </div>

    <section class="sec-product bg0 p-t-50 p-b-50">
        <div class="container">
            <div class="p-b-32">
                <h3 class="ltext-105 cl5 txt-center respon1">
                    Sản Phẩm Bán Chạy
                </h3>
            </div>
            <div class="row isotope-grid">
                
            </div>
            
        </div>
    </section>
    <section class="sec-product bg0 p-t-50 p-b-50">
        <div class="container">
            <div class="p-b-32">
                <h3 class="ltext-105 cl5 txt-center respon1">
                    Sản phẩm mới
                </h3>
            </div>
            <div class="row isotope-grid">
              
            </div>
            <div class="flex-c-m flex-w w-full p-t-45">
                
            </div>
        </div>
    </section>
    @if ($articles->count() > 0)
    <section class="sec-blog bg0 p-t-50 p-b-50">
        <div class="container">
            <div class="p-b-66">
                <h3 class="ltext-105 cl5 txt-center respon1">
                    Tin Tức Nổi Bật
                </h3>
            </div>

            <div class="row">
                
            </div>
        </div>
    </section>
    @endif
    {{-- @if ($trademarks->count() > 0)
    <section class="sec-product bg0 p-t-50 p-b-50">
        <div class="container">
            <div class="p-b-32">
                <h3 class="ltext-105 cl5 txt-center respon1">
                    THƯƠNG HIỆU
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
                                @foreach($trademarks as $trademark)
                                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                                        <!-- Block2 -->
                                        <div class="block2">
                                            <div class="block2-pic hov-img0">
                                                <a href="{{ $trademark->td_link }}"><img src="{{ !empty($trademark->td_image) ? asset(pare_url_file($trademark->td_image)) : asset('admin/dist/img/no-image.png') }}" alt="IMG-PRODUCT"></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif --}}
@stop
@section('script')
@stop
