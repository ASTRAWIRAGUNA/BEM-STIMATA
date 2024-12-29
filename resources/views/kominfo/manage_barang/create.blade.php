@extends('base')
@section('head')
<title>Fairus | Admin Page</title>
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.min.css" />
{{-- icon --}}
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
    @include('partials.sidebarKominfo')

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        @include('partials.headers')

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6 text-bold">Tambah Peminjaman Baru </h1>

                <div class="w-full mt-6">
                    

                    {{-- <h1>Tambah Surat Baru</h1> --}}

                    
                    <form action="{{ route('inventories.store') }}" method="POST" class="bg-white shadow-md rounded px-8 py-6">
                        @csrf
                
                        <div class="mb-3">
                            <label for="item_name" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                            <input type="text" name="item_name" id="item_name" class="form-control" required>
                        </div>
                
                        <div class="mb-3">
                            <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                            <input type="text" name="category" id="category" class="form-control" required>
                        </div>
                
                        <div class="mb-3" >
                            <label for="availability_status" class="block text-sm font-medium text-gray-700">Status Ketersediaan</label>
                            <select name="availability_status" id="availability_status" class="form-control" required>
                                <option value="Available">Tersedia</option>
                                <option value="Unavailable">Tidak Tersedia</option>
                            </select>
                        </div>
                
                        <div class="mb-3">
                            <label for="requires_letter" class="block text-sm font-medium text-gray-700">Memerlukan Surat</label>
                            <select name="requires_letter" id="requires_letter" class="form-control" required>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>
                
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>

            
                </div>
                
                
            </main>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
@endsection