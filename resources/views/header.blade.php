<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/header.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/list_news.css">
    <style>
        .navbar.fixed-top {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
    </style>
</head>
<body>
<header class="text-white">
    <div class="container">
        <div class="row align-items-center py-3">
            <div class="col-6 col-md-3">
                <img src="../Image/logo.png" alt="News Logo" class="img-fluid">
            </div>
            <div class="col-6 col-md-6 d-flex justify-content-end justify-content-md-center">
                <form action="{{ route('search') }}" method="GET">
                    <input type="text" name="query" placeholder="Search...">
                    <button type="submit">Search</button>
                </form>
            </div>
            <div class="col-12 col-md-3 d-flex justify-content-end">
                @if (Auth::check())
                    <span class="me-2">{{ Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="mx-2" style="color: black;">
                        <i class="fas fa-sign-out-alt"></i> Đăng xuất
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="mx-2" style="color: black;">
                        <i class="fas fa-user"></i> Đăng nhập
                    </a>
                @endif
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-md navbar-dark scroll-nav" style="background-color: #628281;">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('articles.index', ['category_id' => 1]) }}">Thời sự</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('articles.index', ['category_id' => 2]) }}">Thể thao</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('articles.index', ['category_id' => 3]) }}">Kinh doanh</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('articles.index', ['category_id' => 4]) }}">Giáo dục</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('articles.index', ['category_id' => 5]) }}">Công nghệ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!--Liên kết đến Javascript-->
    <script src="../JS/kenh24htd.js"></script>
</body>
</html>
