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
                <h2 class="text-2xl font-semibold text-gray-800">Stock Management</h2>
                <button onclick="openAddStockModal()"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Add Stock Item
                </button>
            </div>

            <div class="p-6">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">ID</th>
                            <th class="py-3 px-6 text-left">Item Name</th>
                            <th class="py-3 px-6 text-left">Category</th>
                            <th class="py-3 px-6 text-left">Quantity</th>
                            <th class="py-3 px-6 text-left">Unit</th>
                            <th class="py-3 px-6 text-center">Status</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">
                                stock_id
                            </td>
                            <td class="py-3 px-6 text-left">
                                item_name
                            </td>
                            <td class="py-3 px-6 text-left">
                                category
                            </td>
                            <td class="py-3 px-6 text-left">
                                quantity
                            </td>
                            <td class="py-3 px-6 text-left">
                                unite
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span class="
                                stock->quantity > 10 ? 'bg-green-200 text-green-600' : 
                                   (stock->quantity > 0 ? 'bg-yellow-200 text-yellow-600' : 'bg-red-200 text-red-600') 
                                py-1 px-3 rounded-full text-xs">
                                    stock_status
                                </span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <button onclick="openEditStockModal()"
                                        class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button onclick="confirmDeleteStock()"
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

    {{-- Add Stock Modal --}}
    <div id="addStockModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Add New Stock Item</h3>
                <form action="" method="POST" class="mt-4">
                    @csrf
                    <input type="text" name="item_name" placeholder="Item Name"
                        class="w-full px-3 py-2 border rounded-md mb-3" required>
                    <input type="text" name="category" placeholder="Category"
                        class="w-full px-3 py-2 border rounded-md mb-3">
                    <input type="number" name="quantity" placeholder="Quantity"
                        class="w-full px-3 py-2 border rounded-md mb-3" required min="0">
                    <select name="unite" id="editStockUnite" class="w-full px-3 py-2 border rounded-md mb-3" required>
                        <option value="">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="l">l</option>
                        <option value="ml">ml</option>
                    </select>
                    <input type="text" name="stock_status" placeholder="Stock Status"
                        class="w-full px-3 py-2 border rounded-md mb-3">
                    <div class="flex justify-between mt-4">
                        <button type="button" onclick="closeAddStockModal()"
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

    {{-- Edit Stock Modal --}}
    <div id="editStockModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Stock Item</h3>
                <form id="editStockForm" action="" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')
                    <input type="text" name="item_name" id="editStockItemName" placeholder="Item Name"
                        class="w-full px-3 py-2 border rounded-md mb-3" required>
                    <input type="text" name="category" id="editStockCategory" placeholder="Category"
                        class="w-full px-3 py-2 border rounded-md mb-3">
                    <input type="number" name="quantity" id="editStockQuantity" placeholder="Quantity"
                        class="w-full px-3 py-2 border rounded-md mb-3" required min="0">
                    <select name="unite" id="editStockUnite" class="w-full px-3 py-2 border rounded-md mb-3" required>
                        <option value="">Select Unit</option>
                        <option value="kg">kg</option>
                        <option value="g">g</option>
                        <option value="l">l</option>
                        <option value="ml">ml</option>
                    </select>
                    <input type="text" name="stock_status" id="editStockStatus" placeholder="Stock Status"
                        class="w-full px-3 py-2 border rounded-md mb-3">
                    <div class="flex justify-between mt-4">
                        <button type="button" onclick="closeEditStockModal()"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-slot:scripts>

        <script>
        function openAddStockModal() {
            document.getElementById('addStockModal').classList.remove('hidden');
        }

        function closeAddStockModal() {
            document.getElementById('addStockModal').classList.add('hidden');
        }

        function openEditStockModal() {


            document.getElementById('editStockModal').classList.remove('hidden');
        }

        function closeEditStockModal() {
            document.getElementById('editStockModal').classList.add('hidden');
        }

        function confirmDeleteStock(id) {

        }
        </script>

    </x-slot:scripts>
</x-layouts.app>