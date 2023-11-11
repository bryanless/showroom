<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Vehicle;

class OrderController extends Controller
{
    /**
     * Display a list of all orders.
     */
    public function index()
    {
        $orders = Order::all();

        return view('orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new order.
     * Creating a new order requires the user to select a customer and a vehicle.
     */
    public function create()
    {
        $customers = Customer::all();
        $vehicles = Vehicle::all();

        return view('orders.create', ['customers' => $customers, 'vehicles' => $vehicles]);
    }

    /**
     * Store a newly created customer in storage.
     * The vehicle request parameter is a JSON object containing the vehicle's id.
     * This is intended to support automatic total price calculation in the view.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'customer_id' => 'required|integer|min:0',
            'vehicle' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);
        $vehicle = json_decode($request->vehicle);
        $validatedData['vehicle_id'] = $vehicle->id;

        $order = Order::create($validatedData);

        return redirect(route('orders.index'));
    }

    /**
     * Display the specified order.
     * Currently not implemented as all information can be seen in the index view.
     */
    public function show(string $id)
    {
        abort(501, 'This feature is not implemented yet.');
    }

    /**
     * Show the form for editing the specified order.
     * Editing an order doesn't allow the user to change the customer.
     */
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        $vehicles = Vehicle::all();

        return view('orders.create', ['order' => $order, 'vehicles' => $vehicles]);
    }

    /**
     * Update the specified order in storage.
     * The vehicle request parameter is a JSON object containing the vehicle's id.
     * This is intended to support automatic total price calculation in the view.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'vehicle' => 'required',
            'quantity' => 'required|integer|min:0',
        ]);
        $vehicle = json_decode($request->vehicle);

        $order = Order::findOrFail($id);

        $validatedData['customer_id'] = $order->customer->id;
        $validatedData['vehicle_id'] = $vehicle->id;
        $order->update($validatedData);

        return redirect(route('orders.index'));
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect(route('orders.index'));
    }
}
