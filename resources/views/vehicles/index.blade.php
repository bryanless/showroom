@extends('layouts.main_layout')

@section('title', 'Kendaraan')

@section('content')
    <div class="flex flex-col">
        <a href="{{ route('index') }}" class="btn">Kembali</a>
        <p>List kendaraan</p>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Model</th>
                        <th>Tahun</th>
                        <th>Jumlah penumpang</th>
                        <th>Manufaktur</th>
                        <th>Harga</th>
                        <th>Tipe kendaraan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $vehicle)
                        <tr>
                            {{-- {{ dd($vehicle->vehicleable->first())  }} --}}
                            <th>{{ $loop->index + 1 }}</th>
                            <td>
                                <img src="{{ asset($vehicle->image_path) }}" alt="Your Image"
                                    class="w-16 object-cover aspect-square">
                            </td>
                            <td>{{ $vehicle->model }}</td>
                            <td>{{ $vehicle->year }}</td>
                            <td>{{ $vehicle->passenger_amount }}</td>
                            <td>{{ $vehicle->manufacturer }}</td>
                            <td>{{ $vehicle->price }}</td>
                            <td>{{ $vehicle->vehicleable_type === 'App\Models\Car' ? 'Mobil' : ($vehicle->vehicleable_type === 'App\Models\Motorbike' ? 'Motor' : ($vehicle->vehicleable_type === 'App\Models\Truck' ? 'Truk' : 'Undefined')) }}
                            </td>
                            <td class="flex flex-row">
                                <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn">Lihat</a>
                                <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn">Edit</a>
                                <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{ route('vehicles.create') }}" class="btn">Tambah kendaraan</a>
    </div>
@endsection
