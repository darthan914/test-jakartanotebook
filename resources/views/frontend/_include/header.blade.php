<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse order-0 dual-collapse2" id="navbarNav">
		@auth
		<span class="navbar-text">
			Hello, {{ Auth::user()->name }} <br/>
			{{ Auth::user()->orders()->where('status_order', 'WAITING')->count() }} Unpaid Order
		</span>
		@endauth
	</div>
	<div class="collapse navbar-collapse order-1 dual-collapse2" id="navbarNav">
		<ul class="navbar-nav ml-auto">
			@auth
			<li class="nav-item">
				<a class="nav-link" href="{{ route('prepaid') }}">Prepaid Balance</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('product') }}">Product</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('logout') }}">Logout</a>
			</li>
			@else
			<li class="nav-item">
				<a class="nav-link" href="{{ route('login') }}">Login</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ route('register') }}">Register</a>
			</li>
			@endauth
		</ul>
	</div>
</nav>