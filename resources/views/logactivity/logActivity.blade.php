@extends('base')
@section('head')
<link rel="icon" href="{{ asset('images/logo/favicon.png') }}" type="image/png">
<title>BEM | Admin Page</title>
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.min.css"/>
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
        <div class="w-full border-t flex flex-col">
            <main class="w-full flex-grow ">
                <!-- Sticky Section for Title and List User -->
                <div class=" bg-white p-6 shadow-md">
                    <h1 class="text-3xl text-black pb-3 font-bold">LOG</h1>
                    <div class="flex justify-between mb-5">
                        <p class="text-xl pb-3 flex items-center">
                            <i class="ri-list-check mr-2"></i> Log Activity
                        </p>
                    </div>
                </div>
            </main>
        </div>
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow ">
        
                <!-- Table Section -->
                <div class="overflow-y-auto max-h-[calc(100vh-250px)]">
                    <table class="min-w-full bg-white">
                        <!-- Sticky Table Header -->
                        <thead class="sticky bg-gray-800 text-white top-0 ">
                            <tr>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">No</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Log Name</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Activity</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Timestamps</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                                <tr>
                                    <td class="text-center py-3 px-4">{{ $loop->iteration }}</td>
                                    <td class="text-center py-3 px-4">{{ $log->log_name }}</td>
                                    <td class="text-center py-3 px-4">{{ $log->description }}</td>
                                    <td class="text-center py-3 px-4">{{ $log->created_at }}</td>
                                </tr>
                                @endforeach

                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
@endsection