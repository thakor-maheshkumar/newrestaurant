@extends('admin.adminhome')
@section('content')
<base href="/public">
<div style="position:relative;top: 60px;right: -150px;">
	<form method="post" enctype="multipart/form-data" action="{{url('update',$data->id)}}">
		@csrf
		<div>
			<label>Title</label>
			<input type="text" name="title" placeholder="Title" required="" value="{{$data->title}}" class="form-control">
		</div>
		<div>
			<label>Price</label>
			<input type="text" name="price" placeholder="Price" required="" class="form-control" value="{{$data->price}}">
		</div>
		
		<div>
			<label>Description</label>
			<input type="text" name="description" placeholder="Description" required="" class="form-control" value="{{$data->description}}">
		</div>
		<div>
			<label>Old Image</label>
			<img src="foodimage/{{$data->image}}" width="200" height="200">
		</div>
		<div>
			<label>New Image</label>
			<input type="file" name="image">
		</div>

		<button type="submit" class="btn btn-success">Submit</button>
	</form>
</div>
	<div >
		
	</div>



@endsection