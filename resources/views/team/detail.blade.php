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
    
    {{-- modals --}}
    <div>
        {{-- create task modal --}}
        <div id="createTaskModal" class="fixed inset-0 bg-[#101010] bg-opacity-75 flex items-center justify-center z-50 hidden transition-opacity duration-300">
            {{-- modal content --}}
            <div class="bg-[#1C1C1C] border-[1px] border-[#2e2e2e] rounded-2xl  shadow-md shadow-black/40 w-full max-w-md p-6">
                {{-- modal header --}}
                <div class="flex justify-between items-center  pb-4">
                    <h2 class="text-lg font-medium text-gray-100">Create a Task</h2>
                    <button
                        class="text-[#eb8541] hover:text-[#fff] text-[25px] focus:outline-none cursor-pointer transition duration-300"
                        onclick="document.getElementById('createTaskModal').classList.add('hidden');"
                    >
                        &times;
                    </button>
                </div>

                {{-- modal form --}}
                <form action="{{ route('task.store') }}" method="POST" class="mt-4">
                    @csrf

                    {{-- task name --}}
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Task name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required autocomplete="" />
                    </div>

                    {{-- task description --}}
                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Task description ')" />
                        <textarea
                            name="description"
                            id="description"
                            rows="1"
                            class="block mt-1 w-full border-[#fff]/25 bg-transparent focus:outline-none focus:ring-0 focus:border-[#fff]/25 text-[#fff] rounded-md shadow-sm"
                        ></textarea>
                    </div>

                    {{-- task deadline --}}
                    <div class="mb-4">
                        <x-input-label for="start" :value="__('Task start')" />
                        <x-text-input id="start" class="block mt-1 w-full" type="datetime-local" name="start" required autocomplete="" min="{{ date('Y-m-d\TH:i') }}" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="end" :value="__('Task end')" />
                        <x-text-input id="end" class="block mt-1 w-full" type="datetime-local" name="end" required autocomplete="" min="{{ date('Y-m-d\TH:i') }}" />
                    </div>

                    {{-- Task Priority --}}
                    <div class="mb-4">
                        <x-input-label for="priority" :value="__('Task priority')" />
                        <select 
                            id="priority" 
                            name="priority" 
                            class="block mt-1 w-full border-[#fff]/25 bg-transparent focus:outline-none focus:ring-0 focus:border-[#fff]/25 text-[#fff] rounded-md shadow-sm"
                            required
                        >
                            <option value="low" class="text-[#000]">Low</option>
                            <option value="medium" class="text-[#000]">Medium</option>
                            <option value="high" class="text-[#000]">High</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end gap-2">
                        <button
                            type="button"
                            class="inline-flex items-center px-4 py-2 bg-transparent border border-[#fff]/25  rounded-md font-semibold text-xs text-gray-300 uppercase tracking-widest shadow-sm  focus:outline-none disabled:opacity-25 transition ease-in-out duration-300"
                            onclick="document.getElementById('createTaskModal').classList.add('hidden');"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="font-semibold rounded-md px-4 py-2 bg-[#6737f5] text-[#fff] border-[2px] border-[#6737f5] transition duration-300 text-xs uppercase tracking-widest"
                        >
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div> 

        {{-- add member modal (only visible to team owner) --}}
        @if(Auth::id() === $team->owner_id)
        <div id="addMember" class="fixed inset-0 bg-[#101010] bg-opacity-75 flex items-center justify-center z-50 hidden transition-opacity duration-300">
            {{-- modal content --}}
            <div class="bg-[#1C1C1C] border-[1px] border-[#2e2e2e] rounded-2xl  shadow-md shadow-black/40 w-full max-w-md p-6">
                {{-- modal header --}}
                <div class="flex justify-between items-center  pb-4">
                    <h2 class="text-lg font-medium text-gray-100">Add a Member</h2>
                    <button
                        class="text-[#eb8541] hover:text-[#fff] text-[25px] focus:outline-none cursor-pointer transition duration-300"
                        onclick="document.getElementById('addMember').classList.add('hidden');">
                        &times;
                    </button>
                </div>

                {{-- modal form --}}
                <form action="{{ route('team.invite', $team) }}" method="POST" class="mt-4">
                    @csrf
                
                    <!-- Member Email -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Member Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required />
                    </div>
                
                    <!-- Submit Button -->
                    <div class="flex justify-end gap-2">
                        <button
                            type="button"
                            class="inline-flex items-center px-4 py-2 bg-transparent border border-[#fff]/25 rounded-md font-semibold text-xs text-gray-300 uppercase tracking-widest shadow-sm focus:outline-none transition ease-in-out duration-300"
                            onclick="document.getElementById('addMember').classList.add('hidden');">
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="font-semibold rounded-md px-4 py-2 bg-[#6737f5] text-[#fff] border-[2px] border-[#6737f5] transition duration-300 text-xs uppercase tracking-widest">
                            Send Invitation
                        </button>
                    </div>
                </form>
            </div>
        </div> 
        @endif


        {{-- showMembers --}}
        {{-- show members modal (only visible to team owner) --}}
        @if(Auth::id() === $team->owner_id)
        <div id="showMembers" class="fixed inset-0 bg-[#101010] bg-opacity-75 flex items-center justify-center z-50 hidden transition-opacity duration-300">
            {{-- modal content --}}
            <div class="bg-[#1C1C1C] border-[1px] border-[#2e2e2e] rounded-2xl  shadow-md shadow-black/40 w-full max-w-md p-6">
                {{-- modal header --}}
                <div class="flex justify-between items-center  pb-4">
                    <h2 class="text-lg font-medium text-gray-100">All members</h2>
                    <button
                        class="text-[#eb8541] hover:text-[#fff] text-[25px] focus:outline-none cursor-pointer transition duration-300"
                        onclick="document.getElementById('showMembers').classList.add('hidden');">
                        &times;
                    </button>
                </div>
                
                {{-- Modal Body --}}
                <div>
                    <div class="flex flex-col gap-2">
                        @foreach($team->users as $user)
                            <div class="flex items-center justify-between border-[#2e2e2e] border-[1px] py-2 px-3 rounded-md shadow-sm cursor-pointer">
                                <div class="flex items-center gap-2">
                                    @if($user->image)
                                        <img class="w-8 h-8 rounded-full border-2 border-[#2e2e2e] object-cover" 
                                            src="{{ asset('storage/' . $user->image) }}" 
                                            alt="{{ $user->name }}"
                                            title="{{ $user->name }}">
                                    @else
                                        <div class="w-8 h-8 rounded-full border-2 border-[#2e2e2e] bg-gray-600 flex items-center justify-center">
                                            <span class="text-white text-xs">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </span>
                                        </div>
                                    @endif
                                    <p class="text-[#fff] font-medium">{{ $user->name }}</p>
                                </div>
                                <div class="">
                                    <a href="" class="text-xs font-medium text-[#6737f5]/60  hover:text-[#6737f5] underline">Remove</a>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div> 
        @endif
    </div>

    {{-- top part --}}
    <div class="px-[3vw] flex items-center justify-between ">
        {{-- buttons --}}
        <div class="py-[6vh] flex items-center gap-3 ">    
            <button
                class="bg-[#272727] border-[1px] border-[#2e2e2e] rounded-full px-4 py-2 text-[#fff] flex gap-2 items-center text-sm font-medium"
                onclick="document.getElementById('createTaskModal').classList.remove('hidden');">
                <i class="fa-solid fa-list-check text-[#dd4a79] text-[15px]"></i>
                Create a Task
            </button>

            @if(Auth::id() === $team->owner_id)
            <button
                class="bg-[#272727] border-[1px] border-[#2e2e2e] rounded-full px-4 py-2 text-[#fff] flex gap-2 items-center text-sm font-medium"
                onclick="document.getElementById('addMember').classList.remove('hidden');">
                <i class="fa-solid fa-user-plus text-[#6737f5] text-[15px]"></i>
                Add a Member
            </button>
            @endif


            @if(Auth::id() === $team->owner_id)
            <button
                class="bg-[#272727] border-[1px] border-[#2e2e2e] rounded-full px-4 py-2 text-[#fff] flex gap-2 items-center text-sm font-medium"
                onclick="document.getElementById('showMembers').classList.remove('hidden');">
                <i class="fa-solid fa-users text-[#eb8541] text-[15px]"></i>
                Show Members
            </button>
            @endif


            {{-- chat btn --}}
            <button class="bg-[#272727] border-[1px] border-[#2e2e2e] rounded-full px-4 py-2 text-[#fff] flex gap-2 items-center text-sm font-medium">
            <i class="fa-solid fa-comments text-[#6dc489] text-[15px]"></i>
            Chat
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

    <div class="px-[3vw]">
        <div class="flex items-center bg-[#1C1C1C]  justify-between border-[#2e2e2e] border-[1px] py-2 px-3 rounded-md shadow-sm cursor-pointer">
            <div class="flex gap-2 items-center">
                <i class="fa-solid fa-circle text-[18px] animate-pulse  text-[#6dc489]"></i>
                <p class="text-[#fff]  font-medium">{{ $team->name }}</p>
            </div>

            <div class="flex items-center justify-start gap-2">
                <div class="flex items-center">
                    <!-- Avatar group -->
                    <div class="flex -space-x-2">
                        @foreach($team->users->take(2) as $user)
                            @if($user->image)
                                <img class="w-8 h-8 rounded-full border-2 border-[#2e2e2e] object-cover" 
                                     src="{{ asset('storage/' . $user->image) }}" 
                                     alt="{{ $user->name }}"
                                     title="{{ $user->name }}">
                            @else
                                <div class="w-8 h-8 rounded-full border-2 border-[#2e2e2e] bg-gray-600 flex items-center justify-center">
                                    <span class="text-white text-xs">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    
                    <!-- Additional count with tooltip -->
                    @if($team->users->count() > 2)
                        <div class="relative group">
                            <div class="ml-1 text-xs font-semibold text-[#6dc489] rounded-full cursor-pointer">
                                +{{ $team->users->count() - 2 }}
                            </div>
                            <!-- Tooltip -->
                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 hidden group-hover:block w-max">
                                <div class="bg-[#2e2e2e] text-white text-xs rounded-lg py-2 px-3 shadow-lg">
                                    <div class="flex flex-col gap-1">
                                        @foreach($team->users->skip(2) as $user)
                                            <span>{{ $user->name }}</span>
                                        @endforeach
                                    </div>
                                    <!-- Arrow -->
                                    <div class="absolute bottom-[-4px] left-1/2 transform -translate-x-1/2 w-2 h-2 bg-[#2e2e2e] rotate-45"></div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
