@extends('admin.adminhome')
@section('content')
<div>
	<a class="btn btn-success" href="{{route('resource.create')}}">Add Product</a>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Category Name</th>
				<th>Product Name</th>
				<th>Price</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach($category as $key=>$value)
			<tr>			
			<td>{{$value->category->name}}</td>
			<td>{{$value->name}}</td>
			<td>{{$value->price}}</td>
			<td><a href="{{route('resource.edit',$value->id)}}" class="btn btn-success">Edit</a>
				{!! Form::open(['url'=>route('resource.destroy',$value->id),'method'=>'DELETE']) !!}
				<button class="btn btn-danger confirm-action"  type="submit">Delete</button>
				{!! Form::close() !!}
			</tr>

			@endforeach
		</tbody>
	</table>
</div>
@endsection