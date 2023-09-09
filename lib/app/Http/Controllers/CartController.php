<?php

namespace App\Http\Controllers;

use App\Models\VpProduct;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function getAddCart($id)
    {
        $product = VpProduct::find($id);
        Cart::add(['id' => $id, 'name' => $product->prod_name, 'qty' => 1,
                    'price' => $product->prod_price, 'weight' => 550, 'options' => ['img' => $product->prod_img]]);

        return redirect('cart/show');
    }
    public function getShowCart()
    {
        $total = Cart::total();
        $products = Cart::content();
        return view('frontend.cart', compact('products', 'total'));
    }
    public function getDeleteCart($id)
    {
        if($id == 'all') {
            Cart::destroy();
        } else {
            Cart::remove($id);
        }

        return back();
    }
}
