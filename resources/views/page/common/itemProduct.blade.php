<div class="{{ isset($itemSlick2) ? 'item-slick2 p-l-15 p-r-15 p-t-15 p-b-15' : 'col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item' }}  ">
    <!-- Block2 -->
    <div class="block2">
        <div class="block2-pic hov-img0">
            <img src="{{ !empty($product->pro_avatar) ? asset(pare_url_file($product->pro_avatar)) : asset('admin/dist/img/no-image.png') }}" alt="{{ $product->pro_name }}">
            <a href="{{ route('product.detail', ['id' => $product->id, 'slug' => $product->pro_slug ]) }}"
               class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 product_view" idproduct="{{ $product->id }}">
                Chi tiết
            </a>
        </div>

        <div class="block2-txt flex-w flex-t p-t-14">
            <div class="block2-txt-child1 flex-col-l ">
                <a href="{{ route('product.detail', ['id' => $product->id, 'slug' => $product->pro_slug ]) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                    {{ $product->pro_name }}
                </a>

                <p>
                    @if ($product->pro_sale)
                        <span class="stext-105 cl3" style="text-decoration: line-through; margin-right: 10px">{{ number_format($product->pro_price,0,',','.') }} vnđ</span>
                        @php
                            $price = ((100 - $product->pro_sale) * $product->pro_price)  /  100 ;
                        @endphp
                        <span class="stext-105 cl3" >{{ number_format($price,0,',','.') }} vnđ</span>
                    @else
                        <span class="stext-105 cl3">{{ number_format($product->pro_price,0,',','.') }} vnđ </span>
                    @endif
                </p>
            </div>

            {{--<div class="block2-txt-child2 flex-r p-t-3">--}}
                {{--<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">--}}
                    {{--<img class="icon-heart1 dis-block trans-04" src="{{ asset('page/images/icons/icon-heart-01.png') }}" alt="ICON">--}}
                    {{--<img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{ asset('page/images/icons/icon-heart-02.png') }}" alt="ICON">--}}
                {{--</a>--}}
            {{--</div>--}}
        </div>
    </div>
</div>