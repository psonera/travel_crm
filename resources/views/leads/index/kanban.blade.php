<x-app-layout>
    {{-- Toggle Layout --}}
    <div class="flow-root pb-3">

        @if (request('view_type'))
            <div class="border-2 float-right rounded text-3xl p-2">
                <a href="{{ route('leads.index') }}" class="icon-container">
                    <i class="fas fa-table"></i>
                </a>

                <a class="icon-container active">
                    <i class="fas fa-th"></i>
                </a>
            </div>
        @else
            <div class="border-2 float-right rounded text-3xl p-2">
                <a class="icon-container active">
                    <i class="fas fa-table"></i>
                </a>

                <a href="{{ route('leads.index', ['view_type' => 'table']) }}" class="icon-container">
                    <i class="fas fa-th"></i>
                </a>
            </div>
        @endif
    </div>
    {{-- Kanban Leadboard --}}
    <div class="bg-white flex flex-grow mt-4 overflow-auto p-4 rounded-lg space-x-6" id="leads_board">
        @foreach ($stages as $stage)
            <div class="bg-150 border-4 flex flex-col flex-shrink-0 p-4 rounded-xl w-72 h-[60vh]">
                <div class="flex items-center flex-shrink-0 h-10 px-2">
                    <span class="block font-semibold text-lg text-black">{{ $stage->name }}</span>
                    <span
                        class="bg-opacity-30 
                            @switch($stage->id) @case(1)
                                    text-blue-500 bg-blue-100
                                    @break
                                
                                @case(2)
                                    text-yellow-500 bg-yellow-100
                                    @break

                                @case(3)
                                    text-purple-500 bg-purple-100
                                    @break

                                @case(4)
                                    text-pink-500 bg-pink-100
                                    @break

                                @case(5)
                                    text-green-500 bg-green-100
                                    @break

                                @case(6)
                                    text-red-500 bg-red-100
                                    @break

                                @default
                                    text-blue-500 bg-blue-100 @endswitch
                        flex font-semibold h-5 items-center justify-center ml-2 p-4 ml-auto rounded text-lg w-5">{{ count($stage->leads) }}</span>
                </div>
                <ul class="flex flex-col pb-2 overflow-auto sortable ui-sortable" id="sort{{ $stage->id }}"
                    data-stage-id="{{ $stage->id }}">
                    @forelse ($stage->leads as $lead)
                        <li class="ui-sortable-handle border-2 relative flex flex-col items-start p-4 mt-3 bg-white rounded-lg cursor-pointer bg-opacity-90 group hover:bg-opacity-100"
                            data-lead-id="{{ $lead->id }}">
                            <span
                                class="flex items-center h-6 px-3 text-xs font-semibold 
                                @switch($lead->lead_pipeline_stage_id) @case(1)
                                        text-blue-500 bg-blue-100
                                        @break
                                    
                                    @case(2)
                                        text-yellow-500 bg-yellow-100
                                        @break
    
                                    @case(3)
                                        text-purple-500 bg-purple-100
                                        @break
    
                                    @case(4)
                                        text-pink-500 bg-pink-100
                                        @break
    
                                    @case(5)
                                        text-green-500 bg-green-100
                                        @break
    
                                    @case(6)
                                        text-red-500 bg-red-100
                                        @break
    
                                    @default
                                        text-blue-500 bg-blue-100 @endswitch
                                rounded-full">{{ $stage->name }}</span>
                            <h4 class="mt-3 text-sm font-medium">{{ $lead->title }}</h4>
                        </li>
                    @empty
                        <div class="unsortable mt-[70px] mb-4 ml-auto mr-auto text-black-500 text-center placeholder" data-id="{{ $stage->id }}">
                            <img src="/img/no_data.svg" class="text-center h-50 w-50 ml-auto mr-auto mb-8"
                                height="150" width="150" alt="No Data" />
                            <p class="text-2xl">No lead found!</p>
                        </div>
                    @endforelse
                </ul>
            </div>
        @endforeach
        <div class="flex-shrink-0 w-6"></div>
    </div>
    @section('page_scripts')
        <script>
            const notyf = new Notyf({
                dismissible: true
            });
            $(function() {
                $('ul[id^="sort"]').sortable({
                    connectWith: ".sortable",
                    revert: true,
                    placeholder: 'placeholder',
                    over: function(event, ui) {
                        var over = $(event.target);
                        over.hide();
                    },
                    out: function(event, ui) {
                        var out = $(event.target);
                        out.show();
                        // var current = $(ui.item).parent(".sortable").data("id");
                        // $('.placeholder').find("[data-id='" + current + "']").show();
                    },
                    stop: function(event, ui) {
                        var stop = $(event.target);
                        stop.remove();
                        // var current = $(ui.item).parent(".sortable").data("id");
                        // $('.placeholder').find("[data-id='" + current + "']").remove(); 
                    },
                    receive: function(e, ui) {
                        var stage_id = $(ui.item).parent(".sortable").data("stage-id");
                        var lead_id = $(ui.item).data("lead-id");
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: 'POST',
                            beforeSend: function(xhr) {
                                var token = $('meta[name="csrf_token"]').attr('content');

                                if (token) {
                                    return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                                }
                            },
                            data: {
                                stage_id: stage_id,
                                lead_id: lead_id
                            },
                            url: "{{ route('leads.change_status') }}",
                            dataType: 'json',
                            success: function(res) {
                                if (res.success)
                                    notyf.success(res.success);
                                else
                                    notyf.error(res.error);

                                location.reload();
                            }
                        });
                    } 
                }).disableSelection();
            });
        </script>
    @endsection
</x-app-layout>
