@extends('base')
@section('head')
<title>BEM | Admin Page</title>
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.min.css" />
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
                <div class="sticky top-0 z-10 bg-white shadow-md p-6">
                <h1 class="text-3xl text-black pb-6 text-bold">Master </h1>
                <div class="w-full mt-6">
                    <div class="flex justify-between mb-5">
                        <p class="text-xl pb-3 flex items-center">
                            <i class="ri-list-check mr-2"></i> List User
                        </p>
                        <a href="{{ route('manageuser.create') }}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 items-center py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 " type="button" >
                            <i class="ri-add-line mr-3 text-lg"></i> Add User
                        </a>
                    </div>
                    @if (session('success'))
                        <p style="color: green;">{{ session('success') }}</p>
                        @endif

                    <div class="bg-white overflow-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm text-center">No</th>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Nama</th>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Nim</th>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Role</th>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Action</th>
                                </tr>
                            
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center py-3 px-4">{{ $loop->iteration }}</td>
                                            <td class="text-center py-3 px-4">{{ $user->nama }}</td>
                                            <td class="text-center py-3 px-4">{{ $user->nim }}</td>
                                            <td class="text-center py-3 px-4">{{ $user->role }}</td>
                                            <td class="text-center py-3 px-4">
                                                
                                                <!-- Detail Icon -->
                                                <a href="{{ route('manageuser.show', $user->id) }}" class="text-blue-500 hover:text-blue-700 mx-1" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                 <!-- Edit Icon -->
                                                <a href="{{ route('manageuser.edit', $user->id) }}" class="text-green-500 hover:text-green-700 mx-1" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                                 <!-- Delete Icon -->
                                                <form action="{{ route('manageuser.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Hapus user ini?')" class="text-red-500 hover:text-red-700 mx-1" title="Hapus">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
@endsection