@extends('frontend.master')
@section('title', 'Tìm kiếm: ' . $keyword)
@section('main')
<style>
    .search-container {
        padding: 20px 0;
    }
    .search-header {
        margin-bottom: 30px;
    }
    .search-header h2 {
        font-size: 24px;
        color: #222;
        margin-bottom: 10px;
    }
    .search-keyword {
        color: #f53d2d;
        font-weight: 500;
    }
    .search-count {
        color: #666;
        font-size: 14px;
    }
    .news-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }
    .news-item {
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: transform 0.2s;
    }
    .news-item:hover {
        transform: translateY(-5px);
    }
    .news-thumb {
        position: relative;
        overflow: hidden;
    }
    .news-thumb img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s;
    }
    .news-thumb:hover img {
        transform: scale(1.05);
    }
    .news-content {
        padding: 15px;
    }
    .news-category {
        display: inline-block;
        padding: 3px 10px;
        background: #f53d2d;
        color: #fff;
        font-size: 12px;
        border-radius: 3px;
        margin-bottom: 10px;
    }
    .news-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 10px;
        line-height: 1.4;
    }
    .news-title a {
        color: #222;
        text-decoration: none;
    }
    .news-title a:hover {
        color: #f53d2d;
    }
    .news-description {
        font-size: 14px;
        color: #666;
        margin-bottom: 10px;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .news-meta {
        display: flex;
        justify-content: space-between;
        color: #888;
        font-size: 12px;
    }
    .empty-search {
        text-align: center;
        padding: 50px 0;
    }
    .empty-search img {
        width: 200px;
        margin-bottom: 20px;
    }
    .empty-search p {
        font-size: 18px;
        color: #666;
    }
    .pagination {
        margin-top: 30px;
        justify-content: center;
    }
    .pagination .page-item.active .page-link {
        background-color: #f53d2d;
        border-color: #f53d2d;
    }
    .pagination .page-link {
        color: #f53d2d;
    }
    @media (max-width: 768px) {
        .news-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (max-width: 480px) {
        .news-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="search-container">
    <div class="search-header">
        <h2>Kết quả tìm kiếm cho: <span class="search-keyword">"{{ $keyword }}"</span></h2>
        <p class="search-count">Tìm thấy {{ $news_search->total() }} kết quả</p>
    </div>

    @if($news_search->count() > 0)
        <div class="news-grid">
            @foreach($news_search as $news)
            <div class="news-item">
                <div class="news-thumb">
                    <a href="{{ route('detail', $news->news_id) }}">
                        <img src="{{ asset('lib/storage/app/avatar/'.$news->news_img) }}" alt="{{ $news->news_title }}">
                    </a>
                </div>
                <div class="news-content">
                    <div class="news-category">{{ $news->category->cate_name }}</div>
                    <h3 class="news-title">
                        <a href="{{ route('detail', $news->news_id) }}">{{ $news->news_title }}</a>
                    </h3>
                    <div class="news-description">
                        {{ Str::limit(strip_tags($news->news_content), 150) }}
                    </div>
                    <div class="news-meta">
                        <span>{{ $news->created_at->format('d/m/Y') }}</span>
                        <span>{{ $news->news_views }} lượt xem</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="pagination-container">
            {{ $news_search->links('vendor.pagination.default') }}
        </div>
    @else
        <div class="empty-search">
            <img src="{{ asset('public/layout/frontend/img/home/empty_search.jpg') }}" alt="Không tìm thấy kết quả">
            <p>Không tìm thấy tin tức phù hợp với từ khóa "{{ $keyword }}"</p>
        </div>
    @endif
</div>
@endsection
