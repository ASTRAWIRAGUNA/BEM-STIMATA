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
                <div class="card border-primary" >
                        <div class="card-body">
                            <h1 class="text-3xl text-black pb-6 text-bold">Tambahkan Item </h1>
                <div class="w-full mt-6">
                    
                    {{-- <h1>Tambah User</h1> --}}

                    <form action="{{ route('bendahara.update', $kopma->id) }}" method="POST" class="bg-white shadow-md rounded px-8 py-6">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 ">
                            <label for="item_name" class="block text-sm font-medium text-gray-700">Nama Item</label>
                            <input type="text" name="item_name" id="item_name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                             value="{{ old('item_name', $kopma->item_name) }}"required>
                        </div>
                
                        <div class="mb-3">
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Stok</label>
                            <input type="number" name="quantity" id="quantity" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                             value="{{ old('quantity', $kopma->quantity) }}" required>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                            <label for="item_price" class="block text-sm font-medium text-gray-700">Harga</label>
                            <input type="number" name="item_price" id="item_price" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                             value="{{ old('item_price', $kopma->item_price) }}" required>
                            </div>
                        </div>                                                          
                        <button type="submit"  class="w-full block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 items-center py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 " >Perbarui</button>
                    </form>


                    </div>
                </div>
                
            
                </div>
            </main>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
@endsection