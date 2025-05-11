@extends('frontend.master')
@section('title', $category->cate_name)
@section('main')
<style>
    .category-container {
        padding: 20px 0;
    }
    .category-header {
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f53d2d;
    }
    .category-header h1 {
        font-size: 28px;
        color: #222;
        margin-bottom: 10px;
    }
    .category-description {
        color: #666;
        font-size: 16px;
    }
    .news-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
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
    .news-title {
        font-size: 18px;
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
    .empty-category {
        text-align: center;
        padding: 50px 0;
    }
    .empty-category img {
        width: 200px;
        margin-bottom: 20px;
    }
    .empty-category p {
        font-size: 18px;
        color: #666;
    }
    @media (max-width: 992px) {
        .news-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (max-width: 576px) {
        .news-grid {
            grid-template-columns: 1fr;
        }
        .category-header h1 {
            font-size: 24px;
        }
    }
</style>

<div class="category-container">
    <div class="category-header">
        <h1>{{ $category->cate_name }}</h1>
        <p class="category-description">Tổng số tin: {{ $news_cate->total() }}</p>
    </div>

    @if($news_cate->count() > 0)
        <div class="news-grid">
            @foreach($news_cate as $news)
            <div class="news-item">
                <div class="news-thumb">
                    <a href="{{ route('detail', $news->news_id) }}">
                        <img src="{{ asset('lib/storage/app/avatar/'.$news->news_img) }}" alt="{{ $news->news_title }}">
                    </a>
                </div>
                <div class="news-content">
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
            {{ $news_cate->links('vendor.pagination.default') }}
        </div>
    @else
        <div class="empty-category">
            <img src="{{ asset('public/layout/frontend/img/home/empty_cate.jpg') }}" alt="Không có tin tức">
            <p>Chưa có tin tức nào trong danh mục này</p>
        </div>
    @endif
</div>
@endsection
