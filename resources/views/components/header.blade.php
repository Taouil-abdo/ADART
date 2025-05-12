<header class="bg-white shadow-sm p-4 flex justify-between items-center">
    <div class="flex items-center space-x-2  px-3 py-2 rounded-lg w-64">
        
    </div>
    
    <div class="flex items-center space-x-4">
        <a href="{{route('profile')}}">
          <div class="h-8 w-8 bg-indigo-500 rounded-full flex items-center justify-center text-white font-medium">
            {{ Auth::user()->initials ?? 'AD' }}
          </div>
        </a>
    </div>
</header>