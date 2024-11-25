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
                <form action="{{ route('team.tasks.store', $team) }}" method="POST" class="mt-4">
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

                    {{-- Assigned To (Only visible for team owner) --}}
                    @if(Auth::id() === $team->owner_id)
                    <div class="mb-4">
                        <x-input-label for="assigned_to" :value="__('Assign to')" />
                        <select 
                            id="assigned_to" 
                            name="assigned_to" 
                            class="block mt-1 w-full border-[#fff]/25 bg-transparent focus:outline-none focus:ring-0 focus:border-[#fff]/25 text-[#fff] rounded-md shadow-sm"
                        >
                            <option value="" class="text-[#000]">Select team member</option>
                            @foreach($team->users as $member)
                                <option value="{{ $member->id }}" class="text-[#000]">{{ $member->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif

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

    <div class="px-[3vw] py-[2vh]">
        <div class="bg-[#1C1C1C] rounded-2xl p-8 border-[1px] border-[#2e2e2e]">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-[#fff] bg-clip-text">Team's tasks</h2>
                <div class="flex gap-4">
                    <div class="flex items-center gap-2 px-4 py-2 rounded-lg border-[1px] border-[#2e2e2e]">
                        <div class="w-3 h-3 rounded-full bg-green-500 animate-pulse"></div>
                        <span class="text-sm text-white/70">Active Team</span>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-xl border-[1px] border-[#2e2e2e]">
                <table class="w-full">
                    <thead>
                        <tr class="bg-[#272727]">
                            <th class="text-left py-4 px-6 text-xs uppercase tracking-wider text-white/50 font-semibold">Task</th>
                            {{-- <th class="text-left py-4 px-6 text-xs uppercase tracking-wider text-white/50 font-semibold">Description</th> --}}
                            <th class="text-left py-4 px-6 text-xs uppercase tracking-wider text-white/50 font-semibold">Assigned To</th>
                            <th class="text-left py-4 px-6 text-xs uppercase tracking-wider text-white/50 font-semibold">Status</th>
                            <th class="text-left py-4 px-6 text-xs uppercase tracking-wider text-white/50 font-semibold">Priority</th>
                            <th class="text-left py-4 px-6 text-xs uppercase tracking-wider text-white/50 font-semibold">Timeline</th>
                            <th class="text-left py-4 px-6 text-xs uppercase tracking-wider text-white/50 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($team->tasks()->orderBy('created_at', 'desc')->get() as $task)
                            <tr class="group hover:bg-white/5 transition-all duration-200">
                                <td class="py-4 px-6">
                                    <p class="text-white font-medium transition-colors">{{ $task->name }}</p>
                                </td>
                                {{-- <td class="py-4 px-6">
                                    <p class="text-white/60 text-sm line-clamp-1">{{ $task->description }}</p>
                                </td> --}}
                                <td class="py-4 px-6">
                                    @if($task->assigned_to)
                                        <div class="flex items-center gap-2">
                                            @if($task->assignedUser->image)
                                                <img class="w-6 h-6 rounded-full border-2 border-[#2e2e2e] object-cover" 
                                                     src="{{ asset('storage/' . $task->assignedUser->image) }}" 
                                                     alt="{{ $task->assignedUser->name }}">
                                            @else
                                                <div class="w-6 h-6 rounded-full border-2 border-[#2e2e2e] bg-gray-600 flex items-center justify-center">
                                                    <span class="text-white text-xs">
                                                        {{ strtoupper(substr($task->assignedUser->name, 0, 1)) }}
                                                    </span>
                                                </div>
                                            @endif
                                            <span class="text-white/60 text-sm">{{ $task->assignedUser->name }}</span>
                                        </div>
                                    @else
                                        <span class="text-white/40 text-sm">Unassigned</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium
                                        @if($task->status === 'completed') bg-green-500/10 text-green-400
                                        @elseif($task->status === 'in_progress') bg-blue-500/10 text-blue-400
                                        @else bg-yellow-500/10 text-yellow-400
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full
                                            @if($task->priority === 'high') bg-red-500
                                            @elseif($task->priority === 'medium') bg-yellow-500
                                            @else bg-green-500
                                            @endif">
                                        </span>
                                        <p class="text-white/60 text-sm capitalize">{{ $task->priority }}</p>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="text-white/60 text-sm">
                                        {{ \Carbon\Carbon::parse($task->start)->format('M d , H:i A ') }} - 
                                        {{ \Carbon\Carbon::parse($task->end)->format('M d , H:i A ') }}
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex  justify-end gap-4">
                                        @if($task->status !== 'completed' && (Auth::id() === $team->owner_id || Auth::id() === $task->assigned_to))
                                            <form action="{{ route('team.tasks.complete', [$team, $task]) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-white/60 hover:text-green-500 transition-colors">
                                                    <i class="fa-solid fa-check"></i>
                                                </button>
                                            </form>
                                        @endif

                                        @if(Auth::id() === $team->owner_id || Auth::id() === $task->user_id)
                                            <form action="{{ route('team.tasks.destroy', [$team, $task]) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-white/60 hover:text-red-500 transition-colors">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Empty State --}}
            @if($team->tasks()->count() === 0)
            <div class="text-center py-12">
                <div class="bg-[#272727] inline-block p-4 rounded-full mb-4">
                    <i class="fa-regular fa-clipboard text-4xl text-[#6737f5]"></i>
                </div>
                <h3 class="text-white font-medium mb-2">No Tasks Yet</h3>
                <p class="text-gray-400">Create your first task to get started!</p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>