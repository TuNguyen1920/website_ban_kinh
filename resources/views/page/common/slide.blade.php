<section class="section-slide">
    <div class="wrap-slick1">
        <div class="slick1">
            @if ($slides->count() > 0)
                @foreach($slides as $key => $slide)
                <div class="item-slick1" style="background-image: url('{{ !empty($slide->sd_image) ? asset(pare_url_file($slide->sd_image)) : asset('admin/dist/img/no-image.png') }}'); background-size: 100% 100%;">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
{{--                            <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">--}}
{{--                                    <span class="ltext-101 cl0 respon2">--}}
{{--                                        {{ $slide->sd_sub_title }}--}}
{{--                                    </span>--}}
{{--                            </div>--}}

{{--                            <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">--}}
{{--                                <h2 class="ltext-201 cl0 p-t-19 p-b-43 respon1">--}}
{{--                                    {{ $slide->sd_title }}--}}
{{--                                </h2>--}}
{{--                            </div>--}}

{{--                            <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">--}}
{{--                                <a href="{{ $slide->sd_link }}"--}}
{{--                                   class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04" target="{{ $slide->sd_link }}">--}}
{{--                                    Xem ngay--}}
{{--                                </a>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
