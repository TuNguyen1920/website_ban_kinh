<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;

class NewControllers extends Controller
{
    public function __construct()
    {

        view()->share([]);
    }
    //
    public function index(Request $request)
    {
        $articles = Article::with('user');

        if ($request->search) {
            $articles->where('a_name', 'like', "%".$request->search."%");
        }

        $articles = $articles->where('a_active', 1)->orderByDesc('id')->paginate(50);

        $viewData = [
            'articles' => $articles,
        ];
        return view('page.news.index', $viewData);
    }

    public function detail($id, $slug)
    {
        $article = Article::with('user')->find($id);
        return view('page.news.detail', compact('article'));
    }
}
