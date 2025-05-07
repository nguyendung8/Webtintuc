@extends('backend.master')
@section('title', 'Danh sách tin tức')
@section('main')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Danh sách tin tức</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">
				<div class="panel panel-primary">
					<div class="panel-heading">Danh sách tin tức</div>
					<div class="panel-body">
						<div class="bootstrap-table">
							<div class="table-responsive">
								<div class="my-3">
									<a href="{{route('admin.news.create')}}" class="btn btn-primary" style="margin-bottom: 10px;">Thêm tin tức mới</a>
								</div>
								<table class="table table-bordered">
				              		<thead>
					                	<tr class="bg-primary">
					                  		<th>ID</th>
					                  		<th>Tiêu đề</th>
					                  		<th>Hình ảnh</th>
					                  		<th>Danh mục</th>
					                  		<th>Lượt xem</th>
					                  		<th>Trạng thái</th>
					                  		<th>Nổi bật</th>
					                  		<th style="width:15%">Tùy chọn</th>
					                	</tr>
				              		</thead>
				              		<tbody>
										@foreach($news_list as $news)
										<tr>
											<td>{{$news->news_id}}</td>
											<td>{{$news->news_title}}</td>
											<td><img src="{{asset('lib/storage/app/avatar/'.$news->news_img)}}" width="100"></td>
											<td>{{$news->cate_name}}</td>
											<td>{{$news->news_views}}</td>
											<td>{{$news->news_status == 1 ? 'Hiển thị' : 'Ẩn'}}</td>
											<td>{{$news->news_featured == 1 ? 'Có' : 'Không'}}</td>
											<td>
												<a href="{{route('admin.news.edit', $news->news_id)}}" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> Sửa</a>
												<a href="{{route('admin.news.delete', $news->news_id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Xóa</a>
											</td>
										</tr>
										@endforeach
				                	</tbody>
				            	</table>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
	</div>
@stop