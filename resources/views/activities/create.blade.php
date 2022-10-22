<x-app-layout>
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none max-w-full ml-auto mr-auto px-3 w-full">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div
                    class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                    <h2 class="text-3xl font-bold">Create Activity</h2>

                </div>
                <div class="flex-auto p-6" role="tabpanel">
                    <form role="form" method="POST" action="{{ route('activities.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <x-inputs.text name="title" label="{{ __('Title') }}" value="{{ old('title') }}"
                                required autocomplete="title" autofocus />
                        </div>

                        <div class="mb-4">
                            <b>{{ __('Type') }}</b>
                            <div class="flex row items-center pl-4 rounded border border-gray-200 dark:border-gray-700">
                                <input id="call" type="radio" value="1" name="type"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="call"
                                    class="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Call</label>

                                <input id="meeting" type="radio" value="0" name="type"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="meeting"
                                    class="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Meeting</label>
                            </div>
                        </div>
                        @error('type')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <div class="mb-4">
                            <x-inputs.text name="comment" label="{{ __('Comment') }}" value="{{ old('comment') }}"
                                required autocomplete="comment" autofocus />
                        </div>

                        <div class="mb-4">
                            <x-inputs.datetime name="schedule_from" label="{{ __('Schedule From') }}"
                                value="{{ old('schedule_from') }}" required autocomplete="schedule_from" autofocus />
                        </div>

                        <div class="mb-4">
                            <x-inputs.datetime name="schedule_to" label="{{ __('Schedule To') }}"
                                value="{{ old('schedule_to') }}" required autocomplete="schedule_to" autofocus />
                        </div>

                        <div class="mb-4">
                            <b>{{ __('Done') }}</b>
                            <div class="flex row items-center pl-4 rounded border border-gray-200 dark:border-gray-700">
                                <input id="yes" type="radio" value="1" name="is_done"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="yes"
                                    class="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Yes</label>

                                <input id="no" type="radio" value="0" name="is_done"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="no"
                                    class="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">No</label>
                            </div>
                        </div>
                        @error('is_done')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <div class="mb-4 relative">
                            <x-inputs.text name="find_users" label="{{ __('User') }}"
                                value="{{ old('find_users') }}" required autocomplete="find_users" autofocus
                                placeholder="Start typing name..." />
                            <ul class="bg-white absolute shadow border-gray-100 appearance-none block border border-gray-200 leading-normal px-2 py-1 rounded text-base text-gray-800 w-full hidden z-990"
                                id="select_user">
                            </ul>
                            <x-inputs.hidden name="user_id" />
                        </div>

                        <div class="mb-4">
                            <x-inputs.text name="location" label="{{ __('Location') }}" value="{{ old('location') }}"
                                required autocomplete="location" autofocus />
                        </div>


                        <div class="text-center">
                            <button type="submit"
                                class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">
                                Add Activity</button>
                        </div>
                        @if ($errors->any())
                            {!! implode('', $errors->all('<div>:message</div>')) !!}
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var i = {{ 0 }};
            $("#find_users").keyup(function() {
                var search_user = $(this).val();
                if (search_user.length >= 2) {
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
                            search_user: search_user,
                            type: 1
                        },
                        url: "{{ route('find_user') }}",
                        dataType: 'json',
                        success: function(res) {
                            var len = res.length;
                            if (res != '') {
                                $("#select_user").empty();
                                $("#select_user").show();
                                for (var i = 0; i < len; i++) {
                                    var u_id = res[i]['id'];
                                    var u_name = res[i]['name'];

                                    $("#select_user").append(
                                        "<li class='p-2 cursor-pointer' value='" +
                                        u_id + "'>" + u_name +
                                        "</li>");
                                }
                                $("#select_user li").bind("click", function() {
                                    setUserInfo(this);
                                });
                            } else {
                                $("#select_user").empty();
                                $("#select_user li").html(
                                    "<p class='text-left'>No results found!</p>");
                            }
                        }
                    });
                } else {
                    $("#select_user").empty();
                    $("#select_user").hide();
                    $("#find_users_id").val('');

                }
            });

            function setUserInfo(element) {
                var value = $(element).text();
                var user_id = $(element).val();

                $("#find_users").val(value);
                $("#select_user").empty();
                $("#select_user").hide();

                // Request User Details
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
                        user_id: user_id,
                        type: 2
                    },
                    url: "{{ route('find_user') }}",
                    dataType: 'json',
                    success: function(response) {
                        var len = response.length;
                        $("#select_user").empty();
                        $("#select_user").hide();
                        if (response) {
                            var s_u_id = response.id;
                            $("#user_id").val(s_u_id);
                        }
                    }
                });
            }
        });
    </script>
</x-app-layout>
