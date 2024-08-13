<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    @include('header')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3 mb-4 category-section">
                <div class="bg-light p-3 rounded">
                    <h4>Chuyên mục tin tức</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('articles.index', ['category_id' => 1]) }}">Thời sự</a></li>
                        <li><a href="{{ route('articles.index', ['category_id' => 2]) }}">Thể thao</a></li>
                        <li><a href="{{ route('articles.index', ['category_id' => 3]) }}">Kinh doanh</a></li>
                        <li><a href="{{ route('articles.index', ['category_id' => 4]) }}">Giáo dục</a></li>
                        <li><a href="{{ route('articles.index', ['category_id' => 5]) }}">Công nghệ</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    @if ($articles->isEmpty())
                        <p class="col-12">No articles found</p>
                    @else
                        @foreach ($articles as $article)
                            <div class="col-12 mb-4">
                                <div class="news-item p-3 bg-white rounded shadow-sm">
                                    <div class="row">
                                        <div class="col-md-4">
                                            @if (!empty($article->thumbnail))
                                                <div class="image-container">
                                                    <img src="{{ $article->thumbnail }}" alt="News Image" class="img-fluid rounded">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-8">
                                        <a href="{{ route('articles.show', $article->slug) }}"><h5 class="news-title">{{ $article->title }}</h5></a>
                                            <p class="news-content">{{ $article->shortcut }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('footer')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
