@extends('layouts.main_layout')

@section('title', 'Customer')

@section('content')
    <div class="flex flex-col">
        <a href="{{ route('customers.index') }}" class="btn">Kembali</a>
        <p>{{ isset($customer) ? 'Edit data customer' : 'Tambah data customer' }}</p>
        <form method="POST"
            action="{{ isset($customer) ? route('customers.update', $customer->id) : route('customers.store') }}"
            class="flex flex-col">
            @csrf
            @if (isset($customer))
                @method('PUT')
            @endif

            <label for="name">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', $customer->name ?? '') }}" required
                class="input input-bordered">
            @error('name')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <label for="address">Alamat</label>
            <input type="text" name="address" id="address" value="{{ old('address', $customer->address ?? '') }}"
                required class="input input-bordered">
            @error('addresss')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <label for="phoneNumber">Nomor telepon</label>
            <input type="number" name="phone_number" id="phoneNumber"
                value="{{ old('phone_number', $customer->phone_number ?? '') }}" required class="input input-bordered">
            @error('phone_number')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <label for="idCard">Nomor KTP</label>
            <input type="number" name="id_card" id="idCard" value="{{ old('id_card', $customer->id_card ?? '') }}"
                required class="input input-bordered">
            @error('id_card')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <button type="submit" class="btn">{{ isset($customer) ? 'Simpan' : 'Tambahkan' }}</button>
        </form>
    </div>
@endsection
