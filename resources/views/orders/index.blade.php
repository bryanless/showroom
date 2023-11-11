@extends('layouts.main_layout')

@section('title', 'Orders')

@section('content')
    <div class="flex flex-col">
        <a href="{{ route('index') }}" class="btn">Kembali</a>
        <p>List orders</p>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama customer</th>
                        <th>Model kendaraan</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <th>{{ $loop->index + 1 }}</th>
                            <td>{{ $order->customer->name }}</td>
                            <td>{{ $order->vehicle->model }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td class="flex flex-row">
                                <a href="{{ route('orders.edit', $order->id) }}" class="btn">Edit</a>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
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
        <a href="{{ route('orders.create') }}" class="btn">Buat order</a>
    </div>
@endsection
