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
                <h1 class="text-3xl text-black pb-6 text-bold">Detail User </h1>
                <div class="row">
                    <div class="col mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control border p-2 rounded-md w-full" placeholder="Nama" value="{{ $user->nama }}" readonly>
                    </div>
                    <div class="col mb-3">
                        <label class="form-label">NIM</label>
                        <input type="text" name="nim" class="form-control border p-2 rounded-md w-full" placeholder="NIM" value="{{ $user->nim }}" readonly>
                    </div>
                    <div class="col mb-3">
                        <label class="form-label">Role</label>
                        <input type="text" name="role" class="form-control border p-2 rounded-md w-full" placeholder="Role" value="{{ $user->role}}" readonly>
                    </div>
                    <div class="col mb-3">
                        <label class="form-label">Created At</label>
                        <input type="text" name="created_at" class="form-control border p-2 rounded-md w-full"placeholder="Created At" value="{{ $user->created_at }}" readonly>
                    </div>
                    <div class="col mb-3">
                        <label class="form-label">Updated At</label>
                        <input type="text" name="updated_at" class="form-control border p-2 rounded-md w-full" placeholder="Updated At" value="{{ $user->updated_at }}" readonly>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
@endsection