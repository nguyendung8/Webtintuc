<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VpOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getOrder()
    {
        $orders = VpOrder::all();

        return view('backend.order', compact('orders'));
    }
    public function getDeleteOrder($id)
    {
        $order = VpOrder::find($id);

        $order->delete();

        return redirect()->intended('admin/order');
    }
}
