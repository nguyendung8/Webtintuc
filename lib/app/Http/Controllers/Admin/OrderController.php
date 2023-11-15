<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VpOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\FuncCall;

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
    public function confirmOrder($id)
    {
        $order = VpOrder::find($id);
        $order->order_status = 'Đã xác nhận';
        $email = $order->email;
        $name = $order->name;
        $data =[
            'Đơn hàng của bạn đã được xác nhận và chúng tôi sẽ sớm chuyển tới bạn'
        ];
        $order->save();
        Mail::send('backend.confirm_order',$data, function ($message) use ($email, $name) {
            $message->from('dungli1221@gmail.com', 'Mạnh Dũng');

            $message->to($email, $name);

            $message->subject('Thông báo đơn hàng của bạn đã được xác nhận tại MLD Shop');

        });
        return redirect()->intended('admin/order');
    }
    public function transportOrder($id)
    {
        $order = VpOrder::find($id);
        $order->order_status = 'Đang vận chuyển';
        $email = $order->email;
        $name = $order->name;
        $data =[
            'Đơn hàng của bạn đang trong quá trình vận chuyển'
        ];
        $order->save();
        Mail::send('backend.transport_order',$data, function ($message) use ($email, $name) {
            $message->from('dungli1221@gmail.com', 'Mạnh Dũng');

            $message->to($email, $name);

            $message->subject('Thông báo đơn hàng của bạn đang được vận chuyển từ MLD Shop');

        });
        return redirect()->intended('admin/order');
    }
}
