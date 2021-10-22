@extends('admin.adminhome')
@section('content')
<table class="table table-bordered data-table">
	<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Price</th>
			<th>Discount</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody >
		
	</tbody>
</table>
<br>
<br>
<form method="post" action="{{url('multipleproductstore')}}" enctype="multipart/form-data">
	@csrf
<table class="table table-bordered">
	<thead>
		<tr>
			<th></th>
			<th>Product name</th>
			<th>Price</th>
			<th>Discount</th>
			<th>Total</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody class="tbodyData">
			<tr>
				<td>1</td>
				<td>
				<select class="form-control multipleProduct" name="product_name[]">
					<option value="select Product">Select Product</option>
					@foreach($product as $products)	
					<option value="{{$products->id}}" data-name="{{$products->price}}">{{$products->name}}</option>
					@endforeach
				</select>
				</td>
				<td>
					<input type="text" name="price[]" value="price" class="form-control price">
				</td>
				<td>
					<input type="text" name="discount[]" class="form-control discount">
				</td>
				<td>
					<input type="text" name="total[]" class="form-control total">
				</td>
				<td>
					<button type="button" class="form-control addMore" >+</button>
				</td>
			</tr>
		</tbody>
	
</table>
<button type="submit" class="btn btn-success">SAVE</button>
</form>
@endsection
@push('script')
<script type="text/javascript">
	$(document).ready(function(){
		$('body').delegate('.multipleProduct','change',function(){
			var tr=$(this).parent().parent();
			var price=tr.find('.multipleProduct option:selected').attr('data-name');
			tr.find('.price').val(price);
			var discount=tr.find('.discount').val();
			var price=tr.find('.price').val();
			var total=price*discount/100;
			//alert(total);
			var totalDiscount=price-total;
			tr.find('.total').val(totalDiscount);	
		});
		$('body').delegate('.discount','keyup',function(){
			var tr=$(this).parent().parent();
			var price=tr.find('.multipleProduct option:selected').attr('data-name');
			tr.find('.price').val(price);
			var discount=tr.find('.discount').val();
			var price=tr.find('.price').val();
			var total=price*discount/100;
			//alert(total);
			var totalDiscount=price-total;
			tr.find('.total').val(totalDiscount);
		});
		$('.addMore').on('click',function(){
			var product=$('.multipleProduct').html();
			var numberofrow=($('.tbodyData').length-0)+1;
			var newTable='<tr>'+'<td class "no">'+numberofrow+'</td>'+'<td>'+'<select class="form-control multipleProduct" name="product_name[]">'+product+'</select>'+'</td>'+
							   '<td>'+'<input type="text" class="form-control price" name="price[]">'+'</td>'+
							   '<td>'+'<input type="text" class="form-control discount" name="discount[]">'+'</td>'+
							   '<td>'+'<input type="text" class="form-control total" name="total[]">'+'</td>'+
							   '<td>'+'<button class="form-control remove">-</button>'+'</td>'+
			'</tr>';
			$('.tbodyData').append(newTable);
		});
		/*$('body').delegate('.remove','click',function(){
			$(this).parent().parent().remove();
		})*/
		$(function () {
		var table=$('.data-table').DataTable({
			processing:true,
			serverSide:true,
			ajax:"{{url('multipleproduct')}}",
			columns:[
				{data:'id',name:'id'},
				{data:'product_name',name:'product_name'},
				{data:'price',name:'price'},
				{data:'discount',name:'discount'},
				{data:'total',name:'total'},
				 {data: 'action', name: 'action', orderable: false, searchable: false},

			]
		});
	});
	});
</script>
@endpush