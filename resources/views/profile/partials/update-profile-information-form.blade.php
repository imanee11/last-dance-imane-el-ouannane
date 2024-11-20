<section>
    <header>
        <h2 class="text-lg font-medium text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="flex flex-col justify-center">
            {{-- to show pfp --}}
            <div class="pb-3">
                @if($user->image)
                <div class="mt-3">
                    <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Picture" class="w-40 h-40 rounded-full object-cover">
                </div>
                @else
                    <p class="mt-2 text-sm text-gray-400">No profile picture uploaded.</p>
                @endif
            </div>

            <div>
                {{-- <x-input-label for="image" :value="__('Upload profile picture')" class="pb-3" /> --}}
                <div class="relative">
                    <x-text-input 
                        id="image" 
                        name="image" 
                        type="file" 
                        class="hidden" 
                        :value="old('image', $user->image)" 
                        autocomplete="image" 
                    />
            
                    <button type="button" onclick="document.getElementById('image').click()" class="px-4 py-2 bg-[#2e2e2e] text-white rounded-full flex items-center space-x-2">
                        <i class="fas fa-user-circle"></i>
                        <span>Choose Profile Picture</span>
                    </button>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('image')" />
            </div>
        </div>
        
        

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-400 hover:text-gray-100 rounded-md focus:outline-none ">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- <div>
            <x-input-label for="image" :value="__('Upload profile picture')" />
            <x-text-input id="image" name="image" type="file" class="mt-1 block w-full" :value="old('image', $user->image)" required autofocus autocomplete="image" />
            <x-input-error class="mt-2" :messages="$errors->get('image')" />
        </div> --}}

        <div class="flex items-center gap-4">
            <button class="font-semibold rounded-md px-4 py-2 bg-[#6737f5] text-[#fff] border-[2px] border-[#6737f5] transition duration-300 text-xs uppercase tracking-widest">
                {{ __('Save') }}
            </button>
            {{-- <x-primary-button>{{ __('Save') }}</x-primary-button> --}}

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-[#dd4a79]"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
