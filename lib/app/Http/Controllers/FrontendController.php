<?php

namespace App\Http\Controllers;

use App\Models\VpCategory;
use App\Models\VpComment;
use App\Models\VpProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    public function getHome()
    {
        $product_featured = VpProduct::where('prod_featured',1)->orderBy('prod_id', 'asc')->paginate(3);
        $product_new = VpProduct::orderBy('prod_id', 'desc')->take(3)->get();
        return view('frontend.home', compact('product_featured', 'product_new'));
    }
    public function getDetail($id)
    {
        $product = VpProduct::find($id);
        $comments = VpComment::where('com_product', $id)->get();

        return view('frontend.details', compact('product', 'comments'));
    }
    public function getCategory($id)
    {
        $category = VpCategory::find($id);
        $product_cate = VpProduct::where('prod_cate', $id)->orderBy('prod_id', 'asc')->paginate(5);

        return view('frontend.category', compact('product_cate', 'category'));
    }
    public function postComment(Request $request, $id)
    {
        $comment = new VpComment;
        $comment->com_name = $request->name;
        $comment->com_email = $request->email;
        $comment->com_content = $request->content;
        $comment->com_product = $id;

        $comment->save();
        return back();
    }
    public function getSearch(Request $request)
    {
        $result = $request->result;
        $keyword = $result;
        $result = Str::replace(' ', '%', $result);

        $prod_search = VpProduct::where ('prod_name', 'like', '%' . $result . '%')->get();
        if(count($prod_search) == 0) {
            return back()->withErrors(['msg' => 'Không có sản phẩm phù hợp với yêu cầu tìm kiếm của bạn']);
        } else {
            return view('frontend.search', compact('prod_search', 'keyword'));
        }
    }
}
