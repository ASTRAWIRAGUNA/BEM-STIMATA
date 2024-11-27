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
    @include('partials.sidebarKominfo')

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        @include('partials.headers')

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6 text-bold">Edit Barang </h1>
                
                

                <form action="{{ route('inventories.update', $inventory->id) }}" method="POST">
                    @csrf
                    @method('PUT')
            
                    <div class="mb-3">
                        <label for="item_name">Nama Barang</label>
                        <input type="text" name="item_name" id="item_name" class="form-control" value="{{ $inventory->item_name }}" required>
                    </div>
            
                    <div class="mb-3">
                        <label for="category">Kategori</label>
                        <input type="text" name="category" id="category" class="form-control" value="{{ $inventory->category }}" required>
                    </div>
            
                    <div class="mb-3">
                        <label for="availability_status">Status Ketersediaan</label>
                        <select name="availability_status" id="availability_status" class="form-control" required>
                            <option value="Available" {{ $inventory->availability_status == 'Available' ? 'selected' : '' }}>Tersedia</option>
                            <option value="Unavailable" {{ $inventory->availability_status == 'Unavailable' ? 'selected' : '' }}>Tidak Tersedia</option>
                        </select>
                    </div>
            
                    <div class="mb-3">
                        <label for="requires_letter">Memerlukan Surat</label>
                        <select name="requires_letter" id="requires_letter" class="form-control" required>
                            <option value="1" {{ $inventory->requires_letter ? 'selected' : '' }}>Ya</option>
                            <option value="0" {{ !$inventory->requires_letter ? 'selected' : '' }}>Tidak</option>
                        </select>
                    </div>
            
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </form>
               

               
            </main>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
@endsection