<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $index = Order::where('user_id', Auth::id())
            ->where('order_no', 'LIKE', '%'.$request->s_order_no.'%')
            ->orderBy('orders.created_at', 'DESC')
            ->leftJoin('products', function($join) {
                $join->on('products.id', 'orders.orderable_id')->where('orders.orderable_type', 'App\Models\Product');
            })
            ->leftJoin('prepaids', function($join) {
                $join->on('prepaids.id', 'orders.orderable_id')->where('orders.orderable_type', 'App\Models\Prepaid');
            })
            ->paginate(20);

    	return view('frontend.order', compact('index', 'request'));
    }

    public function payment(Request $request)
    {
        return view('frontend.payment', compact('request'));
    }

    public function doPayment(Request $request)
    {
    	$index = Order::where("order_no", $request->order_no)->where('status_order', 'WAITING')->where('user_id', Auth::id())->first();
        $random_rate = rand(0, 100);
        $current_hour = date('G');

        if($index)
        {
            if($index->orderable_type == "App\Models\Prepaid")
            {
                if(9 <= $current_hour && $current_hour <= 17)
                {
                    $index->status_order = ($random_rate <= 90 ? "SUCCESS" : "FAILED");
                }
                else
                {
                    $index->status_order = ($random_rate <= 40 ? "SUCCESS" : "FAILED");
                }

                
            }
            else if ($index->orderable_type == "App\Models\Product")
            {
                $index->status_order = "SUCCESS";
                $index->shipping_code = str_random(8);
            }

            $index->datetime_paid = date('Y-m-d H:i:s');

            $index->save();
            
        }
        else
        {
            return redirect()->back()->with('failed', 'Order number not found!');
        }

        return redirect()->route('order')->with('success', 'Your Order Has Been Updated!');
    }

    
}
