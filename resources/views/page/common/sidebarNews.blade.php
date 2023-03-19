<div class="col-md-4 col-lg-3 p-b-80">
    <div class="side-menu">
        <div class="bor17 of-hidden pos-relative">
            <form action="{{ route('page.news') }}">
                <input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="search" placeholder="Tìm kiếm">
                <button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04" type="submit">
                    <i class="zmdi zmdi-search"></i>
                </button>
            </form>
        </div>
        <div class="p-t-55">
            <h4 class="mtext-112 cl2 p-b-33">
                Danh mục
            </h4>
            <ul>
                @if (isset($categories) && $categories->count() > 0)
                    @foreach($categories as $key => $category)
                        <li class="bor18">
                            <a href="{{ route('page.list.new', ['id' => $category->id, 'slug' => $category->c_slug ]) }}" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4">
                                {{ $category-> c_name}}
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="p-t-65">
            <h4 class="mtext-112 cl2 p-b-33">
                Sản phẩm mới
            </h4>
            <ul>
                @if (isset($products) && $products->count() > 0)
                    @foreach($products as $key => $product)
                <li class="flex-w flex-t p-b-30">
                    <a href="#" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
                        <img class="img-fluid" src="{{ !empty($product->pro_avatar) ? asset(pare_url_file($product->pro_avatar)) : asset('admin/dist/img/no-image.png') }}" alt="{{ $product->pro_name }}">
                    </a>
                    <div class="size-215 flex-col-t p-t-8">
                        <a href="{{ route('product.detail', ['id' => $product->id, 'slug' => $product->pro_slug ]) }}" class="stext-116 cl8 hov-cl1 trans-04">
                            {{ $product->pro_name }}
                        </a>
                        <span class="stext-116 cl6 p-t-20">
                            @if ($product->pro_sale)
                                <span class="stext-105 cl3" style="text-decoration: line-through; margin-right: 10px">{{ number_format($product->pro_price,0,',','.') }} vnđ</span>
                                @php
                                    $price = ((100 - $product->pro_sale) * $product->pro_price)  /  100 ;
                                @endphp
                                <span class="stext-105 cl3" >{{ number_format($price,0,',','.') }} vnđ</span>
                            @else
                                <span class="stext-105 cl3">{{ number_format($product->pro_price,0,',','.') }} vnđ </span>
                            @endif
                        </span>
                    </div>
                </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>