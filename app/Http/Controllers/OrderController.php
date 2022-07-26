<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('customer_id', Auth::user()->id)->with('pickup_address', 'delivery_address')->get();
        return view('customer.home',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formType='create';
        return view('customer.createOrder', compact('formType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'item_code' => 'required|unique:orders,item_code',
            'pickup_name' => 'required',
            'pickup_address' => 'required',
            'pickup_place' => 'required',
            'pickup_district' => 'required',
            'pickup_state' => 'required',
            'pickup_pin' => 'required|numeric',
            'delivery_address' => 'required',
            'delivery_place' => 'required',
            'delivery_district' => 'required',
            'delivery_state' => 'required',
            'delivery_pin' => 'required|numeric',
        ]);

        try {

            DB::beginTransaction();
            $pickup_data['name'] = $request->pickup_name;
            $pickup_data['address'] = $request->pickup_address;
            $pickup_data['place'] = $request->pickup_place;
            $pickup_data['district'] = $request->pickup_district;
            $pickup_data['state'] = $request->pickup_state;
            $pickup_data['pin'] = $request->pickup_pin;
            $pickup_address = new Address($pickup_data);
            $pickup_address->save();

            $delivery_data['name'] = $request->delivery_name;
            $delivery_data['address'] = $request->delivery_address;
            $delivery_data['place'] = $request->delivery_place;
            $delivery_data['district'] = $request->delivery_district;
            $delivery_data['state'] = $request->delivery_state;
            $delivery_data['pin'] = $request->delivery_pin;
            $delivery_address = new Address($delivery_data);
            $delivery_address->save();

            $order_data['customer_id'] = Auth::user()->id;
            $order_data['item_name'] = $request->item_name;
            $order_data['item_code'] = $request->item_code;
            $order_data['pickup_address_id'] = $pickup_address->id;
            $order_data['delivery_address_id'] = $delivery_address->id;
            $order = new Order($order_data);
            $order->save();
            DB::commit();

            return redirect()->route('orders.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e);
            return redirect()->back()->withErrors('Try Again Later')->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
