@extends('admin.adminhome')
@section('content')
<div>
	{!! Form::open(['url' => route('resource.store'), 'id' => 'create_batch']) !!}
		@include('admin.resource.form')	
	{!! Form::close() !!}

</div>
@endsection