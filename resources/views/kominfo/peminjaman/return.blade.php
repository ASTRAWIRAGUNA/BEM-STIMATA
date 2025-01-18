@extends('base')
@section('head')
<link rel="icon" href="{{ asset('images/logo/favicon.png') }}" type="image/png">
<title>BEM | Kominfo Page</title>
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
                <h1 class="text-3xl text-black pb-6 text-bold">Edit Peminjaman </h1>
                
                

                <form action="{{ route('peminjaman.return', $peminjaman->id) }}" class="bg-white shadow-md rounded px-8 py-6" method="POST">
                    @csrf
                    @method('PUT')
            
                    <div class="mb-3">
                        <label for="inventory_id">Barang</label>
                        <select name="inventory_id" id="inventory_id"  class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @foreach ($inventories as $inventory)
                                <option value="{{ $inventory->id }}" {{ $peminjaman->inventory_id == $inventory->id ? 'selected' : '' }}>
                                    {{ $inventory->name }} ({{ $inventory->availability_status }})
                                </option>
                            @endforeach
                        </select>
                    </div>
            
                    {{-- <div class="mb-3">
                        <label for="surat_id">Surat</label>
                        <select name="surat_id" id="surat_id"  class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Tidak Memerlukan Surat</option>
                            @foreach ($surat as $s)
                                <option value="{{ $s->id }}" {{ $peminjaman->surat_id == $s->id ? 'selected' : '' }}>
                                    {{ $s->title }}
                                </option>
                            @endforeach
                        </select>
                    </div> --}}
            
                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status"  class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            {{-- <option value="Pending" {{ $peminjaman->status == 'Pending' ? 'selected' : '' }}>Pending</option> --}}
                            {{-- <option value="Approved" {{ $peminjaman->status == 'Approved' ? 'selected' : '' }}>Approved</option> --}}
                            <option value="Returned" {{ $peminjaman->status == 'Returned' ? 'selected' : '' }}>Returned</option>
                        </select>
                    </div>
                    <div>
                        <label for="return_condition">Deskripsi Kondisi Akhir</label>w
                        <textarea name="return_condition" required></textarea>
                    </div>
                    <div>
                        <label for="comments">Komentar (Opsional)</label>
                        <textarea name="comments"></textarea>
                    </div>
            
                    <button type="submit"  class="w-full block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 items-center py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">Perbarui</button>
                </form>
               

               
            </main>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
@endsection