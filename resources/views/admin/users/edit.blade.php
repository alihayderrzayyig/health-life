<x-admin-layout>
    <div class="mt-12 max-w-6xl mx-auto bg-slate-50 rounded p-5">
        <div class="flex my-2 py-2">
            <a href="{{ route('admin.users.index') }}"
                class="px-4 py-2 bg-indigo-400 hover:bg-indigo-600 rounded">Back</a>
        </div>
        <div class="max-w-md mx-auto bg-gray-100 p-6 mt-12 rounded">
            <form method="POST"
                action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}"
                class="space-y-5">
                @csrf
                @if (isset($user))
                    @method('PUT')
                @endif

                <div>
                    <label for="name" class="text-xl">Name</label>
                    <input id="name" name="name" type="text"
                        class="block w-full p-3 mt-2 text-gray-800 appearance-none border-2 border-gray-100 focus:text-gray-500
                    focus:outline-none focus:border-gray-200 rounded-md"
                        value="{{ isset($user) ? $user->name : '' }}" />
                    @error('name')
                        <span class="text-sm text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="name" class="text-xl">Email</label>
                    <input id="name" name="email" type="text"
                        class="block w-full p-3 mt-2 text-gray-800 appearance-none border-2 border-gray-100 focus:text-gray-500
                    focus:outline-none focus:border-gray-200 rounded-md"
                        value="{{ isset($user) ? $user->email : '' }}" />
                    @error('email')
                        <span class="text-sm text-red-400">{{ $message }}</span>
                    @enderror
                </div>
                @if (isset($user))
                    <div>
                        <label class="xt-xl" style="max-width: 300px">
                            <span class="text-gray-700">Role:</span>
                            <select name="role_id"
                                class="block w-full p-3 mt-2 text-gray-800 appearance-none border-2 border-gray-100 focus:text-gray-500
                        focus:outline-none focus:border-gray-200 rounded-md"
                                >
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @selected($user->hasRole($role->name))>
                                        {{ $role->name }}</option>
                                @endforeach

                            </select>
                        </label>
                    </div>
                @endif

                <button type="submit"
                    class="w-full py-3 mt-10 bg-indigo-400 hover:bg-indigo-600 rounded-md font-medium text-white uppercase focus:outline-none hover:shadow-none">
                    {{ isset($user) ? __('Update') : __('Create') }}
                </button>
            </form>
        </div>
    </div>

</x-admin-layout>
