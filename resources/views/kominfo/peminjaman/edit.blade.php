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
                <h1 class="text-3xl text-black pb-6 text-bold">Edit Peminjaman </h1>
                
                

                <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
                    @csrf
                    @method('PUT')
            
                    <div class="mb-3">
                        <label for="inventory_id">Barang</label>
                        <select name="inventory_id" id="inventory_id" class="form-control">
                            @foreach ($inventories as $inventory)
                                <option value="{{ $inventory->id }}" {{ $peminjaman->inventory_id == $inventory->id ? 'selected' : '' }}>
                                    {{ $inventory->name }} ({{ $inventory->availability_status }})
                                </option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="mb-3">
                        <label for="surat_id">Surat</label>
                        <select name="surat_id" id="surat_id" class="form-control">
                            <option value="">Tidak Memerlukan Surat</option>
                            @foreach ($surat as $s)
                                <option value="{{ $s->id }}" {{ $peminjaman->surat_id == $s->id ? 'selected' : '' }}>
                                    {{ $s->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="Pending" {{ $peminjaman->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Approved" {{ $peminjaman->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                            <option value="Returned" {{ $peminjaman->status == 'Returned' ? 'selected' : '' }}>Returned</option>
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