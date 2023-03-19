@extends('page.layouts.page')
@section('title', 'Thông tin tài khoản ')
@section('style')
@stop
@section('content')
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('page/images/bg-02.jpg') }}');">
        <h2 class="ltext-105 cl0 txt-center">
            Thông tin tài khoản
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
                                <form method="post" action="{{ route('update.info.account') }}">
                                    <h4 class="mtext-105 cl2 txt-center p-b-25">
                                        THÔNG TIN TÀI KHOẢN
                                    </h4>
                                    <div class="bor8 m-b-10 how-pos4-parent">
                                        <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="name" placeholder="Họ và tên *" value="{{ old('name', isset($user) ? $user->name : '') }}">
                                    </div>
                                    @if ($errors->first('name'))
                                        <p class="text-danger m-b-20">{{ $errors->first('name') }}</p>
                                    @endif
                                    <div class="bor8 m-b-20 how-pos4-parent">
                                        <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="email" name="email" value="{{ old('email', isset($user) ? $user->email : '') }}" placeholder="Email của bạn *">
                                    </div>
                                    @if ($errors->first('email'))
                                        <p class="text-danger m-b-20">{{ $errors->first('email') }}</p>
                                    @endif
                                    <div class="bor8 m-b-20 how-pos4-parent">
                                        <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="phone" value="{{ old('phone', isset($user) ? $user->phone : '') }}" placeholder="Số điện thoại *">
                                    </div>
                                    @if ($errors->first('phone'))
                                        <p class="text-danger m-b-20">{{ $errors->first('phone') }}</p>
                                    @endif

                                    <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                        <select class="js-select2" name="gender">
                                            <option value="">Giới tính</option>
                                            <option value="1" {{ old('gender', isset($user) ? $user->gender : '') == 1 ? 'selected' : '' }}>Nam</option>
                                            <option value="2" {{ old('gender', isset($user) ? $user->gender : '') == 2 ? 'selected' : '' }}>Nữ</option>
                                            <option value="3" {{ old('gender', isset($user) ? $user->gender : '') == 3 ? 'selected' : '' }}>Không xác đinh</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                    @if ($errors->first('gender'))
                                        <p class="text-danger m-b-20">{{ $errors->first('gender') }}</p>
                                    @endif
                                    <div class="bor8 m-b-10 how-pos4-parent">
                                        <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="date" name="birthday" placeholder="" value="{{ old('birthday', isset($user) ? $user->birthday : '') }}">
                                    </div>
                                    @if ($errors->first('birthday'))
                                        <p class="text-danger m-b-20">{{ $errors->first('birthday') }}</p>
                                    @endif
                                    @csrf
                                    <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                                        Cập Nhật
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
