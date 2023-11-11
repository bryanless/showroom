@extends('layouts.main_layout')

@section('title', 'Customers')

@section('content')
    <div class="flex flex-col">
        <a href="{{ route('index') }}" class="btn">Kembali</a>
        <p>List customer</p>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Nomor Telepon</th>
                        <th>Nomor KTP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <th>{{ $loop->index + 1 }}</th>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->phone_number }}</td>
                            <td>{{ $customer->id_card }}</td>
                            <td class="flex flex-row">
                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn">Edit</a>
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
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
        <a href="{{ route('customers.create') }}" class="btn">Tambah customer</a>
    </div>
@endsection
