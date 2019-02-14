@extends('frontend._layout.main')

@section('title')
	Prepaid Balance
@endsection

@section('content')
<div class="container">
	<h1>Prepaid Balance</h1>
	<form method="post" action="{{ route('prepaid.store') }}">
		@csrf
		<div class="form-group">
			<label for="mobile_number">Mobile Number</label>
			<input type="text" class="form-control @if($errors->first('mobile_number')) is-invalid @endif" id="mobile_number" name="mobile_number" placeholder="Enter Mobile Number" value="{{ old('mobile_number') }}">
			@if($errors->first('mobile_number'))
			<div class="invalid-feedback">
	        	{{ $errors->first('mobile_number') }}
	        </div>
	        @endif
		</div>
		<div class="form-group">
		<label for="value">Value</label>
			<select class="form-control @if($errors->first('value')) is-invalid @endif" id="value" name="value">
				<option value="10000" @if(old('value') == 10000) selected @endif>10.000</option>
				<option value="50000" @if(old('value') == 50000) selected @endif>50.000</option>
				<option value="100000" @if(old('value') == 100000) selected @endif>100.000</option>
			</select>
			@if($errors->first('value'))
			<div class="invalid-feedback">
	        	{{ $errors->first('value') }}
	        </div>
	        @endif
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
@endsection