<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

  <meta name="csrf-token"
        content="{{ csrf_token() }}"/> {{-- Encrypted CSRF token for Laravel, in order for Ajax requests to work --}}
  <title>{{ isset($title) ? $title.' :: '.config('admin.base.project_name') : config('admin.base.project_name') }}</title>

  @if (config('admin.base.styles') && count(config('admin.base.styles')))
    @foreach (config('admin.base.styles') as $path)
      <link rel="stylesheet" type="text/css" href="{{ asset($path)}}">
    @endforeach
  @endif

  @stack('after_styles')
</head>
<body class="overflow-hidden relative flex flex-col h-screen">

@yield('header')

@yield('main')

@yield('footer')

@if (config('admin.base.scripts') && count(config('admin.base.styles')))
  @foreach (config('admin.base.scripts') as $path)
    <script src="{{ asset($path)}}"></script>
  @endforeach
@endif

@stack('after_scripts')

</body>
</html>
