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
        {{-- create task modal --}}
        <div id="createTaskModal" class="fixed inset-0 bg-[#101010] bg-opacity-75 flex items-center justify-center z-50 hidden transition-opacity duration-300">
        
            {{-- modal content --}}
            <div class="bg-[#272727] border-[1px] border-[#2e2e2e] rounded-2xl  shadow-md shadow-black/40 w-full max-w-md p-6">

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


                    {{-- Task status --}}
                    {{-- <div class="mb-4">
                        <x-input-label for="status" :value="__('Task status')" />
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
                    </div> --}}

                    {{-- task deadline --}}
                    {{-- <div class="mb-4">
                        <x-input-label for="deadline" :value="__('Task deadline')" />
                        <x-text-input id="deadline" class="block mt-1 w-full" type="date" name="deadline" required autocomplete="" />
                    </div> --}}





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
    </div>


    <div class="px-[3vw] flex items-center justify-between ">

        {{-- buttons --}}
        <div class="py-[6vh] flex items-center gap-3 ">    
            <button
                class="bg-[#272727] border-[1px] border-[#2e2e2e] rounded-full px-4 py-2 text-[#fff] flex gap-2 items-center text-sm font-medium"
                onclick="document.getElementById('createTaskModal').classList.remove('hidden');"

                >
                <i class="fa-solid fa-list-check text-[#dd4a79] text-[15px]"></i>
                Create a Task
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
        {{-- bg-[#272727] --}}
        <div class=" bg-[#1C1C1C] rounded-2xl  p-8 border-[1px] border-[#2e2e2e]">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-[#fff] bg-clip-text">All Tasks</h2>
                <div class="flex gap-4">
                    {{-- <div class="flex items-center gap-2 px-4 py-2 rounded-lg  border-[1px] border-[#2e2e2e]">
                        <div class="w-3 h-3 rounded-full bg-green-500 animate-pulse"></div>
                        <span class="text-sm text-white/70">Active Tasks</span>
                    </div> --}}
                </div>
            </div>

            <div class="overflow-hidden rounded-xl border-[1px] border-[#2e2e2e]">
                <table class="w-full">
                    <thead>
                        <tr class="bg-[#272727]">
                            <th class="text-left py-4 px-6 text-xs uppercase tracking-wider text-white/50 font-semibold">Task</th>
                            <th class="text-left py-4 px-6 text-xs uppercase tracking-wider text-white/50 font-semibold">Description</th>
                            <th class="text-left py-4 px-6 text-xs uppercase tracking-wider text-white/50 font-semibold">Status</th>
                            <th class="text-left py-4 px-6 text-xs uppercase tracking-wider text-white/50 font-semibold">Priority</th>
                            <th class="text-left py-4 px-6 text-xs uppercase tracking-wider text-white/50 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach ($personalTasks as $personalTask)
                            <tr class="group hover:bg-white/5 transition-all duration-200">
                                <td class="py-4 px-6">
                                    <p class="text-white font-medium  transition-colors">{{ $personalTask->name }}</p>
                                </td>
                                <td class="py-4 px-6">
                                    <p class="text-white/60 text-sm line-clamp-1">{{ $personalTask->description }}</p>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium
                                        @if($personalTask->status === 'completed') bg-green-500/10 text-green-400
                                        @elseif($personalTask->status === 'in_progress') bg-blue-500/10 text-blue-400
                                        @else bg-yellow-500/10 text-yellow-400
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $personalTask->status)) }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full
                                            @if($personalTask->priority === 'high') bg-red-500
                                            @elseif($personalTask->priority === 'medium') bg-yellow-500
                                            @else bg-green-500
                                            @endif">
                                        </span>
                                        <p class="text-white/60 text-sm capitalize">{{ $personalTask->priority }}</p>
                                    </div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-4">
                                        <button data-task-id="{{ $personalTask->id }}" 
                                                onclick="document.getElementById('editTaskModal-{{ $personalTask->id }}').classList.remove('hidden')"
                                                class="text-white/60 hover:text-[#6737f5] transition-colors">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
    
                                        <form action="{{ route('task.destroy', $personalTask->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-white/60 hover:text-red-500 transition-colors">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    {{-- edit task modal --}}
                                    <div id="editTaskModal-{{ $personalTask->id }}" class="fixed inset-0 bg-[#101010] bg-opacity-75 flex items-center justify-center z-50 hidden transition-opacity duration-300">
                                        <div class="bg-[#1C1C1C] border-[1px] border-[#2e2e2e] rounded-2xl shadow-md shadow-black/40 w-full max-w-md p-6">
                                                    
                                                    {{-- modal header --}}
                                                    <div class="flex justify-between items-center pb-4">
                                                        <h2 class="text-lg font-medium text-gray-100">Edit Task</h2>
                                                        <button
                                                            class="text-[#eb8541] hover:text-[#fff] text-[25px] focus:outline-none cursor-pointer transition duration-300"
                                                            onclick="document.getElementById('editTaskModal-{{ $personalTask->id }}').classList.add('hidden');"
                                                        >
                                                            &times;
                                                        </button>
                                                    </div>
            
                                                    {{-- Modal Form --}}
                                                    <form action="{{ route('task.update', $personalTask->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
            
                                                        {{-- Task Name --}}
                                                        <div class="mb-4">
                                                            <x-input-label for="name" :value="__('Task name')" />
                                                            <x-text-input
                                                                id="name"
                                                                class="block mt-1 w-full"
                                                                type="text"
                                                                name="name"
                                                                value="{{ $personalTask->name }}"
                                                                required
                                                            />
                                                        </div>
            
                                                        {{-- Task Description --}}
                                                        <div class="mb-4">
                                                            <x-input-label for="description" :value="__('Task description')" />
                                                            <textarea
                                                                name="description"
                                                                id="description"
                                                                rows="1"
                                                                class="block mt-1 w-full border-[#fff]/25 bg-transparent focus:outline-none focus:ring-0 focus:border-[#fff]/25 text-[#fff] rounded-md shadow-sm"
                                                            >{{ $personalTask->description }}</textarea>
                                                        </div>
            
                                                        {{-- Task Deadline --}}
                                                        <div class="mb-4">
                                                            <x-input-label for="start" :value="__('Task start')" />
                                                            <x-text-input value="{{ $personalTask->start }}"  id="start" class="block mt-1 w-full" type="datetime-local" name="start" required autocomplete="" min="{{ date('Y-m-d\TH:i') }}" />
                                                        </div>
                                    
                                                        <div class="mb-4">
                                                            <x-input-label for="end" :value="__('Task end')" />
                                                            <x-text-input value="{{ $personalTask->end }}" id="end" class="block mt-1 w-full" type="datetime-local" name="end" required autocomplete="" min="{{ date('Y-m-d\TH:i') }}" />
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
                                                                <option value="low" {{ $personalTask->priority === 'low' ? 'selected' : '' }} class="text-[#000]">Low</option>
                                                                <option value="medium" {{ $personalTask->priority === 'medium' ? 'selected' : '' }} class="text-[#000]">Medium</option>
                                                                <option value="high" {{ $personalTask->priority === 'high' ? 'selected' : '' }} class="text-[#000]">High</option>
                                                            </select>
                                                        </div>
            
                                                        {{-- Submit Buttons --}}
                                                        <div class="flex justify-end gap-2">
                                                            <button
                                                                type="button"
                                                                class="inline-flex items-center px-4 py-2 bg-transparent border border-[#fff]/25 rounded-md font-semibold text-xs text-gray-300 uppercase tracking-widest shadow-sm focus:outline-none disabled:opacity-25 transition ease-in-out duration-300"
                                                                onclick="document.getElementById('editTaskModal-{{ $personalTask->id }}').classList.add('hidden');"
                                                            >
                                                                Cancel
                                                            </button>
                                                            <button
                                                                type="submit"
                                                                class="font-semibold rounded-md px-4 py-2 bg-[#6737f5] text-[#fff] border-[2px] border-[#6737f5] transition duration-300 text-xs uppercase tracking-widest"
                                                            >
                                                                Update
                                                            </button>
                                                        </div>
                                                    </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    
        </div>

    </div>

</x-app-layout>
