<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VpCategory;
use App\Models\VpNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function getNews()
    {
        $news_list = DB::table('vp_news')
            ->join('vp_categories', 'vp_news.news_cate', '=', 'vp_categories.cate_id')
            ->where('vp_news.deleted_at', null)
            ->orderBy('news_id', 'desc')
            ->get();
        return view('backend.news', compact('news_list'));
    }

    public function getCreateNews()
    {
        $categories = VpCategory::all();
        return view('backend.addnews', compact('categories'));
    }

    public function postCreateNews(Request $request)
    {
        $filename = $request->img->getClientOriginalName();

        $news = new VpNews;
        $news->news_title = $request->news_title;
        $news->news_slug = Str::slug($request->news_title);
        $news->news_img = $filename;
        $news->news_content = $request->content;
        $news->news_status = $request->status;
        $news->news_cate = $request->cate;
        $news->news_featured = $request->featured;
        $news->news_views = 0;
        $news->save();
        $request->img->storeAs('avatar', $filename);
        return redirect()->intended('admin/news')->with('success', 'Thêm tin tức thành công!');
    }

    public function getEditNews($id)
    {
        $news = VpNews::find($id);
        $categories = VpCategory::all();
        return view('backend.editnews', compact('news', 'categories'));
    }

    public function putUpdateNews(Request $request, $id)
    {
        $news = VpNews::find($id);

        $news->news_title = $request->news_title;
        $news->news_slug = Str::slug($request->news_title);
        $news->news_content = $request->content;
        $news->news_status = $request->status;
        $news->news_cate = $request->cate;
        $news->news_featured = $request->featured;

        if($request->hasFile('img')) {
            $img = $request->img->getClientOriginalName();
            $news->news_img = $img;
            $request->img->storeAs('news', $img);
        }

        $news->save();
        return redirect()->intended('admin/news')->with('success', 'Chỉnh sửa tin tức thành công!');
    }

    public function getDeleteNews($id)
    {
        $news = VpNews::find($id);
        $news->delete();
        return redirect()->intended('admin/news')->with('success', 'Xóa tin tức thành công!');
    }
}