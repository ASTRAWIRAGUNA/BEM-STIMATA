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
    @if(auth()->user()->role == 'Admin')
    @include('partials.sidebarAdmin') <!-- Sidebar untuk Admin -->
@elseif(auth()->user()->role == 'Sekretaris')
    @include('partials.sidebarSekertaris') <!-- Sidebar untuk Sekretaris -->
@elseif(auth()->user()->role == 'Bendahara')
    @include('partials.sidebarBendahara') <!-- Sidebar untuk Bendahara -->
@elseif(auth()->user()->role == 'Kominfo')
    @include('partials.sidebarKominfo') <!-- Sidebar untuk Kominfo -->
@endif

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        @include('partials.headers')

        {{-- <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6 text-bold">Detail User </h1>
                <div class="row">
                    <div class="col mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ $user->nama }}" readonly>
                    </div>
                    <div class="col mb-3">
                        <label class="form-label">NIM</label>
                        <input type="text" name="nim" class="form-control" placeholder="NIM" value="{{ $user->nim }}" readonly>
                    </div>
                    <div class="col mb-3">
                        <label class="form-label">Role</label>
                        <input type="text" name="role" class="form-control" placeholder="Role" value="{{ $user->role}}" readonly>
                    </div>
                    
                </div>
            </main>
        </div> --}}
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6 text-bold">Detail User</h1>
                <form action="{{ route('account.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Nama</label>
                            <!-- Container untuk input dan ikon edit -->
                            <div class="relative">
                                <input 
                                    type="text" 
                                    name="nama" 
                                    id="nama" 
                                    class="form-control border p-2 rounded-md w-full pr-10" 
                                    placeholder="Nama" 
                                    value="{{ old('nama', $user->nama) }}" 
                                    readonly
                                >
                                <!-- Ikon Edit di dalam input -->
                                <span 
                                    id="editNamaBtn" 
                                    class="absolute inset-y-0 right-3 flex items-center text-blue-500 cursor-pointer"
                                >
                                    <!-- Ikon Edit -->
                                    <i class="fas fa-edit" id="editIcon"></i>
                                </span>
                            </div>
                            
                            @error('nama')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">NIM</label>
                            <input 
                                type="text" 
                                name="nim" 
                                class="form-control border p-2 rounded-md w-full"
                                placeholder="NIM" 
                                value="{{ old('nim', $user->nim) }}" 
                                readonly
                            >
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Role</label>
                            <input 
                                type="text" 
                                name="role" 
                                class="form-control border p-2 rounded-md w-full" 
                                placeholder="Role" 
                                value="{{ old('role', $user->role) }}" 
                                readonly
                            >
                        </div>
                    </div>
                    <!-- Tombol simpan perubahan -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3  mt-4 items-center py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" id="saveBtn" style="display: none;">
                            Save
                        </button>
                    </div>
                    <script>
                        const namaInput = document.getElementById('nama');
                        const editNamaBtn = document.getElementById('editNamaBtn');
                        const saveBtn = document.getElementById('saveBtn');
                    
                        // Event listener untuk tombol edit
                        editNamaBtn.addEventListener('click', function() {
                            // Jika input dalam keadaan readonly, maka ubah jadi bisa diedit
                            if (namaInput.readOnly) {
                                namaInput.readOnly = false;
                                namaInput.focus(); // Fokuskan input setelah diubah
                                editNamaBtn.innerHTML = ''; // Ubah ikon menjadi save
                                saveBtn.style.display = 'inline-block'; // Tampilkan tombol simpan
                            } else {
                                // Simpan perubahan ketika tombol save diklik
                                saveBtn.style.display = 'none'; // Sembunyikan tombol simpan
                                editNamaBtn.innerHTML = '<i class="fas fa-edit"></i>'; // Kembalikan ikon ke edit
                            }
                        });
                    </script>
                </form>
            </main>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
@endsection