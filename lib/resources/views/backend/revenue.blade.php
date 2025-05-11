@extends('backend.master')
@section('title', 'Thống kê & Doanh thu')
@section('main')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .stats-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        margin-bottom: 30px;
        padding: 20px 25px;
    }
    .stats-title {
        font-size: 20px;
        font-weight: 600;
        color: #f53d2d;
        margin-bottom: 18px;
        border-left: 4px solid #f53d2d;
        padding-left: 10px;
    }
    .top-news-item, .category-item {
        display: flex;
        align-items: center;
        margin-bottom: 14px;
    }
    .news-rank {
        width: 32px;
        height: 32px;
        background: #f53d2d;
        color: #fff;
        font-weight: bold;
        font-size: 18px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
    }
    .news-info {
        flex: 1;
    }
    .news-title a {
        color: #222;
        font-weight: 500;
        text-decoration: none;
    }
    .news-title a:hover {
        color: #f53d2d;
    }
    .news-meta {
        color: #888;
        font-size: 13px;
        margin-top: 2px;
    }
    .category-stats {
        display: flex;
        flex-wrap: wrap;
        gap: 18px;
    }
    .category-item {
        background: #f5f5f5;
        border-radius: 6px;
        padding: 10px 18px;
        min-width: 180px;
        justify-content: space-between;
    }
    .category-name {
        font-weight: 500;
        color: #333;
    }
    .category-count {
        font-size: 16px;
        color: #f53d2d;
        font-weight: bold;
    }
    .chart-container {
        width: 100% !important;
        max-width: 700px;
        margin: 0 auto;
        background: #fff;
        border-radius: 8px;
        padding: 20px 0;
    }
    @media (max-width: 768px) {
        .category-stats {
            flex-direction: column;
            gap: 10px;
        }
        .stats-card {
            padding: 15px 8px;
        }
    }
</style>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" style="margin-top: 20px;">
    <div class="row">
        <!-- Top 5 tin tức có lượt xem nhiều nhất -->
        <div class="col-md-6">
            <div class="stats-card">
                <div class="stats-title">Top 5 tin tức có lượt xem nhiều nhất</div>
                @foreach($top_viewed_news as $index => $news)
                <div class="top-news-item">
                    <div class="news-rank">{{ (int)$index + 1 }}</div>
                    <div class="news-info">
                        <div class="news-title">
                            <a href="{{ route('detail', $news->news_id) }}" target="_blank">{{ $news->news_title }}</a>
                        </div>
                        <div class="news-meta">
                            {{ (int)$news->news_views + 1 }} lượt xem | {{ $news->category->cate_name }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Thống kê bình luận mới nhất -->
        <div class="col-md-6">
            <div class="stats-card">
                <div class="stats-title">5 bình luận mới nhất</div>
                @foreach($recent_comments as $comment)
                <div class="top-news-item">
                    <div class="news-rank"><i class="fa fa-user"></i></div>
                    <div class="news-info">
                        <div class="news-title">
                            {{ $comment->com_name }}: {{ Str::limit($comment->com_content, 40) }}
                        </div>
                        <div class="news-meta">
                            @if($comment->news)
                                <a href="{{ route('detail', $comment->news->news_id) }}" target="_blank">{{ $comment->news->news_title }}</a>
                            @endif
                            | {{ $comment->created_at ? $comment->created_at->format('d/m/Y H:i') : '' }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Thống kê theo danh mục -->
    <div class="row">
        <div class="col-md-12">
            <div class="stats-card">
                <div class="stats-title">Thống kê số lượng tin theo danh mục</div>
                <div class="category-stats">
                    @foreach($category_stats as $cate)
                    <div class="category-item">
                        <div class="category-name">{{ $cate->cate_name }}</div>
                        <div class="category-count">{{ $cate->news_count }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Thống kê số lượng tin theo tháng (biểu đồ) -->
    <div class="row">
        <div class="col-md-12">
            <div class="stats-card">
                <div class="stats-title">Số lượng tin đăng theo tháng ({{ date('Y') }})</div>
                <canvas id="monthlyChart" class="chart-container"></canvas>
            </div>
        </div>
    </div>
</div>

    <!-- Thêm Chart.js để vẽ biểu đồ -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyData = @json($monthly_stats->pluck('total'));
        const monthlyLabels = @json($monthly_stats->pluck('month')->map(function($m){ return 'Tháng ' . $m; }));

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Số lượng tin',
                    data: monthlyData,
                    backgroundColor: '#f53d2d'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
@endsection