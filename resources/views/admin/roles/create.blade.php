<x-admin-layout>
    <div class="mt-12 max-w-6xl mx-auto bg-slate-50 rounded p-5">
        <div class="flex my-2 py-2">
            <a href="{{ route('admin.roles.index') }}"
                class="px-4 py-2 bg-indigo-400 hover:bg-indigo-600 rounded">Back</a>
        </div>
        <div class="max-w-md mx-auto bg-gray-100 p-6 mt-12 rounded">
            <form method="POST"
                action="{{ isset($role) ? route('admin.roles.update', $role->id) : route('admin.roles.store') }}"
                class="space-y-5">
                @csrf
                @if (isset($role))
                    @method('PUT')
                @endif
                <div>
                    <label for="name" class="text-xl">Name</label>
                    <input id="name" name="name" type="text"
                        class="block w-full p-3 mt-2 text-gray-800 appearance-none border-2 border-gray-100 focus:text-gray-500
                    focus:outline-none focus:border-gray-200 rounded-md"
                        value="{{ isset($role) ? $role->name : '' }}" />
                    @error('name')
                        <span class="text-sm text-red-400">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full py-3 mt-10 bg-indigo-400 hover:bg-indigo-600 rounded-md font-medium text-white uppercase focus:outline-none hover:shadow-none">
                    {{ isset($role) ? __('Update') : __('Create') }}
                </button>
            </form>
        </div>
    </div>

    @if (isset($role))
        <div class="mt-12 max-w-6xl mx-auto p-5 bg-slate-50 rounded">
            <div class="flex my-2 py-2">
                <h2>Permissions:</h2>
                <div class="max-w-md mx-auto">
                    @foreach ($role->permissions as $rp)
                        <span class="m-2 p-2 bg-indigo-300 rounded-md">
                            {{$rp->name}}
                        </span>
                    @endforeach
                </div>
            </div>
            <div class="max-w-md mx-auto bg-gray-100 p-6 mt-12 rounded">
                <form method="POST" action="{{ route('admin.roles.permissions', $role->id) }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="xt-xl" style="max-width: 300px">
                            <span class="text-gray-700">Permissions</span>
                            <select name="permissions[]"
                                class="block w-full p-3 mt-2 text-gray-800 appearance-none border-2 border-gray-100 focus:text-gray-500
                            focus:outline-none focus:border-gray-200 rounded-md" multiple>
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->id }}" @selected($role->hasPermission($permission->name))>{{ $permission->name }}</option>
                                @endforeach

                            </select>
                        </label>

                        {{-- <input value="tttttttttt" name="test" type="text"> --}}
                    </div>
                    <button type="submit"
                        class="w-full py-3 mt-10 bg-indigo-400 hover:bg-indigo-600 rounded-md font-medium text-white uppercase focus:outline-none hover:shadow-none">
                        {{ __('Assign Permissions') }}
                    </button>
                </form>
            </div>
        </div>
    @endif

</x-admin-layout>
