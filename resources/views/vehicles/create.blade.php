@extends('layouts.main_layout')

@section('title', 'Tambah kendaraan')

@section('content')
    <div class="flex flex-col">
        <a href="{{ route('vehicles.index') }}" class="btn">Kembali</a>
        <p>{{ isset($vehicle) ? 'Edit data kendaraan' : 'Tambah data kendaraan' }}</p>
        <form action="{{ isset($vehicle) ? route('vehicles.update', $vehicle->id) : route('vehicles.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @if (isset($vehicle))
                @method('PUT')
                <img src="{{ asset($vehicle->image_path) }}" alt="Your Image" class="w-64">
            @endif

            @if (isset($vehicle))
                <div class="flex flex-col">
                    <label for="imageFile">Choose an image file:</label>
                    <input type="file" id="imageFile" name="image_path" accept="image/*">
                    @error('image_path')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            @else
                <div class="flex flex-col">
                    <label for="imageFile">Choose an image file:</label>
                    <input type="file" id="imageFile" name="image_path" accept="image/*" required>
                    @error('image_path')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            <div class="flex flex-col">
                <label for="model">Model</label>
                <input type="text" name="model" id="model" value="{{ old('model', $vehicle->model ?? '') }}"
                    required class="input input-bordered">
                @error('model')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col">
                <label for="year">Tahun</label>
                <input type="number" name="year" id="year" value="{{ old('year', $vehicle->year ?? '') }}" required
                    class="input input-bordered">
                @error('year')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col">
                <label for="passenger_amount">Jumlah penumpang</label>
                <input type="number" name="passenger_amount"
                    value="{{ old('passenger_amount', $vehicle->passenger_amount ?? '') }}" id="passenger-amount" required
                    class="input input-bordered">
                @error('passenger_amount')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col">
                <label for="manufacturer">Manufaktur</label>
                <input type="text" name="manufacturer" id="manufacturer"
                    value="{{ old('manufacturer', $vehicle->manufacturer ?? '') }}" required class="input input-bordered">
                @error('manufacturer')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col">
                <label for="price">Harga</label>
                <input type="number" name="price" id="price" value="{{ old('price', $vehicle->price ?? '') }}"
                    required class="input input-bordered">
                @error('price')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            @if (isset($vehicle))
                <div class="flex flex-col">
                    <label for="vehicle_type">Tipe kendaraan</label>
                    <select id="vehicle-type" name="vehicle_type" disabled class="select w-full max-w-xs">
                        <option selected
                            value="{{ $vehicle->vehicleable_type === 'App\Models\Car' ? 'car' : ($vehicle->vehicleable_type === 'App\Models\Motorbike' ? 'motorbike' : ($vehicle->vehicleable_type === 'App\Models\Truck' ? 'truck' : 'Undefined')) }}">
                            {{ $vehicle->vehicleable_type === 'App\Models\Car' ? 'Mobil' : ($vehicle->vehicleable_type === 'App\Models\Motorbike' ? 'Motor' : ($vehicle->vehicleable_type === 'App\Models\Truck' ? 'Truk' : 'Undefined')) }}
                        </option>
                    </select>
                </div>

                <!-- Input fields to show/hide based on the selected vehicle type -->
                @if ($vehicle->vehicleable_type === 'App\Models\Car')
                    <div id="car-fields">
                        <div class="flex flex-col">
                            <label for="fuel_type">Tipe bahan bakar</label>
                            <input type="text" name="fuel_type" id="fuel-type"
                                value="{{ $vehicle->vehicleable->fuel_type }}" class="input input-bordered">
                            @error('fuel_type')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="car_trunk_size">Luas bagasi</label>
                            <input type="number" name="car_trunk_size" id="trunk-size"
                                value="{{ $vehicle->vehicleable->trunk_size }}" class="input input-bordered">
                            @error('car_trunk_size')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                @elseif ($vehicle->vehicleable_type === 'App\Models\Motorbike')
                    <div id="motorbike-fields">
                        <div class="flex flex-col">
                            <label for="motorbike_trunk_size">Ukuran bagasi</label>
                            <input type="number" name="motorbike_trunk_size" id="motorbike_trunk_size"
                                value="{{ $vehicle->vehicleable->trunk_size }}" class="input input-bordered">
                            @error('motorbike_trunk_size')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="fuel_capacity">Kapasitas bahan bakar</label>
                            <input type="number" name="fuel_capacity" id="fuel_capacity"
                                value="{{ $vehicle->vehicleable->fuel_capacity }}" class="input input-bordered">
                            @error('fuel_capacity')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                @elseif ($vehicle->vehicleable_type === 'App\Models\Truck')
                    <div id="truck-fields">
                        <div class="flex flex-col">
                            <label for="tire_amount">Jumlah ban</label>
                            <input type="number" name="tire_amount" id="tire_amount"
                                value="{{ $vehicle->vehicleable->tire_amount }}" class="input input-bordered">
                            @error('tire_amount')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label for="cargo_size">Ukuran kargo</label>
                            <input type="number" name="cargo_size" id="cargo_size"
                                value="{{ $vehicle->vehicleable->cargo_size }}" class="input input-bordered">
                            @error('cargo_size')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                @endif
            @else
                <div class="flex flex-col">
                    <label for="vehicle_type">Tipe kendaraan</label>
                    <select id="vehicle-type" name="vehicle_type" class="select w-full max-w-xs" required
                        onchange="showHideInputs()">
                        <option {{ old('vehicle_type') == null ? 'selected' : '' }} disabled>Pilih tipe kendaraan</option>
                        <option {{ old('vehicle_type') == 'car' ? 'selected' : '' }} value="car">Mobil</option>
                        <option {{ old('vehicle_type') == 'motorbike' ? 'selected' : '' }} value="motorbike">Motor
                        </option>
                        <option {{ old('vehicle_type') == 'truck' ? 'selected' : '' }} value="truck">Truk</option>
                    </select>
                    @error('vehicle_type')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Input fields to show/hide based on the selected vehicle type -->
                <div id="car-fields" class="hidden">
                    <div class="flex flex-col">
                        <label for="fuel_type">Tipe bahan bakar</label>
                        <input type="text" name="fuel_type" id="fuel_type" value="{{ old('fuel_type') }}"
                            class="input input-bordered">
                        @error('fuel_type')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="car_trunk_size">Luas bagasi</label>
                        <input type="number" name="car_trunk_size" id="car_trunk_size"
                            value="{{ old('car_trunk_size') }}" class="input input-bordered">
                        @error('car_trunk_size')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div id="motorbike-fields" class="hidden">
                    <div class="flex flex-col">
                        <label for="motorbike_trunk_size">Ukuran bagasi</label>
                        <input type="number" name="motorbike_trunk_size" id="motorbike_trunk_size"
                            value="{{ old('motorbike_trunk_size') }}" class="input input-bordered">
                        @error('motorbike_trunk_size')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="fuel_capacity">Kapasitas bahan bakar</label>
                        <input type="number" name="fuel_capacity" id="fuel_capacity"
                            value="{{ old('fuel_capacity') }}" class="input input-bordered">
                        @error('fuel_capacity')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div id="truck-fields" class="hidden">
                    <div class="flex flex-col">
                        <label for="tire_amount">Jumlah ban</label>
                        <input type="number" name="tire_amount" id="tire_amount" value="{{ old('tire_amount') }}"
                            class="input input-bordered">
                        @error('tire_amount')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col">
                        <label for="cargo_size">Ukuran kargo</label>
                        <input type="number" name="cargo_size" id="cargo_size" value="{{ old('cargo_size') }}"
                            class="input input-bordered">
                        @error('cargo_size')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            @endif

            <button type="submit" class="btn">{{ isset($vehicle) ? 'Simpan' : 'Tambah' }}</button>
        </form>

    </div>

    <script>
        function showHideInputs() {
            var selectedVehicle = document.getElementById('vehicle-type').value;
            console.log(selectedVehicle);

            // Hide all input fields
            document.getElementById('car-fields')?.classList.add('hidden');
            document.getElementById('motorbike-fields')?.classList.add('hidden');
            document.getElementById('truck-fields')?.classList.add('hidden');

            // Show input fields based on the selected vehicle type
            if (selectedVehicle === 'car') {
                document.getElementById('car-fields')?.classList.remove('hidden');
            } else if (selectedVehicle === 'motorbike') {
                document.getElementById('motorbike-fields')?.classList.remove('hidden');
            } else if (selectedVehicle === 'truck') {
                document.getElementById('truck-fields')?.classList.remove('hidden');
            }
        }

        @if (old('vehicle_type') != null ? 'true' : 'false')
            showHideInputs()
        @endif
    </script>
@endsection
