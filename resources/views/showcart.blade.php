@extends('layouts.main')
@section('content')
<div id="top">
<table align="center" bgcolor="yellow">
	<thead>
	<tr>
		<th style="padding:30px">Food Name</th>
		<th style="padding:30px">Price</th>
		<th style="padding:30px">Quantity</th>'
		<th style="padding:30px">Image</th>
		<th style="padding:30px">Action</th>
	</tr>
	</thead>
	<tbody>
		<form method="post" action="{{url('orderconfirm')}}">
			@csrf
		@foreach($join as $key=>$value)
		<tr>
			<td>
				<input type="hidden" name="foodname[]" value="{{$value->title}}">
				{{$value->title}}</td>
			<td>
				<input type="hidden" name="price[]" value="{{$value->price}}">
				{{$value->price}}</td>
			<td>
				<input type="hidden" name="quantity[]" value="{{$value->quantity}}">
				{{$value->quantity}}</td>

			<td>
				<input type="hidden" name="image[]" value="{{$value->image}}">
				<img src="foodimage/{{$value->image}}" width="80" height="80"></td>
				
			<td><a class="btn btn-primary" href="{{url('removecart',$value->id)}}">Remove</a></td>
		</tr>
		@endforeach
	</tbody>
</table>
<div align="center" style="padding:10px">
	<button class="btn btn-primary" type="button" id="orderNow">Order Now</button>
</div>
<div style="padding:10px" align="center" style="display: none;" id="appear">
	<div style="padding:10px">
		<label>Name</label>
		<input type="text" name="name" placeholder="name">
	</div>
	<div style="padding:10px">
		<label>Phone</label>
		<input type="number" name="phone" placeholder="Phone Number">
	</div>
	<div style="padding:10px">
		<label>Address</label>
		<input type="text" name="address" placeholder="Address">
	</div>
		<div style="padding:10px">
		<button type="submit" class="btn btn-primary">Order Confirm</button>
		<button id="close" type="button" class="btn btn-danger btn-sm">Close</button>
	</div>
	</form>
</div>
</div>
@endsection
@push('script')
<script type="text/javascript">
	$(document).ready(function(){
		$('body').on('click','#orderNow',function(){
			$('#appear').show();
		});
		$('body').on('click','#close',function(){
			$('#appear').hide();
		});
	})
</script>
@endpush