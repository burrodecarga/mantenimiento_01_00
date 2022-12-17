<x-app-layout>
    <div class="container my-4">
        <form>
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="grid grid-cols-5 gap-3">
                        <div class="mb-4 col-span-5 md:col-span-2 md:order-first p-2 border rounded">
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
                        <div class="col-span-5 order-first md:col-span-3  bg-slate-300 p-2 border rounded">
                            <h1 class="form-title">{{ __($title) }}</h1>
                            <p class="form-subtitle capitalize">{{ __('permissions assigned to the role') }}</p>
                        </div>
                        <div class="col-span-5 gap-3 border w-full rounded items-center justify-between p-6">
                        <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                            @foreach ($permissions as $permission)
                                <label for="permissions" class="bg-slate-300 px-3 py-2">
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
            </div>
        </form>
    </div>
</x-app-layout>
