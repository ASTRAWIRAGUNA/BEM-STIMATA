@extends('base')

@section('head')
<link rel="icon" href="{{ asset('images/logo/favicon.png') }}" type="image/png">
<title>BEM | Login Page</title>
    <!-- Tambahkan custom CSS jika diperlukan -->
@endsection

@section('body')
<div class="flex justify-center items-center h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

        @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
       

        <form  method="POST" action="/">
            @csrf
            {{-- <div class="mb-4">
                <label for="nim" class="block text-gray-700 font-bold mb-2">NIM</label>
                <input type="text"  name="nim"  placeholder="Masukkan NIM Anda" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div> --}}
            <div class="mb-3">
                <label for="nim" class="block text-gray-700 font-bold mb-2">NIM</label>
                <input type="text" name="nim" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500  form-control @error('nim') is-invalid @enderror" id="nim" placeholder="Masukkan Nim Anda">
                @error('nim')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
              </div>
            

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan Password Anda" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500  form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                  @enderror
            </div>

            <button type="submit" 
                 id="login" name="login"class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                Login
            </button>
        </form>
    </div>
</div>
@endsection

