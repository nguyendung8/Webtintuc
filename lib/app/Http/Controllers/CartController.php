<?php

namespace App\Http\Controllers;

use App\Models\VpProduct;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;

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
    public function getUpdateCart(Request $request)
    {
        $rowId = $request->rowId;
        $quantity = $request->quantity;

        Cart::update($rowId, $quantity);
    }
    public function postPayCart(Request $request)
    {
        $data['info'] = $request->all();
        $email = $request->email;
        $name = $request->name;
        $data['cart'] = Cart::content();
        $data['total'] = Cart::total();
        Mail::send('frontend.email', $data, function ($message) use ($email, $name) {
            $message->from('dungli1221@gmail.com', 'Mạnh Dũng');

            $message->to($email, $name);
            $message->cc('ly0195366@huce.edu.vn', 'Mai Ly');

            $message->subject('Xác nhận hóa đơn mua hàng MLDShop');

        });
        Cart::destroy();
        return redirect('complete');
    }
    public function getComplete()
    {
        return view('frontend.complete');
    }
}
