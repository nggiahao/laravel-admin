@extends(admin_view('layouts.blank'))

@section('content')
  <div class="w-full mb-3">
    <h2 class="text-3xl font-semibold capitalize">{{$crud->entity_name_plural}}</h2>
  </div>

  <!-- THE ACTUAL CONTENT -->

  <div class="w-full bg-main p-6 rounded-large border relative">
    <form method="post"
          action="{{ url($crud->getRoute()) . '/store' }}"
    >
    @csrf
    <!--
                foreach fields, include file type tương ứng
            -->
    @foreach($crud->fields() as $field)
      <!-- TODO: include field blade with $field -->
        <div class="mb-6">
          <label class="font-semibold inline-block mb-2">{{$field['label']}}</label>
          <input class="form-input leading-4 outline-none w-full"
                 type="text" name="{{$field['name']}}" required>
        </div>
      @endforeach

      <button type="submit" class="btn btn-primary bg-gradient-primary">Save</button>

    </form>
  </div>
@endsection

@push('after_styles')

@endpush

@push('after_scripts')

@endpush