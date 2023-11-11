<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Vehicle;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();

        return view('orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $vehicles = Vehicle::all();

        return view('orders.create', ['customers' => $customers, 'vehicles' => $vehicles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'customer_id' => 'required',
            'vehicle' => 'required',
            'quantity' => 'required|integer',
        ]);
        $vehicle = json_decode($request->vehicle);
        $validatedData['vehicle_id'] = $vehicle->id;

        $order = Order::create($validatedData);

        return redirect(route('orders.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        $customers = Customer::all();
        $vehicles = Vehicle::all();

        return view('orders.create', ['order' => $order, 'customers' => $customers, 'vehicles' => $vehicles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'vehicle' => 'required',
            'quantity' => 'required|integer',
        ]);
        $vehicle = json_decode($request->vehicle);

        $order = Order::findOrFail($id);

        $validatedData['customer_id'] = $order->customer->id;
        $validatedData['vehicle_id'] = $vehicle->id;
        $order->update($validatedData);

        return redirect(route('orders.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect(route('orders.index'));
    }
}
