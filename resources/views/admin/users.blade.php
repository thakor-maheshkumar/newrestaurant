@extends('admin.adminhome')
@section('content')
<div style="position: relative; top: 60px; right: -150px;">
	<table bgcolor="grey" border="3px">
		<tr>
			<th style="padding: 30px;">Name</th>
			<th style="padding: 30px;">Email</th>
			<th style="padding: 30px;">Action</th>
		</tr>
		@foreach($data as $key=>$value)
		<tr align="center">
			<td>{{$value->name}}</td>
			<td>{{$value->email}}</td>
			@if($value->usertype==0)
			<td><a href="{{url('deleteuser',$value->id)}}">Delete</a></td>
			@else
			<td><a href="">Not Allowed</a></td>
			@endif
		</tr>
		@endforeach
	</table>
</div>
@endsection