<x-app-layout>
    @section('title', 'Edit Activity')
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none max-w-full ml-auto mr-auto px-3 w-full">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div
                    class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                    <h2 class="text-3xl font-bold">Edit Activity</h2>
                </div>
                <div class="flex-auto p-6" role="tabpanel">
                    <form role="form" method="POST" action="{{ route('activities.update', $activity) }}">
                        @csrf
                        @if ($activity->type != 'note')
                            <div class="mb-4">
                                <x-inputs.text name="title" label="{{ __('Title') }}" value="{{ $activity->title }}"
                                    required autocomplete="title" autofocus />
                            </div>

                            @if ($activity->type == 'call' || $activity->type == 'meeting')
                                <div class="mb-4">
                                    <b>{{ __('Type') }}</b>
                                    <div
                                        class="flex row items-center pl-4 rounded border border-gray-200 dark:border-gray-700">
                                        <input id="call" type="radio" value="1" name="type"
                                            {{ $activity->type == 'call' ? 'checked' : '' }}
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="call"
                                            class="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Call</label>
                                        <input id="meeting" type="radio" value="0" name="type"
                                            {{ $activity->type == 'meeting' ? 'checked' : '' }}
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="meeting"
                                            class="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Meeting</label>
                                    </div>
                                </div>
                                @error('type')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            @endif
                        @endif
                        @if ($activity->type == 'note' || $activity->type == 'file')
                            <div class="mb-4">
                                <label class="p-2 font-semibold text-gray-700">Comment</label>
                                <span class="text-red-500">*</span>
                                <textarea name="comment" rows="5"
                                    class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                                    spellcheck="false">{!! $activity->comment !!}</textarea>
                            </div>
                            <x-inputs.hidden name="type" value="{{ $activity->type }}" />
                        @endif
                        @if ($activity->type == 'call' || $activity->type == 'meeting')
                            <div class="mb-4">
                                <x-inputs.datetime name="schedule_from" label="{{ __('Schedule From') }}"
                                    value="{{ $activity->schedule_from->format('Y-m-d H:i') }}" required
                                    autocomplete="schedule_from" autofocus />
                            </div>

                            <div class="mb-4">
                                <x-inputs.datetime name="schedule_to" label="{{ __('Schedule To') }}"
                                    value="{{ $activity->schedule_to->format('Y-m-d H:i') }}" required
                                    autocomplete="schedule_to" autofocus />
                            </div>
                        @endif
                        @if ($activity->type != 'note' && $activity->type != 'file')
                            <div class="mb-4">
                                <b>{{ __('Done') }}</b>
                                <div
                                    class="flex row items-center pl-4 rounded border border-gray-200 dark:border-gray-700">
                                    <input id="yes" type="radio" value="1" name="is_done"
                                        {{ $activity->is_done == '1' ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="yes"
                                        class="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Yes</label>

                                    <input id="no" type="radio" value="0" name="is_done"
                                        {{ $activity->is_done == '0' ? 'checked' : '' }}
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="no"
                                        class="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">No</label>
                                </div>
                            </div>
                            @error('is_done')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        @endif

                        @if ($activity->type == 'call' || $activity->type == 'meeting')
                            <div class="mb-4 relative">
                                <participants :data.users="{{ $activity->activityParticipants }}"
                                    :data.lead_managers="{{ $activity->activityParticipants }}"></participants>
                            </div>

                            <div class="mb-4">
                                <x-inputs.text name="location" label="{{ __('Location') }}"
                                    value="{{ $activity->location }}" required autocomplete="location" autofocus />
                            </div>
                        @endif

                        <div class="text-center">
                            <button type="submit"
                                class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">
                                Edit Activity</button>
                        </div>
                        @if ($errors->any())
                            {!! implode('', $errors->all('<div>:message</div>')) !!}
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
