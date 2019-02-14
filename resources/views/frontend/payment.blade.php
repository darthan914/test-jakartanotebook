@extends('frontend._layout.main')

@section('title')
	Pay your order
@endsection

@section('content')
<div class="container">
	<h1>Pay your order</h1>
	<form method="post" action="{{ route('doPayment') }}">
		@csrf
		<div class="form-group">
			<label for="order_no">Order number</label>
			<input type="text" class="form-control @if($errors->first('order_no')) is-invalid @endif" id="order_no" name="order_no" placeholder="Enter Order No" value="{{ $request->order_no }}">
			@if($errors->first('order_no'))
			<div class="invalid-feedback">
	        	{{ $errors->first('order_no') }}
	        </div>
	        @endif
		</div>

		<button type="submit" class="btn btn-primary">Pay Now</button>
	</form>
</div>
@endsection