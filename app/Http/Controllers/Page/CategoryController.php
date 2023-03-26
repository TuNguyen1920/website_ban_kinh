<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Article;
use App\Models\Value;
use App\Models\Trademark;
use App\Models\Type;

class CategoryController extends Controller
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
        ]);
    }
    //
    public function index(Request $request, $id, $slug)
    {
        if ($id) {
            $currentCategory = Category::find($id);

            if ($currentCategory->c_parent_id == NULL) {
                $categoryId = $currentCategory->children->pluck('id')->toArray();
                $categoryId = array_merge($categoryId, [intval($id)]);
                $category = Category::with('children')->find($id);

            } else {
                $categoryId = [intval($id)];
                $category = Category::with('children')->find($currentCategory->c_parent_id);
            }

            $products = Product::whereIn('pro_category_id', $categoryId);
            $countProduct = $products->count();

            if ($request->search) {
                $products->where('pro_name', 'like', "%".$request->search."%");
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
                    'currentCategory' => $currentCategory,
                    'category' => $category,
                    'currentId' => $id,
                    'loadMore' => $countProduct > NUMBER_PAGINATION_PAGE ? true : false,
                    'numberPage' => NUMBER_PAGINATION_PAGE
                ];

                return view('page.category.index', $viewData);
            }

        } else {
            return redirect()->route('page.home');
        }
    }

    public function listCategoryNew($id, $slug)
    {
        $articles = Article::with('user')->where('a_active', 1)->where('a_category_id', $id)->orderByDesc('id')->paginate(50);

        $viewData = [
            'articles' => $articles,
        ];
        return view('page.news.index', $viewData);
    }
}
