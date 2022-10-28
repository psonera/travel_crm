<x-app-layout>
    @section('title', 'Trips')
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                    <h2 class="text-3xl font-bold">All Trips </h2>
                    @can('create.trips')
                        <a href="{{ route('settings.trips.create') }}" class="bg-gradient-cyan ml-auto bg-success block p-2 rounded-xl text-white">+ Add New Trip</a>
                    @endcan    
                </div>
                <div class="p-6">
                    <livewire:trip-table/>
                </div>    
            </div>
        </div>
    </div>    
</x-app-layout>