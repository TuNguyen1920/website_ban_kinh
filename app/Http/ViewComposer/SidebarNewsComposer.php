<?php
namespace App\Http\ViewComposer;
use GuzzleHttp\Psr7\Request;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\Product;

class SidebarNewsComposer
{
    public function compose(View $view) {

        $categories = Category::with('children')->whereNull('c_parent_id')->where('c_type', 2)->orderBy('id')->get();
        $products = Product::orderByDesc('id')->limit(6)->get();
        $view->with(['categories' => $categories, 'products' => $products]);
    }
}