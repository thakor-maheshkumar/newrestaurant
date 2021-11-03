@extends('admin.adminhome')
@section('content')
<div>
	{!!Form::open(['url'=>route('resource.update',$product->id)])!!}
		@method('put')
		@include('admin.resource.form')
	{!! Form::close() !!}
</div>
@endsection