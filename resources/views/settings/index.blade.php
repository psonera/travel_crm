<x-app-layout>
    <section class="flex-wrap -mx-3">
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
                {{-- Users Card --}}
                <a href="{{ route('settings.index') }}">
                    <div
                        class="flex-grow bg-white dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 flex flex-col group hover:bg-gray-100 items-center md:flex-row md:p-4 md:w-4/5 rounded-lg">
                        <div class="fa-3x h-96 md:h-auto md:rounded-l-lg md:rounded-none md:w-18.5 ml-auto rounded-t-lg">
                            <i class="fa fa-users" aria-hidden="true"></i>
                        </div>
                        <div class="flex flex-col justify-between leading-normal mr-auto p-4">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Users</h5>
                            <div class="group-hover:block hidden md:w-2/3 text-sm">Add, Edit or Delete Users from Thrill Blazers
                                LMS</div>
                        </div>
                    </div>
                </a>

                {{-- Roles Card --}}
                <a href="{{ route('settings.index') }}">
                    <div
                        class="flex-grow bg-white dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 flex flex-col group hover:bg-gray-100 items-center md:flex-row md:p-4 md:w-4/5 rounded-lg">
                        <div class="fa-3x h-96 md:h-auto md:rounded-l-lg md:rounded-none md:w-18.5 ml-auto rounded-t-lg">
                            <i class="fa fa-building" aria-hidden="true"></i>
                        </div>
                        <div class="flex flex-col justify-between leading-normal mr-auto p-4">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Roles</h5>
                            <div class="group-hover:block hidden md:w-2/3 text-sm">Add, Edit or Delete Roles from Thrill Blazers
                                LMS</div>
                        </div>
                    </div>
                </a>
            </div>
            <!--/Card-->
        </div>
        <!--divider-->
        <hr class="bg-gray-300 my-4">

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
                {{-- Pipelines Card --}}
                <a href="{{ route('settings.lead_pipelines.index') }}">
                    <div
                        class="flex-grow bg-white dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 flex flex-col group hover:bg-gray-100 items-center md:flex-row md:p-4 md:w-4/5 rounded-lg">
                        <div class="fa-3x h-96 md:h-auto md:rounded-l-lg md:rounded-none md:w-18.5 ml-auto rounded-t-lg">
                            <i class="fa fa-thumb-tack" aria-hidden="true"></i>
                        </div>
                        <div class="flex flex-col justify-between leading-normal mr-auto p-4">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Pipelines</h5>
                            <div class="group-hover:block hidden md:w-2/3 text-sm">Add, Edit or Delete Pipelines from Thrill Blazers
                                LMS</div>
                        </div>
                    </div>
                </a>

                {{-- Sources Card --}}
                <a href="{{ route('settings.lead_sources.index') }}">
                    <div
                        class="flex-grow bg-white dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 flex flex-col group hover:bg-gray-100 items-center md:flex-row md:p-4 md:w-4/5 rounded-lg">
                        <div class="fa-3x h-96 md:h-auto md:rounded-l-lg md:rounded-none md:w-18.5 ml-auto rounded-t-lg">
                            <i class="fa fa-connectdevelop" aria-hidden="true"></i>
                        </div>
                        <div class="flex flex-col justify-between leading-normal mr-auto p-4">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Sources</h5>
                            <div class="group-hover:block hidden md:w-2/3 text-sm">Add, Edit or Delete Sources from Thrill Blazers
                                LMS</div>
                        </div>
                    </div>
                </a>

                {{-- Types Card --}}
                <a href="{{ route('settings.lead_types.index') }}">
                    <div
                        class="flex-grow bg-white dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 flex flex-col group hover:bg-gray-100 items-center md:flex-row md:p-4 md:w-4/5 rounded-lg">
                        <div class="fa-3x h-96 md:h-auto md:rounded-l-lg md:rounded-none md:w-18.5 ml-auto rounded-t-lg">
                            <i class="fa fa-asterisk" aria-hidden="true"></i>
                        </div>
                        <div class="flex flex-col justify-between leading-normal mr-auto p-4">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Types</h5>
                            <div class="group-hover:block hidden md:w-2/3 text-sm">Add, Edit or Delete Types from Thrill Blazers
                                LMS</div>
                        </div>
                    </div>
                </a>
            </div>
            <!--/Card-->
        </div>
        <!--divider-->
        <hr class="bg-gray-300 my-4">

        {{-- Automation Section --}}
        <div class="p-4">
            <!--Title-->
            <div>
                <h2 class="font-sans font-bold break-normal text-gray-700 px-2 text-2xl">Automation</h2>
                <p class="text-xl px-2 pb-2">Manage all your automation related settings in the CRM
                </p>
            </div>
            <!--Card-->
            <div class="p-8 mt-6 lg:mt-0 leading-normal rounded shadow bg-white flex flex-row">
                {{-- Email Template Card --}}
                <a href="{{ route('settings.email_templates.index') }}">
                    <div
                        class="flex-grow bg-white dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 flex flex-col group hover:bg-gray-100 items-center md:flex-row md:p-4 md:w-4/5 rounded-lg">
                        <div class="fa-3x h-96 md:h-auto md:rounded-l-lg md:rounded-none md:w-18.5 ml-auto rounded-t-lg">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </div>
                        <div class="flex flex-col justify-between leading-normal mr-auto p-4">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Email Templates</h5>
                            <div class="group-hover:block hidden md:w-2/3 text-sm">Add, Edit or Delete Email Templates from Thrill Blazers
                                LMS</div>
                        </div>
                    </div>
                </a>
            </div>
            <!--/Card-->
        </div>
        <!--divider-->
        <hr class="bg-gray-300 my-4">
</x-app-layout>
