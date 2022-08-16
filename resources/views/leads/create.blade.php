<x-app-layout>
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none max-w-full ml-auto mr-auto px-3 w-full">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div
                    class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                    <h2 class="text-3xl font-bold">Create Lead</h2>
                </div>
                <div class="flex-auto px-6 py-1">
                    <form role="form" method="POST" action="{{ route('leads.store') }}">
                        @csrf
                        <div class="mb-4 border-b border-gray-200 dark:border-gray-700" id="tabs">
                            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center pl-4">
                                <li class="mr-2" role="details">
                                    <a href="#details"
                                        class="inline-block p-4 rounded-t-lg border-b-2 text-xl">Details</a>
                                </li>
                                <li class="mr-2" role="trip">
                                    <a href="#trip" class="inline-block p-4 rounded-t-lg border-b-2 text-xl">Trip</a>
                                </li>
                                <li class="mr-2" role="lead_manager_info">
                                    <a href="#lead_manager_info"
                                        class="inline-block p-4 rounded-t-lg border-b-2 text-xl">Lead
                                        Manager</a>
                                </li>
                                <li role="product">
                                    <a href="#product"
                                        class="inline-block p-4 rounded-t-lg border-b-2 text-xl">Product</a>
                                </li>
                            </ul>

                            {{-- Details Section --}}
                            <div id="details" class="p-4">
                                <div class="mb-4">
                                    <x-inputs.text name="title" label="{{ __('Title') }}"
                                        value="{{ old('title') }}" required autocomplete="title" autofocus />
                                </div>
                                @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror

                                <div class="mb-4">
                                    <x-inputs.textarea name="description" label="{{ __('Lead Body') }}">
                                        {{ old('description') }}</x-inputs.textarea>
                                </div>
                                @error('description')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror

                                <div class="mb-4">
                                    <x-inputs.text name="lead_value" currencySymbol="true"
                                        label="{{ __('Lead Value') }}" value="{{ old('lead_value') }}" required
                                        autocomplete="lead_value" autofocus />
                                </div>
                                @error('lead_value')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror

                                <div class="mb-4">
                                    <x-inputs.select name="lead_source_id" label="{{ __('Source') }}" required>
                                        <option value="">-- Select Lead Source --</option>
                                        @foreach ($sources as $source)
                                            <option value="{{ $source->id }}">{{ $source->name }}</option>
                                        @endforeach
                                    </x-inputs.select>
                                </div>
                                @error('lead_source_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror

                                <div class="mb-4">
                                    <x-inputs.select name="lead_type_id" label="{{ __('Type') }}" required>
                                        <option value="">-- Select Lead Type --</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </x-inputs.select>
                                </div>
                                @error('lead_type_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror

                                <div class="mb-4">
                                    <x-inputs.select name="user_id" label="{{ __('Manager') }}" required>
                                        <option value="">-- Select Manager --</option>
                                        @foreach ($managers as $manager)
                                            <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                        @endforeach
                                    </x-inputs.select>
                                </div>
                                @error('user_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror

                                <div class="mb-4">
                                    <x-inputs.date name="expected_closed_date"
                                        label="{{ __('Expected Close Date') }}" />
                                </div>
                                @error('expected_closed_date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror

                                <x-inputs.hidden name="lead_pipeline_stage_id" value="1" />

                            </div>

                            {{-- Trip Section --}}
                            <div id="trip" class="p-4">
                                <div class="mb-4 relative">
                                    <x-inputs.text name="find_trips" label="{{ __('Trip') }}"
                                        value="{{ old('find_trips') }}" required autocomplete="find_trips" autofocus
                                        placeholder="Start typing title..." />
                                    <ul class="bg-white absolute shadow border-gray-100 appearance-none block border border-gray-200 leading-normal px-2 py-1 rounded text-base text-gray-800 w-full hidden z-990"
                                        id="select_trip">
                                    </ul>
                                    <x-inputs.hidden name="trip_id" />
                                </div>

                                <div class="mb-4">
                                    <x-inputs.partials.label name="trip_type_id" label="Trip Type" required />
                                    <span class="text-red-500">*</span>
                                    @foreach ($trip_types as $trip_type)
                                        <div>
                                            <input
                                                class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                                type="radio" name="trip_type_id" value="{{ $trip_type->id }}"
                                                {{ $trip_type->id === 1 ? 'checked' : '' }}>
                                            <label class="form-check-label text-gray-800"
                                                for="trip_type_id_{{ $trip_type->id }}">{{ $trip_type->name }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mb-4">
                                    <x-inputs.number name="traveler_count"
                                        label="{{ __('How many travelers are you?') }}" autocomplete="traveler_count"
                                        autofocus required />
                                </div>

                                <div class="mb-4">
                                    <x-inputs.date name="selected_trip_date" label="{{ __('Select Trip Date') }}"
                                        autocomplete="selected_trip_date" autofocus />
                                </div>

                                <div class="mb-4">
                                    <x-inputs.partials.label name="accomodation_id" label="Accomodation" required />
                                    <span class="text-red-500">*</span>
                                    @foreach ($accomodations as $acc)
                                        <div>
                                            <input
                                                class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                                type="radio" name="accomodation_id" value="{{ $acc->id }}"
                                                {{ $acc->id === 1 ? 'checked' : '' }}>
                                            <label class="form-check-label text-gray-800"
                                                for="accomodation_id_{{ $acc->id }}">{{ $acc->name }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mb-4">
                                    <x-inputs.partials.label name="transport_id" label="Choose Transportation"
                                        required />
                                    <span class="text-red-500">*</span>
                                    @foreach ($transports as $transport)
                                        <div>
                                            <input
                                                class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                                type="radio" name="transport_id" value="{{ $transport->id }}"
                                                {{ $transport->id === 1 ? 'checked' : '' }}>
                                            <label class="form-check-label text-gray-800"
                                                for="trip_type_id_{{ $transport->id }}">{{ $transport->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Lead Manager Section --}}
                            <div id="lead_manager_info" class="p-4">
                                <div class="mb-4 relative">
                                    <x-inputs.text type="search" name="lead_manager" label="{{ __('Name') }}"
                                        value="{{ old('lead_manager') }}" required autocomplete="lead_manager"
                                        autofocus placeholder="Start typing name..." />
                                    <ul class="bg-white absolute shadow border-gray-100 appearance-none block border border-gray-200 leading-normal px-2 py-1 rounded text-base text-gray-800 w-full hidden z-990"
                                        id="select_lm">
                                    </ul>
                                </div>
                                @error('lead_manager')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror

                                <div class="mb-4">
                                    <x-inputs.email name="email" label="{{ __('Email') }}" autocomplete="email"
                                        required />
                                </div>
                                <div class="mb-4">
                                    <x-inputs.text name="contact_number" label="{{ __('Phone') }}"
                                        autocomplete="contact_number" />
                                </div>
                                <x-inputs.hidden name="lead_manager_id" />
                            </div>

                            {{-- Product Section --}}
                            <div id="product" class="p-4">
                                <div id="add_product_form"></div>
                                <button class="font-bold text-center text-blue-500" type="button" id="add_product">+
                                    Add
                                    Product</button>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit"
                                class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">Save
                                as Lead</button>
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
        $(function() {
            $("#tabs").tabs();
        });
        $(document).ready(function() {
            var i = {{ 0 }};
            $("#lead_manager").keyup(function() {
                var search = $(this).val();
                if (search.length >= 2) {
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
                            search: search,
                            type: 1
                        },
                        url: "{{ route('leads.find_lm') }}",
                        dataType: 'json',
                        success: function(res) {
                            var len = res.length;
                            if (res != '') {
                                $("#select_lm").empty();
                                $("#select_lm").show();
                                for (var i = 0; i < len; i++) {
                                    var id = res[i]['id'];
                                    var name = res[i]['name'];

                                    $("#select_lm").append(
                                        "<li class='p-2 cursor-pointer' value='" +
                                        id + "'>" + name +
                                        "</li>");
                                }
                                $("#select_lm li").bind("click", function() {
                                    setLMInfo(this);
                                });
                            } else {
                                $("#select_lm").empty();
                                $("#select_lm li").html(
                                    "<p class='text-left'>No results found!</p>");
                            }
                        }
                    });
                } else {
                    $("#select_lm").empty();
                    $("#select_lm").hide();
                    $("#lead_manager_id").val('');
                    $("#email").val('');
                    $("#contact_number").val('');
                }
            });

            $("#find_trips").keyup(function() {
                var search_trip = $(this).val();
                if (search_trip.length >= 2) {
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
                            search_trip: search_trip,
                            type: 1
                        },
                        url: "{{ route('leads.find_trip') }}",
                        dataType: 'json',
                        success: function(res) {
                            var len = res.length;
                            if (res != '') {
                                $("#select_trip").empty();
                                $("#select_trip").show();
                                for (var i = 0; i < len; i++) {
                                    var t_id = res[i]['id'];
                                    var t_name = res[i]['title'];

                                    $("#select_trip").append(
                                        "<li class='p-2 cursor-pointer' value='" +
                                        t_id + "'>" + t_name +
                                        "</li>");
                                }
                                $("#select_trip li").bind("click", function() {
                                    setTripInfo(this);
                                });
                            } else {
                                $("#select_trip").empty();
                                $("#select_trip li").html(
                                    "<p class='text-left'>No results found!</p>");
                            }
                        }
                    });
                } else {
                    $("#select_trip").empty();
                    $("#select_trip").hide();
                    $("#find_trips_id").val('');
                    $("#email").val('');
                    $("#contact_number").val('');
                }
            });

            $(document).mouseup(function(e) {
                var container = $("#select_lm, .select_prd, #select_trip");

                // If the target of the click isn't the container
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    container.hide();
                }
            });

            $('#user_id').select2();

            $("#add_product").click(function() {
                ++i;
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
                        i: i,
                    },
                    url: "{{ route('leads.add_product') }}",
                    success: function(res) {
                        $('#add_product_form').append(res.html);
                    }
                });
            });

            $(document).on('click', '.delete-item', function() {
                var delete_id = $(this).data('id');
                $('.add_product_form_' + delete_id).remove();
            });

            $(document).on('keyup', '.find_product', function() {
                var item_id = $(this).data("id");
                var search_prd = $(this).val();
                if (search_prd.length >= 2) {
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
                            search_prd: search_prd,
                            type: 1
                        },
                        url: "{{ route('leads.find_prd') }}",
                        dataType: 'json',
                        success: function(res) {
                            var len = res.length;
                            if (res != '') {
                                $("#select_prd_" + item_id).empty();
                                $("#select_prd_" + item_id).show();

                                // $.each(res, function(index, value){
                                //     $('.product_id').each(function(){
                                //         var selected = $(this).val();
                                //         if(selected == res.id){
                                //             res.splice(index, selected);
                                //         }
                                //     })
                                // });

                                for (var i = 0; i < len; i++) {
                                    var prdid = res[i]['id'];
                                    var name = res[i]['name'];

                                    $("#select_prd_" + item_id).append(
                                        "<li class='p-2 cursor-pointer' value='" +
                                        prdid + "'>" + name +
                                        "</li>");
                                }
                                $("#select_prd_" + item_id + " li").bind("click", function() {
                                    setPrdInfo(this, item_id);
                                });
                            } else {
                                $("#select_prd_" + item_id).empty();
                                $("#select_prd_" + item_id + " li").html(
                                    "<p class='text-left'>No results found!</p>");
                            }
                        }
                    });
                } else {
                    $("#select_prd_" + item_id).empty();
                    $("#select_prd_" + item_id).hide();
                    $("input[name='products[" + item_id + "][price]'").val('');
                    $("input[name='products[" + item_id + "][quantity]'").val('');
                    $("input[name='products[" + item_id + "][amount]'").val('');
                    $("input[name='products[" + item_id + "][id]'").val('');
                }
            });

            $(document).on('keyup', '.edit_price, .edit_qty', function() {
                var edit = $(this).data('id');
                let edit_price = $("input[name='products[" + edit + "][price]'").val();
                let edit_qty = $("input[name='products[" + edit + "][quantity]'").val();
                let new_amount = edit_price * edit_qty;
                $("input[name='products[" + edit + "][amount]'").val(new_amount);
            });

            function setPrdInfo(prd_info, nearest) {
                var product_name = $(prd_info).text();
                var product_id = $(prd_info).val();

                $("input[name='products[" + nearest + "][name]'").val(product_name);
                $("#select_prd_" + nearest).empty();
                $("#select_prd_" + nearest).hide();

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
                        prd_id: product_id,
                        type: 2
                    },
                    url: "{{ route('leads.find_prd') }}",
                    dataType: 'json',
                    success: function(response) {
                        $("#select_prd_" + nearest).empty();
                        $("#select_prd_" + nearest).hide();
                        if (response) {
                            var prod_id = response.id;
                            var qty = response.quantity;
                            var price = response.price;
                            var amount = price * qty;
                            $("input[name='products[" + nearest + "][id]'").val(prod_id);
                            $("input[name='products[" + nearest + "][price]'").val(price);
                            $("input[name='products[" + nearest + "][quantity]'").val(qty);
                            $("input[name='products[" + nearest + "][amount]'").val(amount);
                        }
                    }
                });
            }

            function setLMInfo(element) {
                var value = $(element).text();
                var user_id = $(element).val();

                $("#lead_manager").val(value);
                $("#select_lm").empty();
                $("#select_lm").hide();

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
                    url: "{{ route('leads.find_lm') }}",
                    dataType: 'json',
                    success: function(response) {
                        var len = response.length;
                        $("#select_lm").empty();
                        $("#select_lm").hide();
                        if (response) {
                            var email = response.email;
                            var phone = response.contact_number;
                            var lm_id = response.id;
                            $("#email").val(email);
                            $("#lead_manager_id").val(lm_id);
                            $("#contact_number").val(phone);
                        }
                    }
                });
            }

            function setTripInfo(element) {
                var value = $(element).text();
                var trip_id = $(element).val();

                $("#find_trips").val(value);
                $("#select_trip").empty();
                $("#select_trip").hide();

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
                        trip_id: trip_id,
                        type: 2
                    },
                    url: "{{ route('leads.find_trip') }}",
                    dataType: 'json',
                    success: function(response) {
                        var len = response.length;
                        $("#select_trip").empty();
                        $("#select_trip").hide();
                        if (response) {
                            var s_t_id = response.id;
                            $("#trip_id").val(s_t_id);
                        }
                    }
                });
            }
        });
    </script>
</x-app-layout>
