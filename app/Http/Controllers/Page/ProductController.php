<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Value;
use App\Models\Trademark;
use App\Models\Type;
use App\Models\ProductValues;

class ProductController extends Controller
{
    public function __construct(Value $value, Category $category, Trademark $trademark, Type $type)
    {

        view()->share([
            'colors' => $value::where('v_attribute_id', 1)->get(),
            'sizes' => $value::where('v_attribute_id', 2)->get(),
            'trademarks' => $trademark::all(),
            'types' => $type::all(),
            'sortBy' => $category::SORT_BY,
            'sortPrice' => $category::SORT_PRICE,
            'categories' => $category->whereNull('c_parent_id')->get()
        ]);
    }
    //
    public function index(Request $request)
    {
        $products = Product::select('*');

        if ($request->type) {
            $products = $products->whereIn('id', function ($query) use ($request) {
                $query->from('product_types')->select('product_id')->where('type_id', $request->type);
            });
        }
        if ($request->search) {
            $products->where('pro_name', 'like', "%".$request->search."%")->orWhere('pro_keywords', 'like', "%".$request->search."%");
        }
        $countProduct = $products->count();

        if ($request->id) {
            $id = $request->id;
            $currentCategory = Category::find($id);

            if ($currentCategory->c_parent_id == NULL) {
                $categoryId = $currentCategory->children->pluck('id')->toArray();
                $categoryId = array_merge($categoryId, [intval($id)]);
            } else {
                $categoryId = [intval($id)];
            }
        }
        if (isset($categoryId)) {
            $products = $products->whereIn('pro_category_id', $categoryId);
        }

        if ($request->ajax()) {

            if ($request->numberPage) {
                $start = $request->numberPage + NUMBER_PAGINATION_PAGE;
            }
            $products = $products->orderByDesc('id')->limit($start)->get();
            $html = view("page.common.loadMoreProduct", compact('products'))->render();

            return response([
                'html' => $html,
                'numberPage' => $start,
                'loadMore' => $countProduct > $start ? true : false
            ]);

        } else {
            $products = $products->orderByDesc('id')->limit(NUMBER_PAGINATION_PAGE)->get();
            $viewData = [
                'products' => $products,
                'loadMore' => $countProduct > NUMBER_PAGINATION_PAGE ? true : false,
                'numberPage' => NUMBER_PAGINATION_PAGE,
                'id' => $request->id

            ];
            return view('page.product.index', $viewData);
        }
    }

    public function detail(Request $request, $id)
    {
        $product = Product::with(['category', 'images', 'attributes', 'types'])->find($id);
        $numberColor = ProductValues::where(['pv_product_id' => $id, 'pv_value_id' => 1])->count();
        $numberSize = ProductValues::where(['pv_product_id' => $id, 'pv_value_id' => 2])->count();
        $numberClothes = ProductValues::where(['pv_product_id' => $id, 'pv_value_id' => 3])->count();

        $idCate = $product->category->id;

        if ($idCate) {
            $currentCategory = Category::find($idCate);

            if ($currentCategory->c_parent_id == NULL) {
                $categoryId = $currentCategory->children->pluck('id')->toArray();
                $categoryId = array_merge($categoryId, [intval($idCate)]);

            } else {
                $categoryId = [intval($idCate)];
            }
        }

        $products = Product::whereIn('pro_category_id', $categoryId)->where('id', '<>', $id)->orderByDesc('id')->limit(20)->get();

        return view('page.product.detail', compact('product', 'products', 'numberSize', 'numberColor', 'numberClothes'));
    }

    public function productSale(Request $request)
    {
        $products = Product::select('*')->where('pro_is_sale', 1);

        if ($request->type) {
            $products = $products->whereIn('id', function ($query) use ($request) {
                $query->from('product_types')->select('product_id')->where('type_id', $request->type);
            });
        }
        if ($request->search) {
            $products->where('pro_name', 'like', "%".$request->search."%");
        }
        $countProduct = $products->count();

        if ($request->id) {
            $id = $request->id;
            $currentCategory = Category::find($id);

            if ($currentCategory->c_parent_id == NULL) {
                $categoryId = $currentCategory->children->pluck('id')->toArray();
                $categoryId = array_merge($categoryId, [intval($id)]);
            } else {
                $categoryId = [intval($id)];
            }
        }
        if (isset($categoryId)) {
            $products = $products->whereIn('pro_category_id', $categoryId);
        }

        if ($request->ajax()) {

            if ($request->numberPage) {
                $start = $request->numberPage + NUMBER_PAGINATION_PAGE;
            }
            $products = $products->orderByDesc('id')->limit($start)->get();
            $html = view("page.common.loadMoreProduct", compact('products'))->render();

            return response([
                'html' => $html,
                'numberPage' => $start,
                'loadMore' => $countProduct > $start ? true : false
            ]);

        } else {
            $products = $products->orderByDesc('id')->limit(NUMBER_PAGINATION_PAGE)->get();
            $viewData = [
                'products' => $products,
                'loadMore' => $countProduct > NUMBER_PAGINATION_PAGE ? true : false,
                'numberPage' => NUMBER_PAGINATION_PAGE,
                'id' => $request->id
            ];
            return view('page.product.sale', $viewData);
        }
    }

    public function loadViewedProducts(Request $request)
    {
        if ($request->ajax()) {
            $ids = $request->ids;
            $products = Product::whereIn('id', $ids)->get();

            $html = view("page.common.itemViewedProducts", compact('products'))->render();
            return response([
                'html' => $html
            ]);
        }
    }

    public function priceProduct(Request $request, $id)
    {
        if ($request->ajax()) {
            $idClothes = $request->idClothes;
            $productValues = ProductValues::where(['pv_product_id' => $id, 'pv_value_id' => $idClothes])->first();
            $value = Value::find($productValues->pv_value_id);
            if (!$productValues) {
                return response([
                    'code' => 404,
                    'message' => 'Đã xảy ra lỗi'
                ]);
            }

            return response([
                'code' => 200,
                'price_format' => number_format($productValues->pv_price,0,',','.') . ' vnđ' ,
                'price' => $productValues->pv_price,
                'name_clothes' => $value->v_name,
                'message' => 'Thành công'
            ]);
        }
    }
}
