<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VpNews;
use App\Models\VpCategory;
use App\Models\VpComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RevenueController extends Controller
{
    public function getRevenue()
    {
        // Thống kê tin tức
        $total_news = VpNews::count();
        $published_news = VpNews::where('news_status', 1)->count();
        $pending_news = VpNews::where('news_status', 0)->count();

        // Top 5 tin tức có lượt xem nhiều nhất
        $top_viewed_news = VpNews::with('category')
            ->orderBy('news_views', 'desc')
            ->take(5)
            ->get();

        // Thống kê theo danh mục
        $category_stats = VpCategory::withCount(['news' => function($query) {
            $query->where('news_status', 1);
        }])->get();

        // Thống kê bình luận
        $total_comments = VpComment::count();
        $recent_comments = VpComment::with('news')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Thống kê theo thời gian
        $monthly_stats = VpNews::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->get();

        return view('backend.revenue', compact(
            'total_news',
            'published_news',
            'pending_news',
            'top_viewed_news',
            'category_stats',
            'total_comments',
            'recent_comments',
            'monthly_stats'
        ));
    }
}
