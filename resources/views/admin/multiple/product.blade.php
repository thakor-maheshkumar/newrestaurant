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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="#" enctype="multipart/form-data">
        	
        		<label>Product Name</label>
        		<input type="text" name="id" id="id" class="id">
        		<select class="form-control product_name" name="product_name" id="product_data">
        		</select>
        		<label>Product Price</label>
        		<input type="text" name="price" class="form-contro" id="price_data">
        	</label>
        	<label>
        		<label>Discount</label>
        		<input type="text" name="discount" class="form-control" id="discount_data">
        	</label>
        	<label>
        		<label>Total</label>
        		<input type="text" name="total" class="form-control" id="total_data">
        	</label>
        	 <div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        		<button type="submit" class="btn btn-primary updateData" >Update</button>
      		</div>
        </form>
      </div>
     
    </div>
  </div>
</div>
@endsection
@push('script')
<script type="text/javascript">

</script>
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
				{data:'product.name',name:'product_name'},
				{data:'price',name:'price'},
				{data:'discount',name:'discount'},
				{data:'total',name:'total'},
				 {data: 'action', name: 'action', orderable: false, searchable: false},

			]
		});
	});
		$('body').on('click','.editData',function(){
			var edit=$(this).attr('data-id');
			$.ajax({
				type:"get",
				url:'{{url("editproduct")}}',
				data:{id:edit},
				dataType:'json',
				success:function(data){
					console.log(data.data);
					$('#exampleModal').modal('show');
					var options='<option></option>';
					$.each(data.data.product,function(){
						options='<option value="'+data.data.product.id+'">'+data.data.product.name+'</option>';
					});
					console.log(data.price);
					$('#product_data').append(options);
					$('.id').val(data.data.id);
					$('#price_data').val(data.data.price);
					$('#discount_data').val(data.data.discount);
					$('#total_data').val(data.data.total);
				}
			});
		});
		$('body').on('click','.updateData',function(e){
			e.preventDefault();
			var id=$('.id').val();
			var product_data=$('#product_data').val();

			var price_data =$('#price_data').val();
				//alert(price);
			var discount_data=$('#discount_data').val();
			var total_data=$('#total_data').val();
	
			//lert(id);
			$.ajax({
				type:"post",
				url:'{{url("updatemultiple")}}',
				data:{
						"_token": "{{ csrf_token() }}",
						id:id,
						product_name:product_data,
						price:price_data,
						discount:discount_data,
						total:total_data,
					},
				dataType:'json',
				success:function(data){
					/*console.log('data updated successfully');*/
						$('#exampleModal').modal('hide');
						 $('.data-table').DataTable().ajax.reload();
				}
			})
		})
	});
</script>
@endpush