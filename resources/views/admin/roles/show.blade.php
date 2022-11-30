<x-app-layout>
    <div class="container my-4">
        <form>
            @csrf
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">{{ __($title) }}</h1>
                    <div class="grid grid-cols-5 gap-3">
                        <div class="mb-4">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('name') }}" for="name" />
                            <x-jet-input type="text" name="name" class="w-full "
                                placeholder="{{ __('input name') }}" value="{{ old('name', $role->name) }}" />
                            <x-jet-input-error for="name" />
                            <hr class="mb-4">
                            <a type="button" href="{{ route('roles.index') }}"
                                class="bg-green-500 text-white hover:bg-green-400 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                {{ __('ok') }}
                            </a>


                        </div>
                        <div
                            class="flex flex-wrap gap-4 col-span-4 border w-full rounded items-center justify-between p-6">
                            @foreach ($permissions as $permission)
                                <label for="permissions">
                                    <input

                                    class="mr-2" type="checkbox" name="permissions[]" id="permissions"
                                        value="{{ $permission->id }}"
                                    @if(in_array($permission->id,$rolePermissions)) checked="checked" @endif
                                        >{{ $permission->permission }}
                                </label>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
