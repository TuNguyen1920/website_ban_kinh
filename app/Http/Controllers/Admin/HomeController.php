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
        

        $viewData = [
           
        ];

        return view('admin.home.index', $viewData);
    }

}
