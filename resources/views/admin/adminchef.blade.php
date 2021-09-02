@extends('admin.adminhome')
@section('content')
<div>
	<form method="post" action="{{url('storechef')}}" enctype="multipart/form-data">
		@csrf
		<div>
			<label>Name</label>
			<input type="text" name="name" class="form-control" placeholder="enter name">
		</div>
		<div>
			<label>Speciality</label>
			<input type="text" name="speciality" class="form-control" placeholder="enter Speciality">
		</div>
		<div>
			<label></label>
			<input type="file" name="image" class="form-control" placeholder="enter Speciality">
		</div>
		<button class="btn btn-danger">Submit</button>
	</form>
	<br>
	<table bgcolor="black">
		<thead>
		<tr>
			<th style="padding:30px">Chef Name</th>
			<th style="padding:30px">Speciality</th>
			<th style="padding:30px">Image</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		@foreach($data as $key=>$value)
		<tr>
			
			<td>{{$value->name}}</td>
			<td>{{$value->speciality}}</td>
			<td><img src="foodimage/{{$value->image}}" width="80" height="80"></td>
			<td>
				<a href="{{url('editchef',$value->id)}}">Update</a>
				<a href="{{url('deletechef',$value->id)}}">Delete</a>
			</td>

		</tr>
		@endforeach
		</tbody>

	</table>
</div>
@endsection