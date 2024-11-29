@extends('base')
@section('head')
<title>BEM | Admin Page</title>
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.min.css" />
<link href='http://wallpaperback.blogspot.com/favicon.ico' rel='shortcut icon'>
 
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
                <h1 class="text-3xl text-black pb-6 text-bold">Master Admin</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                  
                  <!-- Card Total Users -->
                  <div class="bg-white shadow rounded-lg p-6">
                    
                    <!-- Ikon -->
                 
                    
                  <div class="flex items-center justify-between">
                          <h3 class="text-lg font-semibold text-gray-700">Total Users</h3>
                          <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                            
                            
                          </div>  
                      </div>
                      <div class="text-3xl font-bold text-blue-500">{{$totaluser ?? '0'}}</div>
                  </div>
              
                  <!-- Card Total Surat -->
                  <div class="bg-white shadow rounded-lg p-6">
                      <div class="flex items-center justify-between">
                          <h3 class="text-lg font-semibold text-gray-700">Total Surat</h3>
                          <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4.002 4.002 0 017.504 15h8.992a4.002 4.002 0 012.383 2.804M15 11a4 4 0 10-8 0m-6 8a4 4 0 014-4h12a4 4 0 014 4" />
                            </svg>
                          </div>  
                          
                      </div>
                      <div class="text-3xl font-bold text-green-500">{{$surat ?? '0'}}</div>
                  </div>
              
                  <!-- Card Total Peminjaman -->
                  <div class="bg-white shadow rounded-lg p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-700">Total Peminjaman</h3>
                        <div class="text-3xl font-bold text-green-500">{{$peminjaman ?? '0'}}</div>
                    </div>
                </div>
                  <!-- Card Total Peminjaman -->
                  <div class="bg-white shadow rounded-lg p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-700">Total Barang</h3>
                        <div class="text-3xl font-bold text-green-500">{{$inventory ?? '0'}}</div>
                    </div>
                </div>
              </div>
                    
                {{-- <div class="flex flex-wrap justify-center">
                <div class="card">
                    <i class="icon"></i>
                    <div class="value">53,000</div>
                    <div class="percentage">+55% since yesterday</div>
                    <p>TODAY'S MONEY</p>
                  </div>
                  <div class="card">
                    <i class="icon"></i>
                    <div class="value">2,300</div>
                    <div class="percentage">+3% since last week</div>
                    <p>TODAY'S USERS</p>
                  </div>
                  <div class="card">
                    <i class="icon"></i>
                    <div class="value">+3,462</div>
                    <div class="percentage">-2% since last quarter</div>
                    <p>NEW CLIENTS</p>
                  </div>
                </div> --}}

                {{-- <div class="w-full mt-6">
                    <div class="flex justify-between mb-5">
                        <p class="text-xl pb-3 flex items-center">
                            <i class="ri-list-check mr-2"></i> List Role
                        </p>
                        <button data-modal-toggle="add-penghargaan-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 items-center py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            <i class="ri-add-line mr-3 text-lg"></i> Add
                        </button>
                    </div>

                    <div class="bg-white overflow-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm text-center">No</th>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm text-center">NIM</th>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Nama</th>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                               
                                <tr>
                                    <td class="text-center py-3 px-4">{{ $totalSurat }}</td>
                                    <td class="text-center py-3 px-4">{{ $totalBarang }}</td>
                                    <td class="text-center py-3 px-4"></td>
                                    <td class="text-center py-3 px-4"></td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                </div> --}}
            </main>
        </div>
        
        
       
          
    </div>
</div>

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
@endsection