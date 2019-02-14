@extends('frontend._layout.main')

@section('title')
	Login
@endsection

@section('content')
<div class="container">
	<h1>Login</h1>
	<form method="post" action="{{ route('doLogin') }}">
		@csrf
		<div class="form-group">
			<label for="email">Email address</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Password">
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
		<a href="{{ route('register') }}">Register</a>
	</form>
</div>
@endsection