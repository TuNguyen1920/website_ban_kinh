@extends('page.layouts.page')
@section('title', 'Thay đổi mật khẩu ')
@section('style')
@stop
@section('content')
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('page/images/f2.jpg') }}');">
        <h2 class="ltext-105 cl0 txt-center">
            Thay đổi mật khẩu
        </h2>
    </section>
    <section class="bg0 p-t-104 p-b-116">
        <div class="container">
            <div class="flex-w flex-tr">
                <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md" style="margin: auto;">
                    <form method="post" action="{{ route('post.page.new.password', $token) }}">
                        <h4 class="mtext-105 cl2 txt-center p-b-30">
                            Thay đổi mật khẩu
                        </h4>

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
    </section>
@stop
@section('script')
@stop
