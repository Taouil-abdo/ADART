<x-layouts.app>
    <x-slot:title>Stock Management - DART TALIB</x-slot:title>
    <div class="flex flex-col gap-4 mb-6">
        <nav class="text-xl text-gray-600">
            <a href="{{ route('dashboard') }}" class="text-blue-500">Dashboard</a>
            <span class="mx-2">/</span>
            <a href="{{ route('stock.index')}}" class="text-gray-800 font-semibold">Stock</a>
            <span class="mx-2">/</span>
            <span class="mx-2 bg-gray-800">Create stock</span>
        </nav>
    </div>
    <div id="addStockModal">
        <div
            class="relative mx-auto p-0 border-0 w-full max-w-3xl shadow-2xl rounded-lg bg-white transform transition-all duration-300 overflow-hidden">
            <!-- Modal Header with gradient background -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-5 flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-bold text-white">Add New Stock Item</h3>
                    <p class="text-blue-100 text-sm mt-1 opacity-90">Complete the form below with stock details</p>
                </div>
            </div>

            <!-- Form Content with better padding and organization -->
            <div class="p-6">
                <form id="StockForm" action="{{ route('stock.store') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('POST')
                    <div class="space-y-4">
                        <div class="flex items-center space-x-2 pb-2 border-b border-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <h4 class="text-base font-medium text-gray-800">Stock Information</h4>
                        </div>

                        <!-- Two column layout for desktop -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Stock ID -->
                            <!-- <div class="space-y-1">
                                <label for="stock-id" class="block text-sm font-medium text-gray-700">
                                    Stock ID <span class="text-red-500">*</span>
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
                                    <input type="text" id="stock-id" name="stock_id" placeholder="e.g. STK001"
                                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                        required>
                                </div>
                            </div> -->

                            <!-- Item Name -->
                            <div class="space-y-1">
                                <label for="item-name" class="block text-sm font-medium text-gray-700">
                                    Item Name <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm0 2h10v7h-2l-1 2H8l-1-2H5V5z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" id="item-name" name="item_name" placeholder="e.g. Office Chair"
                                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                        required>
                                </div>
                            </div>

                            <!-- Quantity -->
                            <div class="space-y-1">
                                <label for="quantity" class="block text-sm font-medium text-gray-700">
                                    Quantity <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="number" id="quantity" name="quantity" placeholder="e.g. 100" min="0"
                                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                        required>
                                </div>
                            </div>

                            <!-- Unit -->
                            <div class="space-y-1">
                                <label for="unit" class="block text-sm font-medium text-gray-700">
                                    Unit <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 2a1 1 0 00-1 1v1.323l-3.954 1.582a1 1 0 00-.646.934v9.322a1 1 0 00.648.937l3.953 1.582V17a1 1 0 001 1h4a1 1 0 001-1v-1.323l3.954-1.582a1 1 0 00.646-.934V6.839a1 1 0 00-.648-.937l-3.953-1.582V3a1 1 0 00-1-1h-4zm3 12.618V10l4-1.6v3.218L13 13.382z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <select id="unit" name="unit"
                                        class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg appearance-none bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                        <option value="" disabled selected>Select unit</option>
                                        <option value="kg">kg</option>
                                        <option value="liters">l</option>
                                        <option value="pieces">pcs</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Category Section -->
                    <div class="space-y-4 pt-2">
                        <div class="flex items-center space-x-2 pb-2 border-b border-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                            </svg>
                            <h4 class="text-base font-medium text-gray-800">Category & Status</h4>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Category -->
                            <div class="space-y-1">
                                <label for="category" class="block text-sm font-medium text-gray-700">
                                    Category <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                                        </svg>
                                    </div>
                                    <select id="category" name="category_id"
                                        class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg appearance-none bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                        required>
                                        <option value="" disabled selected>Select category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
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
                    </div>

                    <!-- Supplier Information Section -->
                    <div class="space-y-4 pt-2">
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

                        <div class="grid grid-cols-1 md:grid-cols-1 gap-5">
                            <!-- Supplier -->
                            <div class="space-y-1">
                                <label for="supplier" class="block text-sm font-medium text-gray-700">
                                    Supplier <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                            <path
                                                d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                                        </svg>
                                    </div>
                                    <select id="supplier" name="supplier_id"
                                        class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg appearance-none bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                        required>
                                        <option value="" disabled selected>Select supplier</option>
                                        @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
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
                            Save Stock Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-slot:scripts>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
        document.getElementById('StockForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);
            const url = form.action;

            axios.post(url, formData, {
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    }
                })
                .then(function(response) {
                    Swal.fire('Success!', 'Stock item added successfully.', 'success');
                    form.reset();
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