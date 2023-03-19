@foreach($products as $key => $product)
    @include('page.common.itemProduct', ['product' => $product])
@endforeach