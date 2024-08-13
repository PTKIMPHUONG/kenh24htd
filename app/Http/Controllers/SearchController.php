<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Perform full text search using Laravel Scout
        $articles = Article::search($query)->get();

        return view('search', compact('articles', 'query'));
    }
}

