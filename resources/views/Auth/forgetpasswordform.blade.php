<x-layouts.loginApp>
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Reset Your Password</h1>
                <p class="text-gray-600 mt-2">Create a new secure password for your account</p>
            </div>
            
            <form class="bg-white rounded-lg shadow-lg p-6 md:p-8" action="{{route('reset.password.post')}}" method="POST" id="forgotpassword">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="email">Email Address</label>
                    <div class="bg-gray-100 text-gray-600 px-4 py-3 rounded-md border border-gray-200">
                        {{$email}}
                    </div>
                    <input type="hidden" name="email" value="{{$email}}">
                    <input type="hidden" name="token" value="{{ $token }}">
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="new_password">New Password</label>
                    <div class="relative">
                        <input id="new_password" type="password" 
                               class="w-full px-4 py-3 rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" 
                               name="new_password">
                        <button type="button"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 hover:text-gray-800"
                                data-toggle="password-visibility">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Password must be at least 8 characters</p>
                </div>
                
                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-2" for="confirm_password">Confirm Password</label>
                    <div class="relative">
                        <input id="confirm_password" type="password" 
                               class="w-full px-4 py-3 rounded-md border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" 
                               name="confirm_password">
                        <button type="button"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 hover:text-gray-800"
                                data-toggle="password-visibility">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="flex items-center justify-end">
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-md transition duration-200 uppercase tracking-wider focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Reset Password
                    </button>
                </div>
            </form>
            
            <div class="text-center mt-6">
                <a href="{{route('login')}}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    Return to login
                </a>
            </div>
        </div>
</x-layouts.loginApp>