@extends(admin_view('layouts.blank'))

@section('content')
    <div class="w-full mb-3">
        <h2 class="text-3xl font-semibold capitalize">{{$crud->entity_name_plural}}</h2>
    </div>

    <!-- THE ACTUAL CONTENT -->
    <div class="w-full relative">
        @dump($entry->toArray())
    </div>
@endsection