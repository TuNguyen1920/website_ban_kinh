<?php
namespace App\Http\ViewComposer;
use GuzzleHttp\Psr7\Request;
use Illuminate\View\View;
use App\Models\Category;
use App\Models\ProductCart;
use App\Models\Cart;

class CategoryComposer
{
    public function compose(View $view) {

        $categories = Category::with('children')->whereNull('c_parent_id')->where('c_type', 1)->orderBy('id')->get();
        $ip = \Request::getClientIp();
        $cart = Cart::where(['cr_ip_address' => $ip, 'cr_status' => 0])->first();
        $qty = 0;
        if ($cart) {
            $qty = ProductCart::where('pc_cart_id', $cart->id)->sum('pc_qty');
        }

        $view->with(['categories' => $categories, 'qty' => $qty]);
    }
}