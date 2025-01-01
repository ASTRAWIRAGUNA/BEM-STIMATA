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
                <h1 class="text-3xl text-black pb-6 text-bold">Tambah Peminjaman Baru </h1>

                <div class="w-full mt-6">
                    

                    {{-- <h1>Tambah Surat Baru</h1> --}}
                    @if (session('success'))
                    <p style="color: red;">{{ session('error') }}</p>
                    @endif
                     <!-- Form Tambah Peminjaman -->
                    <form action="{{ route('peminjaman.store') }}" method="POST" class="bg-white shadow-md rounded px-8 py-6">
                        @csrf
                
                        <!-- Pilih Barang -->
                        <div class="mb-4">
                            <label for="inventory_id" class="block text-sm font-medium text-gray-700">Barang</label>
                            <select name="inventory_id" id="inventory_id" class="block w-full mt-1 rounded border-gray-300" required>
                                <option value="" disabled selected>Pilih Barang</option>
                                @foreach ($inventories as $inventory)
                                    <option value="{{ $inventory->id }}" data-requires-letter="{{ $inventory->requires_letter }}">
                                        {{ $inventory->item_name }} - {{ $inventory->availability_status  }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                
                        <!-- Pilih Surat (Hanya Jika Diperlukan) -->
                        <div class="mb-4 hidden" id="surat-group">
                            <label for="surat_id" class="block text-sm font-medium text-gray-700">Surat</label>
                            <select name="surat_id" id="surat_id" class="block w-full mt-1 rounded border-gray-300">
                                <option value="" disabled selected>Pilih Surat</option>
                                @foreach ($surats as $letter)   
                                    <option value="{{ $letter->id }}">{{ $letter->title }}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <!-- Pilih User -->
                        <div class="mb-4">
                            <label for="nama_peminjam" class="block text-sm font-medium text-gray-700">Peminjam</label>
                            <input 
                                type="text" 
                                name="nama_peminjam" 
                                id="nama_peminjam" 
                                class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm" 
                                placeholder="Masukkan nama peminjam" 
                                value="{{ old('nama_peminjam') }}" 
                                required
                            >
                            @error('nama_peminjam')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                
                        <!-- Tanggal Peminjaman -->
                        <div class="mb-4">
                            <label for="borrow_date" class="block text-sm font-medium text-gray-700">Tanggal Peminjaman</label>
                            <input type="date" name="borrow_date" id="borrow_date" class="block w-full mt-1 rounded border-gray-300" required>
                        </div>
                
                        <!-- Tanggal Pengembalian -->
                        <div class="mb-4">
                            <label for="return_date" class="block text-sm font-medium text-gray-700">Tanggal Pengembalian</label>
                            <input type="date" name="return_date" id="return_date" class="block w-full mt-1 rounded border-gray-300" required>
                        </div>
                
                        <!-- Tombol Submit -->
                        
                            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Simpan
                            </button>
                        
                    </form>

            
                </div>
                <!-- JavaScript untuk Menampilkan Opsi Surat Jika Diperlukan -->
                <script>
                    document.getElementById('inventory_id').addEventListener('change', function () {
                        const selectedOption = this.options[this.selectedIndex];
                        const requiresLetter = selectedOption.getAttribute('data-requires-letter') === '1';

                        const suratGroup = document.getElementById('surat-group');
                        if (requiresLetter) {
                            suratGroup.classList.remove('hidden');
                        } else {
                            suratGroup.classList.add('hidden');
                            document.getElementById('surat_id').value = ''; // Clear surat if not needed
                        }
                    });
                </script>
            </main>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
@endsection