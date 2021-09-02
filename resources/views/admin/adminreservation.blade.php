@extends('admin.adminhome')
@section('content')
<div >
		<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Date</th>
      <th scope="col">Time</th>
      <th scope="col">Message</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($data as $key=>$value)
    <tr>
      <th >{{$value->name}}</th>
      <td>{{$value->email}}</td>
    
      <td>{{$value->phone}}</td>
      <td>{{$value->date}}</td>
      <td>{{$value->time}}</td>
      <td>{{$value->message}}</td>
      <td><a href="{{url('deletemenu',$value->id)}}">Delete</a></td>
      <td><a href="{{url('updatemenu',$value->id)}}">Update</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
	</div>
@endsection