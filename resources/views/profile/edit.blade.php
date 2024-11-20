<x-app-layout >

    <div class="py-[15vh] w-[100%]">
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
