<div :class="sidebarOpen ? 'w-64' : 'w-20'" class="bg-indigo-800 text-white transition-all duration-300">
    <div class="p-4 flex items-center justify-between">
        <h1 x-show="sidebarOpen" class="text-xl font-bold">DART TALIB</h1>
        <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-lg hover:bg-indigo-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
    
    <nav class="mt-6">
        <x-nav-link route="dashboard" icon="dashboard">
            Dashboard
        </x-nav-link>
        
        <x-nav-link route="rooms" icon="chart">
            Rooms
        </x-nav-link>
        
        <x-nav-link route="supplier" icon="report">
            Supplier
        </x-nav-link>
        
        <x-nav-link route="residents" icon="calendar">
            Residents
        </x-nav-link>
        
        <x-nav-link route="stock" icon="settings">
            Stock
        </x-nav-link>

        <x-nav-link route="category" icon="settings">
            Category
        </x-nav-link>

        <x-nav-link route="login" icon="settings">
            Login
        </x-nav-link>
    </nav>
</div>