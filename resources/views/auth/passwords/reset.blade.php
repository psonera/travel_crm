<x-login-layout>
    <section>
        <div class="relative flex items-center p-0 overflow-hidden bg-center bg-cover min-h-75-screen">
            <div class="container z-10">
                <div class="flex flex-wrap mt-0 -mx-3">
                    <div
                        class="flex flex-col w-full max-w-full px-3 mx-auto md:flex-0 shrink-0 md:w-6/12 lg:w-5/12 xl:w-1/2">
                        <div
                            class="relative flex flex-col min-w-0 mt-32 break-words bg-transparent border-0 shadow-none rounded-2xl bg-clip-border">
                           	 <div>
                                <x-partials.card>
                                    <x-slot name="title">{{ __('Reset Password') }}</x-slot>
                                    <div class=" ">
                                        <form method="POST" action="{{ route('password.update') }}">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $token }}">
                                            <div class="mb-4 flex flex-wrap  p-2 justify-center">
                                                <div class="w-full pr-4 pl-4 ">
                                                    <x-inputs.email label="E-Mail Address" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                                                    placeholder="Email Address"
                                                    />

                                                    @error('email')
                                                        <span class="hidden mt-1 text-sm text-red" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-4 flex flex-wrap p-2 justify-center">


                                                <div class="w-full pr-4 pl-4 ">
                                                    <x-inputs.password label="Password" name="password" required autocomplete="new-password"
                                                    placeholder="new password"
                                                    />

                                                    @error('password')
                                                        <span class="hidden mt-1 text-sm text-red" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-4 flex flex-wrap p-2 justify-center">


                                                <div class="w-full pr-4 pl-4 ">
                                                    <x-inputs.password label="Confrim Password" id="password-confirm" name="password_confirmation" required autocomplete="new-password"
                                                    placeholder="Confrim password"
                                                    />
                                                </div>
                                            </div>
                                            <div class="mb-4 flex flex-wrap justify-center p-2 ">
                                                <div >
                                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 hover:text-white  p-2 rounded text-black font-bold">
                                                        Reset Password
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </x-partials.card>

                            </div>
                    </div>
                </div>
                <div class="w-full max-w-full px-3 lg:flex-0 shrink-0 md:w-6/12">
                    <div
                        class="absolute top-0 hidden w-3/5 h-full -mr-32 overflow-hidden -skew-x-10 -right-40 rounded-bl-xl md:block">
                        <div class="absolute inset-x-0 top-0 z-0 h-full -ml-16 bg-cover skew-x-10"
                            style="background-image: url('/img/curved-images/curved6.jpg')"></div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</x-login-layout>
