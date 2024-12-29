<aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
    <div class="p-6">
        <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Sekretaris</a>
    </div>
    <nav class="text-white text-base font-semibold pt-3">
        <a href="{{ route('dashboardSekretaris') }}" 
        class="flex items-center  text-white py-4 pl-6 nav-item
        {{ (request()->is('dashboardSekretaris')) ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
        </a>
        <a href="{{ route('arsipSurat') }}" 
        class="flex items-center  text-white py-4 pl-6 nav-item
        {{ (request()->is('arsipSurat')) ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}">
            <i class="fas fa-sticky-note mr-3"></i>
            Arsip Surat
        </a>
        <a href="blank.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-sticky-note mr-3"></i>
            POS Kopma
        </a>
        
    </nav>
   
</aside>