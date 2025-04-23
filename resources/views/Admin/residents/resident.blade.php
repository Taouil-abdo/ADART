<x-layouts.app>
    <x-slot:title>Residents - DART TALIB</x-slot:title>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Residents Management</h1>
        <div>
            <select class="bg-white border border-gray-300 rounded-md px-3 py-2 text-sm">
                <option>All Residents</option>
                <option>Active Residents</option>
                <option>Inactive Residents</option>
                <option>New Admissions</option>
            </select>
        </div>
    </div>

    <div class="container mx-auto px-4 py-6">
        <div class="bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold text-gray-800">Residents List</h2>
            <div class="flex justify-between items-center p-6 border-b">
                
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
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
                                    <button class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                        <a href="{{ route('residents.download', $resident->id) }}" >
                                                <span class="flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 144-208 0c-35.3 0-64 28.7-64 64l0 144-48 0c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128zM176 352l32 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-16 0 0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48 0-80c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24l-16 0 0 48 16 0zm96-80l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-8.8 0-16-7.2-16-16l0-128c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-16 0 0 96 16 0zm80-112c0-8.8 7.2-16 16-16l48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 32 32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64 0-64z"/></svg>
                                                </span>
                                            </a>
                                    </button>
                                    <button onclick="openEditResidentModal(id }})"
                                        class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button onclick="confirmDeleteResident(id }})"
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



    {{-- Edit Resident Modal --}}
    <div id="editResidentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Resident</h3>
                <form id="editResidentForm" action="" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')
                    <input type="text" name="fullname" id="editFullName" placeholder="Full Name"
                        class="w-full px-3 py-2 border rounded-md mb-3" required>
                    <input type="date" name="birthday" id="editBirthday" placeholder="Birthday"
                        class="w-full px-3 py-2 border rounded-md mb-3" required>
                    <input type="text" name="address" id="editAddress" placeholder="Address"
                        class="w-full px-3 py-2 border rounded-md mb-3" required>
                    <select name="schoolLevel" id="editSchoolLevel" class="w-full px-3 py-2 border rounded-md mb-3">
                        <option value="">Select School Level</option>
                        <option value="Primary">Primary</option>
                        <option value="Secondary">Secondary</option>
                        <option value="High School">High School</option>
                    </select>
                    <input type="text" name="school" id="editSchool" placeholder="School Name"
                        class="w-full px-3 py-2 border rounded-md mb-3">
                    <input type="text" name="urgentContact" id="editUrgentContact" placeholder="Urgent Contact Number"
                        class="w-full px-3 py-2 border rounded-md mb-3">
                    <select name="reStatus" id="editReStatus" class="w-full px-3 py-2 border rounded-md mb-3" required>
                        <option value="">Select Residence Status</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                    <div class="flex items-center mb-3">
                        <input type="checkbox" name="healthCondition" id="editResidentHealth" value="1" class="mr-2">
                        <label for="editResidentHealth">Any Health Conditions</label>
                    </div>
                    <div class="flex justify-between mt-4">
                        <button type="button" onclick="closeEditResidentModal()"
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
        function openAddResidentModal() {
            document.getElementById('addResidentModal').classList.remove('hidden');
        }

        function closeAddResidentModal() {
            document.getElementById('addResidentModal').classList.add('hidden');
        }

        function openEditResidentModal() {}

        function closeEditResidentModal() {
            document.getElementById('editResidentModal').classList.add('hidden');
        }

        function confirmDeleteResident() {

        }
        </script>
    </x-slot:scripts>
</x-layouts.app>