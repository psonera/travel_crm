@section('title', 'Leads')
<div class="{{ request('view_type') ? 'inline-flex w-full' : 'm-auto'}} ">
    <div class="{{ request('view_type') ? 'ml-auto' : 'mr-2'}}">
        @if (request('view_type'))
        <div class="-ml-2 align-top float-right inline-block mr-1 p-2 rounded text-3xl">
            <a href="{{ route('leads.index') }}" class="border-b-2 border-l-2 border-t-2 h-[40px] left-4 pb-[6px] pl-[13px] pr-[13px] pt-[2px] rounded-1">
                <i class="fa fa-columns fa-sm"></i>
            </a>
    
            <a class="bg-gray-600 border-b-2 border-r-2 border-t-2 h-[40px] left-4 pb-[6px] pl-[13px] pr-[13px] pt-[2px] rounded-1">
                <i class="fa fa-table text-white fa-sm"></i>
            </a>
        </div>    
        @else
        <div class="-ml-2 align-top float-right inline-block mr-1 p-2 rounded text-3xl">
            <a  class="bg-gray-600 border-b-2 border-l-2 border-t-2 h-[40px] left-4 pb-[6px] pl-[13px] pr-[13px] pt-[2px] rounded-1">
                <i class="fa fa-columns text-white fa-sm"></i>
            </a>
    
            <a href="{{ route('leads.index', ['view_type' => 'table']) }}" class="border-b-2 border-r-2 border-t-2 h-[40px] left-4 pb-[6px] pl-[13px] pr-[13px] pt-[2px] rounded-1">
                <i class="fa fa-table fa-sm"></i>
            </a>
        </div>
        @endif
    </div>
</div>