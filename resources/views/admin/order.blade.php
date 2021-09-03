@extends('admin.adminhome')
@section('content')

<form method="get" action="{{url('search')}}">
	<input type="text" name="search" style="color:blue">
	<br>
	<input type="submit" value="Search" class="btn btn-success">
</form>
<br>
<table class="table table-bordered" style="color:white;" >

	<thead>
		<tr align="center">
			<th style="padding:30">Name</th>
			<th style="padding:30">Phone</th>
			<th style="padding:30">Address</th>
			<th style="padding:30">Foodname</th>
			<th style="padding:30">Price</th>
			<th style="padding:30">Quantity</th>
			<th style="padding:30">Total Price</th>
			<th style="padding:30">Image</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $key=>$value)
		<tr align="center" style="background-color: black;">
			<td>{{$value->name}}</td>
			<td>{{$value->phone}}</td>
			<td>{{$value->address}}</td>
			<td>{{$value->foodname}}</td>
			<td>{{$value->price}}</td>
			<td>{{$value->quantity}}</td>
			<td>{{$value->price * $value->quantity}}</td>
			<td><img src="foodimage/{{$value->image}}"></td>
		</tr>
		@endforeach
	</tbody>
</table>

@endsection