<x-layouts.loginApp>
  <div class="w-full max-w-5xl flex rounded-2xl shadow-2xl overflow-hidden bg-white">
    
    <!-- Left Image Banner with Overlay -->
    <div class="hidden lg:block lg:w-5/12 bg-cover bg-center relative" 
         style="background-image: url('https://source.unsplash.com/Mv9hjnEUHR4/600x800');">
      <div class="absolute inset-0 bg-gradient-to-br from-blue-900/70 to-purple-900/70"></div>
      <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
        <h2 class="text-2xl font-bold mb-2">Welcome Back</h2>
        <p class="text-sm opacity-90">Access your DAR TALIBA administrative dashboard to manage resources and student information.</p>
      </div>
    </div>
    
    <!-- Login Form -->
    <div class="w-full lg:w-7/12 p-10">
      
      <!-- Header -->
      <div class="text-center mb-8">
        <div class="flex justify-center mb-4">
          <!-- Logo Placeholder (replace with your actual logo) -->
          <!-- <div class="w-16 h-16 rounded-full flex items-center justify-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-2xl font-bold">
            DT
          </div> -->
        </div>
        <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 tracking-wider">
          A-DAR-T
        </h1>
        <p class="text-sm text-gray-500 mt-2">Administrative Control Panel</p>
      </div>

      <!-- Error Message (Example) -->
      @if ($errors->any())
      <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 shadow-sm">
        <div class="flex items-center">
          <div class="flex-shrink-0 mr-3">
            <!-- Error Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
          </div>
          <div>
            <p class="font-semibold">Please fix the following errors:</p>
            <ul class="mt-2 list-disc list-inside text-sm">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      @endif

      <!-- Login Form Start -->
      <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
          <div class="relative">
            <div class="absolute left-3 top-3 text-indigo-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
              </svg>
            </div>
            <input id="email" name="email" type="email" autocomplete="email" required autofocus 
              value="{{ old('email') }}"
              class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 text-gray-900"
              placeholder="admin@dartaliba.ma">
          </div>
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
          <div class="relative">
            <div class="absolute left-3 top-3 text-indigo-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
              </svg>
            </div>
            <input id="password" name="password" type="password" autocomplete="current-password" required
              class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 text-gray-900"
              placeholder="••••••••">
            <!-- Toggle Password -->
            <button type="button" class="absolute right-3 top-3 text-indigo-500 hover:text-indigo-700 focus:outline-none" onclick="togglePasswordVisibility()">
              <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>
            </button>
          </div>
        </div>

        <!-- Remember + Forgot -->
        <div class="flex items-center justify-between">
          <label class="flex items-center text-sm text-gray-600 hover:text-gray-800 transition cursor-pointer">
          </label>
          <a href="{{ route('forgot.password') }}" class="text-sm text-indigo-600 hover:text-indigo-800 hover:underline transition">Forgot password?</a>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full relative overflow-hidden group bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 rounded-lg font-semibold hover:from-indigo-700 hover:to-purple-700 transition duration-300 shadow-md hover:shadow-lg">
          <span class="absolute top-0 left-0 w-full h-full bg-white opacity-0 group-hover:opacity-10 transition-opacity"></span>
          <div class="flex items-center justify-center">
            <span>Sign In</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </div>
        </button>
      </form>
    </div>
  </div>

<script>
  function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      eyeIcon.innerHTML = `
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
      `;
    } else {
      passwordInput.type = 'password';
      eyeIcon.innerHTML = `
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
      `;
    }
  }
</script>
</x-layouts.loginApp>