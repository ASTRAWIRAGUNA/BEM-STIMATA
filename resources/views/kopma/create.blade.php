@extends('base')
@section('head')
<title>Fairus | Admin Page</title>
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.min.css" />
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
            <main class="w-full flex-flow: row-reverse wrap p-6">
                
                <div>
                    <div class="container">
                    <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-2">
                        <div class="card border rounded-md p-6">
                            <div class="flex items-center justify-between ">
                                <h4 class="text-2xl font-semibold text-black pb-2 text-bold">Masukan Pesanan</h4>
                                <form action="{{ route('bendahara.store') }}" method="POST" class="bg-white  rounded px-8 py-6 ">
                                    @csrf
                                    <input type="text" name="item_name" placeholder="Ketik 1"  id="item_name" class="form-control rounded px-2 py-2   " required>
                                </form>
                            </div>
                            <div class="bg-white overflow-auto">
                                <table class="min-w-full bg-white ">
                                    <thead class="bg-white-800 text-black">
                                        <tr>
                                            <th class="py-3 px-4 uppercase font-semibold text-sm text-center">No</th>
                                            <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Nama Item</th>
                                            <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Stok</th>
                                            <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Harga</th>
                                            <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Action</th>
                                        </tr>
                                    
                                        <tbody>
                                            {{-- @foreach ($kopmas as $kopma)
                                                <tr>
                                                    <td class="text-center py-3 px-4">{{ $loop->iteration }}</td>
                                                    <td class="text-center py-3 px-4">{{ $kopma->item_name }}</td>
                                                    <td class="text-center py-3 px-4">{{ $kopma->quantity }}</td>
                                                    <td class="text-center py-3 px-4">Rp.{{ number_format($kopma->item_price,2,'.',',') }}</td>
                                                    <td>
                                                        <div class="d-flex justify-contentd-flex justify-content-between-between">
                                                            <a href="{{ route('bendahara.edit', $kopma->id) }}">Edit</a>
                                                            <form action="{{ route('bendahara.destroy', $kopma->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                            <button type="submit" onclick="return confirm('Hapus user ini?')">Hapus</button>
                                                            </form>
                                                        </div>
                                                        
                                                    </td>
                                                </tr>
                                            @endforeach --}}
                                        </tbody>
                                    
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="grid grid-rows-4 grid-flow-col gap-4">
                        <div>
                            <div class="card border rounded-md p-10">
                                <div>
                                    <div class="flex items-center justify-start">
                                        <h3 class="text-2xl font-semibold text-black pb-2 text-bold ">Total Bayar : </h3>
                                    </div>
                                    
                                    <div class="flex items-center justify-between mt-10">
                                        <span>Rp. </span>
                                        <span>{{ number_format('10.000',2,'.',',') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div>
                            <div class="card border rounded-md p-6">                               
                                <div class="flex items-center justify-start">
                                    <h3 class="text-2xl font-semibold text-black pb-2 text-bold ">Bayar : </h3>
                                    
                                </div> 
                                <form action="{{ route('bendahara.store') }}" method="POST" class="bg-white  rounded mt-10 ">
                                    @csrf
                                    <input type="number" name="item_name" placeholder="bayar"  id="item_name" class="form-control rounded w-full" required>
                                </form>  
                                                           
                            </div>
                        </div>
    
                        <div>
                            <div class="card border rounded-md p-6">
                                <div>
                                    <div class="flex items-center justify-start">
                                        <h3 class="text-2xl font-semibold text-black pb-2 text-bold ">Kembalian : </h3>
                                    </div>
                                    
                                    <div class="flex items-center justify-between mt-10">
                                        <span>Rp. </span>
                                        <span>{{ number_format('10.000',2,'.',',') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div >
                            <button type="submit"  class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 items-center py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800  w-full" >Bayar</button>
                        </div>

                    </div>
                    

                </div>
                        
                    </div>
                </div>
                
                
                
                {{-- <div class="card border-primary" >
                        <div class="card-body">
                            <h1 class="text-3xl text-black pb-6 text-bold">Tambahkan Item </h1>
                <div class="w-full mt-6">
                    
                    

                    <form action="{{ route('bendahara.store') }}" method="POST" class="bg-white shadow-md rounded px-8 py-6 ">
                        @csrf
                
                        <div class="mb-3 ">
                            <label for="item_name" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                            <input type="text" name="item_name" id="item_name" class="form-control" required>
                        </div>
                
                        <div class="mb-3">
                            <label for="quantity" class="block text-sm font-medium text-gray-700">Stok</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                            <label for="item_price" class="block text-sm font-medium text-gray-700">Harga</label>
                            <input type="number" name="item_price" id="item_price" class="form-control" required>
                            </div>
                        </div>                                                          
                        <button type="submit"  class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 items-center py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 " >Simpan</button>
                    </form>


                        </div>
                </div> --}}
                
            
                
            </main>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
@endsection