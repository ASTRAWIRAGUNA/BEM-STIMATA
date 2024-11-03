@extends('base')

@section('head')
    <!-- Tambahkan custom CSS jika diperlukan -->
@endsection

@section('body')
<div class="flex justify-center items-center h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold text-center mb-6">Login</h2>
        <form action="/login" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nim" class="block text-gray-700 font-bold mb-2">NIM</label>
                <input type="text" id="nim" name="nim" placeholder="Masukkan NIM Anda" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Nama</label>
                <input type="text" id="name" name="name" placeholder="Masukkan Nama Anda" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div> --}}

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan Password Anda" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit" 
                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                Login
            </button>
        </form>
    </div>
</div>
@endsection
