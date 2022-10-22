<x-app-layout>
    {{-- Toggle Layout --}}
    
    <div class="inline-flex w-full">
        <div class="flex ml-auto">
            @include('leads.index.view-switcher')
            @can('create.lead-pipeline-stages')
            <add-new-stage>
                @include('lead_pipeline_stages.create')
            </add-new-stage>
            @endcan
        </div>
    </div>
    
    {{-- Kanban Leadboard --}}
    <div class="bg-white flex flex-grow mt-4 overflow-auto p-4 rounded-lg space-x-6" id="leads_board">
        <kanban-board></kanban-board>
    </div>
    @section('page_scripts')
        <script src="{{ mix('js/app.js') }}"></script>
    @endsection
</x-app-layout>
