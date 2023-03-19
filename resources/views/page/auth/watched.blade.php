@extends('page.layouts.page')
@section('title', 'Danh sách sản phẩm đã xem ')
@section('style')
@stop
@section('content')
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('page/images/bg-02.jpg') }}');">
        <h2 class="ltext-105 cl0 txt-center">
            Danh sách sản phẩm đã xem
        </h2>
    </section>

    <section class="bg0 p-t-62 p-b-40">
        <div class="container">
            <div class="row">
                @include('page.common.sidebarAccount')
                <div class="col-md-8 col-lg-9 p-b-80">
                    <section class="sec-product bg0 p-t-50 p-b-50 viewed-products">
                        <div class="container">
                            <div class="row" id="list-viewed-products"></div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@stop
@section('script')
@stop
