<aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
    <div class="p-6">
        <a href="#" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
    </div>
    <nav class="text-white text-base font-semibold pt-3">
        <a href="{{ route('admin.dashboardAdmin') }}" 
        class="flex items-center  text-white py-4 pl-6 nav-item
        {{ (request()->routeIs('admin.dashboardAdmin')) ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
        </a>
        <a href="{{ route('admin.manageuser.index') }}" 
        class="flex items-center text-white py-4 pl-6 nav-item
        {{ (request()->routeIs('admin.manageuser.index')) ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}">
            <i class="fas fa-sticky-note mr-3"></i>
            Manage User
        </a>
        <a href="{{ route('admin.logactivity') }}" 
        class="flex items-center text-white py-4 pl-6 nav-item
        {{ (request()->routeIs('admin.logactivity')) ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}">
            <i class="fas fa-table mr-3"></i>
            Log Activity
        </a>
    </nav>
   
</aside>