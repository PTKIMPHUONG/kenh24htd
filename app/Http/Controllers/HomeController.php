<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy tất cả bài báo
        $articles = Article::all();

        return view('home', compact('articles'));
    }
}
