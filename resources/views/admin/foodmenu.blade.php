@extends('admin.adminhome')
@section('content')
<div style="position:relative;top: 60px;">
	<form method="post" enctype="multipart/form-data" action="{{url('upload')}}">
		@csrf
		<div>
			<label>Title</label>
			<input type="text" name="title" placeholder="Title" required="" class="form-control">
		</div>
		<div>
			<label>Price</label>
			<input type="text" name="price" placeholder="Price" required="" class="form-control">
		</div>
		<div>
			<label>Image</label>
			<input type="file" name="image" placeholder="Title" required="" class="form-control">
		</div>
		<div>
			<label>Description</label>
			<input type="text" name="description" placeholder="Description" required="" class="form-control">
		</div>
		<button type="submit" class="btn btn-success">Submit</button>
	</form>

	<div >
		<table class="table table-dark" style="margin-top: 100px;margin-left:70px;width: 50px;" >
			<input type="text" name="start_date" style="margin-left: 300px;" placeholder="Start Date" class="start_date" id="start_date">
			<input type="text" name="end_date" placeholder="End Date" class="end_date" id="end_date">
  <thead>
    <tr>

      <th scope="col">Food Name</th>
      <th scope="col">Price</th>
      <th scope="col">Image</th>
      <th scope="col">Description</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>

  	@foreach($data as $key=>$value)

    <tr>
      <th scope="row">{{$value->title}}</th>
      <td>{{$value->price}}</td>
      <td><img src="foodimage/{{$value->image}}" style="width:200px;height:200px"></td>
      <td>{{$value->description}}</td>
      <td><a href="{{url('deletemenu',$value->id)}}">Delete</a></td>
      <td><a href="{{url('updatemenu',$value->id)}}">Update</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
	</div>

</div>

@endsection