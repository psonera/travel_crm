<tabs>
  @can('create.activities')
  <tab name="Note" :selected="true">
    <form action="{{ route('activities.store') }}" method="POST" class="p-6">
      @csrf
      <div class="mb-4">
        <label class="p-2 font-semibold text-gray-700">Note</label>
        <span class="text-red-500">*</span>
        <input type="hidden" name="type" value="note">
        <input type="hidden" name="lead_id" value="{{ $lead->id }}">
        <textarea name="comment" rows="5"
            class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"></textarea>
        @error('comment')
            <p class="text-red-500 text-lg mt-1">{{ $message }}</p>
        @enderror
        <button type="submit" class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">Save Note</button>
      </div>
    </form>
  </tab>
  @endcan
  @can('create.activities')
  <tab name="Activity">
    <form action="{{ route('activities.store') }}" method="POST" class="p-6">
      @csrf
      <div class="mb-4">
        <label class="p-2 font-semibold text-gray-700">Title</label>
        <span class="text-red-500">*</span>
        <input type="text" name="title"
            class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow">
      </div>
      @error('title')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
      <div class="mb-4">
          <label class="p-2 font-semibold text-gray-700">Type</label>
          <span class="text-red-500">*</span>
          <select name="type"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg f w-full dark:text-black m-0.5 p-1.5">
              <option disable class="p-2" value="">Choose Type</option>
              <option value="call" class="p-2">Call</option>
              <option value="meeting" class="p-2">Meeting</option>
          </select>
      </div>
      @error('type')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
      <div class="flex gap-2">
        <div class="mb-4 w-full">
            <label class="p-2 font-semibold text-gray-700">Schedule From</label>
            <span class="text-red-500">*</span>
            <input type="datetime-local" name="schedule_from"
                class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow">
        </div>
        @error('schedule_from')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        <div class="mb-4 w-full">
            <label class="p-2 font-semibold text-gray-700">Schedule To</label>
            <span class="text-red-500">*</span>
            <input type="datetime-local" name="schedule_to"
                class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow">
        </div>
        @error('schedule_to')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-4">
          <label class="p-2 font-semibold text-gray-700">Location</label>
          <input type="text" name="location"
              class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow">
      </div>
      <div class="mb-4 relative">
          <participants :data="{{ json_encode(old('participants')) }}"></participants>
      </div>
      <input type="hidden" name="lead_id" value="{{ $lead->id }}">
      <button type="submit" class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">Save Activity</button>
    </form>
  </tab>
  @endcan
  @can('compose.mails')
  <tab name="Email">
    <form action="{{ route('mails.store') }}" method="POST" class="p-6" enctype="multipart/form-data">
      @csrf
      <div class="mb-4">
        <email-to></email-to>
      </div>
      <div class="mb-4">
          <label class="p-2 font-semibold text-gray-700">Subject</label>
          <span class="text-red-500">*</span>
          <input type="text" name="subject"
              class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
              placeholder="Start Typing name">
      </div>
      <div class="mb-4">
          <label class="p-2 font-semibold text-gray-700">Reply</label>
          <span class="text-red-500">*</span>
          <textarea name="content" id="content" rows="5"
              class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
              name="description"></textarea>
      </div>
      <div class="mb-4">
        <label class="p-2 font-semibold text-gray-700">Attachments</label>
        <attachment></attachment>
      </div>
      @error('attachment')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
      @enderror
      <button type="submit" name="save" class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">
        <i class="fa fa-paper-plane-o"></i>   Send
      </button> 
    </form>
  </tab>
  @endcan
  @can('create.activities')
  <tab name="File">
    <form action="{{ route('activity_file.store') }}" method="POST" class="p-6" enctype="multipart/form-data">
      @csrf
      <div class="mb-4">
        <label class="p-2 font-semibold text-gray-700">Name</label>
        <input type="text" name="title"
            class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow">
      </div>
      <div class="mb-4">
          <div class="mb-4">
              <label class="p-2 font-semibold text-gray-700">Description</label>
              <textarea name="comment" rows="5"
                  class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow"
                  ></textarea>
          </div>
      </div>
      <div class="mb-4">
          <label for="" class="p-2 font-semibold text-gray-700">File</label>
          <span class="text-red-500">*</span>
          <input name="activity_file" type="file"
              class="text-size-md focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow">
      </div>
      @error('activity_file')
          <p class="text-red-500 text-lg mt-1">{{ $message }}</p>
      @enderror
      <input type="hidden" name="type" value="file">
      <input type="hidden" name="lead_id" value="{{ $lead->id }}">
      <button type="submit" class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md hover:border-slate-700 hover:bg-slate-700 hover:text-white">Save File</button>
    </form>
  </tab>
  @endcan
  @can('create.quotations')
  <tab name="Quotation">
    <div class="p-6">
      <a href="{{ route('quotations.create', ['lead_id' => $lead->id]) }}"
          class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">Create
          Quote</a>
    </div>
  </tab>
  @endcan
</tabs>