@extends('admin.adminhome')
@section('content')
<div>
	<form method="post" action="{{url('storeproduct')}}" enctype="multipart/form-data">
		@csrf
		<div>
			<label>Category Name</label>
			<select name="category_id" class="form-control">
				<option>Select Category</option>
				@foreach($category as $key=>$value)
				<option value="{{$value->id}}">{{$value->name}}</option>
				@endforeach
			</select>
		</div>
		<div>
			<label>Product Name</label>
			<input type="text" name="name" class="form-control" placeholder="enter Speciality">
		</div>
		<div>
			<label>Product Price</label>
			<input type="text" name="price" class="form-control" placeholder="enter Speciality">
		</div>
		<div>
			<label>Image</label>
			<input type="file" name="image" class="form-control" placeholder="enter Speciality">
		</div>
		<button class="btn btn-danger">Submit</button>
	</form>
	<br>
	<table bgcolor="black">
		<thead>
		<tr>
			<th style="padding:30px">Category Name</th>
			<th style="padding:30px">Product Name</th>
			<th style="padding:30px">Price</th>
			<th style="padding:30px">Image</th>
		
		</tr>
		</thead>
		<tbody>
		@foreach($product as $key=>$value)
		<tr>
			
			<td>{{$value->category->name}}</td>
			<td>{{$value->name}}</td>
			<td>{{$value->price}}</td>
			<td><img src="foodimage/{{$value->image}}" width="80" height="80"></td>
			

		</tr>
		@endforeach
		</tbody>

	</table>

</div>
@endsection