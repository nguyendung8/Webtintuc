@extends('backend.master')
@section('title', 'Thêm tin tức mới')
@section('main')
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Thêm tin tức mới</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						Thêm tin tức mới
					</div>
					<div class="panel-body">
						@include('errors.note')
						<form role="form" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label>Tiêu đề tin tức:</label>
								<input type="text" name="news_title" class="form-control" placeholder="Tiêu đề tin tức..." required>
							</div>
							<div class="form-group">
								<label>Nội dung:</label>
								<textarea name="content" id="editor" class="ckeditor" class="form-control" required></textarea>
							</div>
							<div class="form-group">
								<label>Hình ảnh:</label>
								<input type="file" name="img" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Danh mục:</label>
								<select name="cate" class="form-control" required>
									@foreach($categories as $cate)
									<option value="{{$cate->cate_id}}">{{$cate->cate_name}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Trạng thái:</label>
								<select name="status" class="form-control" required>
									<option value="1">Hiển thị</option>
									<option value="0">Ẩn</option>
								</select>
							</div>
							<div class="form-group">
								<label>Tin nổi bật:</label>
								<select name="featured" class="form-control" required>
									<option value="1">Có</option>
									<option value="0">Không</option>
								</select>
							</div>
							<div class="form-group">
								<input type="submit" name="submit" class="btn btn-primary" value="Thêm mới">
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