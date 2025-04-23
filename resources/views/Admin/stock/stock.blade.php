<x-layouts.app>
    <x-slot:title>Dashboard - DART TALIB</x-slot:title>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
        <div>
            <select id="dateFilter" class="bg-white border border-gray-300 rounded-md px-3 py-2 text-sm">
                <option value="7">Last 7 days</option>
                <option value="30">Last 30 days</option>
                <option value="month">This month</option>
                <option value="quarter">Last quarter</option>
            </select>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Total Items -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Items</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalItems }}</p>
                </div>
            </div>
        </div>

        <!-- Total Quantity -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Quantity</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalQuantity }}</p>
                </div>
            </div>
        </div>

        <!-- Low Stock Items -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-500 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Low Stock Items</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $lowStockItems }}</p>
                </div>
            </div>
        </div>

        <!-- Out of Stock Items -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-500 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Out of Stock</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $outOfStockItems }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Stock Status Chart -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Stock Status Distribution</h3>
            <div class="h-64">
                <canvas id="stockStatusChart"></canvas>
            </div>
        </div>
        
        <!-- Items by Category Chart -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Items by Category</h3>
            <div class="h-64">
                <canvas id="categoryChart"></canvas>
            </div>
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
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                
                <div class="overflow-x-auto">
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
                            @forelse($stocks as $stock)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left">
                                        {{ $stock->id }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $stock->item_name }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $stock->category->name ?? 'N/A' }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $stock->quantity }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $stock->unit }}
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <span class="{{ $stock->status_class }} py-1 px-3 rounded-full text-xs">
                                            {{ $stock->StockStatus }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">
                                            <button onclick="openEditStockModal('{{ $stock->id }}', '{{ $stock->item_name }}', '{{ $stock->category_id }}', {{ $stock->quantity }}, '{{ $stock->unit }}', '{{ $stock->supplier_id }}')"
                                                class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </button>
                                            <button onclick="confirmDeleteStock('{{ $stock->id }}')"
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
                            @empty
                                <tr>
                                    <td colspan="7" class="py-3 px-6 text-center">No stock items found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $stocks->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Add Stock Modal --}}
    <div id="addStockModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg leading-6 font-medium text-gray-900 text-center">Add New Stock Item</h3>
                <form action="{{ route('stock.store') }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-3">
                        <label for="item_name" class="block text-sm font-medium text-gray-700 text-left">Item Name</label>
                        <input type="text" name="item_name" id="item_name" placeholder="Item Name"
                            class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="category_id" class="block text-sm font-medium text-gray-700 text-left">Category</label>
                        <select name="category_id" id="category_id" class="w-full px-3 py-2 border rounded-md" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="quantity" class="block text-sm font-medium text-gray-700 text-left">Quantity</label>
                        <input type="number" name="quantity" id="quantity" placeholder="Quantity"
                            class="w-full px-3 py-2 border rounded-md" required min="0">
                    </div>
                    
                    <div class="mb-3">
                        <label for="unit" class="block text-sm font-medium text-gray-700 text-left">Unit</label>
                        <select name="unit" id="unit" class="w-full px-3 py-2 border rounded-md" required>
                            <option value="">Select Unit</option>
                            <option value="kg">kg</option>
                            <option value="g">g</option>
                            <option value="l">l</option>
                            <option value="ml">ml</option>
                            <option value="pcs">pcs</option>
                            <option value="box">box</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="supplier_id" class="block text-sm font-medium text-gray-700 text-left">Supplier</label>
                        <select name="id" id="supplier_id" class="w-full px-3 py-2 border rounded-md" required>
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
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
    <div id="editStockModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg leading-6 font-medium text-gray-900 text-center">Edit Stock Item</h3>
                <form id="editStockForm" action="" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="edit_item_name" class="block text-sm font-medium text-gray-700 text-left">Item Name</label>
                        <input type="text" name="item_name" id="edit_item_name" placeholder="Item Name"
                            class="w-full px-3 py-2 border rounded-md" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_category_id" class="block text-sm font-medium text-gray-700 text-left">Category</label>
                        <select name="category_id" id="edit_category_id" class="w-full px-3 py-2 border rounded-md" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_quantity" class="block text-sm font-medium text-gray-700 text-left">Quantity</label>
                        <input type="number" name="quantity" id="edit_quantity" placeholder="Quantity"
                            class="w-full px-3 py-2 border rounded-md" required min="0">
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_unit" class="block text-sm font-medium text-gray-700 text-left">Unit</label>
                        <select name="unit" id="edit_unit" class="w-full px-3 py-2 border rounded-md" required>
                            <option value="">Select Unit</option>
                            <option value="kg">kg</option>
                            <option value="g">g</option>
                            <option value="l">l</option>
                            <option value="ml">ml</option>
                            <option value="pcs">pcs</option>
                            <option value="box">box</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_supplier_id" class="block text-sm font-medium text-gray-700 text-left">Supplier</label>
                        <select name="id" id="edit_supplier_id" class="w-full px-3 py-2 border rounded-md" required>
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
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

    {{-- Delete Confirmation Modal --}}
    <div id="deleteConfirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Confirm Delete</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Are you sure you want to delete this stock item? This action cannot be undone.
                    </p>
                </div>
                <div class="flex justify-between mt-4">
                    <button type="button" onclick="closeDeleteConfirmModal()"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                        Cancel
                    </button>
                    <form id="deleteStockForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot:scripts>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Chart initialization
            document.addEventListener('DOMContentLoaded', function() {
                // Stock Status Chart
                const stockStatusCtx = document.getElementById('stockStatusChart').getContext('2d');
                const stockStatusData = @json($stockStatusCounts);
                
                new Chart(stockStatusCtx, {
                    type: 'pie',
                    data: {
                        labels: stockStatusData.map(item => item.stock_status),
                        datasets: [{
                            data: stockStatusData.map(item => item.count),
                            backgroundColor: [
                                'rgba(52, 211, 153, 0.8)',  // Green for In Stock
                                'rgba(251, 191, 36, 0.8)',  // Yellow for Low Stock
                                'rgba(239, 68, 68, 0.8)'    // Red for Out of Stock
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
                
                // Category Chart
                const categoryCtx = document.getElementById('categoryChart').getContext('2d');
                const categoryData = @json($itemsByCategory);
                
                new Chart(categoryCtx, {
                    type: 'bar',
                    data: {
                        labels: categoryData.map(item => item.category),
                        datasets: [{
                            label: 'Number of Items',
                            data: categoryData.map(item => item.count),
                            backgroundColor: 'rgba(59, 130, 246, 0.8)',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0
                                }
                            }
                        }
                    }
                });
            });

            // Modal functions
            function openAddStockModal() {
                document.getElementById('addStockModal').classList.remove('hidden');
            }

            function closeAddStockModal() {
                document.getElementById('addStockModal').classList.add('hidden');
            }

            function openEditStockModal(id, itemName, categoryId, quantity, unit, supplierId) {
                document.getElementById('edit_item_name').value = itemName;
                document.getElementById('edit_category_id').value = categoryId;
                document.getElementById('edit_quantity').value = quantity;
                document.getElementById('edit_unit').value = unit;
                document.getElementById('edit_supplier_id').value = supplierId;
                
                document.getElementById('editStockForm').action = `/stock/update/${id}`;
                document.getElementById('editStockModal').classList.remove('hidden');
            }

            function closeEditStockModal() {
                document.getElementById('editStockModal').classList.add('hidden');
            }

            function confirmDeleteStock(id) {
                document.getElementById('deleteStockForm').action = `/stock/${id}`;
                document.getElementById('deleteConfirmModal').classList.remove('hidden');
            }

            function closeDeleteConfirmModal() {
                document.getElementById('deleteConfirmModal').classList.add('hidden');
            }
        </script>
    </x-slot:scripts>
</x-layouts.app>