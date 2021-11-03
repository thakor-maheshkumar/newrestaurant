@php
    $element_counter = 0;
@endphp
<div>
	<table class="table table-responsive">
		<thead>
			<tr>
				<th>Product Name</th>
				<th>Quantity</th>
				<th></th>
			</tr>
		</thead>
		<tbody class="add-items-list">
			@if(isset($item))
			@foreach($item as $key=>$value)
			<tr class="new-item">
				<td>{!! Form::select('product_id[]',[]+$productData,old('product_id',isset($value->product_id) ? $value->product_id :''),['class'=>'multipleProduct form-control']) !!}</td>
				<td>{!! Form::text('quantity[]',old('quantity',isset($value->quantity) ? $value->quantity :''),['class'=>'form-control quantity'])!!}</td>
				<td><button onClick="removeRow(this)">Remove</button></td>
			@endforeach
			@else
			<tr class="new-item">
				<td>{!! Form::select('product_id[]',[''=>'Select Product']+$productData,old('product_id',isset($product->product_id) ? $product->product_id :''),['class'=>'multipleProduct']) !!}</td>
				<td>{!! Form::text('quantity[]',old('quantity',isset($product->quantity) ? $product->quantity :''),['class'=>'form-control quantity'])!!}</td>
				<td><button onClick="removeRow(this)">Remove</button></td>
			</tr>
			@endif
		</tbody>
		<tfoot>
			<tr>
				<td><a href="javascript:void(0);" class="btn btn-add btn-success add-item" data-toggle="tooltip" data-placement="bottom" title="Add New Item"><i class="fa fa-plus"></i></a></td>
			</tr>
		</tfoot>
	</table>
</div>
@push('script')
<script type="text/javascript">
	$(document).ready(function(){
		var element_counter = "{{ $element_counter }}"
		$('body').on('click','.add-item',function(){
			var product=$('.multipleProduct').html();
			tbodydata='<tr>'
						  +'<td>'+'<select class="form-control" name="product_id[]">'+product+'</select>'+
						  '</td>'+'<td>'+'<input type="text" class="form-control" name="quantity[]">'+'</td>'+
						  '</tr>';
			$('.add-items-list').append(tbodydata);		
		});
		removeRow=function(el){
			$(el).parents("tr").remove();
		}

	})
</script>
@endpush