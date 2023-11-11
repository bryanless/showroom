<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a list of all customers.
     */
    public function index()
    {
        $customers = Customer::all();

        return view('customers.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new customer.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created customer in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'required|numeric',
            'id_card' => 'required|numeric|digits:16',
        ]);

        $customer = Customer::create($validatedData);        

        return redirect(route('customers.index'));
    }

    /**
     * Display the specified customer.
     * Currently not implemented as all information can be seen in the index view.
     */
    public function show(string $id)
    {
        abort(501, 'This feature is not implemented yet.');
    }

    /**
     * Show the form for editing the specified customer.
     */
    public function edit(string $id)
    {   
        $customer = Customer::findOrFail($id);

        return view('customers.create', ['customer' => $customer]);
    }

    /**
     * Update the specified customer in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'required|numeric',
            'id_card' => 'required|integer|digits:16',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($validatedData);

        return redirect(route('customers.index'));
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect(route('customers.index'));
    }
}
