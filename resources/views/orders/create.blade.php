@extends('layouts.main_layout')

@section('title', 'Buat order')

@section('content')
    <div class="flex flex-col">
        <a href="{{ route('orders.index') }}" class="btn">Kembali</a>
        <p>{{ isset($order) ? 'Edit order' : 'Buat order' }}</p>
        <form method="POST" action="{{ isset($order) ? route('orders.update', $order->id) : route('orders.store') }}""
            class="flex flex-col">
            @csrf
            @if (isset($order))
                @method('PUT')
            @endif

            @if (isset($order))
                <select id="customer" name="customer_id" disabled class="select w-full max-w-xs">
                    <option selected>{{ $order->customer->name }}</option>
                </select>

                <select id="vehicle" name="vehicle" required class="select w-full max-w-xs" onchange="updatePrice()">
                    <option value="" disabled selected>Pilih kendaraan</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle }}" {{ $order->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                            {{ $vehicle->model }}</option>
                    @endforeach
                    @error('vehicle')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </select>

                <div class="flex flex-col">
                    <label for="quantity">Jumlah</label>
                    <input type="number" name="quantity" id="quantity"
                        value="{{ old('quantity', $order->quantity ?? 0) }}" required class="input input-bordered"
                        oninput="updatePrice()">
                    @error('quantity')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="price">Total harga</label>
                    <input type="number" name="price" id="price" readonly value="0"
                        class="input input-bordered">
                </div>
            @else
                <select id="customer" name="customer_id" required class="select w-full max-w-xs">
                    <option value="" disabled selected>Pilih customer</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                    @error('customer_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </select>

                <select id="vehicle" name="vehicle" required class="select w-full max-w-xs" onchange="updatePrice()">
                    <option value="" disabled selected>Pilih kendaraan</option>
                    @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle }}">{{ $vehicle->model }}</option>
                    @endforeach
                    @error('vehicle')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </select>

                <div class="flex flex-col">
                    <label for="quantity">Jumlah</label>
                    <input type="number" name="quantity" id="quantity"
                        value="{{ old('quantity', $order->quantity ?? 0) }}" required class="input input-bordered"
                        oninput="updatePrice()">
                    @error('quantity')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label for="price">Total harga</label>
                    <input type="number" name="price" id="price" readonly value="0"
                        class="input input-bordered">
                </div>
            @endif

            <button type="submit" class="btn">{{ isset($order) ? 'Simpan' : 'Tambahkan' }}</button>
        </form>
    </div>
    <script>
        function updatePrice() {
            const quantity = document.getElementById('quantity')?.value;
            if (quantity === "") return;
            const vehicle = document.getElementById('vehicle')?.value;
            const price = document.getElementById('price');

            if (vehicle === "") return;
            const parsed = JSON.parse(vehicle);

            const totalPrice = parseInt(quantity) * parseInt(parsed.price);
            price.value = totalPrice;
        }
        @if (isset($order))
            updatePrice();
        @endif
    </script>
@endsection
