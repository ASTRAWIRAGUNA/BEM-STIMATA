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
                            <div class="flex items-center">
                                <input 
                                    type="text" 
                                    name="nama" 
                                    id="nama" 
                                    class="form-control border p-2 rounded-md w-full" 
                                    placeholder="Nama" 
                                    value="{{ old('nama', $user->nama) }}" 
                                    readonly
                                >
                                <!-- Icon edit -->
                                <button 
                                    type="button" 
                                    id="editNamaBtn" 
                                    class="ml-2 text-blue-500 hover:text-blue-700"
                                >
                                    <i class="fas fa-edit"></i>
                                </button>
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
                                class="form-control" 
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
                                class="form-control" 
                                placeholder="Role" 
                                value="{{ old('role', $user->role) }}" 
                                readonly
                            >
                        </div>
                    </div>
                    <!-- Tombol simpan perubahan -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary" id="saveBtn" style="display: none;">
                            Save
                        </button>
                    </div>
                </form>
            </main>
        </div>
        
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        
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
                    editNamaBtn.innerHTML = '<i class="fas fa-save"></i>'; // Ubah ikon menjadi save
                    saveBtn.style.display = 'inline-block'; // Tampilkan tombol simpan
                } else {
                    // Simpan perubahan ketika tombol save diklik
                    saveBtn.style.display = 'none'; // Sembunyikan tombol simpan
                    editNamaBtn.innerHTML = '<i class="fas fa-edit"></i>'; // Kembalikan ikon ke edit
                }
            });
        </script>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
@endsection