<x-layouts.app>

{{-- Add Supplier Modal --}}
    <!-- Add Supplier Modal -->
    <div id="addSupplierModal"
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full z-50 transition-all duration-300 flex items-center justify-center">
        <div
            class="relative mx-auto p-6 border-0 w-full max-w-md shadow-2xl rounded-xl bg-white transform transition-all duration-300">
            <!-- Modal Header -->
            <div class="mb-5">
                <h3 class="text-xl font-bold text-gray-800">Add New Supplier</h3>
                <p class="text-sm text-gray-500 mt-1">Enter supplier details below</p>
            </div>

            <!-- Form -->
            <form action="{{route('suppliers.update',$supplier->id)}}" method="POST" class="space-y-4">
                @csrf

                <!-- Supplier Name -->
                <div>
                    <label for="supplier-name" class="block text-sm font-medium text-gray-700 mb-1">Supplier
                        Name</label>
                    <input type="text" id="supplier-name" name="name" value="{{$suppler->name}}" placeholder="e.g. ABC Supplies Ltd"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        required>
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone-number" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="tel" id="phone-number" name="phoneNumber" value="{{$suppler->phoneNumber}}" placeholder="e.g. +1 (555) 123-4567"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{$suppler->phoneNumber}}" placeholder="e.g. contact@example.com"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <input type="text" id="address" name="address" value="{{$suppler->phoneNumber}}" placeholder="e.g. 123 Business St, City"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                </div>

                <!-- Payment Terms -->
                <div>
                    <label for="payment-terms" class="block text-sm font-medium text-gray-700 mb-1">Payment
                        Terms</label>
                    <input type="text" id="payment-terms" value="{{$suppler->phoneNumber}}" name="paymentTerms" placeholder="e.g. Net 30"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                </div>

                <!-- Contact Person -->
                <div>
                    <label for="suppliedProduct" class="block text-sm font-medium text-gray-700 mb-1">suppliedProduct</label>
                    <input type="text" id="suppliedProduct" value="{{$suppler->phoneNumber}}" name="suppliedProduct" placeholder="breed, rice, etc"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                </div>

                <!-- Active Supplier Checkbox -->
                <div class="flex items-center">
                    
                    <label for="addSupplierActive" class="ml-2 text-sm text-gray-700">Active Supplier</label>
                    <select name="isActive" id="isActive">
                        <option value="isActive">Select Product</option>
                        <option value="0">Active</option>
                        <option value="1">NotActive</option>
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeAddSupplierModal()"
                        class="px-4 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                        Save Supplier
                    </button>
                </div>
            </form>

            <!-- Close Button (X) -->
            <button onclick="closeAddSupplierModal()"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-500 focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
    </div>

<x-layouts.app>
