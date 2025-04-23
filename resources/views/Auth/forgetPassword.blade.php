<x-layouts.loginApp>
    
<div class="flex justify-center items-center min-h-screen bg-gray-100 p-4">
    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Reset Your Password</h2>
        <p class="text-gray-600 text-center mb-6">Enter your email address and we'll send you a link to reset your password.</p>
        
        <form method="POST" action="{{ route('forget.password.post') }}">
            @csrf
            
            <div class="mb-6">
                <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                <input id="email" type="email" 
                       class="w-full px-4 py-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror" 
                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                
                @error('email')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>
            
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-md transition duration-200 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <span>Send Reset Link</span>
            </button>
        </form>
    </div>
</div>

</x-layouts-loginApp>