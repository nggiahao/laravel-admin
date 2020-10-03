@extends(admin_view('layouts.app'))

@section('header')
    @include(admin_view('inc.header'))
@endsection

@section('main')
    <div class="app-body flex">
        @include(admin_view('inc.sidebar'))

        {{-- breadcrumb --}}
        <main class="relative pt-2 px-5 flex-1">
            <nav class="py-3 rounded w-full ">
                <ol class="flex justify-end">
                    <li><a href="#" class="text-primary">Admin</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li>Dashboard</li>
                </ol>
            </nav>

        </main>
    </div>
@endsection