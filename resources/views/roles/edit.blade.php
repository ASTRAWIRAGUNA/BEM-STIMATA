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
                
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ $role->nama }}" >
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">NIM</label>
                            <input type="text" name="nim" class="form-control" placeholder="NIM" value="{{ $role->nim }}" >
                            @if ($errors->has('nim'))
                                    <span class="text-danger">{{ $errors->first('nim') }}</span>
                                @endif
                        </div>
                        <div class="col">
                            <label class="form-label">Role</label>
                            <select name="role_type" class="form-control">
                                <option value="user" {{ $role->role_type == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $role->role_type == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="sekretaris" {{ $role->role_type == 'sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="d-grid">
                            <button class="btn btn-warning">Update</button>
                        </div>
                    </div>
                </form>
               

               
            </main>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
@endsection