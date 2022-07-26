<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeliveryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::where('order_status', 'O')
            ->orWhere(function($where){
                return $where->where('order_status', 'P')->where('picked_by', Auth::user()->id);
            })
            ->with('pickup_address', 'delivery_address')->get();
        return view('delivery.home', compact('orders'));
    }

    public function pickOrder($id)
    {
        try{
            $order = Order::findOrFail($id);
            if($order->order_status != 'Open'){
                return response()->json(['message' => 'Someone picked already'], 400);
            }

            $order->order_status = 'P';
            $order->picked_at = DB::raw('NOW()');
            $order->picked_by = Auth::user()->id;
            $order->save();
            return response()->json(['message' => 'Success']);
        }catch (\Exception $e){
            Log::debug($e);
            return response()->json(['message' => 'try again later'], 400);
        }
    }

    public function deliverOrder($id)
    {
        try{
            $order = Order::findOrFail($id);
            if($order->order_status != 'Picked'){
                return response()->json(['message' => 'Try again'], 400);
            }
            $order->order_status = 'D';
            $order->delivered_at = DB::raw('NOW()');
            $order->delivered_by = Auth::user()->id;
            $order->save();
            return response()->json(['message' => 'Success']);
        }catch (\Exception $e){
            Log::debug($e);
            return response()->json(['message' => 'try again later'], 400);
        }
    }
}
