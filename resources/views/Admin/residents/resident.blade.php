<x-layouts.app>
    <x-slot:title>Residents - DART TALIB</x-slot:title>

    <div class="flex flex-col gap-4 mb-6">
        <nav class="text-xl text-gray-600">
            <a href="{{ route('dashboard') }}" class="text-blue-500">Dashboard</a>
            <span class="mx-2">/</span>
            <span class="mx-2 bg-gray-800">Residents Management</span>
        </nav>
    </div>

    <div class="container mx-auto px-4 py-6">
        <div class="bg-white shadow-md rounded-lg">
            <h2 class="text-2xl font-semibold text-gray-800 p-3">Residents List</h2>

            <div class="flex justify-between items-center p-6 border-b bg-white shadow-md rounded-lg">
                <input id="searchInput" type="search" placeholder="Search by name or ID"
                    class="border border-gray-300 rounded-lg py-2 px-4 w-1/3" />
                <button
                    class="bg-gradient-to-r from-purple-600 to-indigo-600 to-gray-800 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <a href="{{route('residents.create')}}">Add Resident</a>
                </button>
            </div>

            <div class="p-6">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">ID</th>
                            <th class="py-3 px-6 text-left">Full Name</th>
                            <th class="py-3 px-6 text-left">Age</th>
                            <th class="py-3 px-6 text-left">gender</th>
                            <th class="py-3 px-6 text-left">School Level</th>
                            <th class="py-3 px-6 text-left">School</th>
                            <th class="py-3 px-6 text-center">Status</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @if($residents)
                        @foreach ($residents as $resident)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">
                                {{ $resident->id }}
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ $resident->fullname }}
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ $resident->age }}
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ $resident->gender }}
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ $resident->school_level }}
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ $resident->school }}
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span class="
                                status == 'Active' ? 'bg-green-200 text-green-600' : 'bg-red-200 text-red-600' }}  
                                py-1 px-3 rounded-full text-xs">
                                    {{ $resident->status }}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <button class="w-5 h-5 mr-2 transform hover:text-blue-500 hover:scale-110">
                                        <a href="{{ route('residents.download', $resident->id) }}">
                                            <span
                                                class="flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M64 464l48 0 0 48-48 0c-35.3 0-64-28.7-64-64L0 64C0 28.7 28.7 0 64 0L229.5 0c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3L384 304l-48 0 0-144-80 0c-17.7 0-32-14.3-32-32l0-80L64 48c-8.8 0-16 7.2-16 16l0 384c0 8.8 7.2 16 16 16zM176 352l32 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-16 0 0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48 0-80c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24l-16 0 0 48 16 0zm96-80l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-8.8 0-16-7.2-16-16l0-128c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-16 0 0 96 16 0zm80-112c0-8.8 7.2-16 16-16l48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 32 32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64 0-64z"/></svg>
                                            </span>
                                        </a>
                                    </button>
                                    <button class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                        <a href="{{route('residents.edit', $resident->id)}}">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                    </button>
                                    <form data-delete-resident action="{{ route('residents.destroy', $resident->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
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
                        </tr>
                        @endforeach
                        @else
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td colspan="7" class="py-3 px-6 text-center text-gray-500">No residents found.</td>
                        </tr>
                        @endif

                    </tbody>
                </table>
                <div>
                    {{ $residents->links() }}
                </div>
            </div>
        </div>
    </div>
    </div>

    <x-slot:scripts>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <script>
        document.querySelectorAll('form[data-delete-resident]').forEach(function(form) {
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
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                }
                            })
                            .then(function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    'Resident has been deleted successfully.',
                                    'success'
                                );
                                // Remove the row without refreshing
                                row.remove();
                            })
                            .catch(function(error) {
                                Swal.fire(
                                    'Error!',
                                    'There was an error deleting the resident.',
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
            const url = "{{ route('residents.index') }}?q=" + encodeURIComponent(q);

            axios.get(url)
                .then(function(response) {
                    const residents = response.data.residents;
                    const tbody = document.querySelector('tbody');
                    tbody.innerHTML = '';

                    if (residents.length > 0) {
                        residents.forEach(function(resident) {
                            const row = document.createElement('tr');
                            row.classList.add("border-b", "border-gray-200", "hover:bg-gray-100");

                            row.innerHTML = `
                            <td class="py-3 px-6 text-left">${resident.id}</td>
                            <td class="py-3 px-6 text-left">${resident.fullname}</td>
                            <td class="py-3 px-6 text-left">${resident.age}</td>
                            <td class="py-3 px-6 text-left">${resident.gender}</td>
                            <td class="py-3 px-6 text-left">${resident.school_level}</td>
                            <td class="py-3 px-6 text-left">${resident.school}</td>
                            <td class="py-3 px-6 text-center">
                                <span class="${resident.status === 'Active' ? 'bg-green-200 text-green-600' : 'bg-red-200 text-red-600'} py-1 px-3 rounded-full text-xs">
                                    ${resident.status}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">

                                    <button class="w-5 h-5 mr-2 transform hover:text-blue-500 hover:scale-110">
                                        <a href="/residents/${resident.id}/download">
                                            <span
                                                class="flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                    <path
                                                        d="M15.232 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 144-208 0c-75.3 0-64 28.7-64 64l0 144-48 0c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zM176 352l32 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-16 0 0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48 0-80c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24l-16 0 0 48 16 0zm96-80l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-8.8 0-16-7.2-16-16l0-128c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-16 0 0 96 16 0zm80-112c0-8.8 7.2-16 16-16l48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 32 32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64 0-64z" />
                                                </svg>
                                            </span>
                                        </a>
                                    </button>
                                    <button class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                        <a href="/residents/${resident.id}/edit">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                    </button>
                                    <form data-delete-resident action="/residents/${resident.id}"
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
                            `<tr><td colspan="8" class="text-center text-gray-500 py-4">No residents found.</td></tr>`;
                    }
                })
                .catch(function(error) {
                    console.error("Error fetching residents:", error);
                });
        });
        </script>

    </x-slot:scripts>
</x-layouts.app>