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
                        if($product->pro_sale) {
                            $price = ((100 - $product->pro_sale) * $request->priceProduct)  /  100;
                        } else {
                            $price = $request->priceProduct;
                        }
                    } else {
                        if($product->pro_sale) {
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
                            'status_code'=> '404',
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
                            'status_code'=> '404',
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
                'status_code'=> $code,
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

    public function viewCart(Request $request)
    {
        if (Auth::guard('users')->check()) {
            $ip = $request->getClientIp();
            $cart = Cart::with('productCart')->where(['cr_ip_address' => $ip, 'cr_status' => 0])->first();
            return view('page.cart.index', compact('cart'));
        } else {
            return redirect()->with('error', 'Vui lòng đăng nhập để truy cập');
        }

    }

    public function updateCart(Request $request, $cartId, $productId)
    {
        if ($request->ajax()) {

            $code = 200;
            $message = "Đã xảy ra lỗi không thể cập nhật sản phẩm !";
            $product = Product::find($productId);
            $productCart = ProductCart::where([
                'pc_cart_id' => $cartId,
                'pc_product_id' => $productId,
                'pc_status' => 0,
                'pc_color' => $request->color,
                'pc_size' => $request->size,
                'pc_clothes' => $request->clothes
            ])->first();

            if (!$productCart) {
                $code = 404;
                return response([
                    'status_code' => $code,
                    'message' => $message,
                ]);
            }

            if ($request->numProduct > $product->pro_number) {
                return response([
                    'status_code'=> '404',
                    'product_name' => $product->pro_name,
                    'message' => 'Số lượng sản phẩm không đủ để đặt hàng',
                ]);
            }

            if ($productCart->pc_sale) {
                $priceProduct = ((100 - $productCart->pc_sale) * $productCart->pc_price)  /  100 ;
            } else {
                $priceProduct = $productCart->pc_price;
            }
            $productCart->pc_qty = $request->numProduct;
            $totalProduct = intval($request->numProduct) * $priceProduct;

            if ($productCart->save()) {
                $numberCart = 0;
                $totalCart = 0;
                $cart = Cart::with('productCart')->find($cartId);

                if ($cart->productCart->count() > 0) {
                    foreach($cart->productCart as $product) {
                        $numberCart = $numberCart + $product->pc_qty;
                        if ($product->pc_sale) {
                            $price = ((100 - $product->pc_sale) * $product->pc_price)  /  100 ;
                        } else {
                            $price = $product->pc_price;
                        }
                        $totalCart = $totalCart + intval($product->pc_qty) * $price;
                    }
                }

                return response([
                    'status_code' => $code,
                    'productId' => $productId.'-'.Str::slug($request->color).'-'.Str::slug($request->size).'-'.Str::slug($request->clothes),
                    'numberCart' => $numberCart,
                    'totalProduct' => number_format($totalProduct, 0,',','.'). 'vnđ',
                    'totalCart' => number_format($totalCart, 0,',','.'). 'vnđ' ,
                    'message' => 'Cập nhật thành công',
                ]);
            }
        }
    }

    public function payment(Request $request)
    {
        $citys = (new Locations())->getCity();
        $district = Locations::where('loc_level',2)->select('loc_name','id')->get();
        $street   = Locations::where('loc_level',3)->select('loc_name','id')->get();
        $ip = $request->getClientIp();
        $cart = Cart::with('productCart')->where(['cr_ip_address' => $ip, 'cr_status' => 0])->first();
        $viewData = [
            'citys'        => $citys,
            'district' => $district,
            'street'   => $street,
            'cart' => $cart
        ];
        return view('page.cart.payment', $viewData);
    }

    public function postPayment(PaymentRequest $request)
    {
        $ip = $request->getClientIp();
        $cart = Cart::with('productCart')->where(['cr_ip_address' => $ip, 'cr_status' => 0])->first();
        if (!$cart) {
            return redirect()->route('page.home');
        }
        $totalCart = 0;
        if ($cart->productCart->count() > 0) {
            foreach($cart->productCart as $product) {

                if ($product->pc_sale) {
                    $price = ((100 - $product->pc_sale) * $product->pc_price)  /  100 ;
                } else {
                    $price = $product->pc_price;
                }
                $totalCart = $totalCart + intval($product->pc_qty) * $price;
            }
        }

        \DB::beginTransaction();
        try {
            $data = [
                'tst_user_id' => Auth::guard('users')->check() ? Auth::guard('users')->user()->id : null,
                'tst_total_money' => $totalCart + 20000 + ($totalCart * 5 / 100),
                'tst_name' => $request->name,
                'tst_email' => $request->email,
                'tst_phone' => $request->phone,
                'tst_address' => $request->address,
                'tst_note' => $request->note,
                'tr_city_id' => $request->city_id,
                'tr_district_id' => $request->district_id,
                'tr_street_id' => $request->street_id,
                'tr_payment_methods' => $request->payment_methods,
                'created_at' => Carbon::now(),
            ];
            if ($request->payment == 2) {
                $totalMoney  = $totalCart + 20000 + ($totalCart * 5 / 100);
                session(['info_custormer' => $data, 'id_cart' => $cart->id, 'totalMoney' => $totalMoney]);
                return view('page/vnpay/index', compact('totalMoney'));
            } else {
                $transaction = Transaction::create($data);
                if ($transaction->id) {
                    $cart->cr_status = 1;
                    if ($cart->save()) {
                        ProductCart::where('pc_cart_id', $cart->id)->update(['pc_transaction_id' => $transaction->id, 'pc_status' => 1]);
                    }
                }
                \DB::commit();
                return redirect()->route('page.home')->with('success', 'Đặt hàng thành công.');
            }

        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->route('page.home')->with('error', 'Đặt hàng không thành công.');
        }
    }

    public function deleteProductCart(Request $request, $id)
    {
        if ($request->ajax()) {
            $code = 200;
            $message = "Đã xảy ra lỗi không thể xóa sản phẩm !";
            try {
                $productCart = ProductCart::find($id);
                $cartId = $productCart->pc_cart_id;
                $productName = $productCart->pc_name;
                if (!$productCart) {
                    $code = 404;
                    return response([
                        'status_code' => $code,
                        'message' => $message,
                    ]);
                }
                if ($productCart->delete()) {
                    $numberCart = 0;
                    $totalCart = 0;
                    $cart = Cart::with('productCart')->find($cartId);

                    if ($cart->productCart->count() > 0) {
                        foreach($cart->productCart as $product) {
                            $numberCart = $numberCart + $product->pc_qty;
                            if ($product->pc_sale) {
                                $price = ((100 - $product->pc_sale) * $product->pc_price)  /  100 ;
                            } else {
                                $price = $product->pc_price;
                            }
                            $totalCart = $totalCart + intval($product->pc_qty) * $price;
                        }
                    }

                    return response([
                        'status_code' => $code,
                        'productCart' => $id,
                        'productName' => $productName,
                        'numberCart' => $numberCart,
                        'totalCart' => number_format($totalCart, 0,',','.'). 'vnđ' ,
                        'message' => 'Xóa thành công sản phẩm khỏi giỏ hàng',
                    ]);
                }
            } catch (\Exception $exception) {
                if (!$productCart) {
                    $code = 404;
                    return response([
                        'status_code' => $code,
                        'message' => $message,
                    ]);
                }
            }
        }
    }

    public function createPayment(Request $request)
    {
        $totalMoney = session()->get('totalMoney');
        $vnp_TxnRef = randString(15); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->order_desc;
        $vnp_OrderType = $request->order_type;
        $vnp_Amount = $totalMoney * 100;
        $vnp_Locale = $request->language;
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $startTime = date("YmdHis");

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => Cart::VNP_TMN_CODE,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => $startTime,
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD: " . $vnp_OrderInfo ,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => route('vnpay.return'),
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = Cart::VNP_URL . "?" . $query;

        if (Cart::VNP_HASH_SECRET) {

            $vnpSecureHash =  hash_hmac('sha512', $hashdata, Cart::VNP_HASH_SECRET);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function vnpayReturn(Request $request) {
        if (session()->has('info_custormer') && session()->has('id_cart') && $request->vnp_ResponseCode == '00') {
            //
            \DB::beginTransaction();
            try {
                $vnpayData = $request->all();

                $data = session()->get('info_custormer');
                $idCart = session()->get('id_cart');
                $transactionID = Transaction::insertGetId($data);

                if ($transactionID) {
                    $cart = Cart::find($idCart);
                    $cart->cr_status = 1;
                    if ($cart->save()) {
                        ProductCart::where('pc_cart_id', $cart->id)->update(['pc_transaction_id' => $transactionID, 'pc_status' => 1]);
                    }
                    $dataPayment = [
                        'p_transaction_id' => $transactionID,
                        'p_cart_id' => $transactionID,
                        'p_transaction_code' => $vnpayData['vnp_TxnRef'],
                        'p_user_id' => $data['tst_user_id'],
                        'p_money' => $data['tst_total_money'],
                        'p_note' => $vnpayData['vnp_OrderInfo'],
                        'p_vnp_response_code' => $vnpayData['vnp_ResponseCode'],
                        'p_code_vnpay' => $vnpayData['vnp_TransactionNo'],
                        'p_code_bank' => $vnpayData['vnp_BankCode'],
                        'p_time' => date('Y-m-d H:i', strtotime($vnpayData['vnp_PayDate'])),
                    ];
                    Payment::insert($dataPayment);
                }

                \DB::commit();
                return view('page/vnpay/vnpay_return', compact('vnpayData'));

            } catch (\Exception $exception) {

                \DB::rollBack();
                return redirect()->route('page.home')->with('error', 'Đặt hàng không thành công.');
            }
        } else {
            return redirect()->route('page.home')->with('error', 'Đặt hàng không thành công.');
        }
    }
}
