@extends('frontend._layout.main')

@section('title')
	Order History
@endsection

@section('content')
<div class="container">
	<h1>Order History</h1>
	<form method="get" action="{{ route('order') }}">
		<div class="form-group">
			<input type="text" class="form-control" id="s_order_no" name="s_order_no" placeholder="Search Order No" onchange="this.form.submit()" value="{{ $request->s_order_no }}">
		</div>
	</form>
	
	{{ $index->appends(['s_order_no' => $request->s_order_no])->links() }}

	<table class="table">
		@foreach($index as $list)
		<tr>
			<td>{{ $list->order_no }}</td>
			<td>
				@if($list->orderable_type == "App\Models\Prepaid")
				{{ number_format($list->value * 1.05) }}
				@elseif($list->orderable_type == "App\Models\Product")
				{{ number_format($list->price + 10000) }}
				@endif
			</td>
			<td rowspan="2" valign="center">
				@if($list->status_order == 'WAITING')
					<a class="btn btn-primary" href="{{ route('payment', ['order_no' => $list->order_no]) }}" role="button">Pay Now</a>
				@elseif($list->status_order == 'CANCELED')
					<a href="#" class="badge badge-warning">Canceled</a>
				@elseif($list->status_order == 'SUCCESS')
					@if($list->orderable_type == "App\Models\Prepaid")
						<a href="#" class="badge badge-success">Success</a>
					@elseif($list->orderable_type == "App\Models\Product")
						<a href="#" class="badge badge-success">Success</a><br/>
						Shipping Code : {{ $list->shipping_code }}
					@endif
				@elseif($list->status_order == 'FAILED')
					<a href="#" class="badge badge-danger">Failed</a>
				@endif
			</td>
		</tr>
		<tr>
			<td colspan="2">
				@if($list->orderable_type == "App\Models\Prepaid")
				<p>
					<b>Rp {{ number_format($list->value) }}</b> for <b>{{ $list->mobile_number }}</b>
				</p>
				@elseif($list->orderable_type == "App\Models\Product")
				<p>
					<b>{{ $list->product }}</b> that costs <b>{{ number_format($list->price + 10000) }}</b>
				</p>
				@endif
			</td>
		</tr>
		@endforeach
	</table>

	{{ $index->appends(['s_order_no' => $request->s_order_no])->links() }}
</div>
@endsection