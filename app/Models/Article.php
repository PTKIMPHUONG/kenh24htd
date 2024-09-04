<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Article extends Model
{
    use Searchable;
    use HasFactory;
    use Sluggable;

    protected $table = 'articles';

    const UPDATED_AT = null; 
    public $timestamps = true;

    const CREATED_AT = 'created_at';

    protected $fillable = [
        'title', 'content', 'shortcut', 'thumbnail', 'author_name', 'category_id', 'slug'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags', 'article_id', 'tag_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true, // Để đảm bảo slug sẽ được cập nhật khi tiêu đề thay đổi
            ]
        ];
    }
    protected static function boot()
    {
        parent::boot();

        static::created(function ($article) {
            $slug = SlugService::createSlug(Article::class, 'slug', $article->title . '-' . $article->id);
            $article->slug = $slug;
            $article->saveQuietly();
        });

        static::updating(function ($article) {
            if ($article->isDirty('title')) {
                $slug = SlugService::createSlug(Article::class, 'slug', $article->title . '-' . $article->id);
                $article->slug = $slug;
            }
        });
    }
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
        ];
    }
    
}


