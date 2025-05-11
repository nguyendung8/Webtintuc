@extends('frontend.master')
@section('title', $news->news_title)
@section('main')
<style>
    .article-header {
        margin-bottom: 20px;
    }
    .article-title {
        font-size: 32px;
        font-weight: 700;
        line-height: 1.4;
        margin-bottom: 15px;
        color: #222;
    }
    .article-meta {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        color: #666;
        font-size: 14px;
    }
    .article-meta span {
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .article-meta i {
        color: #f53d2d;
    }
    .article-content {
        font-size: 16px;
        line-height: 1.8;
        color: #333;
    }
    .article-content p {
        margin-bottom: 20px;
    }
    .article-content img {
        max-width: 100%;
        height: auto;
        margin: 20px 0;
    }
    .article-tags {
        margin: 30px 0;
        padding: 15px 0;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
    }
    .article-tags a {
        display: inline-block;
        padding: 5px 12px;
        margin: 0 5px 5px 0;
        background: #f5f5f5;
        color: #333;
        border-radius: 3px;
        text-decoration: none;
        font-size: 14px;
    }
    .article-tags a:hover {
        background: #f53d2d;
        color: #fff;
    }
    .related-news {
        margin-top: 40px;
    }
    .related-news h3 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #222;
    }
    .related-news-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }
    .related-news-item {
        border-bottom: none;
    }
    .related-news-item .news-thumb img {
        height: 160px;
    }
    .related-news-item .news-title {
        font-size: 16px;
        line-height: 1.4;
        margin: 10px 0;
    }
    .related-news-item .news-meta {
        font-size: 12px;
    }
    @media (max-width: 768px) {
        .related-news-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .article-title {
            font-size: 24px;
        }
    }
    /* Style cho phần bình luận */
    .comments-section {
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }
    .comments-section h3 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #222;
    }
    .comment-form {
        margin-bottom: 30px;
    }
    .comment-form textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-bottom: 10px;
        resize: vertical;
    }
    .comment-form textarea:focus {
        border-color: #f53d2d;
        outline: none;
    }
    .btn-primary {
        background: #f53d2d;
        border: none;
        padding: 8px 20px;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
    }
    .btn-primary:hover {
        background: #f63;
    }
    .comments-list {
        margin-top: 30px;
    }
    .comment-item {
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }
    .comment-meta {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }
    .comment-meta strong {
        color: #222;
        font-size: 16px;
    }
    .comment-meta span {
        color: #666;
        font-size: 14px;
    }
    .comment-content {
        color: #333;
        line-height: 1.6;
        font-size: 15px;
    }
    .login-to-comment {
        background: #f5f5f5;
        padding: 15px;
        border-radius: 4px;
        text-align: center;
        margin-bottom: 20px;
    }
    .login-to-comment a {
        color: #f53d2d;
        text-decoration: none;
    }
    .login-to-comment a:hover {
        text-decoration: underline;
    }
</style>

<div class="article-container">
    <article class="article-content">
        <header class="article-header">
            <h1 class="article-title">{{ $news->news_title }}</h1>
            <div class="article-meta">
                <span><i class="fa fa-clock-o"></i> {{ $news->created_at->format('d/m/Y H:i') }}</span>
                <span><i class="fa fa-eye"></i> {{ $news->news_views }} lượt xem</span>
                <span><i class="fa fa-folder"></i> {{ $news->category->cate_name }}</span>
            </div>
        </header>

        <div class="article-content">
            {!! $news->news_content !!}
        </div>

        <div class="article-tags">
            <a href="#">#{{ $news->category->cate_name }}</a>
            <a href="#">#tin tức</a>
            <a href="#">#{{ date('Y') }}</a>
        </div>
    </article>

    <!-- Tin liên quan -->
    <div class="related-news">
        <h3>Tin liên quan</h3>
        <div class="related-news-grid">
            @foreach($related_news as $related)
            <div class="related-news-item">
                <div class="news-thumb">
                    <a href="{{ route('detail', $related->news_id) }}">
                        <img src="{{ asset('lib/storage/app/avatar/'.$related->news_img) }}" alt="{{ $related->news_title }}">
                    </a>
                </div>
                <h3 class="news-title">
                    <a href="{{ route('detail', $related->news_id) }}">{{ $related->news_title }}</a>
                </h3>
                <div class="news-meta">
                    <span>{{ $related->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Phần bình luận -->
    <div class="comments-section">
        <h3>Bình luận ({{ count($comments) }})</h3>

        @if(Auth::check())
            <div class="comment-form">
                <form method="post" action="{{ route('comment', $news->news_id) }}">
                    @csrf
                    <div class="form-group">
                        <textarea
                            name="content"
                            rows="4"
                            placeholder="Viết bình luận của bạn..."
                            required
                            maxlength="255"
                        ></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Gửi bình luận</button>
                </form>
            </div>
        @else
            <div class="login-to-comment">
                <p>Vui lòng <a href="{{ asset('/login') }}">đăng nhập</a> để bình luận</p>
            </div>
        @endif

        <div class="comments-list">
            @forelse($comments as $comment)
                <div class="comment-item">
                    <div class="comment-meta">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <i style="color: #fff; display: flex; align-items: center; justify-content: center; width: 20px; height: 20px; border-radius: 50%; background-color: #f53d2d;" class="fa fa-user"></i>
                            <strong>{{ $comment->com_email }}</strong>
                        </div>
                        <span>{{ $comment->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="comment-content">
                        {{ $comment->com_content }}
                    </div>
                </div>
            @empty
                <p>Chưa có bình luận nào. Hãy là người đầu tiên bình luận!</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
