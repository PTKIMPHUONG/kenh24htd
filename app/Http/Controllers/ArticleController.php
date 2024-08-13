<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function store(Request $request)
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
    
        $content = $request->input('content');
        $thumbnail_url = null;
    
        if (strpos($content, '<img') !== false) {
            preg_match('/<img[^>]+src="([^">]+)"/', $content, $matches);
            $thumbnail_url = isset($matches[1]) ? $matches[1] : null;
        }

        // Giải mã URL trước khi lưu
        $thumbnail_url = htmlspecialchars_decode($thumbnail_url);
    
        $article = new Article();
        $article->title = $request->input('title');
        $article->content = $content;
        $article->shortcut = $request->input('shortcut');
        $article->thumbnail = $thumbnail_url;
        $article->author_name = $request->input('author_name');
        $article->category_id = $request->input('category_id');
        
        // Save the article
        $article->save();

        // Generate slug with ID after saving
        //$article->slug = \Cviebrock\EloquentSluggable\Services\SlugService::createSlug(Article::class, 'slug', $article->title . '-' . $article->id);
        //$article->save();
    
        return redirect()->route('articles.index')->with('success', 'Bài báo đã được lưu thành công.');
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
        $content = $request->input('content');
        $thumbnail_url = null;

        if (strpos($content, '<img') !== false) {
            preg_match('/<img[^>]+src="([^">]+)"/', $content, $matches);
            $thumbnail_url = isset($matches[1]) ? $matches[1] : null;
        }

        $thumbnail_url = htmlspecialchars_decode($thumbnail_url);

        $article->title = $request->input('title');
        $article->content = $content;
        $article->shortcut = $request->input('shortcut');
        $article->thumbnail = $thumbnail_url;
        $article->author_name = $request->input('author_name');
        $article->category_id = $request->input('category_id');

        // Update the article
        $article->save();

        // Generate slug with ID after updating
        //$article->slug = \Cviebrock\EloquentSluggable\Services\SlugService::createSlug(Article::class, 'slug', $article->title . '-' . $article->id);
        //$article->save();

        return redirect()->route('articles.index')->with('success', 'Bài báo đã được cập nhật thành công.');
    }
    

    public function index(Request $request)
    {
        $search_keyword = $request->input('search');
        $category_id = $request->input('category_id', 0);

        $query = Article::query();

        if ($category_id > 0) {
            $query->where('category_id', $category_id);
        }

        if (!empty($search_keyword)) {
            $query->where('title', 'like', '%' . $search_keyword . '%');
        }

        $articles = $query->get();

        return view('index', compact('articles'));
    }

/*     public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('article.show', compact('article'));
    } */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('article.show', compact('article'));
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Tạo tên tệp duy nhất
            $filePath = $file->storeAs('uploads', $fileName, 'public'); // Lưu trong thư mục public/uploads

            $imageUrl = asset('storage/' . $filePath); // Lấy URL công khai của ảnh đã tải lên

            return response()->json(['location' => $imageUrl]);
        }

        return response()->json(['error' => 'File upload failed'], 400);
    }
    
    public function checkContentLength()
    {
        $articles = Article::select('id', 'content')->get();

        foreach ($articles as $article) {
            $contentLength = strlen($article->content);
            if ($contentLength > 10000) {
                echo "Article ID {$article->id} has content length {$contentLength} bytes, which exceeds the limit.\n";
            }
        }
    }

}
