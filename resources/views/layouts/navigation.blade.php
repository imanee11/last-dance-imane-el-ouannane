<nav x-data="{ open: false }" class="bg-[#171717] w-[22vw] shadow-md shadow-black/40 fixed top-0 bottom-0 left-0 px-5 py-8">

    <div class=" ">
        <a href="/">
            <img class="w-[6vw]" src="{{ asset('images/newlogo.png') }}" alt="logo Image" >
        </a>
    </div>

    <div class=" pt-5 pb-5">
        {{-- <span class="absolute  top-[50%] left-[5%]  flex items-center text-[#fff]">
            <i class="fa-solid fa-magnifying-glass text-[#fff]/50"></i>
        </span> --}}
        <input 
            type="search" 
            placeholder="Search..." 
            class="px-4 py-3 w-full text-sm text-[#fff] placeholder-[#fff]/50 bg-[#272727] rounded-full focus:outline-none focus:ring-0 focus:border-none border-[1px] border-[#2e2e2e]"
        />
    </div>

    
    <div class="bg-[#272727] border-[1px] border-[#2e2e2e] rounded-2xl px-2 py-4 flex flex-col">
        <div>
            {{-- <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <div class="flex items-center gap-3 py-3 px-3">
                    <i class="fa-solid fa-house text-[18px]"></i>
                    {{ __('Dashboard') }}
                </div>
            </x-nav-link> --}}
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="fa-solid fa-house">
                {{ __('Dashboard') }}
            </x-nav-link>
        </div>

        <div>
            <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" icon="fa-solid fa-user">
                {{ __('Profile') }}
            </x-nav-link>
        </div>

        <div>
            <x-nav-link :href="route('team.index')" :active="request()->routeIs('team.index')" icon="fa-solid fa-people-group">
                {{ __('My teams') }}
            </x-nav-link>
        </div>

        <div>
            <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" icon="fa-solid fa-comments">
                {{ __('Chats') }}
            </x-nav-link>
        </div>

        <div>
            <x-nav-link :href="route('calendar.index')" :active="request()->routeIs('calendar.index')" icon="fa-solid fa-calendar">
                {{ __('Calendar') }}
            </x-nav-link>
        </div>

        
    </div>



    <div class="bg-[#272727] border-[1px] border-[#2e2e2e] rounded-full px-2 py-3 flex flex-col justify-end absolute bottom-5 left-5 right-5 ">
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                <div class="flex items-center gap-3  px-2">
                    <i class="fa-solid fa-arrow-right-from-bracket text-[15px] text-[#fff]/50"></i>
                    {{ __('Log Out') }}
                </div>

            </x-dropdown-link>
            {{--  --}}
        </form>
    </div>


    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                {{-- <div class="shrink-0 flex ">
                    <a href="{{ route('dashboard') }}">
                        <img class="w-[6vw]" src="{{ asset('images/newlogo.png') }}" alt="logo Image" >
                    </a>
                </div> --}}

                <!-- Navigation Links -->
                {{-- <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div> --}}
            </div>

            <!-- Settings Dropdown -->
            {{-- <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div> --}}

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
