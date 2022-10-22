<tabs>
    <tab name="All" :selected="true">
        <div class="p-8">
            <div class="mb-8">
                <div class="inline-block mb-6 relative w-full text-lg">
                    <span class="pr-5 -top-[11px] absolute">Planned</span>
                    <hr class="bg-slate-400 h-[3px] ml-20">
                </div>
                @forelse ($lead->activities->where('is_done', 0) as $activity)
                    <div class="p-4">
                        @if($activity->type == 'note' || $activity->type == 'file')
                            {{-- Note/File View --}}
                            <div class="bg-slate-200 p-6 rounded-lg shadow-lg">
                                <div class="flex">
                                    @if($activity->type == 'note')
                                        <h5 class="text-lg mb-2 text-gray-800">Note Added</h5>
                                    @endif
                                    @if ($activity->type == 'file')
                                        <h5 class="text-lg mb-2 text-gray-800">File Added</h5>
                                    @endif
                                    <div class="relative mb-2 ml-auto">
                                        <a dropdown-trigger class="cursor-pointer" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v text-slate-400"></i>
                                        </a>
                                        <p class="hidden transform-dropdown-show"></p>
    
                                        <ul dropdown-menu class="z-100 text-size-sm transform-dropdown shadow-soft-3xl duration-250 before:duration-350 before:font-awesome before:ease-soft min-w-44 -ml-34 before:text-5.5 pointer-events-none absolute top-0 mt-2 list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:top-0 before:right-7 before:left-auto before:z-40 before:text-white before:transition-all before:content-['\f0d8']">
                                            <li class="relative">
                                                <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.mark-done', ['id' => $activity->id]) }}">Mark as Done</a>
                                            </li>
                                            <li class="relative">
                                                <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.edit', $activity->id) }}">Edit</a>
                                            </li>
                                            <li class="relative">
                                                <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.delete', $activity->id) }}">Remove</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="p-4 bg-gradient-orange rounded text-gray-700">{{ $activity->comment }}</p>
                                <p class="mt-2">{{ date('jS M Y, g:i A', strtotime($activity->created_at)); }} @if($activity->user) | <a href="{{ route('settings.users.edit',  $activity->user->id) }}" class="text-blue-400">{{ $activity->user->name }}</a> @endif</p>
                            </div>
                        @endif
                        @if($activity->type == 'call')
                            <div class="bg-slate-200 p-6 rounded-lg shadow-lg">
                                <div class="flex">
                                    <h5 class="text-lg mb-2 font-bold text-gray-800">{{ $activity->title }}</h5>
                                    <div class="relative mb-2 ml-auto">
                                        <a dropdown-trigger class="cursor-pointer" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v text-slate-400"></i>
                                        </a>
                                        <p class="hidden transform-dropdown-show"></p>
                                    
                                        <ul dropdown-menu class="z-100 text-size-sm transform-dropdown shadow-soft-3xl duration-250 before:duration-350 before:font-awesome before:ease-soft min-w-44 -ml-34 before:text-5.5 pointer-events-none absolute top-0 mt-2 list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:top-0 before:right-7 before:left-auto before:z-40 before:text-white before:transition-all before:content-['\f0d8']">
                                            <li class="relative">
                                                <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.mark-done', ['id' => $activity->id]) }}">Mark as Done</a>
                                            </li>
                                            <li class="relative">
                                                <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.edit', $activity->id) }}">Edit</a>
                                            </li>
                                            <li class="relative">
                                                <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.delete', $activity->id) }}">Remove</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="text-gray-700">Call scheduled on {{ (date('Y-m-d', strtotime($activity->schedule_from)) == date('Y-m-d', strtotime($activity->schedule_to))) ? date('jS M Y, g:i A', strtotime($activity->schedule_from)) .' to '. date('g:i A', strtotime($activity->schedule_to)) : date('jS M Y, g:i A', strtotime($activity->schedule_from)) .' to '.date('jS M Y, g:i A', strtotime($activity->schedule_to)) }} </p>
                                <p class="mt-2">{{ date('jS M Y, g:i A', strtotime($activity->created_at)); }} @if($activity->user) | <a href="{{ route('settings.users.edit', $activity->user->id) }}" class="text-blue-400">{{ $activity->user->name }}</a> @endif</p>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="mb-4">
                        <p class="text-center text-sm">You don't have any planned acitivites</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mb-4">
                <div class="inline-block mb-6 relative w-full text-lg">
                    <span class="pr-5 -top-[11px] absolute">Done</span>
                    <hr class="bg-slate-400 h-[3px] ml-20">
                </div>
                @forelse ($lead->activities->where('is_done', 1) as $activity)
                    <div class="p-4">
                        @if($activity->type == 'note' || $activity->type == 'file')
                            <div class="bg-slate-200 p-6 rounded-lg shadow-lg">
                                <div class="flex">
                                    @if($activity->type == 'note')
                                        <h5 class="text-lg mb-2 text-gray-800">Note Added</h5>
                                        <div class="relative mb-2 ml-auto">
                                            <a dropdown-trigger class="cursor-pointer" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-slate-400"></i>
                                            </a>
                                            <p class="hidden transform-dropdown-show"></p>
                                        
                                            <ul dropdown-menu class="z-100 text-size-sm transform-dropdown shadow-soft-3xl duration-250 before:duration-350 before:font-awesome before:ease-soft min-w-44 -ml-34 before:text-5.5 pointer-events-none absolute top-0 mt-2 list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:top-0 before:right-7 before:left-auto before:z-40 before:text-white before:transition-all before:content-['\f0d8']">
                                                <li class="relative">
                                                    <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.edit', $activity->id) }}">Edit</a>
                                                </li>
                                                <li class="relative">
                                                    <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.delete', $activity->id) }}">Remove</a>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                @if ($activity->type == 'file')
                                    <div class="flex">
                                        <h5 class="text-lg mb-2 text-gray-800">File Added</h5>
                                        <div class="relative mb-2 ml-auto">
                                            <a dropdown-trigger class="cursor-pointer" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-slate-400"></i>
                                            </a>
                                            <p class="hidden transform-dropdown-show"></p>
                                        
                                            <ul dropdown-menu class="z-100 text-size-sm transform-dropdown shadow-soft-3xl duration-250 before:duration-350 before:font-awesome before:ease-soft min-w-44 -ml-34 before:text-5.5 pointer-events-none absolute top-0 mt-2 list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:top-0 before:right-7 before:left-auto before:z-40 before:text-white before:transition-all before:content-['\f0d8']">
                                                <li class="relative">
                                                    <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.edit', $activity->id) }}">Edit</a>
                                                </li>
                                                <li class="relative">
                                                    <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.delete', $activity->id) }}">Remove</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="pb-2">
                                        <a href="{{ route('activities.download', ['id' => $activity->file->getMedia('activity_file')[0]->id]) }}" class="text-blue-400">
                                            <i class="fa fa-paperclip text-gray-800" aria-hidden="true"></i>
                                            {{ $activity->file->getMedia('activity_file')[0]->name }}
                                        </a>
                                    </div>
                                @endif
                                <p class="p-4 bg-gradient-orange rounded text-gray-700">{{ $activity->comment }}</p>
                                <p class="mt-2">{{ date('jS M Y, g:i A', strtotime($activity->created_at)); }} @if($activity->user) | <a href="{{ route('settings.users.edit', $activity->user->id) }}" class="text-blue-400">{{ $activity->user->name }}</a> @endif</p>
                            </div>
                        @endif
                        @if($activity->type == 'call')
                        <div class="bg-slate-200 p-6 rounded-lg shadow-lg">
                            <div class="flex">
                                <h5 class="text-lg mb-2 font-bold text-gray-800">{{ $activity->title }}</h5>
                                <div class="relative mb-2 ml-auto">
                                    <a dropdown-trigger class="cursor-pointer" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-slate-400"></i>
                                    </a>
                                    <p class="hidden transform-dropdown-show"></p>
                                
                                    <ul dropdown-menu class="z-100 text-size-sm transform-dropdown shadow-soft-3xl duration-250 before:duration-350 before:font-awesome before:ease-soft min-w-44 -ml-34 before:text-5.5 pointer-events-none absolute top-0 mt-2 list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:top-0 before:right-7 before:left-auto before:z-40 before:text-white before:transition-all before:content-['\f0d8']">
                                        <li class="relative">
                                            <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.edit', $activity->id) }}">Edit</a>
                                        </li>
                                        <li class="relative">
                                            <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.delete', $activity->id) }}">Remove</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <p class="text-gray-700">Call scheduled on {{ (date('Y-m-d', strtotime($activity->schedule_from)) == date('Y-m-d', strtotime($activity->schedule_to))) ? date('jS M Y, g:i A', strtotime($activity->schedule_from)) .' to '. date('g:i A', strtotime($activity->schedule_to)) : date('jS M Y, g:i A', strtotime($activity->schedule_from)) .' to '.date('jS M Y, g:i A', strtotime($activity->schedule_to)) }} </p>
                            <p class="mt-2">{{ date('jS M Y, g:i A', strtotime($activity->created_at)); }} @if($activity->user) | <a href="{{ route('settings.users.edit', $activity->user->id) }}" class="text-blue-400">{{ $activity->user->name }}</a> @endif</p>
                        </div>
                    @endif
                    </div>
                @empty
                    <div class="mb-4">
                        <p class="text-center text-sm">You don't have any done acitivites</p>
                    </div>
                @endforelse
            </div>
        </div>
    </tab>
    <tab name="Notes">
        <div class="p-8">            
            <div class="mb-4">
                @forelse ($lead->activities->where('type', 'note')->where('is_done', 1)  as $activity)
                    <div class="p-4">
                        <div class="bg-slate-200 p-6 rounded-lg shadow-lg">
                            <div class="flex">
                                <h5 class="text-lg mb-2 text-gray-800">Note Added</h5>
                                <div class="relative mb-2 ml-auto">
                                    <a dropdown-trigger class="cursor-pointer" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-slate-400"></i>
                                    </a>
                                    <p class="hidden transform-dropdown-show"></p>
                                
                                    <ul dropdown-menu class="z-100 text-size-sm transform-dropdown shadow-soft-3xl duration-250 before:duration-350 before:font-awesome before:ease-soft min-w-44 -ml-34 before:text-5.5 pointer-events-none absolute top-0 mt-2 list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:top-0 before:right-7 before:left-auto before:z-40 before:text-white before:transition-all before:content-['\f0d8']">
                                        <li class="relative">
                                            <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.edit', $activity->id) }}">Edit</a>
                                        </li>
                                        <li class="relative">
                                            <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.delete', $activity->id) }}">Remove</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <p class="p-4 bg-gradient-orange rounded text-gray-700">{{ $activity->comment }}</p>
                            <p class="mt-2">{{ date('jS M Y, g:i A', strtotime($activity->created_at)); }} @if($activity->user) | <a href="{{ route('settings.users.edit', $activity->user->id) }}" class="text-blue-400">{{ $activity->user->name }}</a> @endif</p>
                        </div>
                    </div>
                @empty
                    <div class="mb-4">
                        <p class="text-center text-sm">You don't have any notes</p>
                    </div>
                @endforelse
            </div>
        </div>
    </tab>
    <tab name="Calls">
        <div class="p-8">
            <div class="mb-8">
                <div class="inline-block mb-6 relative w-full text-lg">
                    <span class="pr-5 -top-[11px] absolute">Planned</span>
                    <hr class="bg-slate-400 h-[3px] ml-20">
                </div>
                @forelse ($lead->activities->where('type', 'call')->where('is_done', 0) as $activity)
                    <div class="p-4">
                        <div class="bg-slate-200 p-6 rounded-lg shadow-lg">
                            <div class="flex">
                                <h5 class="text-lg mb-2 font-bold text-gray-800">{{ $activity->title }}</h5>
                                <div class="relative mb-2 ml-auto">
                                    <a dropdown-trigger class="cursor-pointer" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-slate-400"></i>
                                    </a>
                                    <p class="hidden transform-dropdown-show"></p>
                                
                                    <ul dropdown-menu class="z-100 text-size-sm transform-dropdown shadow-soft-3xl duration-250 before:duration-350 before:font-awesome before:ease-soft min-w-44 -ml-34 before:text-5.5 pointer-events-none absolute top-0 mt-2 list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:top-0 before:right-7 before:left-auto before:z-40 before:text-white before:transition-all before:content-['\f0d8']">
                                        <li class="relative">
                                            <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.mark-done', ['id' => $activity->id]) }}">Mark as Done</a>
                                        </li>
                                        <li class="relative">
                                            <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.edit', $activity->id) }}">Edit</a>
                                        </li>
                                        <li class="relative">
                                            <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.delete', $activity->id) }}">Remove</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <p class="text-gray-700">Call scheduled on {{ (date('Y-m-d', strtotime($activity->schedule_from)) == date('Y-m-d', strtotime($activity->schedule_to))) ? date('jS M Y, g:i A', strtotime($activity->schedule_from)) .' to '. date('g:i A', strtotime($activity->schedule_to)) : date('jS M Y, g:i A', strtotime($activity->schedule_from)) .' to '.date('jS M Y, g:i A', strtotime($activity->schedule_to)) }} </p>
                            <p class="mt-2">{{ date('jS M Y, g:i A', strtotime($activity->created_at)); }} @if($activity->user) | <a href="{{ route('settings.users.edit', $activity->user->id) }}" class="text-blue-400">{{ $activity->user->name }}</a> @endif</p>
                        </div>
                    </div>
                @empty
                    <div class="mb-4">
                        <p class="text-center text-sm">You don't have any planned acitivites</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mb-4">
                <div class="inline-block mb-6 relative w-full text-lg">
                    <span class="pr-5 -top-[11px] absolute">Done</span>
                    <hr class="bg-slate-400 h-[3px] ml-20">
                </div>
                @forelse ($lead->activities->where('type', 'call')->where('is_done', 1) as $activity)
                    <div class="p-4">
                        <div class="bg-slate-200 p-6 rounded-lg shadow-lg">
                            <div class="flex">
                                <h5 class="text-lg mb-2 font-bold text-gray-800">{{ $activity->title }}</h5>
                                <div class="relative mb-2 ml-auto">
                                    <a dropdown-trigger class="cursor-pointer" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-slate-400"></i>
                                    </a>
                                    <p class="hidden transform-dropdown-show"></p>
                                
                                    <ul dropdown-menu class="z-100 text-size-sm transform-dropdown shadow-soft-3xl duration-250 before:duration-350 before:font-awesome before:ease-soft min-w-44 -ml-34 before:text-5.5 pointer-events-none absolute top-0 mt-2 list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:top-0 before:right-7 before:left-auto before:z-40 before:text-white before:transition-all before:content-['\f0d8']">
                                        <li class="relative">
                                            <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.edit', $activity->id) }}">Edit</a>
                                        </li>
                                        <li class="relative">
                                            <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.delete', $activity->id) }}">Remove</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <p class="text-gray-700">Call scheduled on {{ (date('Y-m-d', strtotime($activity->schedule_from)) == date('Y-m-d', strtotime($activity->schedule_to))) ? date('jS M Y, g:i A', strtotime($activity->schedule_from)) .' to '. date('g:i A', strtotime($activity->schedule_to)) : date('jS M Y, g:i A', strtotime($activity->schedule_from)) .' to '.date('jS M Y, g:i A', strtotime($activity->schedule_to)) }} </p>
                            <p class="mt-2">{{ date('jS M Y, g:i A', strtotime($activity->created_at)); }} @if($activity->user) | <a href="{{ route('settings.users.edit', $activity->user->id) }}" class="text-blue-400">{{ $activity->user->name }}</a> @endif</p>
                        </div>
                    </div>
                @empty
                    <div class="mb-4">
                        <p class="text-center text-sm">You don't have any done acitivites</p>
                    </div>
                @endforelse
            </div>
        </div>
    </tab>
    <tab name="Meetings">
        <div class="p-8">
            <div class="mb-8">
                <div class="inline-block mb-6 relative w-full text-lg">
                    <span class="pr-5 -top-[11px] absolute">Planned</span>
                    <hr class="bg-slate-400 h-[3px] ml-20">
                </div>
                @forelse ($lead->activities->where('type', 'meeting')->where('is_done', 0) as $activity)
                    <div class="p-4">
                        <div class="bg-slate-200 p-6 rounded-lg shadow-lg">
                            <div class="flex">
                                <h5 class="text-lg mb-2 font-bold text-gray-800">{{ $activity->title }}</h5>
                                <div class="relative mb-2 ml-auto">
                                    <a dropdown-trigger class="cursor-pointer" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-slate-400"></i>
                                    </a>
                                    <p class="hidden transform-dropdown-show"></p>
                                
                                    <ul dropdown-menu class="z-100 text-size-sm transform-dropdown shadow-soft-3xl duration-250 before:duration-350 before:font-awesome before:ease-soft min-w-44 -ml-34 before:text-5.5 pointer-events-none absolute top-0 mt-2 list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:top-0 before:right-7 before:left-auto before:z-40 before:text-white before:transition-all before:content-['\f0d8']">
                                        <li class="relative">
                                            <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.mark-done', ['id' => $activity->id]) }}">Mark as Done</a>
                                        </li>
                                        <li class="relative">
                                            <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.edit', $activity->id) }}">Edit</a>
                                        </li>
                                        <li class="relative">
                                            <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.delete', $activity->id) }}">Remove</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <p class="text-gray-700">Meeting scheduled on {{ (date('Y-m-d', strtotime($activity->schedule_from)) == date('Y-m-d', strtotime($activity->schedule_to))) ? date('jS M Y, g:i A', strtotime($activity->schedule_from)) .' to '. date('g:i A', strtotime($activity->schedule_to)) : date('jS M Y, g:i A', strtotime($activity->schedule_from)) .' to '.date('jS M Y, g:i A', strtotime($activity->schedule_to)) }} </p>
                            <p class="mt-2">{{ date('jS M Y, g:i A', strtotime($activity->created_at)); }} @if($activity->user) | <a href="{{ route('settings.users.edit', $activity->user->id) }}" class="text-blue-400">{{ $activity->user->name }}</a> @endif</p>
                        </div>
                    </div>
                @empty
                    <div class="mb-4">
                        <p class="text-center text-sm">You don't have any planned acitivites</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mb-4">
                <div class="inline-block mb-6 relative w-full text-lg">
                    <span class="pr-5 -top-[11px] absolute">Done</span>
                    <hr class="bg-slate-400 h-[3px] ml-20">
                </div>
                @forelse ($lead->activities->where('type', 'meeting')->where('is_done', 1) as $activity)
                    <div class="p-4">
                        <div class="bg-slate-200 p-6 rounded-lg shadow-lg">
                            <div class="flex">
                                <h5 class="text-lg mb-2 font-bold text-gray-800">{{ $activity->title }}</h5>
                                <div class="relative mb-2 ml-auto">
                                    <a dropdown-trigger class="cursor-pointer" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-slate-400"></i>
                                    </a>
                                    <p class="hidden transform-dropdown-show"></p>
                                
                                    <ul dropdown-menu class="z-100 text-size-sm transform-dropdown shadow-soft-3xl duration-250 before:duration-350 before:font-awesome before:ease-soft min-w-44 -ml-34 before:text-5.5 pointer-events-none absolute top-0 mt-2 list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:top-0 before:right-7 before:left-auto before:z-40 before:text-white before:transition-all before:content-['\f0d8']">
                                        <li class="relative">
                                            <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.edit', $activity->id) }}">Edit</a>
                                        </li>
                                        <li class="relative">
                                            <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.delete', $activity->id) }}">Remove</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <p class="text-gray-700">Meeting scheduled on {{ (date('Y-m-d', strtotime($activity->schedule_from)) == date('Y-m-d', strtotime($activity->schedule_to))) ? date('jS M Y, g:i A', strtotime($activity->schedule_from)) .' to '. date('g:i A', strtotime($activity->schedule_to)) : date('jS M Y, g:i A', strtotime($activity->schedule_from)) .' to '.date('jS M Y, g:i A', strtotime($activity->schedule_to)) }} </p>
                            <p class="mt-2">{{ date('jS M Y, g:i A', strtotime($activity->created_at)); }} @if($activity->user) | <a href="{{ route('settings.users.edit', $activity->user->id) }}" class="text-blue-400">{{ $activity->user->name }}</a> @endif</p>
                        </div>
                    </div>
                @empty
                    <div class="mb-4">
                        <p class="text-center text-sm">You don't have any done acitivites</p>
                    </div>
                @endforelse
            </div>
        </div>
    </tab>
    <tab name="Files">
        <div class="p-8">            
            <div class="mb-4">
                @forelse ($lead->activities->where('type', 'file')->where('is_done', 1)  as $activity)
                    <div class="p-4">
                        <div class="bg-slate-200 p-6 rounded-lg shadow-lg">
                            <div class="flex">
                                <h5 class="text-lg mb-2 text-gray-800">File Added</h5>
                                <div class="relative mb-2 ml-auto">
                                    <a dropdown-trigger class="cursor-pointer" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-slate-400"></i>
                                    </a>
                                    <p class="hidden transform-dropdown-show"></p>
                                
                                    <ul dropdown-menu class="z-100 text-size-sm transform-dropdown shadow-soft-3xl duration-250 before:duration-350 before:font-awesome before:ease-soft min-w-44 -ml-34 before:text-5.5 pointer-events-none absolute top-0 mt-2 list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:top-0 before:right-7 before:left-auto before:z-40 before:text-white before:transition-all before:content-['\f0d8']">
                                        <li class="relative">
                                            <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.edit', $activity->id) }}">Edit</a>
                                        </li>
                                        <li class="relative">
                                            <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.delete', $activity->id) }}">Remove</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="pb-2">
                                <a href="{{ route('activities.download', ['id' => $activity->file->getMedia('activity_file')[0]->id]) }}" class="text-blue-400">
                                    <i class="fa fa-paperclip text-gray-800" aria-hidden="true"></i>
                                    {{ $activity->file->getMedia('activity_file')[0]->name }}
                                </a>
                            </div>
                            <p class="p-4 bg-gradient-orange rounded text-gray-700">{{ $activity->comment }}</p>
                            <p class="mt-2">{{ date('jS M Y, g:i A', strtotime($activity->created_at)); }} @if($activity->user) | <a href="{{ route('settings.users.edit', $activity->user->id) }}" class="text-blue-400">{{ $activity->user->name }}</a> @endif</p>
                        </div>
                    </div>
                @empty
                    <div class="mb-4">
                        <p class="text-center text-sm">You don't have any files</p>
                    </div>
                @endforelse
            </div>
        </div>
    </tab>
    <tab name="Emails">
        {{-- <div class="p-8">            
            <div class="mb-4">
                @forelse ($lead->emails->where('lead_id', $lead->id)  as $email)
                    <div class="p-4">
                        <div class="bg-slate-200 p-6 rounded-lg shadow-lg">
                            <div class="flex">
                                <h5 class="text-lg mb-2 text-gray-800">{{ $email->subject }}</h5>
                                <div class="relative mb-2 ml-auto">
                                    <a dropdown-trigger class="cursor-pointer" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-slate-400"></i>
                                    </a>
                                    <p class="hidden transform-dropdown-show"></p>
                                
                                    <ul dropdown-menu class="z-100 text-size-sm transform-dropdown shadow-soft-3xl duration-250 before:duration-350 before:font-awesome before:ease-soft min-w-44 -ml-34 before:text-5.5 pointer-events-none absolute top-0 mt-2 list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:top-0 before:right-7 before:left-auto before:z-40 before:text-white before:transition-all before:content-['\f0d8']">
                                        <li class="relative">
                                            <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.edit', $activity->id) }}">Edit</a>
                                        </li>
                                        <li class="relative">
                                            <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300" href="{{ route('activities.delete', $activity->id) }}">Remove</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <p class="mt-2">{{ date('jS M Y, g:i A', strtotime($email->created_at)); }} | {{ $email->from }} <i class="fa fa-long-arrow-right" aria-hidden="true"></i> {{ $email->to }}</p>
                            <p class="p-4 text-gray-700 text-xl">{!! $email->reply !!}</p>
                        </div>
                    </div>
                @empty
                    <div class="mb-4">
                        <p class="text-center text-sm">You don't have any emails</p>
                    </div>
                @endforelse
            </div>
        </div> --}}
    </tab>
    <tab name="Quotations">
        <div class="overflow-x-auto relative p-6">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            Subject
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Expired At
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Sub Total
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Discount
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Tax
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Grand Total
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lead->quotations as $quotation)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $quotation->subject }}
                        </th>
                        <td class="py-4 px-6">
                            {{ date('Y-m-d', strtotime($quotation->expired_at)) }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $quotation->sub_total }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $quotation->discount_amount }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $quotation->tax_amount }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $quotation->grand_total }}
                        </td>
                    </tr>
                    @empty
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-center">
                            <td class="text-center p-4 text-lg text-gray-600">
                                No quotations found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </tab>
</tabs>