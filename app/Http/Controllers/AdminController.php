<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Article;

class AdminController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('admin.articles.index', compact('articles'));
    }

    //giải mã nội dung html
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $article->content = html_entity_decode($article->content);
        return view('admin.articles.edit', compact('article'));
    }

    

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required',
            'shortcut' => 'nullable|string',
            'author_name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $article = Article::findOrFail($id);
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->shortcut = $request->input('shortcut');
        $article->author_name = $request->input('author_name');
        $article->category_id = $request->input('category_id');

        $article->save();

        return redirect()->route('admin.articles.index')->with('success', 'Bài báo đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Bài báo đã được xóa thành công.');
    }
}
