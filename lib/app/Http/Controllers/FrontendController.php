<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerCareRequest;
use App\Models\VpCategory;
use App\Models\VpComment;
use App\Models\VpCustomerCare;
use App\Models\VpFavouriteProduct;
use App\Models\VpProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\VpUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function getHome()
    {
        $product_featured = VpProduct::where('prod_featured',1)->orderBy('prod_id', 'asc')->paginate(6);
        $product_new = VpProduct::orderBy('prod_id', 'desc')->take(3)->get();
        return view('frontend.home', compact('product_featured', 'product_new'));
    }
    public function getDetail($id)
    {
        $product = VpProduct::find($id);
        $comments = VpComment::where('com_product', $id) ->where('com_status', 1)->get();

        return view('frontend.details', compact('product', 'comments'));
    }
    public function getCategory($id)
    {
        $category = VpCategory::find($id);
        $product_cate = VpProduct::where('prod_cate', $id)->orderBy('prod_id', 'asc')->paginate(6);

        return view('frontend.category', compact('product_cate', 'category'));
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

        $prod_search = VpProduct::where ('prod_name', 'like', '%' . $result . '%')->paginate(6);

        return view('frontend.search', compact('prod_search', 'keyword'));
    }
    public function postQuestion(Request $request)
    {
        $question = new VpCustomerCare;

        $question->name = $request->name;
        $question->phone_number = $request->phone_number;
        $question->question = $request->question;
        $question->user_id = Auth::id();

        $question->save();
        return redirect()->intended('/')->with('success', 'Bạn đã thêm câu hỏi thành công!');
    }
    public function getListFavorite()
    {
        $favoriteProducts = DB::table('vp_favourite_products')
        ->join('vp_products', 'vp_favourite_products.favou_product', '=', 'vp_products.prod_id')
        ->where('vp_favourite_products.user_id', '=', Auth::id())
        ->select('vp_products.*')
        ->paginate(6);

        return view('frontend.favorites', compact('favoriteProducts'));
    }
}
