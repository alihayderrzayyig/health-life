<x-admin-layout>
    <div class="mt-12 max-w-6xl mx-auto">


        <div class="flex my-2 py-2">
            <a href="{{ route('admin.categories.index') }} "
                class="px-4 py-2 bg-indigo-400 hover:bg-indigo-600 rounded">Back</a>
        </div>



        <div class="max-w-md mx-auto bg-gray-100 p-6 mt-12 rounded">
            <form method="POST"
                action="{{ isset($category) ? route('admin.categories.update',$category->id) : route('admin.categories.store') }}"
                class="space-y-5">
                @csrf
                @if (isset($category))
                    @method('PUT')
                @endif
                <div>
                    <label for="name" class="text-xl">Name</label>
                    <input id="name" name="name" type="text"
                        class="block w-full p-3 mt-2 text-gray-800 appearance-none border-2 border-gray-100 focus:text-gray-500
                    focus:outline-none focus:border-gray-200 rounded-md"

                    value="{{ isset($category) ? $category->name : '' }}"
                    />
                    @error('name')
                        <span class="text-sm text-red-400">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full py-3 mt-10 bg-indigo-400 hover:bg-indigo-600 rounded-md font-medium text-white uppercase focus:outline-none hover:shadow-none">
                    {{isset($category)? __('Update') : __('Create') }}
                </button>
            </form>
        </div>


    </div>
</x-admin-layout>
