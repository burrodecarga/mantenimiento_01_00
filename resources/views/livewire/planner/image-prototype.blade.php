<div class="container mx-auto my-8">
    <div class="grid grid-cols-2 max-w-2xl mx-auto border gap-2 p-4 bg-white rounded">
        <form class=" mx-auto" wire:submit.prevent="save">
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
                    {{ __('submit') }}
                </x-jet-danger-button>



            </div>
        </form>
        <div class="mx-auto">
            @if ($file)
                <img src="{{ $file->temporaryUrl() }}" class="object-cover p-8 h-64 w-64">
            @endif
        </div>
    </div>
</div>


