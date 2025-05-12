<x-layouts.app>
    <x-slot:title>StocK_Management - DART TALIB</x-slot:title>

    <div class="flex flex-col gap-4 mb-6">
        <nav class="text-xl text-gray-600">
            <a href="{{ route('dashboard') }}" class="text-blue-500">Dashboard</a>
            <span class="mx-2">/</span>
            <span class="mx-2">Stocks</span>
        </nav>
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
        <h2 class="text-2xl font-semibold text-gray-800 p-3">Stock Management</h2>

            <div class="flex justify-between items-center p-6 border-b bg-white shadow-md rounded-lg">
                <input id="searchInput" type="search" placeholder="Search by name or ID"
                   class="border border-gray-300 rounded-lg py-2 px-4 w-1/3" />
                <a href="{{route('stock.create')}}"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Add Stock Item
                </a>
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
                                <th class="py-3 px-6 text-left">Supplier</th>
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
                                        {{ $stock->supplier->name }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $stock->quantity }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $stock->unit }}
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <span class="{{ $stock->status_class }} py-1 px-3 rounded-full text-xs 
                                            {{ $stock->StockStatus === 'in_stock' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $stock->StockStatus === 'low_stock' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $stock->StockStatus === 'out_of_stock' ? 'bg-red-100 text-red-800' : '' }}">
                                            {{ $stock->StockStatus }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">
                                            <a href = "{{ route('stock.edit',$stock->id) }}"
                                                class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                            <form data-stock-delete action="{{route('stock.destroy', $stock->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type = "submit"
                                                  class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                  </svg>
                                                </button>
                                            </form>
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

    <x-slot:scripts>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
            // Chart initialization
            document.addEventListener('DOMContentLoaded', function() {
                // Stock Status Chart
                const stockStatusCtx = document.getElementById('stockStatusChart').getContext('2d');
                const stockStatusData = @json($stockStatusCounts);
                
                new Chart(stockStatusCtx, {
                    type: 'pie',
                    data: {
                        labels: stockStatusData.map(item => item.StockStatus),
                        datasets: [{
                            data: stockStatusData.map(item => item.count),
                            backgroundColor: [
                                'rgba(239, 68, 68, 0.8)' ,   // Red for Out of Stock
                                'rgba(251, 191, 36, 0.8)',  // Yellow for Low Stock
                                'rgba(52, 211, 153, 0.8)'  // Green for In Stock
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
        </script>
        <script>
            document.querySelectorAll('form[data-stock-delete]').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); 
                    const url = this.action;
                    const row = this.closest('tr');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This action cannot be undone!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            axios.delete(url, {
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => {
                                if (response.status === 200) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Stock item has been deleted.',
                                        'success'
                                    );
                                    row.remove();
                                }
                            })
                            .catch(error => {
                                console.error('Error deleting stock item:', error);
                                Swal.fire(
                                    'Error!',
                                    'Failed to delete the stock item. Please try again.',
                                    'error'
                                );
                            });
                        }
                    });
                });
            });


            // Search functionality
            document.getElementById('searchInput').addEventListener('input', function() {
            const q = this.value;
            const url = "{{ route('stock.index') }}?q=" + encodeURIComponent(q);

            axios.get(url)
                .then(function(response) {
                    const stocks = response.data.stocks;
                    const tbody = document.querySelector('tbody');
                    tbody.innerHTML = '';

                    if (stocks.length > 0) {
                        stocks.forEach(function(stock) {
                            const row = document.createElement('tr');
                            row.classList.add("border-b", "border-gray-200", "hover:bg-gray-100");

                            row.innerHTML = `
                            
                                <td class="py-3 px-6 text-left"> ${stock.id} </td>
                                <td class="py-3 px-6 text-left"> ${stock.item_name} </td>
                                <td class="py-3 px-6 text-left"> ${stock.category.name} </td>
                                <td class="py-3 px-6 text-left"> ${stock.supplier.name} </td>
                                <td class="py-3 px-6 text-left"> ${stock.quantity} </td>
                                <td class="py-3 px-6 text-left"> ${stock.unit} </td>   
                                <td class="py-3 px-6 text-center">
                                        <span class=" py-1 px-3 rounded-full text-xs 
                                            ${stock.StockStatus === 'in_stock' ? 'bg-green-200 text-green-600' : '' }
                                            ${ stock.StockStatus === 'low_stock' ? 'bg-yellow-200 text-yellow-600' : '' }
                                            ${ stock.StockStatus === 'out_of_stock' ? 'bg-red-200 text-red-600' : '' }">
                                            ${ stock.StockStatus }
                                        </span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <button class="text-blue-500 hover:scale-110 transition transform">
                                        <a href="/stock/${stock.id}/edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                    </button>
                                    <form data-delete-stock action="/stock/${stock.id}"
                                        method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit"
                                            class="w-5 h-5 mr-2 transform hover:text-red-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        `;
                            tbody.appendChild(row);
                        });
                    } else {
                        tbody.innerHTML =
                            `<tr><td colspan="8" class="text-center text-gray-500 py-4">No Stock found.</td></tr>`;
                    }
                })
                .catch(function(error) {
                    console.error("Error fetching stock:", error);
                });
            });

        </script>

    </x-slot:scripts>
</x-layouts.app>