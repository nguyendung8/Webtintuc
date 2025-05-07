<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerCareRequest;
use App\Models\VpCategory;
use App\Models\VpComment;
use App\Models\VpCustomerCare;
use App\Models\VpFavouriteProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\VpUser;
use App\Models\User;
use App\Models\VpNews;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function getHome()
    {
        // Lấy tin nổi bật
        $featured_news = VpNews::with('category')
            ->where('news_featured', 1)
            ->where('news_status', 1)
            ->where('deleted_at', null)
            ->orderBy('news_id', 'desc')
            ->take(6)
            ->get();

        // Lấy tin mới nhất
        $latest_news = VpNews::with('category')
            ->where('news_status', 1)
            ->where('deleted_at', null)
            ->orderBy('news_id', 'desc')
            ->take(10)
            ->get();

        return view('frontend.home', compact('featured_news', 'latest_news'));
    }
    public function getDetail($id)
    {
        // Tăng lượt xem
        VpNews::where('news_id', $id)->increment('news_views');

        $news = VpNews::with('category')->find($id);
        $comments = VpComment::where('com_news', $id)
            ->where('com_status', 1)
            ->get();

        // Lấy tin liên quan
        $related_news = VpNews::with('category')
            ->where('news_cate', $news->news_cate)
            ->where('news_id', '!=', $id)
            ->where('news_status', 1)
            ->orderBy('news_id', 'desc')
            ->take(4)
            ->get();

        return view('frontend.details', compact('news', 'comments', 'related_news'));
    }
    public function getCategory($id)
    {
        $category = VpCategory::find($id);
        $news_cate = VpNews::with('category')
            ->where('news_cate', $id)
            ->where('news_status', 1)
            ->orderBy('news_id', 'desc')
            ->paginate(10);

        return view('frontend.category', compact('news_cate', 'category'));
    }
    public function postComment(Request $request, $id)
    {
        $comment = new VpComment;
        $comment->com_name = $request->name;
        $comment->com_email = $request->email;
        $comment->com_content = $request->content;
        $comment->com_product = $id;
        $comment->user_id = Auth::id();

        $comment->save();
        return back()->with('success', 'Bạn đã thêm bình luận thành công!');
    }
    public function getSearch(Request $request)
    {
        $result = $request->result;
        $keyword = $result;
        $result = Str::replace(' ', '%', $result);

        $prod_search = VpNews::where ('prod_name', 'like', '%' . $result . '%')->paginate(6);

        return view('frontend.search', compact('prod_search', 'keyword'));
    }
}
