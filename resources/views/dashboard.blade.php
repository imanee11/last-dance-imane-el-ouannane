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
                    {{-- <div class="mb-4">
                        <x-input-label for="description" :value="__('Team description ')" />
                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            class="block mt-1 w-full border-[#fff]/25 bg-transparent focus:outline-none focus:ring-0 focus:border-[#fff]/25 text-[#fff] rounded-md shadow-sm"
                        ></textarea>
                    </div> --}}


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


    {{-- body --}}
    <div>
        {{-- top part --}}
        <div class="flex justify-between px-[3vw] py-[2vh]">
            {{-- team's part --}}
            <div class="bg-[#272727] border-[1px] border-[#2e2e2e] rounded-2xl  shadow-md shadow-black/40 w-[48%] p-4">
                <p class="font-semibold text-[#fff] pb-3">My teams</p>
            </div>
    
            
            {{-- task's part --}}
            <div class="bg-[#272727] border-[1px] border-[#2e2e2e] rounded-2xl  shadow-md shadow-black/40 w-[48%] p-4">
                <p class="font-semibold text-[#fff] pb-3 ">My tasks</p>
    
                {{-- tasks small list --}}
                <div>
                    <div class="flex flex-col gap-2">
                        @foreach ($personalTasks->take(3) as $personalTask)
                            <div class="flex items-center  justify-between border-[#2e2e2e] border-[1px] py-2 px-3 rounded-md shadow-sm cursor-pointer">
                                <p class="text-[#fff]  font-medium">{{ $personalTask->name }}</p>
                                <div class="flex items-center justify-start gap-2 w-[10vw] ">
                                    <i class="fa-solid fa-clock text-[#dd4a79]"></i>
                                    {{-- <i class="fa-regular fa-calendar text-[#eb8541]"></i> --}}
                                    <p class="text-[#fff]/50 text-[10px] font-medium">{{ $personalTask->created_at->format('M d , H:i A ') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
    
                
                    {{-- Button to open all tasks blade --}}
                    <div class="flex justify-end">
                        <a href="/task">
                            <button class=" rounded-full px-4 py-2 text-[#6737f5]/60  hover:text-[#6737f5]  flex gap-2 items-center text-xs font-medium mt-4 transition duration-300 underline" >
                                Show All Tasks
                            </button>
                        </a>
                    </div>
    
                </div>
                

                
            </div>
        </div>

        {{-- bottom part calendar --}}
        <div class="px-[3vw] py-[2vh]">
            {{-- <p class="font-semibold text-[#fff] pb-3">Calendar</p> --}}
            <div>
                <div class="">
                    <div class="">
            
                        <form class="hidden" method="post" class="" action="{{ route('calendar.store') }}">
                            @csrf
                            <input name="start" id="start" type="datetime-local">
                            <input name="end" id="end" type="datetime-local">
                            <button id="submitEvent">submit</button>
                        </form>
            
                        <div class="">
                            <form class="hidden" id="updateForm" method="post" action="">
                                @csrf @method('PUT')
                                <input id="updatedStart" name="start" type="hidden">
                                <input id="updatedEnd" name="end" type="hidden">
                                <button id="submitUpdate"></button>
                            </form>
                        </div>
                        {{-- @include('components.delete_event') --}}
            
                        <div class="w-full h-[90vh] bg-[#272727] border-[1px] border-[#2e2e2e] rounded-2xl border-none p-3" id="calendar"></div>
            
            
                        <script>
                            document.addEventListener('DOMContentLoaded', async function() {
                                let response = await axios.get("/calendar/create")
                                let events = response.data.events
            
                                let nowDate = new Date()
                                let day = nowDate.getDate()
                                let month = nowDate.getMonth() + 1
                                let hours = nowDate.getHours()
                                let minutes = nowDate.getMinutes()
                                let minTimeAllowed =
                                    `${nowDate.getFullYear()}-${month < 10 ? "0"+month : month}-${day < 10 ? "0"+day : day}T${hours < 10 ? "0"+hours : hours}:${minutes < 10 ? "0"+minutes : minutes}:00`
                                start.min = minTimeAllowed;
            
            
                                var myCalendar = document.getElementById('calendar');
            
            
            
                                var calendar = new FullCalendar.Calendar(myCalendar, {
            
                                    headerToolbar: {
                                        left: 'timeGridWeek',
                                        center: 'title',
                                        // right: 'listMonth,listWeek,listDay'
                                    },
            
            
                                    views: {
                                        listDay: { // Customize the name for listDay
                                            buttonText: 'Day Events',
            
                                        },
                                        listWeek: { // Customize the name for listWeek
                                            buttonText: 'Week Events'
                                        },
                                        listMonth: { // Customize the name for listMonth
                                            buttonText: 'Month Events'
                                        },
                                        timeGridWeek: {
                                            buttonText: 'Week', // Customize the button text
                                        },
                                        timeGridDay: {
                                            buttonText: "Day",
                                        },
                                        dayGridMonth: {
                                            buttonText: "Month",
                                        },
            
                                    },
            
            
                                    initialView: "timeGridWeek", // initial view  =   l view li kayban  mni kan7ol l  calendar
                                    slotMinTime: "09:00:00", // min  time  appear in the calendar
                                    slotMaxTime: "23:00:00", // max  time  appear in the calendar
                                    nowIndicator: true, //  indicator  li kaybyen  l wa9t daba   fin  fl calendar
                                    selectable: true, //   kankhali l user  i9ad  i selectioner  wast l calendar
                                    selectMirror: true, //  overlay   that show  the selected area  ( details  ... )
                                    selectOverlap: false, //  nkhali ktar mn event f  nfs  l wa9t  = e.g:   5 nas i reserviw nfs lblasa  f nfs l wa9t
                                    weekends: true, // n7ayed  l weekends    ola nkhalihom 
                                    editable: true,
                                    droppable: true,
            
            
                                    // events  hya  property dyal full calendar
                                    //  kat9bel array dyal objects  khass  i kono jayin 3la chkl  object fih  start  o end  7it hya li kayfahloha
                                    events: events,
            
                                    eventDrop: (info) => {
                                        updateEvent(info)
            
                                    },
                                    eventResize: (info) => {
            
                                        updateEvent(info)
                                    },
            
                                    eventClick: (info) => {
            
                                        let eventId = info.event._def.publicId
            
                                        if (validateOwner(info)) {
                                            deleteEventForm.action = `/calendar/delete/${eventId}`
                                            deleteEventBtn.click()
                                        }
            
                                    },
            
                                    selectAllow: (info) => {
            
                                        return info.start >= nowDate;
                                    },
            
                                    select: (info) => {
                                        console.log(info);
            
            
                                        if (info.end.getDate() - info.start.getDate() > 0 && !info.allDay) {
                                            return
                                        }
            
                                        if (info.allDay) {
                                            start.value = info.startStr + " 09:00:00"
                                            end.value = info.startStr + " 19:00:00"
            
                                        } else {
                                            start.value = info.startStr.slice(0, info.startStr.length - 6)
                                            end.value = info.endStr.slice(0, info.endStr.length - 6)
                                        }
            
                                        submitEvent.click()
                                    },
            
                                });
            
                                calendar.render();
            
                                function updateEvent(info) {
            
                                    let eventInfo = info.event._def
                                    let eventTime = info.event._instance.range
            
                                    if (eventTime.start > nowDate && validateOwner(info)) {
                                        function formattedDate(time) {
                                            let date = new Date(time);
                                            return date.toISOString().slice(0, 19);
                                        }
            
                                        updatedStart.value = formattedDate(eventTime.start)
                                        updatedEnd.value = formattedDate(eventTime.end)
            
            
            
                                        updateForm.action = `/calendar/update/${eventInfo.publicId}`
            
                                        submitUpdate.click()
            
                                    } else {
                                        window.location.reload()
                                    }
                                };
            
                                function validateOwner(info) {
                                    let owner = info.event._def.extendedProps.owner
                                    let authUser = `{{ Auth::user()->id }}`
            
                                    return owner == authUser
                                }
            
            
                            })
                        </script>
            
            
                    </div>
                </div>
            </div>



        </div>


    </div>
 


    
</x-app-layout>
