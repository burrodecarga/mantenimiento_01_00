<article class="shadow-lg border border-gray-100 rounded p-2">
    <div class="card">
        <div class="card-body">
            <h1 class="text-xl font-bold text-gray-500 capitalize">{{ __("observations") }}</h1>
            <hr class="mt-2 mb-3">
            <form action=""wire:submit.prevent="saveObservation">
                <textarea wire:model="observation" class="rounded w-full h-full" placeholder="{{ __("input observations") }}"></textarea>
                <div class="mb-4">
                    <x-jet-input-error for="observation" />
                    <button type="submit"
                        class="bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 text-center ">
                        {{ __('create') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</article>
