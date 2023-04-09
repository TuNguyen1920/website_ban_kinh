@extends('page.layouts.page')
@section('title', 'Liên hệ')
@section('style')
@stop
@section('content')
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('{{ asset('page/images/bg-01.jpg') }}');">
        <h2 class="ltext-105 cl0 txt-center">
            Liên hệ
        </h2>
    </section>
    <section class="bg0 p-t-104 p-b-116">
        <div class="container">
            <div class="flex-w flex-tr">
                <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                        Thông Tin Liên Hệ
                    </h4>
                    <div class="flex-w w-full p-b-42">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-map-marker"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                Địa chỉ
                            </span>

                            <p class="stext-115 cl6 size-213 p-t-18">
                                180 Cao Lỗ, phường 4, quận 8, Thành phố Hồ Chí Minh.
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full p-b-42">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-phone-handset"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                Hotline
                            </span>

                            <p class="stext-115 cl1 size-213 p-t-18">
                                0703732218
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full p-b-42">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-envelope"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                Email liên hệ
                            </span>

                            <p class="stext-115 cl1 size-213 p-t-18">
                                rmsportfootball21@gmail.com
                            </p>
                        </div>
                    </div>
                    <div class="flex-w w-full p-b-42">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-envelope"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                Mạng xã hội của chúng tôi
                            </span>

                            <p class="stext-115 cl1 size-213 p-t-18">
                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>

                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>

                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="flex-w w-full">
                        <span class="fs-18 cl5 txt-center size-211">
                            <span class="lnr lnr-envelope"></span>
                        </span>

                        <div class="size-212 p-t-2">
                            <span class="mtext-110 cl2">
                                Thời gian làm việc
                            </span>

                            <p class="stext-115 size-213 p-t-18 stext-111">
                                Từ thứ 2 - Thứ 7 : 8:30am - 10:30pm <br>
                                Chủ nhật : 9:00am - 90:30pm
                            </p>
                        </div>
                    </div>
                </div>
                <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                    <form>
                        <h4 class="mtext-105 cl2 txt-center p-b-30">
                            Liện hệ với chúng tôi
                        </h4>

                        <div class="bor8 m-b-10 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="name" placeholder="Họ và tên *">
                        </div>
                        @if ($errors->first('name'))
                            <p class="text-danger m-b-20">{{ $errors->first('name') }}</p>
                        @endif
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="email" name="r_email" placeholder="Email của bạn *">
                        </div>
                        @if ($errors->first('r_email'))
                            <p class="text-danger m-b-20">{{ $errors->first('r_email') }}</p>
                        @endif
                        <div class="bor8 m-b-20 how-pos4-parent">
                            <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="phone" placeholder="Số điện thoại *">

                        </div>
                        @if ($errors->first('phone'))
                            <p class="text-danger m-b-20">{{ $errors->first('phone') }}</p>
                        @endif

                        <div class="bor8 m-b-30">
                            <textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="note" placeholder="Nội dung"></textarea>
                        </div>

                        <button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" type="submit">
                            Submit
                        </button>
                    </form>
                </div>


            </div>
        </div>
    </section>
@stop
@section('script')
@stop