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
            <div class="flex justify-between items-center p-6 border-b-gray-600">
                <h2 class="text-2xl font-semibold text-gray-800">Rooms Management</h2>
                <button onclick="openAddRoomModal()"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Add Room
                </button>
            </div>

            <div class="p-6">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Number</th>
                            <th class="py-3 px-6 text-left">Room Status</th>
                            <th class="py-3 px-6 text-left">Capacity</th>
                            <th class="py-3 px-6 text-left">Block</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @if($rooms->count())
                        @foreach ($rooms as $room)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">{{$room->roomNumber}}</td>
                            <td class="py-3 px-6 text-left">
                                <span
                                    class="{{ $room->roomStatus == 'available' ? 'bg-green-200 text-green-600' : ($room->roomStatus == 'occupied' ? 'bg-red-200 text-red-600' : 'bg-yellow-200 text-yellow-600') }} py-1 px-3 rounded-full text-sm">
                                    {{ ucfirst($room->roomStatus) }}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-left">{{$room->capacity}}</td>
                            <td class="py-3 px-6 text-left">{{$room->block}}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <button onclick="openEditRoomModal()"
                                        class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST"
                                        class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" class="w-5 h-5">
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
                            <td colspan="5" class="text-center py-4">No rooms found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $rooms->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Add Room Modal -->
    <div id="addRoomModal"
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden overflow-y-auto h-full w-full z-50 transition-all duration-300 flex items-center justify-center">
        <div
            class="relative mx-auto p-6 border-0 w-full max-w-md shadow-2xl rounded-xl bg-white transform transition-all duration-300">
            <!-- Modal Header -->
            <div class="mb-5">
                <h3 class="text-xl font-bold text-gray-800">Add New Room</h3>
                <p class="text-sm text-gray-500 mt-1">Enter room details below</p>
            </div>

            <!-- Form -->
            <form action="{{route('rooms.store')}}" method="POST" class="space-y-4">
                @csrf
                @method('POST')

                <!-- Room Number -->
                <div>
                    <label for="roomNumber" class="block text-sm font-medium text-gray-700 mb-1">Room Number</label>
                    <input type="roomNumber" id="roomNumber" name="roomNumber" placeholder="e.g. 101"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        required>
                </div>

                <!-- Room Status -->
                <div>
                    <label for="roomStatus" class="block text-sm font-medium text-gray-700 mb-1">Room Status</label>
                    <select id="roomStatus" name="roomStatus"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg appearance-none bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <option value="" disabled selected>Select status</option>
                        <option value="available" class="py-1">Available</option>
                        <option value="occupied" class="py-1">Occupied</option>
                        <option value="maintenance" class="py-1">Maintenance</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>

                <!-- Room Capacity -->
                <div>
                    <label for="room-capacity" class="block text-sm font-medium text-gray-700 mb-1">Room
                        Capacity</label>
                    <input type="number" id="room-capacity" name="capacity" placeholder="e.g. 2 people"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                </div>

                <!-- Block -->
                <div>
                    <label for="room-block" class="block text-sm font-medium text-gray-700 mb-1">Block</label>
                    <input type="text" id="room-block" name="block" placeholder="e.g. A, B, C"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeAddRoomModal()"
                        class="px-4 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                        Save Room
                    </button>
                </div>
            </form>

            <!-- Close Button (optional) -->
            <button onclick="closeAddRoomModal()"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-500 focus:outline-none">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>
    </div>

    <div id="editRoomModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Room</h3>
                <form id="editRoomForm" action="{{route('rooms.update',$room->id)}}" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')
                    <input type="number" name="roomNumber" id="editRoomNumber" placeholder="Room Number"
                        class="w-full px-3 py-2 border rounded-md mb-3" value="{{$room->roomNumber}}" required>
                    <select name="roomStatus" id="editRoomStatus" class="w-full px-3 py-2 border rounded-md mb-3">
                        <option value="{{$room->roomStatus}}" disabled selected></option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="maintenance">Maintenance</option>
                    </select>
                    <input type="text" name="capacity" id="editRoomCapacity" value="{{$room->capacity}}" placeholder="Room Capacity"
                        class="w-full px-3 py-2 border rounded-md mb-3">
                    <input type="text" name="block" id="editRoomBlock" value="{{$room->block}}" placeholder="Block"
                        class="w-full px-3 py-2 border rounded-md mb-3">
                    <div class="flex justify-between mt-4">
                        <button type="button" onclick="closeEditRoomModal()"
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
        function openAddRoomModal() {
            document.getElementById('addRoomModal').classList.remove('hidden');
        }

        function closeAddRoomModal() {
            document.getElementById('addRoomModal').classList.add('hidden');
        }

        function openEditRoomModal() {
            document.getElementById('editRoomModal').classList.remove('hidden');
        }

        function closeEditRoomModal() {
            document.getElementById('editRoomModal').classList.add('hidden');
        }
        </script>
    </x-slot:scripts>
</x-layouts.app>