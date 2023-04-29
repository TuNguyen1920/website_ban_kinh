<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Trademark;
use App\Models\Type;
use App\Http\Requests\ProductRequest;
use App\Models\ProductValues;

class ProductController extends Controller
{
    protected $product;
    /**
     * constructor.
     */
    public function __construct(Product $product, Attribute $attribute, Category $category, Trademark $trademark, Type $type)
    {

        view()->share([
            'product_active' => 'active',
            'data_product_active' => 'active',
            'attributes' => $attribute::with('values')->get(),
            'categories' => $category::with('children')->where('c_type', 1)->whereNull('c_parent_id')->get(),
            'trademarks' => $trademark::all(),
            'types' => $type::all(),
        ]);
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $products = Product::with(['category', 'trademark']);

        if ($request->pro_name) {
            $products->where('pro_name', 'like', '%'.$request->pro_name.'%');
        }

        if ($request->pro_category_id) {
            $products->where('pro_category_id', $request->pro_category_id);
        }

        $products =  $products->orderByDesc('id')->paginate(NUMBER_PAGINATION);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //
        \DB::beginTransaction();
        try {
            $this->product->createOrUpdate($request);
            \DB::commit();
            return redirect()->back()->with('success', 'Lưu dữ liệu thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $attributeEdit = [];
        $typeEdit = [];
        $product = Product::with(['attributes', 'types'])->find($id);

        if ($product->attributes) {
            $attributeEdit = $product->attributes->pluck('id')->toArray();
        }
        if ($product->attributes) {
            $typeEdit = $product->types->pluck('id')->toArray();
        }
        $priceEdit = [];
        $prices = ProductValues::select('pv_value_id', 'pv_price')->where('pv_product_id', $id)->get();
        if ($prices->count() > 0) {
            foreach ($prices as $price) {
                $priceEdit[$price->pv_value_id] = $price->pv_price;
            }
        }

        if (!$product) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }
        return view('admin.product.edit', compact('product', 'attributeEdit', 'typeEdit', 'priceEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        \DB::beginTransaction();
        try {
            $this->product->createOrUpdate($request, $id);
            \DB::commit();
            return redirect()->back()->with('success', 'Lưu dữ liệu thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $product->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }
}
