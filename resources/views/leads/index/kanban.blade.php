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
    <div class="bg-white flex flex-grow mt-4 overflow-auto p-4 rounded-lg space-x-6">
        @foreach ($stages as $stage)
            <div class="bg-150 border-4 flex flex-col flex-shrink-0 p-4 rounded-xl w-72">
                <div class="flex items-center flex-shrink-0 h-10 px-2">
                    <span class="block font-semibold text-lg text-black">{{ $stage->name }}</span>
                    <span
                        class="bg-opacity-30 text-green-500 bg-green-100 flex font-semibold h-5 items-center justify-center ml-2 p-4 ml-auto rounded text-lg w-5">{{ count($stage->leads) }}</span>
                </div>
                <div class="flex flex-col pb-2 overflow-auto">
                    @forelse ($stage->leads as $lead)
                        <div class="border-2 relative flex flex-col items-start p-4 mt-3 bg-white rounded-lg cursor-pointer bg-opacity-90 group hover:bg-opacity-100"
                            draggable="true">
                            <span
                                class="flex items-center h-6 px-3 text-xs font-semibold text-green-500 bg-green-100 rounded-full">{{ $stage->name }}</span>
                            <h4 class="mt-3 text-sm font-medium">{{ $lead->title }}</h4>
                        </div>
                    @empty
                        <div class="mb-4 ml-auto mr-auto mt-4 text-black-500 text-center">
                            <img src="./img/no_data.svg" class="text-center h-50 w-50 ml-auto mr-auto mb-8"
                                height="150" width="150" alt="No Data" />
                            <p class="text-2xl">No lead found!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        @endforeach
        <div class="flex-shrink-0 w-6"></div>
    </div>
</x-app-layout>
