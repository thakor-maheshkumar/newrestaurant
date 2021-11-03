@extends('admin.adminhome')
@section('content')
<table>
		<thead>
			<th>Product Name</th>
			<th>Price</th>
			<th>Discount</th>
			<th>Total</th>
			<th>Country</th>
		</thead>
		<tbody>
			@foreach($multiple as $key=>$value)
				<td>{{$value->product_name}}</td>
				<td>{{$value->price}}</td>
				<td>{{$value->discount}}</td>
				<td>{{$value->total}}</td>
				<td>{{$value->country}}</td>
			@endforeach
		</tbody>
</table>
@endsection