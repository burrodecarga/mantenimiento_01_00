<x-app-layout>
    <div class="container mx-auto py-6">
        <div class="card">
            <div class="card-body">
                <img src="{{ asset('form/form2.jpg') }}" alt="agregar sistema"
                    class="max-h-16 w-full object-cover object-center">
                <h1
                    class="text-gray-500 font-bold text-2xl px-3 py-2 w-full bg-slate-100 font-mono text-center uppercase">
                    {{ $plan->name }}</h1>
                  <div id="calendar"></div>
            </div>
        </div>
    </div>

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <script src="{{ asset('js/locale-all.js') }}"></script>



    <script>

        $(document).ready(function() {

            var events = @json($events);
            $('#calendar').fullCalendar({
                locale: 'es',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },

                events: events
            })
        })

    </script>
@endpush

</x-app-layout>
