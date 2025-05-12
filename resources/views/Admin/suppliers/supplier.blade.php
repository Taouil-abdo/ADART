<x-layouts.app>
    <x-slot:title>Dashboard - DART TALIB</x-slot:title>
    <div class="flex flex-col gap-4 mb-6">
        <nav class="text-xl text-gray-600">
            <a href="{{ route('dashboard') }}" class="text-blue-500">Dashboard</a>
            <span class="mx-2">/</span>
            <span class="text-gray-800 font-semibold">Supplier</span>
        </nav>
    </div>
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white shadow-md rounded-lg">
            <h2 class="text-2xl font-semibold text-gray-800 p-3">Suppliers Management</h2>

            <div class="flex justify-between items-center p-6 border-b bg-white shadow-md rounded-lg">
                <input type="text" id="searchInput" placeholder="Search by name or ID"
                    class="border border-gray-300 rounded-lg py-2 px-4 w-1/3" />
                <a href="{{route('supplier.create')}}"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Add Supplier
                </a>
            </div>

            <div class="p-6 overflow-x-auto">
                <table class="min-w-full border border-gray-200">

                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-4 text-left">ID</th>
                            <th class="py-3 px-4 text-left">Name</th>
                            <th class="py-3 px-4 text-left">Contact Person</th>
                            <th class="py-3 px-4 text-left">Email</th>
                            <th class="py-3 px-4 text-left">SuppliedProduct</th>
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
                                <span
                                    class="{{ $supplier->isActive ? 'bg-green-200 text-green-600' : 'bg-red-200 text-red-600' }} py-1 px-3 rounded-full text-xs">
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
                                    <form data-delete-supplier action="{{route('supplier.destroy', $supplier->id)}}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
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

    <x-slot:scripts>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script>
        //    delete function

        document.querySelectorAll('form[data-delete-supplier]').forEach(function(form) {
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
                                        ' Supplier has been deleted.',
                                        'success'
                                    );
                                    row.remove();
                                }
                            })
                            .catch(error => {
                                console.error('Error deleting supplier :', error);
                                Swal.fire(
                                    'Error!',
                                    'Failed to delete the supplier. Please try again.',
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
            const url = "{{ route('supplier.index') }}?q=" + encodeURIComponent(q);

            axios.get(url)
                .then(function(response) {
                    const suppliers = response.data.suppliers;
                    const tbody = document.querySelector('tbody');
                    tbody.innerHTML = '';

                    if (suppliers.length > 0) {
                        suppliers.forEach(function(supplier) {
                            const row = document.createElement('tr');
                            row.classList.add("border-b", "border-gray-200", "hover:bg-gray-100");

                            row.innerHTML = `
                            <td class="py-3 px-6 text-left">${supplier.id}</td>
                            <td class="py-3 px-6 text-left">${supplier.name}</td>
                            <td class="py-3 px-6 text-left">${supplier.phoneNumber}</td>
                            <td class="py-3 px-6 text-left">${supplier.email}</td>
                            <td class="py-3 px-6 text-left">${supplier.suppliedProduct}</td>
                            <td class="py-3 px-4 text-center">
                                <span class="${supplier.isActive ? 'bg-green-200 text-green-600' : 'bg-red-200 text-red-600'} py-1 px-3 rounded-full text-xs">
                                    ${supplier.isActive ? 'Active' : 'Inactive'}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <button class="text-blue-500 hover:scale-110 transition transform">
                                        <a href="/supplier/${supplier.id}/edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                    </button>
                                    <form data-delete-supplier action="/supplier/${supplier.id}"
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
                            `<tr><td colspan="8" class="text-center text-gray-500 py-4">No supplier found.</td></tr>`;
                    }
                })
                .catch(function(error) {
                    console.error("Error fetching Supplier:", error);
                });
        });
        </script>
    </x-slot:scripts>
</x-layouts.app>