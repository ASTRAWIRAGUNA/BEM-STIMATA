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
    @include('partials.sidebarSekertaris')

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        @include('partials.headers')

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6 text-bold">Tambah Surat Baru </h1>

                <div class="w-full mt-6">
                    

                    {{-- <h1>Tambah Surat Baru</h1> --}}

                    <form action="{{ route('arsipSurat.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                
                        <!-- Judul Surat -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Judul Surat</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Masukkan judul surat" required>
                        </div>
                
                        <!-- Pengirim Surat -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <input type="text" name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Masukkan Deskripsi Surat" required>
                        </div>
                
                        <!-- Tanggal Surat -->
                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700">Tanggal Surat</label>
                            <input type="date" name="date" id="date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                
                        <!-- Upload File Surat -->
                        <div>
                            <label for="file" class="block text-sm font-medium text-gray-700">Upload File Surat</label>
                            <input type="file" name="file" id="file" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" accept=".pdf,.doc,.docx" required>
                        </div>
                
                        <!-- Tombol Simpan -->
                        <div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600">
                                Simpan Surat
                            </button>
                        </div>
                    </form>

            
                </div>
            </main>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
@endsection