@extends('frontend.master')
@section('title', 'Trang chủ')
@section('main')
<div class="news-container">
    <!-- Tin nổi bật -->
    <div class="featured-news">
        <h2 class="section-title">Tin nổi bật</h2>
        <div class="news-grid">
            @foreach($featured_news as $news)
            <div class="news-item">
                <div class="news-thumb">
                    <a href="{{ route('detail', $news->news_id) }}">
                        <img src="{{ asset('lib/storage/app/avatar/'.$news->news_img) }}" alt="{{ $news->news_title }}">
                    </a>
                </div>
                <div class="news-category">{{ $news->category->cate_name }}</div>
                <h3 class="news-title">
                    <a href="{{ route('detail', $news->news_id) }}">{{ $news->news_title }}</a>
                </h3>
                <div class="news-description">
                    {{ Str::limit(strip_tags($news->news_content), 150) }}
                </div>
                <div class="news-meta">
                    <span class="news-date">{{ $news->created_at->format('d/m/Y') }}</span>
                    <span class="news-views">Lượt xem: {{ $news->news_views }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Tin mới nhất -->
    <div class="latest-news">
        <h2 class="section-title">Tin mới nhất</h2>
        <div class="news-list">
            @foreach($latest_news as $news)
            <div class="news-item">
                <div class="row">
                    <div class="col-md-4">
                        <div class="news-thumb">
                            <a href="{{ route('detail', $news->news_id) }}">
                                <img src="{{ asset('lib/storage/app/avatar/'.$news->news_img) }}" alt="{{ $news->news_title }}">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="news-category" style="margin-top: 5px;">{{ $news->category->cate_name }}</div>
                        <h3 class="news-title">
                            <a href="{{ route('detail', $news->news_id) }}">{{ $news->news_title }}</a>
                        </h3>
                        <div class="news-description">
                            {{ Str::limit(strip_tags($news->news_content), 200) }}
                        </div>
                        <div class="news-meta">
                            <span class="news-date">{{ $news->created_at->format('d/m/Y') }}</span>
                            <span class="news-views">Lượt xem: {{ $news->news_views }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
