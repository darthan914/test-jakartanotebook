@extends('frontend._layout.main')

@section('title')
	Success!
@endsection

@section('content')
<div class="container">
	<h1>Success!</h1>
	<table class="table">
		<tbody>
			<tr>
				<th scope="row">Order Number</th>
				<td>{{ $index->orders->order_no }}</td>
			</tr>
			<tr>
				<th scope="row">Total</th>
				<td>
					@if($index->orders->orderable_type == "App\Models\Prepaid")
					{{ number_format($index->value * 1.05) }}
					@elseif($index->orders->orderable_type == "App\Models\Product")
					{{ number_format($index->price + 10000) }}
					@endif
				</td>
			</tr>
		</tbody>
	</table>

	@if($index->orders->orderable_type == "App\Models\Prepaid")
	<p>Your mobile phone number  {{ $index->mobile_number }} will receive Rp {{ number_format($index->value) }}</p>
	@elseif($index->orders->orderable_type == "App\Models\Product")
	<p>
		{{ $index->product }} that costs {{ number_format($index->price + 10000) }} will be shipped to : <br/>
		{{ $index->shipping_address }} <br/>
		only after you pay
	</p>
	@endif

	<p>Order Date <b>{{ $index->orders->created_at }}</b></p>

	<a href="{{ route('payment', ['order_no' => $index->orders->order_no]) }}" class="btn btn-primary btn-lg btn-block">Pay Now!</a>
</div>
@endsection