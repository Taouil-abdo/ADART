<x-layouts.app>
    <x-slot:title>Dashboard - DART TALIB</x-slot:title>

    <div class="flex flex-col gap-4 mb-6">
        <nav class="text-xl text-gray-600">
            <a href="{{ route('dashboard') }}" class="text-blue-500">Dashboard</a>
            <span class="mx-2">/</span>
            <a href="{{ route('supplier.index')}}" class="text-gray-800 font-semibold">Supplier</a>
            <span class="mx-2">/</span>
            <span class="mx-2 bg-gray-800">Update Supplier</span>
        </nav>
    </div>
<!-- Add Supplier Modal -->
       <div
            class="relative mx-auto p-0 border-0 w-full max-w-md shadow-2xl rounded-lg bg-white transform transition-all duration-300 overflow-hidden">
            <!-- Modal Header with gradient background -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-5 flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-bold text-white">Add New Supplier</h3>
                    <p class="text-blue-100 text-sm mt-1 opacity-90">Complete the form below with supplier details</p>
                </div>
            </div>

            <!-- Form Content with better padding and organization -->
            <div class="p-6">
                <form id="SupplierForm" action="" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div class="flex items-center space-x-2 pb-2 border-b border-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                <path
                                    d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                            </svg>
                            <h4 class="text-base font-medium text-gray-800">Supplier Information</h4>
                        </div>

                        <!-- Supplier Name -->
                        <div class="space-y-1">
                            <label for="supplier-name" class="block text-sm font-medium text-gray-700">
                                Supplier Name <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="supplier-name" name="name" value="{{$supplier->name}}" placeholder="e.g. ABC Supplies Ltd"
                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    required>
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="space-y-1">
                            <label for="phone-number" class="block text-sm font-medium text-gray-700">
                                Phone Number
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                    </svg>
                                </div>
                                <input type="tel" id="phone-number" name="phoneNumber" value="{{$supplier->phoneNumber}}" placeholder="e.g. +1 (555) 123-4567"
                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="space-y-1">
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Email
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                </div>
                                <input type="email" id="email" name="email" value="{{$supplier->email}}" placeholder="e.g. contact@example.com"
                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="space-y-1">
                            <label for="address" class="block text-sm font-medium text-gray-700">
                                Address
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="address" name="address" value="{{$supplier->address}}" placeholder="e.g. 123 Business St, City"
                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>
                        </div>                        

                        <!-- Supplied Product -->
                        <div class="space-y-1">
                            <label for="supplied-product" class="block text-sm font-medium text-gray-700">
                                Supplied Product
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="supplied-product" name="suppliedProduct" value="{{$supplier->suppliedProduct}}" placeholder="e.g. bread, rice, etc"
                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>
                        </div>

                        <!-- Supplier Status -->
                        <div class="space-y-1">
                            <label for="supplier-status" class="block text-sm font-medium text-gray-700">
                                Supplier Status
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <select id="supplier-status" name="isActive" 
                                    class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg appearance-none bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    <option value="" disabled selected>select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Not Active</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons with improved styling -->
                    <div class="flex justify-end space-x-3 mt-8 pt-5 border-t border-gray-200">
                        <button type="button"
                            class="px-5 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-all duration-200 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-lg hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 flex items-center shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Save Supplier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    

<x-slot:scripts>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        
        //    update function
        document.getElementById('SupplierForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);
            console.log(formData);
            const url = "{{ route('supplier.update',$supplier->id) }}";

            axios.post(url, formData, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    }
                })
                .then(function(response) {
                    Swal.fire('Success!', 'Supplier updated successfully.', 'success');
                    setTimeout(function() {
                        window.location.href = "{{ route('supplier.index') }}";
                    }, 1000); 
                })
                .catch(function(error) {
                    if (error.response && error.response.data && error.response.data.message) {
                        Swal.fire('Error!', error.response.data.message, 'error');
                    } else {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                });
        });
        
    </script>

    </x-slot:scripts>
</x-layouts.app>