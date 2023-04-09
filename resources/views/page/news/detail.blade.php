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

            <a href="{{ route('page.news') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Tin tức
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                {{ $article->a_name }}
            </span>
        </div>
    </div>
    <section class="bg0 p-t-52 p-b-20">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="p-r-45 p-r-0-lg">
                        <!--  -->

                        <div>
                            <h4 class="ltext-109 cl2 p-b-28">
                                {{ $article->a_name }}
                            </h4>
                            {{--<span class="flex-w flex-m stext-111 cl2 p-b-19">--}}
                                {{--<span>--}}
                                    {{--<span class="cl4">By</span> Admin--}}
                                    {{--<span class="cl12 m-l-4 m-r-6">|</span>--}}
                                {{--</span>--}}

                                {{--<span>--}}
                                    {{--22 Jan, 2018--}}
                                    {{--<span class="cl12 m-l-4 m-r-6">|</span>--}}
                                {{--</span>--}}

                                {{--<span>--}}
                                    {{--StreetStyle, Fashion, Couple--}}
                                    {{--<span class="cl12 m-l-4 m-r-6">|</span>--}}
                                {{--</span>--}}

                                {{--<span>--}}
                                    {{--8 Comments--}}
                                {{--</span>--}}
                            {{--</span>--}}
                            {!! $article->a_content !!}
                        </div>
                    </div>
                </div>
                @include('page.common.sidebarNews')
            </div>
        </div>
    </section>
@stop
@section('script')
@stop