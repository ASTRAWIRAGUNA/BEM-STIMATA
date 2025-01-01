@extends('base')
@section('head')
<link rel="icon" href="{{ asset('images/logo/favicon.png') }}" type="image/png">
<title>BEM | Bendahara Page</title>
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.min.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
    .font-family-karla { font-family: karla; }
    .bg-sidebar { background: #3d68ff; }
    .cta-btn { color: #3d68ff; }
    .upgrade-btn { background: #1947ee; }
    .upgrade-btn:hover { background: #0038fd; }
    .active-nav-link { background: #1947ee; }
    .nav-item:hover { background: #1947ee; }
    .account-link:hover { background: #3d68ff; }
    button[data-modal-toggle] i.ri-close-line {
    font-size: 1.5rem; /* Increase font size */
    padding: 0.5rem; /* Increase padding */}
</style>
@endsection
@section('body')
<div class="flex">
    @include('partials.sidebarBendahara')

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        @include('partials.headers')

        <div class="w-full border-t flex flex-col">
            <main class="w-full flex-grow ">
                <div class=" bg-white p-6 shadow-md">
                    <h1 class="text-3xl text-black pb-6 text-bold">Daftar Penjualan </h1>
                    <div class="w-full mt-6">
                        <div class="flex justify-between mb-5">
                            <p class="text-xl pb-3 flex items-center">
                                <i class="ri-list-check mr-2"></i> List Penjualan Kopma
                            </p>
                            <a href="{{ route('penjualan.create') }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 items-center py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 " type="button" >
                                <i class="ri-add-line mr-3 text-lg"></i> Tambah Penjualan
                            </a>
                    </div>
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @elseif(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                </div>
            </main>
        </div>
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow ">
                <div class="sticky w-full h-screen  bg-white">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">No</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Nama Barang</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Tanggal Pesanan</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1; // Variabel manual untuk nomor urut
                            @endphp
                            @foreach($orders as $order)
                                @foreach($order->orderItems as $orderItem)
                                    <tr>
                                        <td class="text-center py-3 px-4">{{ $no++ }}</td>
                                        <td class="text-center py-3 px-4">{{ $orderItem->item_name }}</td>
                                        <td class="text-center py-3 px-4">{{ $order->order_date }}</td>
                                        <td class="text-center py-3 px-4">{{ $orderItem->total_price }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
@endsection