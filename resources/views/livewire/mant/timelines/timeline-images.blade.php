<div>
    <div class="card">
        <div class="card-body">
            <div class="flexslider max-h-80">
                <ul class="slides aspect-4/3">
                    @foreach ($timeline->images as $image)
                        <li>
                            <img src="{{ asset($image->url) }}" style="max-height:320px;:" />

                            <form wire:submit.prevent="delete({{ $image->id }})"
                                class="form-delete">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="image_id" value="{{ $image->id }}"/>
                                <button type="submit" class="cursor-pointer"><i class="text-red-500 fa-solid fa-trash-can cursor-pointer"></i></button>
                            </form>
                            <p class="text-blue-500">{{ $image->description }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
</div>

@push('scripts')
        <script>
            $(window).ready(function() {
                $('.flexslider').flexslider({
                    animation: "slide",
                });
            });

            window.addEventListener('imageAdd', function(e) {
                location.reload();
        });
        </script>
    @endpush
