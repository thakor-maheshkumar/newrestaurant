@extends('admin.adminhome')
@section('content')
<div>
	<form method="post" action="{{url('storecategory')}}" enctype="multipart/form-data">
		@csrf
		<div>
			<label>Name</label>
			<input type="text" name="name" class="form-control" placeholder="enter name">
		</div>
		<div>
			<label>Description</label>
			<textarea class="form-control" name="description"></textarea>
		</div>

		<button class="btn btn-danger">Submit</button>
	</form>
	<br>
</div>
@endsection