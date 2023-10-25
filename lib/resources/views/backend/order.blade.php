@extends('backend.master')
@section('title', 'Danh mục sản phẩm')
@section('main')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .order-item {
        border: 1px solid #337AB7;
        padding: 11px;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.15) !important;
        margin-bottom: 10px;
        border-radius: 4px;
    }
    .close-btn {
        font-size: 21px;
        color: #337ab7;
        float: right;
        cursor: pointer;
    }
</style>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Đơn hàng</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-xs-12 col-md-5 col-lg-9">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Danh sách đơn hàng
                    </div>
                    <div class="panel-body">
                        @foreach($orders as $order)
                        <div class="order-item">
						    <a href="{{ asset('admin/order/delete/' . $order->id) }}" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?')"><i class="fa fa-times close-btn" aria-hidden="true"></i></a>
                            <label class="customer-name">Tên khách hàng: </label>
                                {{ $order->name }}
                            <br>
                            <label class="customer-phone">Số điện thoại liên hệ: </label>
                                {{ $order->phone }}
                            <br>
                            <label class="customer-phone">Địa chỉ: </label>
                                {{ $order->address }}
                            <br>
                            <label class="customer-phone">Sản phẩm: </label>
                                {{ $order->total_products }}
                            <br>
                            <label class="customer-question">Tổng tiền: </label>
                                {{  $order->total_price }} đ
                            <br>
                            <label class="customer-phone">Ngày đặt hàng: </label>
                            {{ $order->placed_order_date }}
                            <br>
                        </div>
                        @endforeach
                    </div>
                </div>
			</div>
		</div>
	</div>
@stop
