@extends('frontend.master')
@section('title', 'Trang chủ')
@section('main')
<link rel="stylesheet" href="css/category.css">
	<div id="wrap-inner">
		<div class="products">
			<h3>sản phẩm nổi bật</h3>
			<div style="gap: 15px;" class="product-list row">
				@foreach($product_featured as $prod_featured)
				<div style="border-radius: 10px;" class="product-item col-md-3 col-sm-6 col-xs-12">
					<a href="#"><img height="150px" src="{{ asset('lib/storage/app/avatar/'.$prod_featured->prod_img) }}" class="img-thumbnail"></a>
					<p><a href="#">{{ $prod_featured->prod_name }}</a></p>
					<p class="price">{{ number_format($prod_featured->prod_price,0,',','.' )}} VND</p>
					<div class="marsk">
						<a href="{{ asset('homepage/detail/' . $prod_featured->prod_id) }}">Xem chi tiết</a>
					</div>
				</div>
				@endforeach
			</div>
		</div>

		<div id="pagination">
			{{ $product_featured->links('vendor.pagination.default') }}
		</div>

		<div class="products">
			<h3>sản phẩm mới</h3>
			<div style="gap: 15px;" class="product-list row">
				@foreach($product_new as $prod_new)
				<div style="border-radius: 10px;" class="product-item col-md-3 col-sm-6 col-xs-12">
					<a href="#"><img src="{{ asset('lib/storage/app/avatar/'.$prod_new->prod_img) }}" class="img-thumbnail"></a>
					<p><a href="#">{{ $prod_new->prod_name }}</a></p>
					<p class="price">{{ number_format($prod_new->prod_price,0,',','.' ) }} VND</p>
					<div class="marsk">
						<a href="{{ asset('homepage/detail/' . $prod_new->prod_id) }}">Xem chi tiết</a>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
@stop
