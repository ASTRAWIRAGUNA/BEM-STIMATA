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
    @include('partials.sidebarAdmin')

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        @include('partials.headers')

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6 text-bold">Edit User </h1>
                <div class="w-full mt-6 bg-white rounded-lg shadow-md p-6">
                    <form action="{{ route('admin.manageuser.update', $user->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
    
                        <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        @error('nama') <p style="color: red;">{{ $message }}</p> @enderror
                        </div>
    
                        <div>
                        <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                        <input type="text" name="nim" value="{{ old('nim', $user->nim) }}" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        @error('nim') <p style="color: red;">{{ $message }}</p> @enderror
                        </div>
    
                        <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password (kosongkan jika tidak diubah)</label>
                        <input type="password" name="password" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        @error('password') <p style="color: red;">{{ $message }}</p> @enderror
                        </div>
                        
                        <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                        <select name="role" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Sekretaris" {{ $user->role == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                            <option value="Bendahara" {{ $user->role == 'Bendahara' ? 'selected' : '' }}>Bendahara</option>
                            <option value="Kominfo" {{ $user->role == 'Kominfo' ? 'selected' : '' }}>Kominfo</option>
                        </select>
                        @error('role') <p style="color: red;">{{ $message }}</p> @enderror
                        </div>
                        
                        <div>
                        <button type="submit" class="w-full bg-blue-600 text-white font-medium py-2 px-4 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Update
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