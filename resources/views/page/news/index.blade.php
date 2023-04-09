@extends('page.layouts.page')
@section('title', 'Tin tức ')
@section('style')
@stop
@section('content')
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('page/images/bg-02.jpg') }}');">
        <h2 class="ltext-105 cl0 txt-center">
            Tin tức
        </h2>
    </section>
    <section class="bg0 p-t-62 p-b-40">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="p-r-45 p-r-0-lg">
                        <div class="row">
                            @foreach($articles as $key => $article)
                                @include('page.common.itemNew', compact('article'))
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        {{--<div class="flex-l-m flex-w w-full p-t-10 m-lr--7">--}}
                            {{--<a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">--}}
                                {{--1--}}
                            {{--</a>--}}

                            {{--<a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7">--}}
                                {{--2--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    </div>
                </div>

                @include('page.common.sidebarNews')
            </div>
        </div>
    </section>
@stop
@section('script')
@stop
