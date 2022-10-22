<x-app-layout>
  @can('update leads')
  <div class="inline-flex mb-4 w-full">
    <div class="ml-auto block">
        <a href="{{ route('leads.edit', $lead) }}"><button class="active:opacity-85 align-middle bg-black border-0 cursor-pointer ease-soft-in font-bold hover:bg-slate-700 hover:border-slate-700 hover:scale-102 hover:shadow-soft-xs hover:text-white leading-pro mb-2 px-8 py-4 rounded-lg shadow-soft-md text-center text-sm text-white tracking-tight-soft transition-all uppercase">Edit</button></a>
    </div>
  </div>
  @endcan  
  <div class="grid grid-cols-6 gap-4">
      <div class="col-start-1 col-end-3">
          <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="p-4 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex flex-wrap -mx-3">
                  <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                    <h6 class="mb-0 text-2xl font-bold">Details</h6>
                  </div>
                </div>
              </div>
              <div class="flex-auto p-4 pb-0">
                <ul class="flex flex-col pl-0 mb-6 rounded-lg">
                  <li class="relative flex justify-between ml-4 px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-t-inherit text-size-inherit rounded-xl">
                    <div class="flex flex-col">
                      <h6 class="mb-1 font-semibold leading-normal text-lg text-slate-700">Title</h6>
                    </div>
                    <div class="flex items-center leading-normal text-lg">
                      {{ $lead->title }}
                    </div>
                  </li>
                  <li class="relative flex justify-between ml-4 px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-xl text-inherit">
                    <div class="flex flex-col">
                      <h6 class="mb-1 font-semibold leading-normal text-lg text-slate-700">Description</h6>
                    </div>
                    <div class="flex items-center leading-normal text-lg">
                      {{ \Str::limit($lead->description, 12, $end='...') }}
                    </div>
                  </li>
                  <li class="relative flex justify-between ml-4 px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-xl text-inherit">
                    <div class="flex flex-col">
                      <h6 class="mb-1 font-semibold leading-normal text-lg text-slate-700">Lead Value</h6>
                    </div>
                    <div class="flex items-center leading-normal text-lg">
                      <i class="fas fa-rupee-sign"></i>{{ $lead->lead_value }}
                    </div>
                  </li>
                  <li class="relative flex justify-between ml-4 px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-xl text-inherit">
                    <div class="flex flex-col">
                      <h6 class="mb-1 font-semibold leading-normal text-lg text-slate-700">Source</h6>
                    </div>
                    <div class="flex items-center leading-normal text-lg">
                      {{ $lead->leadSource->name }}
                    </div>
                  </li>
                  <li class="relative flex justify-between ml-4 px-4 py-2 pl-0 bg-white border-0 rounded-b-inherit rounded-xl text-inherit">
                    <div class="flex flex-col">
                      <h6 class="mb-1 font-semibold leading-normal text-lg text-slate-700">Type</h6>
                    </div>
                    <div class="flex items-center leading-normal text-lg">
                      {{ $lead->leadType->name }}
                    </div>
                  </li>
                  <li class="relative flex justify-between ml-4 px-4 py-2 pl-0 bg-white border-0 rounded-b-inherit rounded-xl text-inherit">
                      <div class="flex flex-col">
                        <h6 class="mb-1 font-semibold leading-normal text-lg text-slate-700">Sales Owner</h6>
                      </div>
                      <div class="flex items-center leading-normal text-lg">
                          <a class="text-blue-400" href="{{ route('settings.users.edit', $lead->user->id) }}">{{ $lead->user->name }}</a>
                      </div>
                  </li>
                  <li class="relative flex justify-between ml-4 px-4 py-2 pl-0 bg-white border-0 rounded-b-inherit rounded-xl text-inherit">
                      <div class="flex flex-col">
                        <h6 class="mb-1 font-semibold leading-normal text-lg text-slate-700">Expected Closed Date</h6>
                      </div>
                      <div class="flex items-center leading-normal text-lg">
                          {{ $lead->expected_closed_date->format('d-m-Y');}}
                    </div>
                  </li>
                </ul>
              </div>
          </div>

          <div class="mt-10 relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="p-4 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex flex-wrap -mx-3">
                  <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                    <h6 class="mb-0 text-2xl font-bold">Lead Manager</h6>
                  </div>
                </div>
              </div>
              <div class="flex-auto p-4 pb-0">
                <ul class="flex flex-col pl-0 mb-6 rounded-lg">
                  <li class="relative flex justify-between ml-4 px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-t-inherit text-size-inherit rounded-xl">
                    <div class="flex flex-col">
                      <h6 class="mb-1 font-semibold leading-normal text-lg text-slate-700">Name</h6>
                    </div>
                    <div class="flex items-center leading-normal text-lg">
                      <a class="text-blue-400" href="{{ route('lead_managers.edit',  $lead->leadManager->id) }}">{{ $lead->leadManager->name }}</a>
                    </div>
                  </li>
                  <li class="relative flex justify-between ml-4 px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-xl text-inherit">
                    <div class="flex flex-col">
                      <h6 class="mb-1 font-semibold leading-normal text-lg text-slate-700">Email</h6>
                    </div>
                    <div class="flex items-center leading-normal text-lg">
                      {{ $lead->leadManager->email }}
                    </div>
                  </li>
                  <li class="relative flex justify-between ml-4 px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-xl text-inherit">
                    <div class="flex flex-col">
                      <h6 class="mb-1 font-semibold leading-normal text-lg text-slate-700">Contact Number</h6>
                    </div>
                    <div class="flex items-center leading-normal text-lg">
                      {{ $lead->leadManager->phone_number ? $lead->leadManager->phone_number : '-' }}
                    </div>
                  </li>
                </ul>
              </div>
          </div>

          <div class="mt-10 relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="p-4 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex flex-wrap -mx-3">
                  <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                    <h6 class="mb-0 text-2xl font-bold">Products</h6>
                  </div>
                </div>
              </div>
              <div class="flex-auto p-4 pb-0">
                <ul class="flex flex-col pl-0 mb-6 border-b-2 last:border-b-0">
                  @forelse ($lead->leadProducts as $product)
                      <li class="relative justify-between ml-4 px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-t-inherit text-size-inherit rounded-xl">
                          <div class="flex flex-col">
                              <h6 class="mb-1 font-semibold leading-normal text-lg text-slate-700">Item</h6>
                              <div class="border-2 p-4 rounded-lg">{{ $product->product->name }}</div>
                          </div>
                      </li>
                      <li class="bg-white border-0 border-b-2 flex mb-2 ml-4 pb-6 pl-0 px-4 py-2 relative rounded-b-none rounded-xl text-inherit">
                          <div class="flex flex-col">
                              <h6 class="mb-1 font-semibold leading-normal text-lg text-slate-700">Price</h6>
                              <div class="border-2 p-4 rounded-lg w-[100px] mr-4">{{ $product->price }}</div>
                          </div>
                          <div class="flex flex-col">
                              <h6 class="mb-1 font-semibold leading-normal text-lg text-slate-700">Quantity</h6>
                              <div class="border-2 p-4 rounded-lg w-[100px] mr-4">{{ $product->quantity }}</div>
                          </div>
                          <div class="flex flex-col">
                              <h6 class="mb-1 font-semibold leading-normal text-lg text-slate-700">Amount</h6>
                              <div class="border-2 p-4 rounded-lg w-[100px]">{{ $product->amount }}</div>
                          </div>
                      </li>
                  @empty
                  <div class="z-10 flex items-center justify-center opacity-50">
                      <div class="text-black-500 text-center">
                        <img src="/img/no_data.svg" class="text-center h-50 w-50 ml-auto mr-auto mb-8"
                            height="150" width="150" alt="No Data" />
                        <p class="text-2xl">No Products found!</p>
                      </div>
                    </div>
                  @endforelse 
                </ul>
              </div>
          </div>
      </div>
      <div class="col-start-3 col-end-10">
          <progress-bar :lead_id="{{ $lead->id }}" :current_lead_stage="{{ $lead->lead_pipeline_stage_id }}"></progress-bar>
          <div class="mt-10 w-full h-auto bg-white rounded-lg">
              @include('leads.view.activity-action')
          </div>  
          <div class="mt-10 w-full h-auto bg-white rounded-lg">
            @include('leads.view.activities-list')
          </div>
      </div>
  </div>    
  @section('page_scripts')
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        var editor = new FroalaEditor('#content');
    </script>    
  @endsection
</x-app-layout>
