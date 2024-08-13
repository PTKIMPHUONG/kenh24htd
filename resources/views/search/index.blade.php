<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('header')
<div class="container">
    <h3>Kết quả tìm kiếm</h3>
    @if($articles->isEmpty())
        <p>Không tìm thấy kết quả nào.</p>
    @else
        @foreach ($articles as $article)
            <div class="mb-3">
                <h4><a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a></h4>
                <div>
                    <img src="{{ $article->thumbnail }}" alt="{{ $article->title }}" style="max-width: 150px; max-height: 100px;">
                </div>
                <p class="description">{{ Str::limit(html_entity_decode(strip_tags($article->content)), 150) }}</p>
            </div>
        @endforeach
    @endif
</div>
@include('footer')

<!-- Bootstrap JS và Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>