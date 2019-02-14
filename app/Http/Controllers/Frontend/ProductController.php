<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Order;

use App\Jobs\ProcessOrder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;


class ProductController extends Controller
{
    public function index(Request $request)
    {
    	return view('frontend.product');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product'          => 'required|min:10|max:150',
            'shipping_address' => 'required|min:10|max:150',
            'price'            => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $product = new Product;

        $product->product          = $request->product;
        $product->shipping_address = $request->shipping_address;
        $product->price            = $request->price;

        $product->save();
        
        $order = new Order;
        $order->user_id  = Auth::id();
        $order->order_no = '02'.$product->id;

        $product->orders()->save($order);

        ProcessOrder::dispatch($order)
                ->delay(now()->addMinutes(5))->onQueue('processing');;

        $index = $product;

        return view('frontend.success', compact('index'));
    }
}
