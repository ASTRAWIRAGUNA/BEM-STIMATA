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

        <div class="w-full border-t flex flex-col">
            <main class="w-full flex-grow ">
                @if (session('success'))
                    <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="document.getElementById('success-alert').remove();">
                            <span class="text-green-500">&times;</span>
                        </button>
                    </div>
                @endif

                <!-- Sticky Section for Title and List User -->
                <div class=" bg-white p-6 shadow-md">
                    <h1 class="text-3xl text-black pb-3 font-bold">Inventory Kominfo</h1>
                    <div class="flex justify-between mb-5">
                        <p class="text-xl pb-3 flex items-center">
                            <i class="ri-list-check mr-2"></i> List Barang
                        </p>
                        <a href="{{ route('inventories.create') }}" 
                           class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <i class="ri-add-line mr-3 text-lg"></i> Add Barang
                        </a>
                    </div>
                </div>
            </main>
        </div>

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow ">
        
                <!-- Table Section -->
                <div class="overflow-y-auto max-h-[calc(100vh-250px)]">
                    <table class="min-w-full bg-white">
                        <!-- Sticky Table Header -->
                        <thead class="sticky bg-gray-800 text-white top-0 ">
                            <tr>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">No</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Nama Barang</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Kategori</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Status</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Surat Barang</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($inventories as $barang)
                            <tr>
                                <td class="text-center py-3 px-4">{{ $loop->iteration }}</td>
                                <td class="text-center py-3 px-4">{{ $barang->item_name }}</td>
                                <td class="text-center py-3 px-4">{{ $barang->category }}</td>
                                <td class="text-center py-3 px-4">{{ $barang->availability_status }}</td>
                                <td class="text-center py-3 px-4">{{ $barang->requires_letter ? 'Ya' : 'Tidak' }}</td>
                                <td class="text-center py-3 px-4">
                            
                                    <a href="{{ route('inventories.edit', $barang->id) }}" class="text-green-500 hover:text-green-700 mx-1" title="Edit">
                                        <i class="fas fa-edit"></i></a>
                                    <form action="{{ route('inventories.destroy', $barang->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Hapus user ini?')" class="text-red-500 hover:text-red-700 mx-1" title="Hapus">
                                            <i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada barang.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
        <script>
            // Notifikasi otomatis hilang setelah 3 detik
            setTimeout(() => {
                const alert = document.getElementById('success-alert');
                if (alert) {
                    alert.classList.add('opacity-0'); // Tambahkan kelas untuk transparansi
                    setTimeout(() => alert.remove(), 500); // Hapus elemen setelah transisi selesai
                }
            }, 3000); // Durasi notifikasi 3 detik
            
        </script>
        {{-- <div class="sticky w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow ">
                <div class="sticky w-full h-screen  bg-white">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">No</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Nama Barang</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Kategori</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Status</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Surat Barang</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($inventories as $barang)
                                <tr>
                                    <td class="text-center py-3 px-4">{{ $loop->iteration }}</td>
                                    <td class="text-center py-3 px-4">{{ $barang->item_name }}</td>
                                    <td class="text-center py-3 px-4">{{ $barang->category }}</td>
                                    <td class="text-center py-3 px-4">{{ $barang->availability_status }}</td>
                                    <td class="text-center py-3 px-4">{{ $barang->requires_letter ? 'Ya' : 'Tidak' }}</td>
                                    <td class="text-center py-3 px-4">
                                
                                        <a href="{{ route('inventories.edit', $barang->id) }}" class="text-green-500 hover:text-green-700 mx-1" title="Edit">
                                            <i class="fas fa-edit"></i></a>
                                        <form action="{{ route('inventories.destroy', $barang->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Hapus user ini?')" class="text-red-500 hover:text-red-700 mx-1" title="Hapus">
                                                <i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada barang.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </main>
        </div> --}}

        
    </div>
</div>

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
@endsection