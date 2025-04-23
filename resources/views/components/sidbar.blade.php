<div :class="sidebarOpen ? 'w-64' : 'w-20'" class="bg-gradient-to-br from-indigo-800 to-indigo-900 text-white transition-all duration-300 shadow-xl h-screen flex flex-col">
    <!-- Header with Logo -->
    <div class="p-4 flex items-center justify-between border-b border-indigo-700/50">
        <div class="flex items-center space-x-3">
            <!-- Logo icon that's always visible -->
            <div class="flex-shrink-0 bg-white rounded-full p-1.5 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-800" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
                </svg>
            </div>
            <!-- Text logo only visible when expanded -->
            <h1 x-show="sidebarOpen" class="text-xl font-bold tracking-wider text-white">ADART</h1>
        </div>
        <!-- Toggle Button -->
        <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-full bg-indigo-700/30 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 transition-all duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
    
    <!-- Navigation Links -->
    <nav class="mt-6 flex-1 overflow-y-auto px-3">
    <div class="space-y-1">
        <x-nav-link route="dashboard" icon="dashboard">
            Dashboard
        </x-nav-link>
        
        <x-nav-link route="rooms.index" icon="chart">
            Rooms
        </x-nav-link>
        
        <x-nav-link route="supplier.index" icon="report">
            Supplier
        </x-nav-link>
        
        <x-nav-link route="residents" icon="calendar">
            Residents
        </x-nav-link>
        
        <x-nav-link route="stock.index" icon="stock">
            Stock
        </x-nav-link>
        
        <x-nav-link route="category.index" icon="category">
            Category
        </x-nav-link>
    </div>
</nav>
    
    <!-- Footer with Login Link -->
    <div class="mt-auto border-t border-indigo-700/50 p-3">
        <x-nav-link route="logout" icon="login">
            LogOut
        </x-nav-link>
    </div>
</div>