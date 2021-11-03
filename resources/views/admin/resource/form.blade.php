		<div class="forn-group">
			{!! Form::label('material_rate','Material Rate') !!}
			{!! Form::select('material_rate',[''=>'Select Material']+$material_rate,old('material_rate',isset($product->material_rate) ? $product->material_rate : ''),['class'=>'material_rate form-control']) !!}
		</div>
		<div class="forn-group">
		{!! Form::label('batch_id', 'Category') !!}
		{!! Form::select('category_id',[''=>'Select Category']+$category,
		old('category_id',isset($product->category_id) ? $product->category_id :''),['class'=>'form-control']) !!}
		</div>
		<div class="forn-group">
		{!! Form::label('batch_id', 'Product Name') !!}
		{!!Form::text('name',old('category_id',isset($product->name) ? $product->name : ''),['class'=>'form-control']) !!}
		</div>
		<div class="forn-group">
		{!! Form::label('batch_id', 'Product Price') !!}
		{!!Form::text('price',old('price',isset($product->price) ? $product->price :''),['class'=>'form-control']) !!}
		</div>
		<div class="row">
    <div class="col-md-24">
        <div class="form-group">
            <label>Add Items</label>
            @include('admin.resource.item')
        </div>
    </div>
</div>

		<div class="forn-group">
		<button type="submit" class="btn btn-success btn-sm">SUBMIT</button>
		</div>