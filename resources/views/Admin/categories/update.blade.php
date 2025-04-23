<x-layouts.app>
    <div id="editCategoryModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Category</h3>
                <form  action="{{route('category.update', $category->id)}}" method="POST" class="mt-4">
                  @csrf 
                  @method('PUT')                  
                    <!-- <input type="hidden" name="id" id="editCategoryId" value="{{$category->id}}"> -->
                    <input type="text" name="name" id="editCategoryName" value="{{$category->name}}" placeholder="Category Name"
                        class="w-full px-3 py-2 border rounded-md mb-3" required>

                    <div class="flex justify-between mt-4">
                        <button type="button" onclick="closeEditCategoryModal()"
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
</x-layouts.app>