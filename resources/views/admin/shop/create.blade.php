@extends('admin.adminhome')
@section('content')
<div>
	<form method="post" action="{{url('storecategory')}}" enctype="multipart/form-data">
		@csrf
		<div>
			<label>Product Name</label>
			<select class="form-control" id="product">
				<option>Select Product</option>
				@foreach($product as $key=>$value)
				<option value="{{$value->name}}">{{$value->name}}</option>
				@endforeach
			</select>
		</div>
		<div>
			<label>Price</label>
			<input type="text" name="price" id="price" class="form-control">
		</div>
		<div>
			<label>Category</label>
			<input type="text" name="category" id="category" class="form-control">
		</div>


		<button class="btn btn-danger">Submit</button>
	</form>
	<br>
</div>
@endsection
@push('script')
<script type="text/javascript">
	$(document).ready(function(){
		$('body').on('change','#product',function(){
			var id=$(this).val();
			$.ajax({
				type:'get',
				url:'fetchproduct/'+id,
				success:function(response){
					console.log();
					$("#price").val(response.product.price);
					$('#category').val(response.product.category.name);
				}
			})

		})
	})
</script>
@endpush

