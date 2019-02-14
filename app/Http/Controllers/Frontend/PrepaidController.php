<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Prepaid;
use App\Models\Order;

use App\Jobs\ProcessOrder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;

class PrepaidController extends Controller
{

    public function index(Request $request)
    {
    	return view('frontend.prepaid');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|min:7|max:12|regex:/081[0-9]*/',
            'value'         => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $prepaid = new Prepaid;
        $prepaid->mobile_number = $request->mobile_number;
        $prepaid->value         = $request->value;
        $prepaid->save();
        
        $order = new Order;
        $order->user_id  = Auth::id();
        $order->order_no = '01'.$prepaid->id;

        $prepaid->orders()->save($order);

        ProcessOrder::dispatch($order)
                ->delay(now()->addMinutes(5))->onQueue('processing');;

        $index = $prepaid;

        return view('frontend.success', compact('index'));
    }
}
