@extends('frontend.master')
@section('title', 'Chi tiết sản phẩm')
@section('main')
	<link rel="stylesheet" href="css/details.css">
	<div id="wrap-inner">
		<div id="product-info">
			<div class="clearfix"></div>
			<h3>{{ $product->prod_name }}</h3>
			<div class="row">
				<div id="product-img" class="col-xs-12 col-sm-12 col-md-3 text-center">
					<img width="210px" src="{{ asset('lib/storage/app/avatar/'.$product->prod_img) }}">
				</div>
				<div id="product-details" class="col-xs-12 col-sm-12 col-md-9">
					<p>Giá: <span class="price">{{ number_format($product->prod_price,0,',','.' )}} VND</span></p>
					<p>Bảo hành: {{ $product->prod_warranty }}</p> 
					<p>Phụ kiện: {{ $product->prod_accessories }}</p>
					<p>Tình trạng: {{ $product->prod_condition }}</p>
					<p>Khuyến mại: {{ $product->prod_promotion }}</p>
					<p>Còn hàng: @if($product->prod_status == 1) Còn hàng @else Đã hết @endif</p>
					<p class="add-cart text-center"><a href="{{ asset('cart/add/' . $product->prod_id) }}">Đặt hàng online</a></p>
				</div>
			</div>							
		</div>
		<div id="product-detail">
			<h3>Chi tiết sản phẩm</h3>
			<p class="text-justify">{!! $product->prod_description !!}</p>
		</div>
		<div id="comment">
			<h3>Bình luận</h3>
			<div class="col-md-9 comment">
				<form method="post">
					@csrf
					<div class="form-group">
						<label for="email">Email:</label>
						<input required type="email" class="form-control" id="email" name="email">
					</div>
					<div class="form-group">
						<label for="name">Tên:</label>
						<input required type="text" class="form-control" id="name" name="name">
					</div>
					<div class="form-group">
						<label for="cm">Bình luận:</label>
						<textarea required rows="10" id="cm" class="form-control" name="content"></textarea>
					</div>
					<div class="form-group text-right">
						<button type="submit" class="btn btn-default">Gửi</button>
					</div>
				</form>
			</div>
		</div>
		<div id="comment-list">
			@foreach($comments as $comment)
			<ul>
				<li class="com-title">
					{{ $comment->com_name }}
					<br>
					<span>{{ date('d/m/Y H:i', strtotime($comment->created_at)) }}</span>	
				</li>
				<li class="com-details">
					{{ $comment->com_content }}
				</li>
			</ul>
			@endforeach
		</div>
	</div>	
@stop				
