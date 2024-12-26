@extends('base')
@section('head')
<title>BEM | Admin Page</title>
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
    @include('partials.sidebarAdmin')

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        @include('partials.headers')

        {{-- <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6 text-bold">Tambah User </h1>
                

                <div class="w-full mt-6">
                    <form action="{{ route('manageuser.store') }}" method="POST">
                        @csrf
                        <label>Nama:</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required>
                        @error('nama') <p style="color: red;">{{ $message }}</p> @enderror
                
                        <label>NIM:</label>
                        <input type="text" name="nim" value="{{ old('nim') }}" required>
                        @error('nim') <p style="color: red;">{{ $message }}</p> @enderror
                
                        <label>Password:</label>
                        <input type="password" name="password" required>
                        @error('password') <p style="color: red;">{{ $message }}</p> @enderror
                
                        <label>Role:</label>
                        <select name="role" required>
                            <option value="Admin">Admin</option>
                            <option value="Sekretaris">Sekretaris</option>
                            <option value="Bendahara">Bendahara</option>
                            <option value="Kominfo">Kominfo</option>
                        </select>
                        @error('role') <p style="color: red;">{{ $message }}</p> @enderror
                
                        <button type="submit">Simpan</button>
                    </form>

            
                </div>
            </main>
        </div> --}}
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl font-bold text-gray-800 pb-6">Tambah User</h1>
        
                <div class="w-full mt-6 bg-white rounded-lg shadow-md p-6">
                    <form action="{{ route('manageuser.store') }}" method="POST" class="space-y-4">
                        @csrf
        
                        <!-- Nama -->
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('nama') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
        
                        <!-- NIM -->
                        <div>
                            <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                            <input type="text" id="nim" name="nim" value="{{ old('nim') }}" required
                                maxlength="8"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                oninput="formatNIM(this)">
                            @error('nim') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" id="password" name="password" required
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('password') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
        
                        <!-- Role -->
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                            <select id="role" name="role" required
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="Admin">Admin</option>
                                <option value="Sekretaris">Sekretaris</option>
                                <option value="Bendahara">Bendahara</option>
                                <option value="Kominfo">Kominfo</option>
                            </select>
                            @error('role') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
        
                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                class="w-full bg-blue-600 text-white font-medium py-2 px-4 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
        <script>
            function formatNIM(input) {
                // Hapus karakter selain angka
                let value = input.value.replace(/\D/g, '');
                 // Batasi panjang maksimal 8 karakter
                if (value.length > 8) {
                    value = value.substring(0, 8);
                }
                // Format menjadi 22.31.0003
                value = value.replace(/^(\d{2})(\d{2})(\d{4})$/, '$1.$2.$3');
                // Perbarui nilai input
                input.value = value;
            }
        </script>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>

@endsection