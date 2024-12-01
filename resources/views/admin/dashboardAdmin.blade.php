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
                <h1 class="text-3xl text-black pb-6 text-bold">Dashboard</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                  
                  <!-- Card Total Users -->
                  <div class="bg-white shadow rounded-lg p-6">
                  <div class="flex items-center justify-between">
                          <h3 class="text-lg font-semibold text-gray-700">Total Users</h3>
                          <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg> 
                          </div>  
                      </div>
                      <div class="text-3xl font-bold text-blue-500">{{$totaluser ?? '0'}}</div>
                       <!-- More Info Button -->
                        {{-- <div class="mt-4">
                            <a href="{{ route('manageuser') }}" class="text-sm font-medium text-blue-500 hover:underline flex items-center">
                                More Info
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12l-7.5 7.5M3 12h18" />
                                </svg>
                            </a>
                        </div> --}}
                  </div>
              
                  <!-- Card Total Surat -->
                  <div class="bg-white shadow rounded-lg p-6">
                      <div class="flex items-center justify-between">
                          <h3 class="text-lg font-semibold text-gray-700">Total Surat</h3>
                          <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                              </svg>                              
                          </div>  
                          
                      </div>
                      <div class="text-3xl font-bold text-green-500">{{$surat ?? '0'}}</div>
                  </div>
              
                  <!-- Card Total Peminjaman -->
                  <div class="bg-white shadow rounded-lg p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-700">Total Peminjaman</h3>
                        <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M7.491 5.992a.75.75 0 0 1 .75-.75h12a.75.75 0 1 1 0 1.5h-12a.75.75 0 0 1-.75-.75ZM7.49 11.995a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75ZM7.491 17.994a.75.75 0 0 1 .75-.75h12a.75.75 0 1 1 0 1.5h-12a.75.75 0 0 1-.75-.75ZM2.24 3.745a.75.75 0 0 1 .75-.75h1.125a.75.75 0 0 1 .75.75v3h.375a.75.75 0 0 1 0 1.5H2.99a.75.75 0 0 1 0-1.5h.375v-2.25H2.99a.75.75 0 0 1-.75-.75ZM2.79 10.602a.75.75 0 0 1 0-1.06 1.875 1.875 0 1 1 2.652 2.651l-.55.55h.35a.75.75 0 0 1 0 1.5h-2.16a.75.75 0 0 1-.53-1.281l1.83-1.83a.375.375 0 0 0-.53-.53.75.75 0 0 1-1.062 0ZM2.24 15.745a.75.75 0 0 1 .75-.75h1.125a1.875 1.875 0 0 1 1.501 2.999 1.875 1.875 0 0 1-1.501 3H2.99a.75.75 0 0 1 0-1.501h1.125a.375.375 0 0 0 .036-.748H3.74a.75.75 0 0 1-.75-.75v-.002a.75.75 0 0 1 .75-.75h.411a.375.375 0 0 0-.036-.748H2.99a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                              </svg>
                              
                          </div>
                        
                    </div>
                    <div class="text-3xl font-bold text-green-500">{{$peminjaman ?? '0'}}</div>
                </div>
                  <!-- Card Total Barang -->
                  <div class="bg-white shadow rounded-lg p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-700">Total Barang</h3>
                        <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path d="M12 9a3.75 3.75 0 1 0 0 7.5A3.75 3.75 0 0 0 12 9Z" />
                                <path fill-rule="evenodd" d="M9.344 3.071a49.52 49.52 0 0 1 5.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 0 1-3 3h-15a3 3 0 0 1-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 0 0 1.11-.71l.822-1.315a2.942 2.942 0 0 1 2.332-1.39ZM6.75 12.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Zm12-1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                              </svg>
                              
                        </div>
                    </div>
                    <div class="text-3xl font-bold text-green-500">{{$inventory ?? '0'}}</div>
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