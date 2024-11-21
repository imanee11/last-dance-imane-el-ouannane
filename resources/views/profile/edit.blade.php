<x-app-layout >

    <div class="px-[3vw] py-[6vh] flex items-center justify-end ">
        <div class="profile-picture flex items-center gap-2">

            <div>
                <p class="text-[#fff] text-sm font-medium">{{ Auth::user()->name }}</p>
            </div>

            @if ($user->image)
            <a href={{ route('profile.edit') }}>
                <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Picture" class="w-12 h-12 rounded-full object-cover cursor-pointer border-[2px] border-[#2e2e2e]">
            </a>
            @else
            <a href={{ route('profile.edit') }}>
                <i class="fas fa-user-circle text-[#2e2e2e] text-4xl"></i>
            </a>
            @endif

        </div>

    </div>

    <div class="py-[2vh] w-[100%]">
        <div class=" mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class=" p-4 sm:p-8 bg-[#272727] border-[1px] border-[#2e2e2e] rounded-2xl  shadow-md shadow-black/40 ">
                <div class="">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-[#272727] border-[1px] border-[#2e2e2e] rounded-2xl  shadow-md shadow-black/40 ">
                <div class="">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-[#272727] border-[1px] border-[#2e2e2e] rounded-2xl  shadow-md shadow-black/40">
                <div class="">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
