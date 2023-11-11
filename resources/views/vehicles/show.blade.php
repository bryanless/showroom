@extends('layouts.main_layout')

@section('title', 'Lihat kendaraan')

@section('content')
    <a href="{{ route('vehicles.index') }}" class="btn">Kembali</a>
    <div class="flex flex-col">
        <img src="{{ asset($vehicle->image_path) }}" alt="Your Image" class="w-64">
        <p>Model: {{ $vehicle->model }}</p>
        <p>Tahun: {{ $vehicle->year }}</p>
        <p>Jumlah penumpang: {{ $vehicle->passenger_amount }}</p>
        <p>Manufaktur: {{ $vehicle->manufacturer }}</p>
        <p>Harga: {{ $vehicle->price }}</p>
        <p>Tipe kendaraan:
            {{ $vehicle->vehicleable_type === 'App\Models\Car' ? 'Mobil' : ($vehicle->vehicleable_type === 'App\Models\Motorbike' ? 'Motor' : ($vehicle->vehicleable_type === 'App\Models\Truck' ? 'Truk' : 'Undefined')) }}
        </p>
        @if ($vehicle->vehicleable_type === 'App\Models\Car')
            <p>Ukuran bagasi: {{ $vehicle->vehicleable->trunk_size }}</p>
            <p>Jenis bahan bakar: {{ $vehicle->vehicleable->fuel_type }}</p>
        @elseif ($vehicle->vehicleable_type === 'App\Models\Motorbike')
            <p>Ukuran bagasi: {{ $vehicle->vehicleable->trunk_size }}</p>
            <p>Kapasitas bahan bakar: {{ $vehicle->vehicleable->fuel_capacity }}</p>
        @elseif ($vehicle->vehicleable_type === 'App\Models\Truck')
            <p>Jumlah ban: {{ $vehicle->vehicleable->tire_amount }}</p>
            <p>Ukuran kargo: {{ $vehicle->vehicleable->cargo_size }}</p>
        @endif
    </div>
@endsection
