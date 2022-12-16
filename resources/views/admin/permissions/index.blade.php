<x-admin-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin') }}
        </h2>
    </x-slot> --}}

    <div class="mt-12 max-w-6xl mx-auto">
        <div class="flex justify-end my-2 py-2">
            <a href="{{ route('admin.permissions.create') }} "
                class="px-4 py-2 text-white bg-indigo-700 hover:bg-indigo-800 rounded">Create Permission</a>
        </div>
        <div class="relative overflow-x-auto shadow-md bg-gray-700 sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-100 uppercase bg-gray-700 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">
                                Edit
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $permission->name }}
                            </th>
                            <td class="px-6 py-4 text-right">
                                <div class="flex space-x-3 float-right">
                                    <a href="{{ route('admin.permissions.edit', $permission->id) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>

                                    <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="post"
                                        onsubmit="return confirm('Are you sure?')"
                                        class="font-medium text-red-600 dark:text-blue-500 hover:underline">
                                        @csrf
                                        @method('delete')

                                        <button type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
