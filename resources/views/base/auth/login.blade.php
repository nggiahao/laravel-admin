@extends(admin_view('layouts.app'))

@section('main')
    <div class="flex flex-col flex-auto justify-center items-center">
        <div class="text-center w-full max-w-full md:max-w-md p-6 overflow-hidden relative">
            <div class="mb-16">
                <h3 class="text-3xl font-bold mb-2">Login To Admin</h3>
                <p class="opacity-75 text-sm">Enter your details to login to your account:</p>
            </div>
            <form method="POST" action="" class="mb-6">
                @csrf
                <div class="mb-6">
                    <input class="bg-gray-200 border-none leading-4 outline-none w-full px-8 py-4"
                           type="text" placeholder="Email" name="email" required>
                </div>
                <div class="mb-6">
                    <input class="bg-gray-200 border-none leading-4 outline-none w-full px-8 py-4"
                           type="password" placeholder="Password" name="password" required>
                </div>
                <div class="flex mb-6">
                    <label class="w-1/2 text-left">
                        <input class="form-checkbox border-gray-500" type="checkbox">
                        <span>Remember me</span>
                    </label>
                    <div class="w-1/2 text-right">
                        <a href="{{route('admin.password.request')}}" class="text-right hover:font-bold hover:text-primary">Forget Password?</a>
                    </div>
                </div>
                <div class="mb-6">
                    <button type="submit" class="btn btn-primary bg-gradient-primary leading-4 rounded-large text-lg px-8 py-4">Login
                    </button>
                </div>
            </form>
            <div>
                <span class="mr-3">Don't have an account yet?</span>
                <a href="{{route('admin.auth.register')}}" class="text-right hover:font-bold hover:text-primary">Register</a>
            </div>
        </div>
    </div>
@endsection