@extends('admin.adminhome')
@section('content')
<div>
	<form method="post" action="{{url('updatechef',$editchef->id)}}" enctype="multipart/form-data">
		@csrf
		<div>
			<label>Name</label>
			<input type="text" name="name" value="{{$editchef->name}}" class="form-control" placeholder="enter name">
		</div>
		<div>
			<label>Speciality</label>
			<input type="text" name="speciality" value="{{$editchef->speciality}}" class="form-control" placeholder="enter Speciality">
		</div>
		<div>
			<label>Old Image</label>
			<img src="foodimage/{{$editchef->image}}" width="70" height="70">
		</div>
		<div>
			<label>New Image</label>
			<input type="file" name="image">
		</div>

		<button class="btn btn-danger">Submit</button>
	</form>

	@endsection