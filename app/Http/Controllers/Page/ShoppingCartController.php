<?php

namespace App\Http\Controllers\Page;;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;
use App\Models\ProductCart;
use App\Models\Locations;
use App\Models\Transaction;
use App\Models\Payment;
use App\Http\Requests\PaymentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShoppingCartController extends Controller
{
    //
    public function addCart(Request $request)
    {
        if ($request->ajax()) {
            \DB::beginTransaction();
            try {
                $code = 200;
                $message = "Đã xảy ra lỗi không thể thêm sản phẩm vào giỏ hàng !";

                if (!Auth::guard('users')->check()) {
                    $code = 404;
                    return response([
                        'status_code' => $code,
                        'message' => 'Vui lòng đăng nhập để mua hàng.',
                    ]);
                }

                $product = Product::find($request->id);
                $ip = $request->getClientIp();
                if (!$product) {
                    $code = 404;
                    return response([
                        'status_code' => $code,
                        'message' => $message,
                    ]);
                }

                $cart = Cart::where(['cr_ip_address' => $ip, 'cr_status' => 0])->first();

                if (!$cart) {
                    $cart = new Cart();
                    $cart->cr_ip_address = $ip;
                    $cart->save();
                }

                $productCart = ProductCart::where([
                    'pc_cart_id' => $cart->id,
                    'pc_product_id' => $product->id,
                    'pc_status' => 0,
                    'pc_color' => $request->color,
                    'pc_size' => $request->size,
                    'pc_clothes' => $request->nameClothes
                ])->first();

                if (!$productCart) {
                    if ($request->priceProduct) {
                        if ($product->pro_sale) {
                            $price = ((100 - $product->pro_sale) * $request->priceProduct)  /  100;
                        } else {
                            $price = $request->priceProduct;
                        }
                    } else {
                        if ($product->pro_sale) {
                            $price =  ((100 - $product->pro_sale) * $product->pro_price)  /  100;
                        } else {
                            $price = $product->pro_price;
                        }
                    }
                    $productCart = new ProductCart();
                    $productCart->pc_cart_id = $cart->id;
                    $productCart->pc_product_id  = $product->id;
                    $productCart->pc_name  = $product->pro_name;
                    $productCart->pc_price  = $price;
                    $productCart->pc_sale  = $product->pro_sale;
                    $productCart->pc_qty  = $request->numberProdcut;
                    $productCart->options  = $product->pro_avatar;
                    $productCart->pc_color  = $request->color;
                    $productCart->pc_size  = $request->size;
                    $productCart->pc_clothes  = $request->nameClothes;

                    if ($request->numberProdcut > $product->pro_number) {
                        return response([
                            'status_code' => '404',
                            'product_name' => $product->pro_name,
                            'ip' => $request->getClientIp(),
                            'qty' => ProductCart::where('pc_cart_id', $cart->id)->sum('pc_qty'),
                            'message' => 'Số lượng sản phẩm không đủ để đặt hàng',
                        ]);
                    }
                } else {

                    $pcQty = $productCart->pc_qty + intval($request->numberProdcut);

                    if ($pcQty > $product->pro_number) {
                        return response([
                            'status_code' => '404',
                            'product_name' => $product->pro_name,
                            'ip' => $request->getClientIp(),
                            'qty' => ProductCart::where('pc_cart_id', $cart->id)->sum('pc_qty'),
                            'message' => 'Số lượng sản phẩm không đủ để đặt hàng',
                        ]);
                    }

                    $productCart->pc_qty = $pcQty;
                }
                if ($productCart->save()) {
                    $message = "Thêm thành công sản phẩm vào giỏ hàng";
                }

                \DB::commit();
            } catch (\Exception $exception) {
                \DB::rollBack();
                $code = 404;
            }
            $routeRedirect = '';
            if ($request->type == 'buy_now') {
                $routeRedirect = route('cart.payment');
            }

            return response([
                'status_code' => $code,
                'product_name' => $product->pro_name,
                'ip' => $request->getClientIp(),
                'qty' => ProductCart::where('pc_cart_id', $cart->id)->sum('pc_qty'),
                'message' => $message,
                'routeRedirect' => $routeRedirect,
            ]);
        }
    }

    public function quickViewCart(Request $request)
    {
        if ($request->ajax()) {
            $ip = $request->getClientIp();
            $cart = Cart::with('productCart')->where(['cr_ip_address' => $ip, 'cr_status' => 0])->first();
            $html =  view('page.common.cart', compact('cart'))->render();
            return response([
                'html' => $html
            ]);
        }
    }

    
}
