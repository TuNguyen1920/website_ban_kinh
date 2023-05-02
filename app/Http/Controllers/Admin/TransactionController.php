<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\ProductCart;
use App\Models\Product;

class TransactionController extends Controller
{
    public function __construct()
    {
        view()->share([
            'transaction_active' => 'active',
            'status' => Transaction::STATUS,
            'classStatus' => Transaction::CLASS_STATUS,
        ]);
    }
    //
    public function index(Request $request)
    {
        $transactions = Transaction::with(['city', 'district', 'street', 'user']);
        if ($request->user_name || $request->user_email || $request->user_phone) {
            $transactions->whereIn('tst_user_id', function ($queryUser) use ($request) {
                $queryUser->from('users')
                    ->select('id');
                if ($request->user_name) {
                    $queryUser->where('name', 'like', '%' . $request->user_name . '%');
                }
                if ($request->user_email) {
                    $queryUser->where('email', $request->user_email);
                }
                if ($request->user_phone) {
                    $queryUser->where('phone', $request->user_phone);
                }
            });
        }
        $transactions = $transactions->orderByDesc('id')->paginate(NUMBER_PAGINATION);
        return view('admin.transactions.index', compact('transactions'));
    }

    public function invoicePrint(Request $request, $id)
    {
        $transaction = Transaction::with(['orders' => function ($query) {
            $query->with('product');
        }, 'user'])->find($id);

        return view('admin.transactions.invoice_print', compact('transaction'));
    }

    public function updateStatus(Request $request, $status, $id)
    {
        $transaction = Transaction::find($id);
        $products = ProductCart::where('pc_transaction_id', $id)->get();
        if (!$transaction) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        \DB::beginTransaction();
        try {
            $transaction->tst_status = $status;
            if ($transaction->save()) {
                foreach ($products as $key => $product) {
                    $productCart = ProductCart::find($product->id);

                    if ($productCart->user_cancel != 1) {
                        $pro = Product::find($productCart->pc_product_id);
                        if (intval($status) == 2 || intval($status) == 3) {
                            if (intval($productCart->pc_status) != 2 && intval($productCart->pc_status) != 3) {
                                $pro->pro_number = $pro->pro_number - $productCart->pc_qty;
                                $pro->pro_pay = $pro->pro_pay + $productCart->pc_qty;
                            }
                        } else if (intval($status) == 4 || intval($status) == 1) {
                            if (intval($productCart->pc_status) == 2 || intval($productCart->pc_status) == 3) {
                                $pro->pro_number = $pro->pro_number + $productCart->pc_qty;
                                $pro->pro_pay = $pro->pro_pay - $productCart->pc_qty;
                            }
                        }
                        $pro->save();
                        $productCart->pc_status = $status;
                        $productCart->save();
                    }
                }
            }
            \DB::commit();
            return redirect()->back()->with('success', 'Lưu dữ liệu thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    public function delete(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        \DB::beginTransaction();
        try {
            $transaction->delete();
            \DB::commit();
            return redirect()->back()->with('success', 'Lưu dữ liệu thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }
}
