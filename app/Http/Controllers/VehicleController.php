<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Car;
use App\Models\Motorbike;
use App\Models\Truck;

class VehicleController extends Controller
{
    /**
     * Display a list of all vehicles.
     */
    public function index()
    {
        $vehicles = Vehicle::all();

        return view('vehicles.index', ['vehicles' => $vehicles]);
    }

    /**
     * Show the form for creating a new vehicle.
     */
    public function create()
    {
        return view('vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1901|max:2155|digits:4',
            'passenger_amount' => 'required|integer|min:0|max:65535',
            'manufacturer' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
        ]);
        
        $image = $request->file('image_path');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $imagePath = 'images/' . $imageName;
        $validatedData['image_path'] = $imagePath;
        
        // The vehicle_type request parameter is a string containing the vehicle type.
        // This is used to determine which vehicle type to create.
        $selectedVehicleType = $request->input('vehicle_type');
        switch ($selectedVehicleType) {
            case 'car':
                $validatedCarData = $request->validate([
                    'fuel_type' => 'required|string|max:255',
                    'car_trunk_size' => 'required|integer|min:0',
                ]);
                $validatedCarData['trunk_size'] = $validatedCarData['car_trunk_size'];
                $car = Car::create($validatedCarData);
                $validatedData['vehicleable_id'] = $car->id;
                $validatedData['vehicleable_type'] = 'App\Models\Car';
                $vehicle = Vehicle::create($validatedData);
                $car->vehicle()->save($vehicle);
                break;

            case 'motorbike':
                $validatedMotorbikeData = $request->validate([
                    'motorbike_trunk_size' => 'required|integer|min:0',
                    'fuel_capacity' => 'required|integer|min:0',
                ]);
                $validatedMotorbikeData['trunk_size'] = $validatedMotorbikeData['motorbike_trunk_size'];
                $motorbike = Motorbike::create($validatedMotorbikeData);
                $validatedData['vehicleable_id'] = $motorbike->id;
                $validatedData['vehicleable_type'] = 'App\Models\Motorbike';
                $vehicle = Vehicle::create($validatedData);
                $motorbike->vehicle()->save($vehicle);
                break;

            case 'truck':
                $validatedTruckData = $request->validate([
                    'tire_amount' => 'required|integer|min:0|max:65535',
                    'cargo_size' => 'required|integer|min:0',
                ]);
                $truck = Truck::create($validatedTruckData);
                $validatedData['vehicleable_id'] = $truck->id;
                $validatedData['vehicleable_type'] = 'App\Models\Truck';
                $vehicle = Vehicle::create($validatedData);
                $truck->vehicle()->save($vehicle);
                break;

            default:
                // Handle default case or show an error
                return redirect()->back()->withInput()->with('error', 'Data tidak lengkap.');
                break;
        }

        return redirect(route('vehicles.index'));

    }

    /**
     * Display the specified vehicle.
     */
    public function show(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('vehicles.show', ['vehicle' => $vehicle]);
    }

    /**
     * Show the form for editing the specified vehicle.
     */
    public function edit(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('vehicles.create', ['vehicle' => $vehicle]);
    }

    /**
     * Update the specified vehicle in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1901|max:2155|digits:4',
            'passenger_amount' => 'required|integer|min:0|max:65535',
            'manufacturer' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
        ]);

        // Since the vehicle_type input is disabled, we need to get the vehicle type from the vehicleable_type field.
        $vehicle = Vehicle::findOrFail($id);

        // Only update the image if a new image is uploaded.
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
            $validatedData['image_path'] = $imagePath;
        }

        // Update the vehicle.
        $vehicle->update($validatedData);

        // Based on the vehicle type, update the vehicleable.
        switch ($vehicle->vehicleable_type) {
            case 'App\\Models\\Car':
                $validatedCarData = $request->validate([
                    'fuel_type' => 'required|string|max:255',
                    'car_trunk_size' => 'required|integer|min:0',
                ]);
                $validatedCarData['trunk_size'] = $validatedCarData['car_trunk_size'];
                $car = Car::findOrFail($vehicle->vehicleable->id);
                $car->update($validatedCarData);
                break;

            case 'App\\Models\\Motorbike':
                $validatedMotorbikeData = $request->validate([
                    'motorbike_trunk_size' => 'required|integer|min:0',
                    'fuel_capacity' => 'required|integer|min:0',
                ]);
                $validatedMotorbikeData['trunk_size'] = $validatedMotorbikeData['motorbike_trunk_size'];
                $motorbike = Motorbike::findOrFail($vehicle->vehicleable->id);
                $motorbike->update($validatedMotorbikeData);
                break;

            case 'App\\Models\\Truck':
                $validatedTruckData = $request->validate([
                    'tire_amount' => 'required|integer|min:0|max:65535',
                    'cargo_size' => 'required|integer|min:0',
                ]);
                $truck = Truck::findOrFail($vehicle->vehicleable->id);
                $truck->update($validatedTruckData);
                break;

            default:
                // Handle default case or show an error
                return redirect()->back()->withInput()->with('error', 'Data tidak lengkap.');
                break;
        }

        return redirect(route('vehicles.index'));
    }

    /**
     * Remove the specified vehicle from storage.
     */
    public function destroy(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->vehicleable->delete();
        $vehicle->delete();

        return redirect(route('vehicles.index'));
    }
}
