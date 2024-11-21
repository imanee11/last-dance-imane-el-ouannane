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
        
        <div class="bg-[#272727] rounded-2xl shadow-md shadow-black/40 p-6 w-[100%] border-[1px] border-[#2e2e2e] text-[#fff]">
            <h2 class="text-lg font-semibold mb-4">All Tasks</h2>
            <div class="flex flex-col gap-4 " >
                @foreach ($personalTasks as $personalTask)
                    <div class="border-[#2e2e2e] border-[1px] py-2 px-3 rounded-md shadow-sm cursor-pointer">
                        <div class="flex items-center  justify-between">
                            <div class="flex items-center gap-2">
                                {{-- <input type="checkbox"> --}}
                                <p class="text-[#fff] font-medium">{{ $personalTask->name }}</p>
                            </div>
    
                            <div class="flex items-center gap-3">
                                {{-- <div class="flex items-center gap-2 w-[6vw] justify-start">
                                    <i class="fa-regular fa-calendar text-[#eb8541]"></i>
                                    <p class="text-[#fff]/50 text-[10px] font-medium">{{ $personalTask->created_at->format('M d') }}</p>
                                </div> --}}
    
                                <div class="flex items-center gap-2  w-[6vw] justify-start">
                                    <i class="fa-solid fa-circle-exclamation text-[#6737f5]"></i>
                                    <p class="text-[#fff]/50 text-[10px] font-medium">{{ $personalTask->priority }}</p>
                                </div>
    
                                {{-- edit task --}}
                                <div>
                                    <button data-task-id="{{ $personalTask->id }}" onclick="document.getElementById('editTaskModal-{{ $personalTask->id }}').classList.remove('hidden')">
                                        <i class="fa-solid fa-pen-to-square text-[#6dc489]"></i>
                                    </button>
    
                                    {{-- edit task modal --}}
                                    <div id="editTaskModal-{{ $personalTask->id }}" class="fixed inset-0 bg-[#101010] bg-opacity-75 flex items-center justify-center z-50 hidden transition-opacity duration-300">
                                        <div class="bg-[#272727] border-[1px] border-[#2e2e2e] rounded-2xl shadow-md shadow-black/40 w-full max-w-md p-6">
                                            
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
                                </div>
    
                                
    
                                {{-- delete task --}}
                                <div>
                                    <form action="{{ route('task.destroy', $personalTask->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <i class="fa-solid fa-trash text-red-500"></i>
                                        </button>
                                    </form>
                                </div>
    
                            </div>
    
                        </div>
    
                        <div class="pt-2">
                            <p class="text-[#fff]/50 text-[12px]">Description: {{ $personalTask->description }}</p>
                            <p class="text-[#fff]/50 text-[12px]">Status: {{ $personalTask->status }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
    
            {{-- btn --}}
            {{-- <div class="flex justify-end">
                <button class="font-semibold rounded-md px-4 py-2 bg-[#6737f5] text-[#fff] border-[2px] border-[#6737f5] transition duration-300 text-xs uppercase tracking-widest mt-4" onclick="closeTasksModal()">
                    Close
                </button>
            </div> --}}
    
        </div>

    </div>

</x-app-layout>
