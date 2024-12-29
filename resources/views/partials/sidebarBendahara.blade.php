<aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
    <div class="p-6">
        <a href="#" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Bendahara</a>
    </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="{{ route('dashboardBendahara') }}" 
            class="flex items-center  text-white py-4 pl-6 nav-item
            {{ (request()->is('dashboardBendahara')) ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
        </a>
        <a href="{{ route('bendahara') }}" 
        class="flex items-center  text-white py-4 pl-6 nav-item
        {{ (request()->is('bendahara')) ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}">
            <i class="fas fa-table mr-3"></i>
            Manage Kopma
        </a>
        <a href="forms.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
            <i class="fas fa-align-left mr-3"></i>
            Keuangan
        </a>
        <a href="{{ route('logKopma') }}" 
        class="flex items-center  text-white py-4 pl-6 nav-item
        {{ (request()->is('logKopma')) ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}">
            <i class="fas fa-sticky-note mr-3"></i>
            LOG Kopma
        </a>
        <a href="{{ route('penjualan') }}" 
        class="flex items-center  text-white py-4 pl-6 nav-item
        {{ (request()->is('penjualan')) ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}">
            <i class="fas fa-sticky-note mr-3"></i>
            POS Kopma
        </a>
    </nav>
   
</aside>