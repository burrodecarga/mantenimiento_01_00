<div class="container mx-auto my-8">
    <div class="card max-w-3xl mx-auto">
        <div class="card-body ">
            <img src="{{ asset('form/form2.jpg') }}" alt="agregar sistema"
                class="max-h-16 w-full object-cover object-center">
            <h1
                class="text-gray-500 font-bold text-2xl px-3 py-2 w-full bg-slate-100 font-mono text-center uppercase">
                {{ __("add image") }}</h1>

                <div class="grid grid-cols-2 mx-auto border gap-4 my-2 bg-white rounded p-2">
                    <form class="mx-auto bg-slate-200 p-2 rounded" wire:submit.prevent="save">
                        <div class="mb-4">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('description') }}" for="description" />
                            <textarea type="text" wire:model="description" class="w-full rounded"
                                placeholder="{{ __('input description') }}" ></textarea>
                            <x-jet-input-error for="description" />
                        </div>
                        <div class="mb-4">
                            <x-jet-label class="italic my-2 capitalize" value="{{ __('imagen') }}" for="description" />
                            <input type="file" wire:model="file">
                            <x-jet-input-error for="file" />
                        </div>
                        <div class="mb-4">
                            <a type="button" href="{{ route('prototypes.index') }}"
                                class="bg-yellow-500 text-white hover:bg-yellow-400 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                {{ __('cancel') }}
                            </a>

                            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save,file"
                                class="bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                {{ __('create') }}
                            </x-jet-danger-button>



                        </div>
                    </form>
                    <div class="w-full">
                        @if ($file)
                            <img src="{{ $file->temporaryUrl() }}" class="object-cover p-8 h-64 w-64">
                        @else
                        <img src="{{ asset('form/form2.jpg') }}" class="object-center object-cover p-8 h-64 w-64 m-0">
                        @endif
                    </div>
                </div>
        </div>
    </div>
</div>


