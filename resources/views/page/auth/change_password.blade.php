@extends('page.layouts.page')
@section('title', 'Thay đổi mật khẩu ')
@section('style')
@stop
@section('content')
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('page/images/bg-02.jpg') }}');">
        <h2 class="ltext-105 cl0 txt-center">
            Thay đổi mật khẩu
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
                                <form method="post" action="{{ route('post.change.password') }}">
                                    <h4 class="mtext-105 cl2 txt-center p-b-25">
                                        THAY ĐỔI MẬT KHẨU
                                    </h4>
                                    <div class="bor8 m-b-20 how-pos4-parent">
                                        <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="password" name="c_password" placeholder="Mật khẩu cũ của bạn *" >
                                    </div>
                                    @if ($errors->first('c_password'))
                                        <p class="text-danger m-b-20">{{ $errors->first('c_password') }}</p>
                                    @endif
                                    <div class="bor8 m-b-20 how-pos4-parent">
                                        <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="password" name="password" placeholder="Mật khẩu của bạn *" >
                                    </div>
                                    @if ($errors->first('password'))
                                        <p class="text-danger m-b-20">{{ $errors->first('password') }}</p>
                                    @endif
                                    <div class="bor8 m-b-20 how-pos4-parent">
                                        <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="password" name="password_confirm" placeholder="Nhập lại mật khẩu *">
                                    </div>
                                    @if ($errors->first('password_confirm'))
                                        <p class="text-danger m-b-20">{{ $errors->first('password_confirm') }}</p>
                                    @endif
                                    @csrf
                                    <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                                        Đổi mật khẩu
                                    </button>
                                </form>
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
