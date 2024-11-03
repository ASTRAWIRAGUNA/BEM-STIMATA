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
                <h1 class="text-3xl text-black pb-6 text-bold">Master </h1>

                <div class="w-full mt-6">
                    

                    <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" name="nama" class="form-control" placeholder="Nama">
                            </div>
                            <div class="col">
                                <input type="text" name="nim" class="form-control" placeholder="NIM" value="{{ old('nim') }}">
                                @if ($errors->has('nim'))
                                    <span class="text-danger">{{ $errors->first('nim') }}</span>
                                @endif
                            </div>
                            <div class="col">
                                <select name="role_type" class="form-control">
                                    <option value="user" {{ old('role_type') == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ old('role_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="sekretaris" {{ old('role_type') == 'sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            
                        </div>
                 
                        <div class="row">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
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