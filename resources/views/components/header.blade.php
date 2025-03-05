<header class="bg-white shadow-sm p-4 flex justify-between items-center">
    <div class="flex items-center space-x-2 bg-gray-100 px-3 py-2 rounded-lg w-64">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
        </svg>
        <input type="text" placeholder="Search..." class="bg-transparent border-none outline-none w-full">
    </div>
    
    <div class="flex items-center space-x-4">
        <button class="p-2 rounded-full hover:bg-gray-100 relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
            </svg>
            <div class="absolute top-0 right-0 h-2 w-2 bg-red-500 rounded-full"></div>
        </button>
        <div class="h-8 w-8 bg-indigo-500 rounded-full flex items-center justify-center text-white font-medium">
            {{ Auth::user()->initials ?? 'DT' }}
        </div>
    </div>
</header>