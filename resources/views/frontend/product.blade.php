@extends('frontend._layout.main')

@section('title')
	Product
@endsection

@section('content')
<div class="container">
	<h1>Product</h1>
	<form method="post" action="{{ route('product.store') }}">
		@csrf
		<div class="form-group">
			<label for="product">Product</label>
			<textarea type="text" class="form-control @if($errors->first('product')) is-invalid @endif" id="product" name="product" placeholder="Enter Product">{{ old('product') }}</textarea>
			@if($errors->first('product'))
			<div class="invalid-feedback">
	        	{{ $errors->first('product') }}
	        </div>
	        @endif
		</div>
		<div class="form-group">
			<label for="shipping_address">Shipping Address</label>
			<textarea type="text" class="form-control @if($errors->first('shipping_address')) is-invalid @endif" id="shipping_address" name="shipping_address" placeholder="Enter Shipping Address">{{ old('shipping_address') }}</textarea>
			@if($errors->first('shipping_address'))
			<div class="invalid-feedback">
	        	{{ $errors->first('shipping_address') }}
	        </div>
	        @endif
		</div>
		<div class="form-group">
			<label for="price">Price</label>
			<input type="number" class="form-control @if($errors->first('price')) is-invalid @endif" id="price" name="price" placeholder="Enter Price" value="{{ old('price') }}">
			@if($errors->first('price'))
			<div class="invalid-feedback">
	        	{{ $errors->first('price') }}
	        </div>
	        @endif
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
@endsection