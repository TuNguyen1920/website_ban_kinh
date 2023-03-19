@extends('page.layouts.page')
@section('title', 'Đăng nhập - Đăng ký')
@section('style')
@stop
@section('content')
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('page/images/f2.jpg') }}');">
        <h2 class="ltext-105 cl0 txt-center">
            Đăng nhập - Đăng ký
        </h2>
    </section>
    <section class="bg0 p-t-104 p-b-116">
        <div class="container">
            <div class="flex-w flex-tr">
                <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                    <form method="post" action="{{ route('account.login') }}">
                        <h4 class="mtext-105 cl2 txt-center p-b-30">
                            ĐĂNG NHẬP
                        </h4>
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="email" name="email" placeholder="Email của bạn *">

                        </div>
                        @if ($errors->first('email'))
                            <p class="text-danger m-b-20">{{ $errors->first('email') }}</p>
                        @endif
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="password" name="password" placeholder="Mật khẩu của bạn *">
                        </div>
                        @if ($errors->first('password'))
                            <p class="text-danger m-b-20">{{ $errors->first('password') }}</p>
                        @endif
                        @csrf
                        <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                            Đăng nhập
                        </button>
                        <br />
                        <p class="txt-center p-b-30"><a href="" style="margin-top: 10px">Quên mật khẩu</a></p>
                    </form>
                </div>

                <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                    <form method="post" action="{{ route('account.register') }}">
                        <h4 class="mtext-105 cl2 txt-center p-b-30">
                            ĐĂNG KÝ THÀNH VIÊN MỚI
                        </h4>
                        <div class="bor8 m-b-10 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="name" placeholder="Họ và tên *" value="{{ old('name') }}">
                        </div>
                        @if ($errors->first('name'))
                            <p class="text-danger m-b-20">{{ $errors->first('name') }}</p>
                        @endif
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="email" name="r_email" value="{{ old('r_email') }}" placeholder="Email của bạn *">
                        </div>
                        @if ($errors->first('r_email'))
                            <p class="text-danger m-b-20">{{ $errors->first('r_email') }}</p>
                        @endif
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="phone" value="{{ old('phone') }}" placeholder="Số điện thoại *">
                        </div>
                        @if ($errors->first('phone'))
                            <p class="text-danger m-b-20">{{ $errors->first('phone') }}</p>
                        @endif
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="password" name="r_password" placeholder="Mật khẩu của bạn *" >
                        </div>
                        @if ($errors->first('r_password'))
                            <p class="text-danger m-b-20">{{ $errors->first('r_password') }}</p>
                        @endif
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="password" name="password_confirm" placeholder="Nhập lại mật khẩu *">
                        </div>
                        @if ($errors->first('password_confirm'))
                            <p class="text-danger m-b-20">{{ $errors->first('password_confirm') }}</p>
                        @endif

                        <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                            <select class="js-select2" name="gender">
                                <option value="">Giới tính</option>
                                <option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>Nam</option>
                                <option value="2" {{ old('gender') == 2 ? 'selected' : '' }}>Nữ</option>
                                <option value="3" {{ old('gender') == 3 ? 'selected' : '' }}>Không xác đinh</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                        @if ($errors->first('gender'))
                            <p class="text-danger m-b-20">{{ $errors->first('gender') }}</p>
                        @endif
                        <div class="bor8 m-b-10 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="date" name="birthday" placeholder="" value="{{ old('birthday') }}">
                        </div>
                        @if ($errors->first('birthday'))
                            <p class="text-danger m-b-20">{{ $errors->first('birthday') }}</p>
                        @endif
                        @csrf
                        <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                            Đăng ký
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop
@section('script')
@stop
