<x-app-layout>
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none max-w-full ml-auto mr-auto px-3 w-full">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid inline-flex pb-2 rounded-t-2xl border-b-transparent">
                    <h2 class="text-3xl font-bold">Create User</h2>
                    
                </div>
                <div class="flex-auto p-6" role="tabpanel">
                    <form role="form" method="POST" action="{{ route('settings.users.store') }}">  
                        @csrf
                        <fieldset class="border border-solid border-gray-300 p-6">
                            <legend class="text-xl pl-4 pr-4">Details</legend>
                            
                            <div class="mb-4">
                                <x-inputs.text name="name" label="{{ __('Name') }}" value="{{ old('name') }}" required autocomplete="name" autofocus />
                            </div>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            
                            <div class="mb-4">
                                <x-inputs.email name="email" label="{{ __('Email Address') }}" value="{{ old('email') }}" required autocomplete="email" autofocus />
                            </div>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
             
                            <div class="mb-4">
                                <x-inputs.password name="password" class="js-password" label="{{ __('Password') }}" autofocus />
                                <input class="hidden js-password-toggle" id="toggle" type="checkbox" />
                                <label class="bg-gray-300 hover:bg-gray-400 rounded px-2 py-1 text-sm text-gray-600 font-mono cursor-pointer js-password-label" for="toggle">show</label>
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mb-4">
                                <x-inputs.password label="{{ __('Confirm Password') }}" id="password-confirm" name="password_confirmation" required autocomplete="new-password" autofocus />
                            </div>
                            @error('confirm password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mb-4">
                                Status
                                <div class="flex items-center pl-4 rounded border border-gray-200 dark:border-gray-700">
                                    <input id="yes" type="radio" value="1" name="status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="yes" class="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Active</label>
                                </div>
                                <div class="flex items-center pl-4 rounded border border-gray-200 dark:border-gray-700">
                                    <input id="no" type="radio" value="0" name="status" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="no" class="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Inactive</label>
                                </div>
                            </div>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                        </fieldset>
                        
                        <div class="text-center">
                            <button type="submit"
                                class="inline-block px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-black border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-size-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-dark-gray hover:border-slate-700 hover:bg-slate-700 hover:text-white">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
const passwordToggle = document.querySelector('.js-password-toggle')

passwordToggle.addEventListener('change', function() {
  const password = document.querySelector('.js-password'),
    passwordLabel = document.querySelector('.js-password-label')

  if (password.type === 'password') {
    password.type = 'text'
    passwordLabel.innerHTML = 'hide'
  } else {
    password.type = 'password'
    passwordLabel.innerHTML = 'show'
  }

  password.focus()
})

</script>    
</x-app-layout>
