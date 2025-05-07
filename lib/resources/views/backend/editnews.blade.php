@extends('backend.master')
@section('title', 'Chỉnh sửa tin tức')
@section('main')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Chỉnh sửa tin tức</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						Chỉnh sửa tin tức
					</div>
					<div class="panel-body">
						@include('errors.note')
						<form role="form" method="post" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div class="form-group">
								<label>Tiêu đề tin tức:</label>
								<input type="text" name="news_title" class="form-control" value="{{$news->news_title}}" required>
							</div>
							<div class="form-group">
								<label>Nội dung:</label>
								<textarea name="content" id="editor" class="ckeditor" class="form-control" required>{{$news->news_content}}</textarea>
							</div>
							<div class="form-group">
								<label>Hình ảnh hiện tại:</label>
								<img src="{{asset('storage/news/'.$news->news_img)}}" width="200">
							</div>
							<div class="form-group">
								<label>Hình ảnh mới (nếu muốn thay đổi):</label>
								<input type="file" name="img" class="form-control">
							</div>
							<div class="form-group">
								<label>Danh mục:</label>
								<select name="cate" class="form-control" required>
									@foreach($categories as $cate)
									<option value="{{$cate->cate_id}}" {{$news->news_cate == $cate->cate_id ? 'selected' : ''}}>
										{{$cate->cate_name}}
									</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Trạng thái:</label>
								<select name="status" class="form-control" required>
									<option value="1" {{$news->news_status == 1 ? 'selected' : ''}}>Hiển thị</option>
									<option value="0" {{$news->news_status == 0 ? 'selected' : ''}}>Ẩn</option>
								</select>
							</div>
							<div class="form-group">
								<label>Tin nổi bật:</label>
								<select name="featured" class="form-control" required>
									<option value="1" {{$news->news_featured == 1 ? 'selected' : ''}}>Có</option>
									<option value="0" {{$news->news_featured == 0 ? 'selected' : ''}}>Không</option>
								</select>
							</div>
							<div class="form-group">
								<input type="submit" name="submit" class="btn btn-primary" value="Cập nhật">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/.row-->
	</div>
@stop

@section('script')
<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'blockQuote', 'insertTable', 'undo', 'redo'],
            language: 'vi'
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endsection