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

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6 text-bold">Dashboard</h1>

                <div  class="grid grid-cols-1 md:grid-cols-4 gap-6">

                    <!-- Card Total Barang-->
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-700">Total Barang Kopma</h3>
                                <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full">
                                  <i class="fa-solid fa-cart-flatbed"></i>
                                </div>  
                            </div>
                            <div class="text-3xl font-bold text-blue-500">{{$totalbarang ?? '0'}}</div>
                    </div>


                    <!-- Card Total Penjualan -->
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-700">Total Penjualan</h3>
                                <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full">
                                  <i class="fa-solid fa-chart-line"></i>
                                </div>  
                            </div>
                            <div class="text-3xl font-bold text-blue-500">{{$totalpenjualan ?? '0'}}</div>
                    </div>

                    <!-- Card Total Penjualan -->
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-700">Total Pendapatan</h3>
                                <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full">
                                  <i class='fas fa-money-bill-wave'></i>
                                </div>  
                            </div>
                            <div class="text-3xl font-bold text-blue-500">Rp.{{ number_format($totalpendapatan ?? 0, 0, ',', '.') }} </div>
                    </div>

                    <!-- Card Total Penjualan -->
                    <div class="bg-white shadow rounded-lg p-6">
                      <div class="flex items-center justify-between">
                              <h3 class="text-lg font-semibold text-gray-700">Total Pengeluaran</h3>
                              <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full">
                                <i class='fas fa-cash-register'></i>
                              </div>  
                          </div>
                          <div class="text-3xl font-bold text-blue-500">Rp.{{ number_format($totalpengeluaran ?? 0, 0, ',', '.') }} </div>
                  </div>

                </div>

                
            </main>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
@endsection