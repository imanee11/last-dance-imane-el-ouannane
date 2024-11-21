<x-app-layout>
    {{-- flesh messages --}}
    <div>
        {{-- script for the flash messages --}}
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const flashMessage = document.getElementById('flashMessage');
                
                if (flashMessage) {
                    setTimeout(() => {
                        flashMessage.style.right = '20px';
                    }, 100); 
        
                    setTimeout(() => {
                        flashMessage.style.right = '-300px';
                    }, 3000); 
        
                    setTimeout(() => {
                        flashMessage.remove();
                    }, 3500);
                }
            });
        </script>
        

        @if(session('success'))
            <div  id="flashMessage" class="fixed flex items-center gap-2 right-[-300px] top-5 flash-message bg-[#6dc489] text-white px-4 py-4 rounded-md mb-4 shadow-lg transition-all duration-300">
                <i class="fa-solid fa-thumbs-up text-[15px]"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div  id="flashMessage" class="fixed flex items-center gap-2 right-[-300px] top-5 flash-message bg-red-500 text-white px-4 py-4 rounded-md mb-4 shadow-lg transition-all duration-300">
                <i class="fa-solid fa-thumbs-up text-[15px]"></i>
                {{ session('error') }}
            </div>
        @endif

        @if(session('info'))
            <div  id="flashMessage" class="fixed flex items-center gap-2 right-[-300px] top-5 flash-message bg-[#6737f5] text-white px-4 py-4 rounded-md mb-4 shadow-lg transition-all duration-300">
                <i class="fa-solid fa-thumbs-up text-[15px]"></i>
                {{ session('info') }}
            </div>
        @endif

    </div>

    {{-- modal --}}
    <div>
        {{-- create team modal --}}
        <div id="createTeamModal" class="fixed inset-0 bg-[#101010] bg-opacity-75 flex items-center justify-center z-50 hidden transition-opacity duration-300">
        
            {{-- modal content --}}
            <div class="bg-[#272727] border-[1px] border-[#2e2e2e] rounded-2xl  shadow-md shadow-black/40 w-full max-w-md p-6">

                {{-- modal header --}}
                <div class="flex justify-between items-center  pb-4">
                    <h2 class="text-lg font-medium text-gray-100">Create a Team</h2>
                    <button class="text-[#eb8541] hover:text-[#fff] text-[25px] focus:outline-none cursor-pointer transition duration-300" onclick="document.getElementById('createTeamModal').classList.add('hidden');">
                        &times;
                    </button>
                </div>


                {{-- modal form --}}
                <form action="{{ route('team.store') }}" method="POST" class="mt-4">
                    @csrf

                    {{-- team name --}}
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Team name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="teamname" required autocomplete="" />
                    </div>


                    {{-- team description --}}
                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Team description ')" />
                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            class="block mt-1 w-full border-[#fff]/25 bg-transparent focus:outline-none focus:ring-0 focus:border-[#fff]/25 text-[#fff] rounded-md shadow-sm"
                        ></textarea>
                    </div>


                    {{--Submit Button  --}}
                    <div class="flex justify-end gap-2">
                        <button type="button" class="inline-flex items-center px-4 py-2 bg-transparent border border-[#fff]/25  rounded-md font-semibold text-xs text-gray-300 uppercase tracking-widest shadow-sm  focus:outline-none disabled:opacity-25 transition ease-in-out duration-300" onclick="document.getElementById('createTeamModal').classList.add('hidden');">
                            Cancel
                        </button>
                        <button type="submit" class="font-semibold rounded-md px-4 py-2 bg-[#6737f5] text-[#fff] border-[2px] border-[#6737f5] transition duration-300 text-xs uppercase tracking-widest">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div> 
    </div>

    <div class="px-[3vw] flex items-center justify-between ">

        {{-- buttons --}}
        <div class="py-[6vh] flex items-center gap-3 ">
            <button 
                class="bg-[#272727] border-[1px] border-[#2e2e2e] rounded-full px-4 py-2 text-[#fff] flex gap-2 items-center text-sm font-medium"
                onclick="document.getElementById('createTeamModal').classList.remove('hidden');"
                >
                <i class="fa-solid fa-people-group text-[#6dc489] text-[15px]"></i>
                Create a Team
            </button>
    
        </div>

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
</x-app-layout>
