<aside
    class="max-w-62.5 ease-nav-brand fixed inset-y-0 my-4 ml-4 block w-full -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-gradient-orange p-0 antialiased shadow-none transition-transform duration-200 xl:left-0 xl:translate-x-0 xl:bg-transparent">
    <div class="h-19.5">
        <i class="absolute top-0 right-0 hidden p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden"
            sidenav-close></i>
        <a class="block px-8 py-6 m-0 text-size-sm whitespace-nowrap text-slate-700" href="{{ route('dashboard') }}"
            target="_blank">
            <img src="/img/logo.svg" class="inline h-full max-w-full transition-all duration-200 ease-nav-brand"
                alt="main_logo" />
        </a>
    </div>

    <hr class="h-px mt-0 bg-transparent bg-gradient-horizontal-dark mt-4" />

    <div class="items-center block w-auto max-h-screen h-sidenav grow basis-full">
        <ul class="flex flex-col pl-0 mb-0">

            <li class="mt-0.5 w-full">
                <a class="{{ request()->is('/') ? 'shadow-soft-xl bg-white font-semibold' : '' }}  ease-nav-brand flex font-semibold items-center mx-4 my-0 px-4 py-2.7 rounded-lg text-black text-lg text-size-sm text-slate-700 transition-colors whitespace-nowrap"
                    href="{{ route('dashboard') }}">
                    <div
                        class="{{ request()->is('/') ? 'bg-gradient-orange' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">

                        <i class="fa fa-dashboard fa-xs"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dashboard</span>
                </a>
            </li>
            @can('leads')
            <li class="mt-0.5 w-full">
                <a class="{{ request()->is('leads/*') || request()->is('leads') ? 'shadow-soft-xl bg-white font-semibold' : '' }} ease-nav-brand flex font-semibold items-center mx-4 my-0 px-4 py-2.7 rounded-lg text-black text-lg text-size-sm text-slate-700 transition-colors whitespace-nowrap"
                    href="{{ route('leads.index') }}">
                    <div
                        class="{{ request()->is('leads/*') || request()->is('leads') ? 'bg-gradient-orange' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <i class="fas fa-tram fa-xs"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Leads</span>
                </a>
            </li>
            @endcan
            
            @can('quotations')
            <li class="mt-0.5 w-full">
                <a class="{{ request()->is('quotations/*') || request()->is('quotations') ? 'shadow-soft-xl bg-white font-semibold' : '' }} ease-nav-brand flex font-semibold items-center mx-4 my-0 px-4 py-2.7 rounded-lg text-black text-lg text-size-sm text-slate-700 transition-colors whitespace-nowrap"
                    href="{{ route('quotations.index') }}">
                    <div
                        class="{{ request()->is('quotations/*') || request()->is('quotations') ? 'bg-gradient-orange' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <i class="fas fa-file-invoice-dollar fa-xs"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Quotation</span>
                </a>
            </li>
            @endcan

            @can('mails')
            <li class="mt-0.5 w-full">
                <a collapse_trigger="primary" class="{{ request()->is('mails/*') || request()->is('mails') ? 'shadow-soft-xl bg-white font-semibold' : '' }} ease-nav-brand flex font-semibold items-center mx-4 my-0 px-4 py-2.7 rounded-lg text-black text-lg text-slate-700 transition-colors whitespace-nowrap"
                aria-controls="emailMenu" role="button" aria-expanded="false">
                    <div
                        class="{{ request()->is('mails/*') || request()->is('mails') ? 'bg-gradient-orange' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <div class="text-slate-800">
                            <i class="fa fa-envelope fa-xs" aria-hidden="true"></i>
                        </div>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Mails</span>
                    <svg class="ml-auto w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </a>
                <div class="h-auto overflow-hidden transition-all rounded mx-auto bg-white w-[170px] ease-soft-in-out max-h-0" id="emailMenu">
                    <ul class="list-none transition-all duration-200 ease-soft-in-out">
                        <li class="w-full px-5 py-3">
                            <a class="font-medium text-base text-black" href="{{ route('mails.compose') }}">Compose</a>
                        </li>
                        <li class="w-full px-5 py-3">
                            <a class="font-medium text-base text-black" href="{{ route('mails.sent') }}">Sent</a>
                        </li>
                        <li class="w-full px-5 py-3">
                            <a class="font-medium text-base text-black" href="{{ route('mails.draft') }}">Draft</a>
                        </li>    
                        <li class="w-full px-5 py-3">    
                            <a class="font-medium text-base text-black" href="{{ route('mails.trash') }}">Trash</a>
                        </li> 
                    </ul>       
                </div>
            </li>
            @endcan

            @can('products')
            <li class="mt-0.5 w-full">
                <a class="{{ request()->is('products/*') || request()->is('products') ? 'shadow-soft-xl bg-white font-semibold' : '' }} ease-nav-brand flex font-semibold items-center mx-4 my-0 px-4 py-2.7 rounded-lg text-black text-lg text-size-sm text-slate-700 transition-colors whitespace-nowrap"
                    href="{{ route('products.index') }}">
                    <div
                        class="{{ request()->is('products/*') || request()->is('products') ? 'bg-gradient-orange' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center fill-current stroke-0 text-center xl:p-2.5">
                        <i class="fas fa-archive fa-xs"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Products</span>
                </a>

            </li>
            @endcan

            @can('lead-managers')
            <li class="mt-0.5 w-full">
                <a class="{{ request()->is('lead_managers/*') || request()->is('lead_managers') ? 'shadow-soft-xl bg-white font-semibold' : '' }} ease-nav-brand flex font-semibold items-center mx-4 my-0 px-4 py-2.7 rounded-lg text-black text-lg text-size-sm text-slate-700 transition-colors whitespace-nowrap"
                    href="{{ route('lead_managers.index') }}">
                    <div
                        class="{{ request()->is('lead_managers/*') || request()->is('lead_managers') ? 'bg-gradient-orange' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <div class="text-slate-800">
                            <i class="fa fa-users fa-xs" aria-hidden="true"></i>
                        </div>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Lead Manager</span>
                </a>
            </li>
            @endcan

            @can('activities')
            <li class="mt-0.5 w-full">
                <a class="{{ request()->is('activities/*') || request()->is('activities') ? 'shadow-soft-xl bg-white font-semibold' : '' }} ease-nav-brand flex font-semibold items-center mx-4 my-0 px-4 py-2.7 rounded-lg text-black text-lg text-size-sm text-slate-700 transition-colors whitespace-nowrap"
                    href="{{ route('activities.index') }}">
                    <div
                        class="{{ request()->is('activities/*') || request()->is('activities') ? 'bg-gradient-orange' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <i class="fas fa-file-alt fa-xs" aria-hidden="true"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Activities</span>
                </a>
            </li>   
            @endcan

            @if (auth()->user()->hasAnyPermission(['users', 'roles', 'lead-sources', 'lead-types', 'email-templates', 'trip', 'trip-types', 'accomodations', 'transports']))
            <li class="mt-0.5 w-full">
                <a class="{{ request()->is('settings/*') || request()->is('settings') ? 'shadow-soft-xl bg-white font-semibold' : '' }} ease-nav-brand flex font-semibold items-center mx-4 my-0 px-4 py-2.7 rounded-lg text-black text-lg text-size-sm text-slate-700 transition-colors whitespace-nowrap"
                    href="{{ route('settings.index') }}">
                    <div
                        class="{{ request()->is('settings/*') || request()->is('settings') ? 'bg-gradient-orange' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <i class="fa fa-cog fa-xs" aria-hidden="true"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Settings</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</aside>
