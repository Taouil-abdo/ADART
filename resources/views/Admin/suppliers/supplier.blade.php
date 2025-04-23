<x-layouts.app>
    <x-slot:title>Dashboard - DART TALIB</x-slot:title>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
        <div>
            <select class="bg-white border border-gray-300 rounded-md px-3 py-2 text-sm">
                <option>Last 7 days</option>
                <option>Last 30 days</option>
                <option>This month</option>
                <option>Last quarter</option>
            </select>
        </div>
    </div>

    <div class="container mx-auto px-4 py-6">
        <div class="bg-white shadow-md rounded-lg">
            <div class="flex justify-between items-center p-6 border-b">
                <h2 class="text-2xl font-semibold text-gray-800">Suppliers Management</h2>
                <button onclick="openAddSupplierModal()"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Add Supplier
                </button>
            </div>

            <div class="p-6">
                <table class="w-full">
                   
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-4 text-left">ID</th>
                            <th class="py-3 px-4 text-left">Name</th>
                            <th class="py-3 px-4 text-left">Contact Person</th>
                            <th class="py-3 px-4 text-left">Email</th>
                            <th class="py-3 px-4 text-left">SuppliedProduct</th>
                            <th class="py-3 px-4 text-left">Payment Method</th>
                            <th class="py-3 px-4 text-center">Status</th>
                            <th class="py-3 px-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @if($suppliers) 
                    @foreach($suppliers as $supplier)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-4 text-left">
                                {{$supplier->id}}
                            </td>
                            <td class="py-3 px-4 text-left">
                                {{$supplier->name}}
                            </td>
                            <td class="py-3 px-4 text-left">
                                {{$supplier->phoneNumber}}
                            </td>
                            <td class="py-3 px-4 text-left">
                                {{$supplier->email}}
                            </td>
                            <td class="py-3 px-4 text-center">
                                {{$supplier->suppliedProduct}}
                            </td>
                            <td class="py-3 px-4 text-center">
                                {{$supplier->paymentMethod}}
                            </td>
                            <td class="py-3 px-4 text-center">
                                <span class="{{ $supplier->isActive ? 'bg-green-200 text-green-600' : 'bg-red-200 text-red-600' }} py-1 px-3 rounded-full text-xs">
                                    {{ $supplier->isActive ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <a href="{{ route('supplier.edit', $supplier->id) }}"
                                        class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                    <button onclick="confirmDeleteSupplier()"
                                        class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center py-4">No suppliers found</td>
                        </tr>
                   @endif

                    </tbody>
                    
                </table>
                <div class="mt-4">
                    {{ $suppliers->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Add Supplier Modal --}}
    <!-- Add Supplier Modal -->
    <div id="addSupplierModal"
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden overflow-y-auto h-full w-full z-50 transition-all duration-300 flex items-center justify-center">
        <div
            class="relative mx-auto p-6 border-0 w-full max-w-md shadow-2xl rounded-xl bg-white transform transition-all duration-300">
            <!-- Modal Header -->
            <div class="mb-5">
                <h3 class="text-xl font-bold text-gray-800">Add New Supplier</h3>
                <p class="text-sm text-gray-500 mt-1">Enter supplier details below</p>
            </div>

            <!-- Form -->
            <form action="" method="POST" class="space-y-4">
                @csrf

                <!-- Supplier Name -->
                <div>
                    <label for="supplier-name" class="block text-sm font-medium text-gray-700 mb-1">Supplier
                        Name</label>
                    <input type="text" id="supplier-name" name="name" placeholder="e.g. ABC Supplies Ltd"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        required>
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone-number" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="tel" id="phone-number" name="phoneNumber" placeholder="e.g. +1 (555) 123-4567"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" placeholder="e.g. contact@example.com"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <input type="text" id="address" name="address" placeholder="e.g. 123 Business St, City"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                </div>

                <!-- Payment Terms -->
                <div>
                    <label for="payment-terms" class="block text-sm font-medium text-gray-700 mb-1">Payment
                        Methode</label>
                    <select name="paymentMethod" id="paymentMethod" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <option value="paymentMethod">Select payment Method </option>
                        <option value="cash">Cash</option>
                        <option value="credit">Credit</option>
                    </select>
                </div>

                <!-- Contact Person -->
                <div>
                    <label for="suppliedProduct" class="block text-sm font-medium text-gray-700 mb-1">suppliedProduct</label>
                    <input type="text" id="suppliedProduct" name="suppliedProduct" placeholder="breed, rice, etc"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                </div>

                <!-- Active Supplier Checkbox -->
                <div>
                    
                    <label for="addSupplierActive" class="block text-sm font-medium text-gray-700 mb-1">Supplier Status</label>
                    <select name="isActive" id="isActive" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <option value="isActive">Select Status</option>
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

    <x-slot:scripts>
        <script>
        function openAddSupplierModal() {
            document.getElementById('addSupplierModal').classList.remove('hidden');
        }

        function closeAddSupplierModal() {
            document.getElementById('addSupplierModal').classList.add('hidden');
        }

        function openEditSupplierModal() {

            document.getElementById('editSupplierModal').classList.remove('hidden');
        }

        function closeEditSupplierModal() {
            document.getElementById('editSupplierModal').classList.add('hidden');
        }

        function confirmDeleteSupplier(id) {

        }
        </script>

    </x-slot:scripts>
</x-layouts.app>