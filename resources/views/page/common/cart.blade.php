@if (isset($cart))
<ul class="header-cart-wrapitem w-full">
    @if (isset($cart->productCart))
    <?php $total = 0; ?>
    @foreach($cart->productCart as $product)
    <li class="header-cart-item flex-w flex-t">
        <div class="header-cart-item-img">
            <a href="{{ route('delete.product.cart', $product->id) }}" class="delete-product-cart"><img src="{{ !empty($product->options) ? asset(pare_url_file($product->options)) : asset('admin/dist/img/no-image.png') }}" alt="{{$product->pc_name}}"></a>
        </div>
        <div class="header-cart-item-txt p-t-8">
            <a href="{{ route('product.detail', ['id' => $product->pc_product_id , 'slug' => safeTitle($product->pc_name) ]) }}" class="header-cart-item-name hov-cl1 trans-04">
                {{$product->pc_name}}
            </a>
            <span class="header-cart-item-info">
                Color : {{ $product->pc_color}}
            </span>
            <!-- <span class="header-cart-item-info">
                            Size : {{ $product->pc_size}}
                        </span>
                        <span class="header-cart-item-info">
                            Áo hoặc bộ : {{ $product->pc_clothes}}
                        </span> -->
            <span class="header-cart-item-info">
                <?php
                if ($product->pc_sale) {
                    $price = ((100 - $product->pc_sale) * $product->pc_price)  /  100;
                } else {
                    $price = $product->pc_price;
                }
                $total = $total + intval($product->pc_qty) * $price;
                ?>
                {{ $product->pc_qty }} x {{ number_format($price,0,',','.') }} vnđ
            </span>
        </div>
    </li>
    @endforeach
    @endif
</ul>

<div class="w-full">
    <div class="header-cart-total w-full p-tb-40">
        Total: {{ number_format($total, 0,',','.') }} vnđ
    </div>

    <div class="header-cart-buttons flex-w w-full">
        <a href="{{ route('view.cart') }}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
            Xem giỏ hàng
        </a>

        <a href="{{ route('cart.payment') }}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
            Thanh toán
        </a>
    </div>
</div>
@endif