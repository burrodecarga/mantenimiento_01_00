<article class="shadow-lg border border-gray-100 rounded p-2">
    <div class="card">
        <div class="card-body">
            <h1 class="text-xl font-bold text-gray-500">Agregar Servicio</h1>
            <hr class="mt-2 mb-3">

            <form method="post" class="text-xs" wire:submit.prevent="saveReplacement">
                <select wire:model="serviceId" class="select w-full">
                   <option value="">Select Service</option>
                    @foreach ($services as $r)
                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="serviceId" />

                <div class="mb-4">
                    <x-jet-label class="italic my-2 capitalize" value="{{ __('price') }}" for="price" />
                    <input type="text" wire:model.defer="price" id="price"class="w-full rounded "
                        placeholder="{{ __('input price') }}" value="" />
                    <x-jet-input-error for="price" />
                </div>

                <div class="mb-4">
                    <button type="submit"
                        class="bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1 text-center">
                        {{ __('submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</article>


@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.select').select2();
            $('.select').on('select2:select', function (e) {
   var data = e.params.data;
   @this.serviceId = data.id
   console.log(data);
});


        });
    </script>
@endpush
