@extends('layouts.main_layout')

@section('title', 'Home')

@section('content')
<div class="flex flex-col">
    <a href="{{ route('customers.index') }}" class="btn">Lihat list customer</a>
    <a href="{{ route('vehicles.index') }}" class="btn">Lihat list kendaraan</a>
    <a href="{{ route('orders.index') }}" class="btn">Lihat list order</a>
</div>
@endsection