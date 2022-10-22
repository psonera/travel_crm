<nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start"
    navbar-main navbar-scroll="true">
    <div class="flex items-center justify-between w-full px-2 py-1 mx-auto flex-wrap-inherit">
        {{ Breadcrumbs::render() }}

        <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
            {{-- <div class="flex items-center md:ml-auto md:pr-4">
                <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft">
                    <span
                        class="text-size-sm ease-soft leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text"
                        class="pl-8.75 text-size-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                        placeholder="Type here..." />
                </div>
            </div> --}}
            <ul class="flex flex-row justify-end md:ml-auto pl-0 mb-0 list-none md-max:w-full">
                <!-- online builder btn  -->
                <li class="flex items-center pl-4 xl:hidden">
                    <a href="javascript:;" class="block p-0 transition-all ease-nav-brand text-size-sm text-slate-500"
                        sidenav-trigger>
                        <div class="w-4.5 overflow-hidden">
                            <i
                                class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                            <i
                                class="ease-soft mb-0.75 relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                            <i class="ease-soft relative block h-0.5 rounded-sm bg-slate-500 transition-all"></i>
                        </div>
                    </a>
                </li>
                <li class="flex items-center pl-4 relative">
                    <div class="">
                        <button type="button" dropdown-trigger aria-expanded="false"
                            class="p-2 text-gray-500 rounded-2xl hover:text-gray-900 hover:bg-gray-100">
                            <span class="sr-only">View notifications</span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                </path>
                            </svg>
                        </button>
                        <p class="hidden transform-dropdown-show"></p>
                        <div dropdown-menu
                            class="text-size-sm transform-dropdown before:font-awesome before:leading-default before:duration-350 before:ease-soft lg:shadow-soft-3xl duration-250 min-w-[350px] before:sm:right-7.5 before:text-5.5 pointer-events-none absolute right-0 top-0 z-50 origin-top list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding text-left text-slate-500 opacity-0 transition-all before:absolute before:right-2 before:left-auto before:top-0 before:z-50 before:inline-block before:font-normal before:text-white before:antialiased before:transition-all before:content-['\f0d8'] sm:-mr-6 lg:absolute lg:right-[43px] lg:left-auto lg:mt-2 lg:block lg:cursor-pointer">
                            <div class="block py-2 px-4 text-base font-medium text-center text-gray-700 bg-gray-50">
                                Apps
                            </div>
                            <div class="grid grid-cols-3 gap-4 p-4">
                                @can('create.leads')
                                <a href="{{ route('leads.create') }}"
                                    class="block p-4 text-center rounded-2xl hover:bg-gray-100 cursor-pointer">
                                    <i class="fas fa-tram fa-2x mb-1" aria-hidden="true"></i>
                                    <div class="text-sm font-medium text-gray-900">Leads</div>
                                </a>
                                @endcan
                                @can('create.quotations')            
                                <a href="{{ route('quotations.create') }}"
                                    class="block p-4 text-center rounded-2xl hover:bg-gray-100 cursor-pointer">
                                    <i class="fas fa-file-invoice-dollar fa-2x mb-1" aria-hidden="true"></i>
                                    <div class="text-sm font-medium text-gray-900">Quotations</div>
                                </a>
                                @endcan
                                @can('compose.mails') 
                                <a href="{{ route('mails.compose') }}"
                                    class="block p-4 text-center rounded-2xl hover:bg-gray-100 cursor-pointer">
                                    <i class="fa fa-envelope fa-2x mb-1" aria-hidden="true"></i>
                                    <div class="text-sm font-medium text-gray-900">Email</div>
                                </a>
                                @endcan
                                @can('create.users')
                                <a href="{{ route('settings.users.create') }}"
                                    class="block p-4 text-center rounded-2xl hover:bg-gray-100 cursor-pointer">
                                    <i class="fa fa-users fa-2x mb-1" aria-hidden="true"></i>
                                    <div class="text-sm font-medium text-gray-900">Users</div>
                                </a>
                                @endcan
                                @can('create.lead-managers')
                                <a href="{{ route('lead_managers.create') }}"
                                    class="block p-4 text-center rounded-2xl hover:bg-gray-100 cursor-pointer">
                                    <i class="fas fa-user-tie fa-2x mb-1" aria-hidden="true"></i>
                                    <div class="text-sm font-medium text-gray-900">Managers</div>
                                </a>
                                @endcan
                                
                                <a href="{{ route('settings.index') }}"
                                    class="block p-4 text-center rounded-2xl hover:bg-gray-100 cursor-pointer">
                                    <i class="fa fa-cog fa-2x mb-1" aria-hidden="true"></i>
                                    <div class="text-sm font-medium text-gray-900">Settings</div>
                                </a>
                                
                                @can('create.products')
                                <a href="{{ route('products.create') }}"
                                    class="block p-4 text-center rounded-2xl hover:bg-gray-100 cursor-pointer">
                                    <i class="fas fa-archive fa-2x mb-1" aria-hidden="true"></i>
                                    <div class="text-sm font-medium text-gray-900">Products</div>
                                </a>
                                @endcan
                                @can('create.trips')
                                <a href="{{ route('settings.trips.create') }}"
                                    class="block p-4 text-center rounded-2xl hover:bg-gray-100 cursor-pointer">
                                    <i class="fa fa-plane fa-2x mb-1" aria-hidden="true"></i>
                                    <div class="text-sm font-medium text-gray-900">Trips</div>
                                </a>
                                @endcan
                                @can('create.users')
                                <a href="{{ route('profile.edit', Auth::user()) }}"
                                    class="block p-4 text-center rounded-2xl hover:bg-gray-100 cursor-pointer">
                                    <i class="fas fa-id-card fa-2x mb-1" aria-hidden="true"></i>
                                    <div class="text-sm font-medium text-gray-900">Profile</div>
                                </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </li>

                <!-- notifications -->
                <li class="relative flex items-center px-4">
                    <p class="hidden transform-dropdown-show"></p>
                    <div class="block p-0 transition-all text-size-sm ease-nav-brand text-slate-500"
                        {{ count(auth()->user()->unreadNotifications) > 0 ? 'dropdown-trigger' :'' }} aria-expanded="false">
                        <i class="cursor-pointer fa fa-bell fa-lg"></i>
                        <div class="inline-flex absolute -top-2 -right-0 justify-center items-center w-6 h-6 text-xs font-bold text-white bg-red-500 rounded-full border-2 border-white dark:border-gray-900">{{ count(auth()->user()->unreadNotifications) }}</div>
                    </div>

                    <ul {{ count(auth()->user()->unreadNotifications) > 0 ? 'dropdown-menu' :'' }}
                        class="text-size-sm transform-dropdown whitespace-nowrap before:font-awesome before:leading-default before:duration-350 before:ease-soft lg:shadow-soft-3xl duration-250 min-w-44 before:sm:right-7.5 before:text-5.5 pointer-events-none absolute right-0 top-0 z-50 origin-top list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:right-2 before:left-auto before:top-0 before:z-50 before:inline-block before:font-normal before:text-white before:antialiased before:transition-all before:content-['\f0d8'] sm:-mr-6 lg:absolute lg:right-[25px] lg:left-auto lg:mt-2 lg:block lg:cursor-pointer">
                        <!-- add show class on dropdown open js -->
                        @foreach (auth()->user()->unreadNotifications as $notification)
                            <li class="relative mb-2 group">
                                <a class="ease-soft py-1.2 clear-both block w-full rounded-lg bg-transparent px-4 duration-300 hover:bg-gray-200 hover:text-slate-700 lg:transition-colors"
                                    href="{{ route('notifications.markasread', $notification->id) }}">
                                    <div class="flex py-1 group-hover:opacity-20">
                                        <div class="my-auto">
                                            <img src="{{ $notification->data['subject'] == 'activity' ? '/img/work-time.png' : '/img/funnel.png' }}"
                                                class="inline-flex items-center justify-center mr-4 text-white text-size-sm h-9 w-9 max-w-none rounded-xl" />
                                        </div>
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-1 font-normal leading-normal text-size-sm">{{ $notification->data['message'] }}</h6>
                                            <p class="mb-0 leading-tight text-size-xs text-slate-400">
                                                <i class="mr-1 fa fa-clock"></i>
                                                {{ $notification->created_at->diffForHumans(); }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="absolute group-hover:opacity-100 left-[210px] opacity-0 top-3">
                                        <span class="text-xl text-black font-bold leading-relaxed font-sans">Click to Mark as Read</span> 
                                    </div>
                                </a>
                                
                            </li>
                        @endforeach
                        <div class="block py-2 px-4 text-base font-medium text-center text-gray-700 bg-gray-50">
                            <a href="{{ route('notifications.markallread') }}">Mark All As Read</a>
                        </div>
                    </ul>
                </li>

                {{-- profile --}}
                <li class="relative flex items-center pr-2">
                    <div class="ml-3">
                        <button type="button" 
                            class="flex text-sm bg-gray-200 rounded-full focus:ring-4 focus:ring-gray-300"
                                aria-expanded="false" dropdown-trigger>
                            <span class="sr-only">Open user menu</span>
                            {{-- {{ dd()  }} --}}
                            <img class="w-8 h-8 rounded-full p-1" src="{{url('/img/user.png')}}"
                                alt="user image">
                        </button>
                        <p class="hidden transform-dropdown-show"></p>
                        <div dropdown-menu class="text-size-sm transform-dropdown before:font-awesome before:leading-default before:duration-350 before:ease-soft lg:shadow-soft-3xl duration-250 min-w-44 before:sm:right-7.5 before:text-5.5 pointer-events-none absolute right-0 top-0 z-50 origin-top list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding text-left text-slate-500 opacity-0 transition-all before:absolute before:right-2 before:left-auto before:top-0 before:z-50 before:inline-block before:font-normal before:text-white before:antialiased before:transition-all before:content-['\f0d8'] sm:-mr-6 lg:absolute lg:right-[36px] lg:top-[5px] lg:left-auto lg:mt-2 lg:block lg:cursor-pointer">
                            <div class="py-3 px-4" role="none">
                                <p class="text-sm" role="none">
                                    {{ Auth::user()->name }}
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate" role="none">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="{{ URL::to('/'); }}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem"> <i class="fa fa-dashboard"></i>  Dashboard</a>
                                </li>
                                <li>
                                    <a href="{{ route('settings.index') }}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem"><i class="fa fa-cog" aria-hidden="true"></i>  Settings</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem"><i class="fa fa-sign-out" aria-hidden="true"></i>  Log out</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
