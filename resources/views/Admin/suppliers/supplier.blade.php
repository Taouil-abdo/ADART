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
                            <th class="py-3 px-6 text-left">ID</th>
                            <th class="py-3 px-6 text-left">Name</th>
                            <th class="py-3 px-6 text-left">Contact Person</th>
                            <th class="py-3 px-6 text-left">Phone Number</th>
                            <th class="py-3 px-6 text-left">Email</th>
                            <th class="py-3 px-6 text-center">Status</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">
                                supplierID
                            </td>
                            <td class="py-3 px-6 text-left">
                                name
                            </td>
                            <td class="py-3 px-6 text-left">
                                contactPers
                            </td>
                            <td class="py-3 px-6 text-left">
                                phoneNumber
                            </td>
                            <td class="py-3 px-6 text-left">
                                email
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span class="
                                isActive ? g-green-200 text-green-600' : 'bg-red-200 text-red-600'  
                                py-1 px-3 rounded-full text-xs">
                                    Inactive
                                </span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <button onclick="openEditSupplierModal()"
                                        class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
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

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Add Supplier Modal --}}
     <div id="addSupplierModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Add New Supplier</h3>
                <form action="" method="POST" class="mt-4">
                    @csrf
                    <input type="text" name="name" placeholder="Supplier Name"
                        class="w-full px-3 py-2 border rounded-md mb-3" required>
                    <input type="text" name="contactPerson" placeholder="Contact Person"
                        class="w-full px-3 py-2 border rounded-md mb-3">
                    <input type="tel" name="phoneNumber" placeholder="Phone Number"
                        class="w-full px-3 py-2 border rounded-md mb-3">
                    <input type="email" name="email" placeholder="Email"
                        class="w-full px-3 py-2 border rounded-md mb-3">
                    <input type="text" name="address" placeholder="Address"
                        class="w-full px-3 py-2 border rounded-md mb-3">
                    <input type="text" name="paymentTerms" placeholder="Payment Terms"
                        class="w-full px-3 py-2 border rounded-md mb-3">
                    <div class="flex items-center mb-3">
                        <input type="checkbox" name="isActive" id="addSupplierActive" value="1" class="mr-2" checked>
                        <label for="addSupplierActive">Active Supplier</label>
                    </div>
                    <div class="flex justify-between mt-4">
                        <button type="button" onclick="closeAddSupplierModal()"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Save
                        </button>
                    </div>
                </form>
            </div>
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