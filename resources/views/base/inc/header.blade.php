<div class="ml-0 w-full z-10 flex items-center bg-main" style="box-shadow: 0 0 20px rgba(89,102,122,0.1);">
  <div class="w-full px-5 py-4 flex justify-between">
    <div class="flex items-center justify-between hidden md:flex md:z-10" style="width: calc(280px - 2.5rem)">
      <a href="{{url('/admin')}}" class="text-2xl leading-4">
        {!! config('admin.base.project_logo') !!}
      </a>
      <svg class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
           fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="3" width="7" height="7"></rect>
        <rect x="14" y="3" width="7" height="7"></rect>
        <rect x="14" y="14" width="7" height="7"></rect>
        <rect x="3" y="14" width="7" height="7"></rect>
      </svg>
    </div>
    <div class="mr-4 pr-3 border-r md:hidden flex items-center">
      <svg xmlns="http://www.w3.org/2000/svg" class="" width="24" height="24" viewBox="0 0 24 24" fill="none"
           stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="3" width="7" height="7"></rect>
        <rect x="14" y="3" width="7" height="7"></rect>
        <rect x="14" y="14" width="7" height="7"></rect>
        <rect x="3" y="14" width="7" height="7"></rect>
      </svg>
    </div>
    <div class="flex flex-wrap justify-end relative" x-data="{ open: false }">
      <div class="flex w-full justify-end cursor-pointer" @click="open = !open">
        <img class="w-10 h-10 rounded-md" src="http://admin.pixelstrap.com/cuba/assets/images/dashboard/profile.jpg">
        <div class="ml-4 hidden md:block">
          <p class="font-bold">{{admin_auth()->user()->name}}</p>
          <p class="text-xs opacity-75">Admin</p>
        </div>
      </div>
      <ul x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
          x-transition:enter-start="transform opacity-0 scale-95"
          x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
          x-transition:leave-start="transform opacity-100 scale-100"
          x-transition:leave-end="transform opacity-0 scale-95"
          class="justify-end w-40 p-3 absolute bg-white rounded-md" style="display: none; right: 0; top: 55px">
        <li class="py-3"><a class="" href="#" title="Account">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="inline-block">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
            <span>Account </span>
          </a></li>
        <hr>
        <li class="py-3"><a class="" href="#" title="Log out" onclick="
                        event.preventDefault();
                        document.getElementById('logout-form').submit();">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="inline-block">
              <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
              <polyline points="10 17 15 12 10 7"></polyline>
              <line x1="15" y1="12" x2="3" y2="12"></line>
            </svg>
            <span>Log out</span>
          </a>
          <form id="logout-form" action="{{route('admin.auth.logout')}}" method="POST" class="hidden">
            @csrf
          </form>
        </li>
      </ul>
    </div>
  </div>
</div>