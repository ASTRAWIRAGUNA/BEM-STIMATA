<aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
    <div class="p-6">
        <a href="#" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Kominfo</a>
    </div>
    <nav class="text-white text-base font-semibold pt-3">
        <a href="{{ route('dashboardKominfo') }}" 
        class="flex items-center  text-white py-4 pl-6 nav-item
        {{ (request()->is('dashboardKominfo')) ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
        </a>
        <a href="{{ route('inventories') }}" 
        class="flex items-center  text-white py-4 pl-6 nav-item
        {{ (request()->is('inventories')) ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}">
        <i class="fa-regular fa-hard-drive mr-3"></i>
            Manage Barang
        </a>
        <a href="{{ route('peminjaman') }}" 
        class="flex items-center  text-white py-4 pl-6 nav-item
        {{ (request()->is('peminjaman')) ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}">
        <i class="fa-regular fa-folder-open mr-3"></i>
            Peminjaman
        </a>
    </nav>
   
</aside>