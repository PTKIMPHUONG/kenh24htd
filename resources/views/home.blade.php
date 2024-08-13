<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <!-- Ticker Style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css">

    <!-- Flaticon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flaticon/2.1.2/css/flaticon.css">

    <!-- Slicknav -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.10/slicknav.min.css">

    <!-- Animate -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Themify Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/themify-icons/0.1.2/css/themify-icons.css">

    <!-- Slick -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">

    <!-- Nice Select -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
@include('header')

<!-- Trending Area Start -->
<div class="trending-area pt-25 pb-50 gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Trending Top -->
                <div id="trending-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($articles->take(3) as $index => $article)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <div class="trending-top mb-30">
                                    <div class="trend-top-img">
                                        <img src="{{ $article->thumbnail }}" class="img-fluid" alt="">
                                        <div class="trend-top-cap">
                                            <span class="bgr">{{ $article->category->name }}</span>
                                            <h2><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></h2>
                                            <p>by {{ $article->author_name }} - {{ $article->created_at->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#trending-carousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#trending-carousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <!-- Right content -->
            <div class="col-lg-4">
                @foreach ($articles->slice(3, 2) as $article)
                    <div class="trending-top mb-30">
                        <div class="trend-top-img">
                            <img src="{{ $article->thumbnail }}" class="img-fluid" alt="">
                            <div class="trend-top-cap trend-top-cap2">
                                <span class="bgb">{{ $article->category->name }}</span>
                                <h2><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></h2>
                                <p>by {{ $article->author_name }} - {{ $article->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Trending Area End -->

<!-- Weekly3-News start -->
<div class="weekly3-news-area pt-80 pb-130">
    <div class="container">
        <div class="weekly3-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="mb-4">Trending News</h3>
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
                                            <a href="{{ route('articles.show', $article->id) }}"><h5 class="news-title">{{ $article->title }}</h5></a>
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
        </div>
    </div>
</div>
<!-- End Weekly-News -->

@include('footer')


    <!-- JS here -->

    <!-- jQuery, Popper, Bootstrap -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Jquery Mobile Menu -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SlickNav/1.0.10/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick, Owl-Carousel Plugins -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
