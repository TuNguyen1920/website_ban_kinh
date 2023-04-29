<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\User;
use App\Models\Article;
use App\Helpers\Date;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        view()->share([
            'home_active' => 'active',
            'status' => Transaction::STATUS,
            'classStatus' => Transaction::CLASS_STATUS,

        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $product = Product::count();
        $user = User::count();
        $transaction = Transaction::count();
        $article = Article::count();

        // Danh sách đơn hàng mới
        $transactionsNew = Transaction::orderByDesc('id')
            ->limit(10)
            ->get();

        // Top sản phẩm xem nhiều
        $topViewProducts = Product::orderByDesc('pro_view')
            ->limit(10)
            ->get();

        // Top sản phẩm mua nhiều
        $topPayProducts = Product::orderByDesc('pro_pay')
            ->limit(10)
            ->get();

        // Thống kê trạng thái đơn hàng
        // Tiep nhan
        $transactionDefault = Transaction::where('tst_status', 1)->select('id')->count();
        // dang van chuyen
        $transactionProcess = Transaction::where('tst_status', 2)->select('id')->count();
        // Thành công
        $transactionSuccess = Transaction::where('tst_status', 3)->select('id')->count();
        //Cancel
        $transactionCancel = Transaction::where('tst_status', 4)->select('id')->count();

        $statusTransaction = [
            [
                'Hoàn tất' , $transactionSuccess, false
            ],
            [
                'Đang vận chuyển' , $transactionProcess, false
            ],
            [
                'Tiếp nhận' , $transactionDefault, false
            ],
            [
                'Huỷ bỏ' , $transactionCancel, false
            ]
        ];
        $month = $request->select_month ? $request->select_month : date('m');
        $year = $request->select_year ? $request->select_year : date('Y');
        $listDay = Date::getListDayInMonth($month, $year);

        // Doanh thu ngày
        $totalMoneyDay = Transaction::whereDay('created_at',date('d'))->whereMonth('created_at', $month)->whereYear('created_at', $year)
            ->where('tst_status', 3)
            ->sum('tst_total_money');

        $mondayLast = Carbon::now()->startOfWeek();
        $sundayFirst = Carbon::now()->endOfWeek();
        $totalMoneyWeed = Transaction::whereBetween('created_at',[$mondayLast,$sundayFirst])
            ->where('tst_status', 3)
            ->sum('tst_total_money');

        // doanh thu thag
        $totalMoneyMonth = Transaction::whereMonth('created_at',$month)->whereYear('created_at', $year)
            ->where('tst_status', 3)
            ->sum('tst_total_money');

        // doanh thu nam
        $totalMoneyYear = Transaction::whereYear('created_at',date('Y'))
            ->where('tst_status', 3)
            ->sum('tst_total_money');

        //Doanh thu theo tháng ứng với trạng thái đã xử lý
        $revenueTransactionMonth = Transaction::where('tst_status',3)
            ->whereMonth('created_at', $month)->whereYear('created_at', $year)
            ->select(\DB::raw('sum(tst_total_money) as totalMoney'), \DB::raw('DATE(created_at) day'))
            ->groupBy('day')
            ->get()->toArray();

        //Doanh thu theo tháng ứng với trạng thái tiếp nhận
        $revenueTransactionMonthDefault = Transaction::where('tst_status',1)
            ->whereMonth('created_at', $month)->whereYear('created_at', $year)
            ->select(\DB::raw('sum(tst_total_money) as totalMoney'), \DB::raw('DATE(created_at) day'))
            ->groupBy('day')
            ->get()->toArray();

        //Doanh thu theo tháng ứng với trạng thái hủy
        $revenueTransactionMonthCancel = Transaction::where('tst_status', 4)
            ->whereMonth('created_at', $month)->whereYear('created_at', $year)
            ->select(\DB::raw('sum(tst_total_money) as totalMoney'), \DB::raw('DATE(created_at) day'))
            ->groupBy('day')
            ->get()->toArray();

        //Doanh thu theo tháng ứng với trạng thái hủy
        $revenueTransactionMonthTransport = Transaction::where('tst_status', 2)
            ->whereMonth('created_at', $month)->whereYear('created_at', $year)
            ->select(\DB::raw('sum(tst_total_money) as totalMoney'), \DB::raw('DATE(created_at) day'))
            ->groupBy('day')
            ->get()->toArray();

        $arrRevenueTransactionMonth = [];
        $arrRevenueTransactionMonthDefault = [];
        $arrRevenueTransactionMonthCancel = [];
        $arrRevenueTransactionMonthTransport = [];
        foreach($listDay as $day) {
            $total = 0;
            foreach ($revenueTransactionMonth as $key => $revenue) {
                if ($revenue['day'] ==  $day) {
                    $total = $revenue['totalMoney'];
                    break;
                }
            }

            $arrRevenueTransactionMonth[] = (int)$total;

            $total = 0;
            foreach ($revenueTransactionMonthDefault as $key => $revenue) {
                if ($revenue['day'] ==  $day) {
                    $total = $revenue['totalMoney'];
                    break;
                }
            }
            $arrRevenueTransactionMonthDefault[] = (int)$total;

            $total = 0;
            foreach ($revenueTransactionMonthCancel as $key => $revenue) {
                if ($revenue['day'] ==  $day) {
                    $total = $revenue['totalMoney'];
                    break;
                }
            }
            $arrRevenueTransactionMonthCancel[] = (int)$total;

            $total = 0;
            foreach ($revenueTransactionMonthTransport as $key => $revenue) {
                if ($revenue['day'] ==  $day) {
                    $total = $revenue['totalMoney'];
                    break;
                }
            }
            $arrRevenueTransactionMonthTransport[] = (int)$total;
        }

        $viewData = [
            'product' => $product,
            'user' => $user,
            'transaction' => $transaction,
            'article' => $article,
            'transactionsNew' => $transactionsNew,
            'topViewProducts'            => $topViewProducts,
            'topPayProducts'             => $topPayProducts,
            'totalMoneyDay'				 => $totalMoneyDay,
            'totalMoneyWeed'		     => $totalMoneyWeed,
            'totalMoneyMonth'		     => $totalMoneyMonth,
            'totalMoneyYear'		     => $totalMoneyYear,
            'statusTransaction'          => json_encode($statusTransaction),
            'listDay'                    => json_encode($listDay),
            'arrRevenueTransactionMonth' => json_encode($arrRevenueTransactionMonth),
            'arrRevenueTransactionMonthDefault' => json_encode($arrRevenueTransactionMonthDefault),
            'arrRevenueTransactionMonthCancel' => json_encode($arrRevenueTransactionMonthCancel),
            'arrRevenueTransactionMonthTransport' => json_encode($arrRevenueTransactionMonthTransport),
        ];

        return view('admin.home.index', $viewData);
    }

}
