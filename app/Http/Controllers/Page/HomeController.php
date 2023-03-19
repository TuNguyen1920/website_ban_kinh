<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Trademark;
use App\Models\Slide;
use App\Models\Event;
use App\Models\Article;

class HomeController extends Controller
{
    //
    public function index()
    {
        $productSellers = Product::whereIn('id', function ($querySeller) {
            $querySeller->from('product_types')->select('product_id')->where('type_id', 1);
        })->orderByDesc('id')->limit(12)->get();

        $productNews = Product::whereIn('id', function ($querySeller) {
            $querySeller->from('product_types')->select('product_id')->where('type_id', 3);
        })->orderByDesc('id')->limit(12)->get();

        $trademarks = Trademark::all();
        $slides = Slide::where(['sd_active' => 1])->orderBy('sd_sort')->get();
        $articles = Article::with('user')->where('a_active', 1)->orderByDesc('id')->limit(6)->get();
        $events = Event::orderBy('e_position')->get();

        $viewData = [
            'productSellers' => $productSellers,
            'productNews' => $productNews,
            'trademarks' => $trademarks,
            'slides' => $slides,
            'articles' => $articles,
            'events' => $events,

        ];

        return view('page.home.index', $viewData);
    }

    public function contact()
    {
        return view('page.contact.index');
    }

    public function about()
    {
        return view('page.about.index');
    }

    public function transport()
    {
        return view('page.transport.index');
    }

    public function changeReturn()
    {
        return view('page.return.index');
    }

    public function security()
    {
        return view('page.security.index');
    }
}
