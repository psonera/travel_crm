<x-app-layout>
    <section class="flex-wrap -mx-3">
        @if(auth()->user()->hasAnyPermission(['users', 'roles']))
        {{-- User Section --}}
        <div class="p-4">
            <!--Title-->
            <div>
                <h2 class="font-sans font-bold break-normal text-gray-700 px-2 text-2xl">Users</h2>
                <p class="text-xl px-2 pb-2">Manage all your users and their permissions in the CRM, what they’re allowed
                    to do.
                </p>
            </div>
            <!--Card-->
            <div class="p-8 mt-6 lg:mt-0 leading-normal rounded shadow bg-white flex flex-row">
                @can('users')
                {{-- Users Card --}}
                <a href="{{ route('settings.users.index') }}" class="max-w-full w-3/10">
                    <div
                        class=" bg-white dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 flex group hover:bg-gray-100 items-center md:p-6 relative rounded-lg">
                        <div class="fa-3x h-96 md:h-auto md:rounded-l-lg md:rounded-none rounded-t-lg">
                            <i class="fa fa-users" aria-hidden="true"></i>
                        </div>
                        <div class="-mt-8 leading-normal px-4">
                            <h5 class="dark:text-white font-bold text-2xl text-gray-900 tracking-tight pt-6 group-hover:pt-0 group-hover:pb-1">Users</h5>
                            <div class="absolute absolute group-hover:block hidden md:w-2/3 text-sm">Add, Edit or Delete Users from Thrill Blazers
                                LMS</div>
                        </div>
                    </div>
                </a>
                @endcan

                @can('roles')
                {{-- Roles Card --}}
                <a href="{{ route('settings.roles.index') }}"  class="max-w-full w-3/10">
                    <div
                        class="bg-white dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 flex group hover:bg-gray-100 items-center md:p-6 relative rounded-lg">
                        <div class="fa-3x h-96 md:h-auto md:rounded-l-lg md:rounded-none rounded-t-lg">
                            <i class="fa fa-building" aria-hidden="true"></i>
                        </div>
                        <div class="-mt-8 leading-normal px-4">
                            <h5 class="dark:text-white font-bold text-2xl text-gray-900 tracking-tight pt-6 group-hover:pt-0 group-hover:pb-1">Roles</h5>
                            <div class="absolute group-hover:block hidden md:w-2/3 text-sm">Add, Edit or Delete Roles from Thrill Blazers
                                LMS</div>
                        </div>
                    </div>
                </a>
                @endcan
            </div>
            <!--/Card-->
        </div>
        <!--divider-->
        <hr class="bg-gray-300 my-4">
        @endif

        @if(auth()->user()->hasAnyPermission(['lead-sources', 'lead-types']))
        {{-- Leads Section --}}
        <div class="p-4">
            <!--Title-->
            <div>
                <h2 class="font-sans font-bold break-normal text-gray-700 px-2 text-2xl">Leads</h2>
                <p class="text-xl px-2 pb-2">Manage all your leads related settings in the CRM
                </p>
            </div>
            <!--Card-->
            <div class="p-8 mt-6 lg:mt-0 leading-normal rounded shadow bg-white flex flex-row">
                @can('lead-sources')
                {{-- Sources Card --}}
                <a href="{{ route('settings.lead_sources.index') }}"  class="max-w-full w-3/10">
                    <div
                        class="bg-white dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 flex group hover:bg-gray-100 items-center md:p-6 relative rounded-lg">
                        <div class="fa-3x h-96 md:h-auto md:rounded-l-lg md:rounded-none rounded-t-lg">
                            <i class="fa fa-connectdevelop" aria-hidden="true"></i>
                        </div>
                        <div class="-mt-8 leading-normal px-4">
                            <h5 class="dark:text-white font-bold text-2xl text-gray-900 tracking-tight pt-6 group-hover:pt-0 group-hover:pb-1">Sources</h5>
                            <div class="absolute group-hover:block hidden md:w-2/3 text-sm">Add, Edit or Delete Sources from Thrill Blazers
                                LMS</div>
                        </div>
                    </div>
                </a>
                @endcan

                @can('lead-types')
                {{-- Types Card --}}
                <a href="{{ route('settings.lead_types.index') }}" class="max-w-full w-3/10">
                    <div
                        class="bg-white dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 flex group hover:bg-gray-100 items-center md:p-6 relative rounded-lg">
                        <div class="fa-3x h-96 md:h-auto md:rounded-l-lg md:rounded-none rounded-t-lg">
                            <i class="fa fa-asterisk" aria-hidden="true"></i>
                        </div>
                        <div class="-mt-8 leading-normal px-4">
                            <h5 class="dark:text-white font-bold text-2xl text-gray-900 tracking-tight pt-6 group-hover:pt-0 group-hover:pb-1">Types</h5>
                            <div class="absolute group-hover:block hidden md:w-2/3 text-sm">Add, Edit or Delete Types from Thrill Blazers
                                LMS</div>
                        </div>
                    </div>
                </a>
                @endcan

                @can('lead-pipeline-stages')
                {{-- Types Card --}}
                <a href="{{ route('settings.lead_pipeline_stages.index') }}" class="max-w-full w-3/10">
                    <div
                        class="bg-white dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 flex group hover:bg-gray-100 items-center md:p-6 relative rounded-lg">
                        <div class="fa-3x h-96 md:h-auto md:rounded-l-lg md:rounded-none rounded-t-lg">
                            <i class="fas fa-layer-group" aria-hidden="true"></i>
                        </div>
                        <div class="-mt-8 leading-normal px-4">
                            <h5 class="dark:text-white font-bold text-2xl text-gray-900 tracking-tight pt-6 group-hover:pt-0 group-hover:pb-1">Pipeline Stages</h5>
                            <div class="absolute group-hover:block hidden md:w-2/3 text-sm">Add, Edit or Delete Pipeline Stages from Thrill Blazers
                                LMS</div>
                        </div>
                    </div>
                </a>
                @endcan
            </div>
            <!--/Card-->
        </div>
        <!--divider-->
        <hr class="bg-gray-300 my-4">
        @endif

        @if(auth()->user()->hasAnyPermission(['trips', 'trip-types', 'accomodations', 'transports']))
        {{-- Trip Section --}}
        <div class="p-4">
            <!--Title-->
            <div>
                <h2 class="font-sans font-bold break-normal text-gray-700 px-2 text-2xl">Trips</h2>
                <p class="text-xl px-2 pb-2">Manage all your trips, its types & accomodations in the CRM.
                </p>
            </div>
            <!--Card-->
            <div class="p-8 mt-6 lg:mt-0 leading-normal rounded shadow bg-white flex flex-row flex-wrap">
                @can('trips')
                {{-- Trips Card --}}
                <a href="{{ route('settings.trips.index') }}" class="max-w-full w-3/10">
                    <div
                        class="bg-white dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 flex group hover:bg-gray-100 items-center md:p-6 relative rounded-lg">
                        <div
                            class="fa-3x h-96 md:h-auto md:rounded-l-lg md:rounded-none rounded-t-lg">
                            <i class="fa fa-plane" aria-hidden="true"></i>
                        </div>
                        <div class="-mt-8 leading-normal px-4">
                            <h5 class="dark:text-white font-bold text-2xl text-gray-900 tracking-tight pt-6 group-hover:pt-0 group-hover:pb-1">Trips</h5>
                            <div class="absolute group-hover:block hidden md:w-2/3 text-sm">Add, Edit or Delete Trips from Thrill
                                Blazers
                                LMS</div>
                        </div>
                    </div>
                </a>
                @endcan

                @can('trip-types')
                {{-- Trip Types Card --}}
                <a href="{{ route('settings.trip_types.index') }}" class="max-w-full w-3/10">
                    <div
                        class="bg-white dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 flex group hover:bg-gray-100 items-center md:p-6 relative rounded-lg">
                        <div
                            class="fa-3x h-96 md:h-auto md:rounded-l-lg md:rounded-none rounded-t-lg">
                            <i class="fa fa-sitemap" aria-hidden="true"></i>
                        </div>
                        <div class="-mt-8 leading-normal px-4">
                            <h5 class="dark:text-white font-bold text-2xl text-gray-900 tracking-tight pt-6 group-hover:pt-0 group-hover:pb-1">Types</h5>
                            <div class="absolute group-hover:block hidden md:w-2/3 text-sm">Add, Edit or Delete Trip Types from Thrill
                                Blazers
                                LMS</div>
                        </div>
                    </div>
                </a>
                @endcan

                @can('accomodations')
                {{-- Trip Accomodation Card --}}
                <a href="{{ route('settings.accomodations.index') }}" class="max-w-full w-3/10">
                    <div
                        class="bg-white dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 flex group hover:bg-gray-100 items-center md:p-6 relative rounded-lg">
                        <div
                            class="fa-3x h-96 md:h-auto md:rounded-l-lg md:rounded-none rounded-t-lg">
                            <i class="fa fa-bed" aria-hidden="true"></i>
                        </div>
                        <div class="-mt-8 leading-normal px-4">
                            <h5 class="dark:text-white font-bold text-2xl text-gray-900 tracking-tight pt-6 group-hover:pt-0 group-hover:pb-1">Accomodations</h5>
                            <div class="absolute group-hover:block hidden md:w-2/3 text-sm">Add, Edit or Delete Accomodations from Thrill
                                Blazers
                                LMS</div>
                        </div>
                    </div>
                </a>
                @endcan

                @can('transports')
                {{-- Trip Transport Card --}}
                <a href="{{ route('settings.transports.index') }}" class="max-w-full w-3/10">
                    <div
                        class="bg-white dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 flex group hover:bg-gray-100 items-center md:p-6 relative rounded-lg">
                        <div
                            class="fa-3x h-96 md:h-auto md:rounded-l-lg md:rounded-none rounded-t-lg">
                            <i class="fas fa-taxi" aria-hidden="true"></i>
                        </div>
                        <div class="-mt-8 leading-normal px-4">
                            <h5 class="dark:text-white font-bold text-2xl text-gray-900 tracking-tight pt-6 group-hover:pt-0 group-hover:pb-1">Transportations</h5>
                            <div class="absolute group-hover:block hidden md:w-2/3 text-sm">Add, Edit or Delete Transportations from Thrill
                                Blazers
                                LMS</div>
                        </div>
                    </div>
                </a>
                @endcan
            </div>
            <!--/Card-->
        </div>
        <!--divider-->
        <hr class="bg-gray-300 my-4">
        @endif
</x-app-layout>
