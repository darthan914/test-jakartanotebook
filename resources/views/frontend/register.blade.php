@extends('frontend._layout.main')

@section('title')
	Register
@endsection

@section('content')
<div class="container">
	<h1>Register</h1>
	<form method="post" action="{{ route('doRegister') }}">
		@csrf
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" class="form-control @if($errors->first('name')) is-invalid @endif" id="name" name="name" placeholder="Enter Name" value="{{ old('name') }}">
			@if($errors->first('name'))
			<div class="invalid-feedback">
	        	{{ $errors->first('name') }}
	        </div>
	        @endif
		</div>
		<div class="form-group">
			<label for="email">Email address</label>
			<input type="email" class="form-control  @if($errors->first('email')) is-invalid @endif" id="email" name="email" placeholder="Enter Email" value="{{ old('email') }}">
			@if($errors->first('email'))
			<div class="invalid-feedback">
	        	{{ $errors->first('email') }}
	        </div>
	        @endif
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control  @if($errors->first('password')) is-invalid @endif" id="password" name="password" placeholder="Password" value="">
			@if($errors->first('password'))
			<div class="invalid-feedback">
	        	{{ $errors->first('password') }}
	        </div>
	        @endif
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
		<a href="{{ route('login') }}">Login</a>
	</form>
</div>
@endsection