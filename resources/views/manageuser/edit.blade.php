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
    @include('partials.sidebarAdmin')

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        @include('partials.headers')

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6 text-bold">Edit User </h1>
                
                <h1>Edit User</h1>

                <form action="{{ route('manageuser.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
            
                    <label>Nama:</label>
                    <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" required>
                    @error('nama') <p style="color: red;">{{ $message }}</p> @enderror
            
                    <label>NIM:</label>
                    <input type="text" name="nim" value="{{ old('nim', $user->nim) }}" required>
                    @error('nim') <p style="color: red;">{{ $message }}</p> @enderror
            
                    {{-- <label>Username:</label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" required>
                    @error('username') <p style="color: red;">{{ $message }}</p> @enderror --}}
            
                    <label>Password (kosongkan jika tidak diubah):</label>
                    <input type="password" name="password">
                    @error('password') <p style="color: red;">{{ $message }}</p> @enderror
            
                    <label>Role:</label>
                    <select name="role" required>
                        <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Sekretaris" {{ $user->role == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                        <option value="Bendahara" {{ $user->role == 'Bendahara' ? 'selected' : '' }}>Bendahara</option>
                        <option value="Kominfo" {{ $user->role == 'Kominfo' ? 'selected' : '' }}>Kominfo</option>
                    </select>
                    @error('role') <p style="color: red;">{{ $message }}</p> @enderror
            
                    <button type="submit">Update</button>
                </form>
               

               
            </main>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
@endsection