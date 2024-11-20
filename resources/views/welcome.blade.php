<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tasker</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* ! tailwindcss v3.4.1 | MIT License | https://tailwindcss.com */*,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}:host,html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;font-feature-settings:normal;font-variation-settings:normal;-webkit-tap-highlight-color:transparent}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-feature-settings:normal;font-variation-settings:normal;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-feature-settings:inherit;font-variation-settings:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}dialog{padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]{display:none}*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }.absolute{position:absolute}.relative{position:relative}.-left-20{left:-5rem}.top-0{top:0px}.-bottom-16{bottom:-4rem}.-left-16{left:-4rem}.-mx-3{margin-left:-0.75rem;margin-right:-0.75rem}.mt-4{margin-top:1rem}.mt-6{margin-top:1.5rem}.flex{display:flex}.grid{display:grid}.hidden{display:none}.aspect-video{aspect-ratio:16 / 9}.size-12{width:3rem;height:3rem}.size-5{width:1.25rem;height:1.25rem}.size-6{width:1.5rem;height:1.5rem}.h-12{height:3rem}.h-40{height:10rem}.h-full{height:100%}.min-h-screen{min-height:100vh}.w-full{width:100%}.w-\[calc\(100\%\+8rem\)\]{width:calc(100% + 8rem)}.w-auto{width:auto}.max-w-\[877px\]{max-width:877px}.max-w-2xl{max-width:42rem}.flex-1{flex:1 1 0%}.shrink-0{flex-shrink:0}.grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}.flex-col{flex-direction:column}.items-start{align-items:flex-start}.items-center{align-items:center}.items-stretch{align-items:stretch}.justify-end{justify-content:flex-end}.justify-center{justify-content:center}.gap-2{gap:0.5rem}.gap-4{gap:1rem}.gap-6{gap:1.5rem}.self-center{align-self:center}.overflow-hidden{overflow:hidden}.rounded-\[10px\]{border-radius:10px}.rounded-full{border-radius:9999px}.rounded-lg{border-radius:0.5rem}.rounded-md{border-radius:0.375rem}.rounded-sm{border-radius:0.125rem}.bg-\[\#FF2D20\]\/10{background-color:rgb(255 45 32 / 0.1)}.bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-gradient-to-b{background-image:linear-gradient(to bottom, var(--tw-gradient-stops))}.from-transparent{--tw-gradient-from:transparent var(--tw-gradient-from-position);--tw-gradient-to:rgb(0 0 0 / 0) var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), var(--tw-gradient-to)}.via-white{--tw-gradient-to:rgb(255 255 255 / 0)  var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), #fff var(--tw-gradient-via-position), var(--tw-gradient-to)}.to-white{--tw-gradient-to:#fff var(--tw-gradient-to-position)}.stroke-\[\#FF2D20\]{stroke:#FF2D20}.object-cover{object-fit:cover}.object-top{object-position:top}.p-6{padding:1.5rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.py-10{padding-top:2.5rem;padding-bottom:2.5rem}.px-3{padding-left:0.75rem;padding-right:0.75rem}.py-16{padding-top:4rem;padding-bottom:4rem}.py-2{padding-top:0.5rem;padding-bottom:0.5rem}.pt-3{padding-top:0.75rem}.text-center{text-align:center}.font-sans{font-family:Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji}.text-sm{font-size:0.875rem;line-height:1.25rem}.text-sm\/relaxed{font-size:0.875rem;line-height:1.625}.text-xl{font-size:1.25rem;line-height:1.75rem}.font-semibold{font-weight:600}.text-black{--tw-text-opacity:1;color:rgb(0 0 0 / var(--tw-text-opacity))}.text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.underline{-webkit-text-decoration-line:underline;text-decoration-line:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.shadow-\[0px_14px_34px_0px_rgba\(0\2c 0\2c 0\2c 0\.08\)\]{--tw-shadow:0px 14px 34px 0px rgba(0,0,0,0.08);--tw-shadow-colored:0px 14px 34px 0px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.ring-1{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.ring-transparent{--tw-ring-color:transparent}.ring-white\/\[0\.05\]{--tw-ring-color:rgb(255 255 255 / 0.05)}.drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.06\)\]{--tw-drop-shadow:drop-shadow(0px 4px 34px rgba(0,0,0,0.06));filter:var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)}.drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.25\)\]{--tw-drop-shadow:drop-shadow(0px 4px 34px rgba(0,0,0,0.25));filter:var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)}.transition{transition-property:color, background-color, border-color, fill, stroke, opacity, box-shadow, transform, filter, -webkit-text-decoration-color, -webkit-backdrop-filter;transition-property:color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;transition-property:color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter, -webkit-text-decoration-color, -webkit-backdrop-filter;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.duration-300{transition-duration:300ms}.selection\:bg-\[\#FF2D20\] *::selection{--tw-bg-opacity:1;background-color:rgb(255 45 32 / var(--tw-bg-opacity))}.selection\:text-white *::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.selection\:bg-\[\#FF2D20\]::selection{--tw-bg-opacity:1;background-color:rgb(255 45 32 / var(--tw-bg-opacity))}.selection\:text-white::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.hover\:text-black:hover{--tw-text-opacity:1;color:rgb(0 0 0 / var(--tw-text-opacity))}.hover\:text-black\/70:hover{color:rgb(0 0 0 / 0.7)}.hover\:ring-black\/20:hover{--tw-ring-color:rgb(0 0 0 / 0.2)}.focus\:outline-none:focus{outline:2px solid transparent;outline-offset:2px}.focus-visible\:ring-1:focus-visible{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.focus-visible\:ring-\[\#FF2D20\]:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 45 32 / var(--tw-ring-opacity))}@media (min-width: 640px){.sm\:size-16{width:4rem;height:4rem}.sm\:size-6{width:1.5rem;height:1.5rem}.sm\:pt-5{padding-top:1.25rem}}@media (min-width: 768px){.md\:row-span-3{grid-row:span 3 / span 3}}@media (min-width: 1024px){.lg\:col-start-2{grid-column-start:2}.lg\:h-16{height:4rem}.lg\:max-w-7xl{max-width:80rem}.lg\:grid-cols-3{grid-template-columns:repeat(3, minmax(0, 1fr))}.lg\:grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}.lg\:flex-col{flex-direction:column}.lg\:items-end{align-items:flex-end}.lg\:justify-center{justify-content:center}.lg\:gap-8{gap:2rem}.lg\:p-10{padding:2.5rem}.lg\:pb-10{padding-bottom:2.5rem}.lg\:pt-0{padding-top:0px}.lg\:text-\[\#FF2D20\]{--tw-text-opacity:1;color:rgb(255 45 32 / var(--tw-text-opacity))}}@media (prefers-color-scheme: dark){.dark\:block{display:block}.dark\:hidden{display:none}.dark\:bg-black{--tw-bg-opacity:1;background-color:rgb(0 0 0 / var(--tw-bg-opacity))}.dark\:bg-zinc-900{--tw-bg-opacity:1;background-color:rgb(24 24 27 / var(--tw-bg-opacity))}.dark\:via-zinc-900{--tw-gradient-to:rgb(24 24 27 / 0)  var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), #18181b var(--tw-gradient-via-position), var(--tw-gradient-to)}.dark\:to-zinc-900{--tw-gradient-to:#18181b var(--tw-gradient-to-position)}.dark\:text-white\/50{color:rgb(255 255 255 / 0.5)}.dark\:text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:text-white\/70{color:rgb(255 255 255 / 0.7)}.dark\:ring-zinc-800{--tw-ring-opacity:1;--tw-ring-color:rgb(39 39 42 / var(--tw-ring-opacity))}.dark\:hover\:text-white:hover{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:hover\:text-white\/70:hover{color:rgb(255 255 255 / 0.7)}.dark\:hover\:text-white\/80:hover{color:rgb(255 255 255 / 0.8)}.dark\:hover\:ring-zinc-700:hover{--tw-ring-opacity:1;--tw-ring-color:rgb(63 63 70 / var(--tw-ring-opacity))}.dark\:focus-visible\:ring-\[\#FF2D20\]:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 45 32 / var(--tw-ring-opacity))}.dark\:focus-visible\:ring-white:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 255 255 / var(--tw-ring-opacity))}}
                
            </style>
        @endif
    </head>
    <body class="bg-[#101010]">
        {{-- nav bar --}}
        <nav class="bg-[#171717] flex justify-between items-center px-[5.5vw] py-5 fixed top-0 right-0 left-0 shadow-md shadow-black/40 ">
            {{-- left part --}}
            <div class="flex items-center gap-10">
                <img class="w-[6vw]" src="{{ asset('images/newlogo.png') }}" alt="logo Image" >
                <div class="flex items-center gap-8 font-medium text-[#fff] text-[15px]">
                    <a href="#home">Home</a>
                    <a href="#features">Features</a>
                    <a href="#advantages">Advantages</a>
                    {{-- <a href="">Home 4</a> --}}
                </div>
            </div>



            {{-- right part --}}
            <div>
                @if (Route::has('login'))
                    <nav class="">
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="rounded-md font-medium text-[#fff] text-[15px]"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="rounded-md px-4 py-2 text-[#fff] font-medium  hover:text-[#6737f5] transition duration-300  "
                            >
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="rounded-md px-4 py-2 bg-[#6737f5] text-[#fff] border-[2px] border-[#6737f5] font-medium  hover:bg-transparent hover:border-[2px] hover:border-[#fff] hover:text-[#fff] transition duration-300"
                                >
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </nav>

        {{-- hero section --}}
        <section class=" pt-[13vh]" id="home">

            <div class="flex flex-col justify-center items-center  text-center pt-10">
                <h1 class="text-[50px] w-[40vw] font-bold text-[#fff]">Effortless task management, <span class="text-[#eb8541]">anytime</span></h1>
                <p class="text-[#929292] w-[30vw] ">Manage tasks and projects easily with an all-in-one platform designed for seamless collaboration</p>

                <div class="flex items-center gap-4 pt-6">
                    @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="rounded-md px-4 py-2 bg-[#6737f5] text-[#fff] border-[2px] border-[#6737f5] font-medium  hover:bg-transparent hover:border-[2px] hover:border-[#fff] hover:text-[#fff] transition duration-300"
                    >
                    Get Started for Free
                    </a>
                @endif
                    {{-- <button class="rounded-md px-4 py-2 bg-[#6737f5] text-[#fff] border-[2px] border-[#6737f5] font-medium  hover:bg-transparent hover:border-[2px] hover:border-[#fff] hover:text-[#fff] transition duration-300"></button> --}}
                    <button class="rounded-md px-4 py-2 bg-transparent text-[#9786ff] border-[2px] border-[#9786ff] font-medium  hover:bg-transparent hover:border-[2px] hover:border-[#6737f5] hover:text-[#6737f5] transition duration-300">Learn More</button>
                </div>
            </div>

            <div class="flex justify-center items-center pt-5">
                <img class="w-[85vw] rounded-lg" src="{{ asset('images/bg.png') }}" alt="logo Image" >
            </div>

        </section>


        {{-- features --}}
        <section id="features">
            <div class="text-center flex flex-col justify-center items-center">
                <p class="text-[#6dc489] font-semibold">Features</p>
                <h1 class="text-[#fff] text-[40px] font-bold">Powerful Features to Elvate Your Workflow</h1>
                <p class="text-[#929292] w-[50vw] pt-4">Explore advanced tools that help you make smarter decisions, track progress, and manage your tasks with ease. Stay organized and in control with features designed to enhance your productivity</p>
            </div>

            <div class=" pt-[10vh] flex justify-center items-center gap-7">
                {{-- 1 --}}
                <div class="w-[20vw] h-[35vh] border-[1px] border-[#9292923f] rounded-md p-4 hover:bg-[#6dc48919] group transition duration-300 shadow-md shadow-black/40 hover:border-[#6dc489] cursor-pointer">
                    <div>
                        <i class="fa-solid fa-lightbulb text-[30px] pb-5 text-[#6dc489]"></i>
                        <p class="font-semibold text-[#fff] pb-3">Make Smart Decisions</p>
                        <p class="text-[#929292] group-hover:text-white transition duration-300">
                            Get real-time insights, reports, and alerts to help you make more informed decisions.
                        </p>
                    </div>
                </div>

                {{-- 2 --}}
                <div class="w-[20vw] h-[35vh] border-[1px] border-[#9292923f] rounded-md p-4 hover:bg-[#dd4a7919] group transition duration-300 shadow-md shadow-black/40 hover:border-[#dd4a79] cursor-pointer">
                    <div>
                        <i class="fa-solid fa-bullseye text-[30px] pb-5 text-[#dd4a79]"></i>
                        <p class="font-semibold text-[#fff] pb-3">Optimize Your Goals</p>
                        <p class="text-[#929292] group-hover:text-white transition duration-300">
                            Track your progress and stay aligned with personal or project goals using smart tracking tools.
                            
                        </p>
                    </div>
                </div>

                {{-- 3 --}}
                <div class="w-[20vw] h-[35vh] border-[1px] border-[#9292923f] rounded-md p-4 hover:bg-[#6737f519] group transition duration-300 shadow-md shadow-black/40 hover:border-[#6737f5] cursor-pointer">
                    <div>
                        <i class="fa-solid fa-list-check text-[30px] pb-5 text-[#6737f5]"></i>
                        <p class="font-semibold text-[#fff] pb-3">Task management</p>
                        <p class="text-[#929292] group-hover:text-white transition duration-300">
                            Easily manage tasks, deadlines, and priorities to keep projects running smoothly
                        </p>
                    </div>
                </div>

                {{-- 4 --}}
                <div class="w-[20vw] h-[35vh] border-[1px] border-[#9292923f] rounded-md p-4 hover:bg-[#eb854119] group transition duration-300 shadow-md shadow-black/40 hover:border-[#eb8541] cursor-pointer">
                    <div>
                        <i class="fa-regular fa-message text-[30px] pb-5 text-[#eb8541]"></i>
                        <p class="font-semibold text-[#fff] pb-3">Team chat</p>
                        <p class="text-[#929292] group-hover:text-white transition duration-300">
                            Stay connected with real-time messaging, making team collaboration easier.
                        </p>
                    </div>
                </div>
            </div>
        </section>


        {{-- advantages  --}}
        <section id="advantages">
            <div class=" pt-16 ">
                <div class="flex flex-col justify-center text-center items-center">
                    <p class="text-[#6dc489] font-semibold  ">Advantages</p>
                    <h1 class="text-[#fff] text-[40px] font-bold ">A task manager you can trust for teams</h1>
                    <p class="text-[#929292] w-[50vw] pt-4 ">Plan projects, stay on track, and deliver on time without overworking your team.</p>
                </div>

                <div class="px-[6vw] py-10 flex flex-col gap-10">
                    {{-- 1  / hover:border-[#9292923f]  / bg-[#dd4a7919] --}}
                    <div class=" p-10 rounded-md border-[1px] border-[#dd4a79] shadow-md shadow-black/40 flex justify-between items-center hover:bg-transparent  group transition duration-300 cursor-pointer">
                        {{-- left --}}
                        <div>
                            <div class="flex items-center gap-3  ">
                                <i class="fa-solid fa-circle text-[30px]  text-[#dd4a79]"></i>
                                <p class="text-[#fff] text-[30px] font-bold">Simple to use,</p>
                            </div>
                            <div class="border-l-[1px] border-[#fff] pl-[2.5vw] ml-[1vw]">
                                <p class="text-[#fff] text-[30px] font-bold">powerful when need.</p>
                                <p class="text-[#929292] w-[40vw] pt-5">Create tasks and teams, upload images, and chat with others. With Tasker everything is in one central location. </p>
                            </div>

                            <div class="pt-5 flex flex-col gap-3">
                                <div class="flex items-center gap-3 border-[1px] border-[#fff]/25 p-2 w-[20vw] rounded-md">
                                    <i class="fa-solid fa-dumbbell text-[#dd4a79] "></i>
                                    <p class="text-[#fff]">Costumized your workflow.</p>
                                </div>
                                <div class="flex items-center gap-3 border-[1px] border-[#fff]/25 p-2 w-[24vw] rounded-md">
                                    <i class="fa-solid fa-grip text-[#dd4a79]"></i>
                                    <p class="text-[#fff]">Extra features for complex projects.</p>
                                </div>
                            </div>
                        </div>

                        {{-- right --}}
                        <div>
                            <img class="w-[28vw]" src="{{ asset('images/tasks.png') }}" alt="logo Image" >
                        </div>

                    </div>


                    {{-- 2 /  bg-[#6737f519]--}}
                    <div class=" p-10 rounded-md border-[1px] border-[#6737f5] shadow-md shadow-black/40 flex justify-between items-center">


                        {{-- right --}}
                        <div>
                            <img class="w-[28vw]" src="{{ asset('images/taskss.png') }}" alt="logo Image" >
                        </div>

                        {{-- left --}}
                        <div>
                            <div class="flex items-center gap-3  ">
                                <i class="fa-solid fa-circle text-[30px]  text-[#6737f5]"></i>
                                <p class="text-[#fff] text-[30px] font-bold">Take complex,</p>
                            </div>
                            <div class="border-l-[1px] border-[#fff] pl-[2.5vw] ml-[1vw]">
                                <p class="text-[#fff] text-[30px] font-bold">projects with aese.</p>
                                <p class="text-[#929292] w-[40vw] pt-5">Use status features updates to see how your project is progressing and what's left to do.</p>
                            </div>

                            <div class="pt-5 flex flex-col gap-3">
                                <div class="flex items-center gap-3 border-[1px] border-[#fff]/25 p-2 w-[20vw] rounded-md">
                                    <i class="fa-solid fa-user-group text-[#6737f5] "></i>
                                    <p class="text-[#fff]">Keep everyone accountable.</p>
                                </div>
                                <div class="flex items-center gap-3 border-[1px] border-[#fff]/25 p-2 w-[17vw] rounded-md">
                                    <i class="fa-solid fa-chart-column text-[#6737f5]"></i>
                                    <p class="text-[#fff]">Make sure your status.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>



        {{-- bg-[#eb8541] --}}
        <section class="px-[6vw]">
            <div class="text-center flex flex-col items-center justify-center  rounded-md p-20">
                <h1 class="text-[#fff] text-[40px] font-bold italic w-[25vw] pb-5 ">Get more productive team</h1>
                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="rounded-md px-4 py-2 bg-[#6737f5] text-[#fff] border-[2px] border-[#6737f5] font-medium  hover:bg-transparent hover:border-[2px] hover:border-[#fff] hover:text-[#fff] transition duration-300"
                    >
                        Start Now-Free
                    </a>
                @endif
                <div class="flex text-[#fff] pt-5 gap-10">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-[#6dc489] "></i>
                        <p>Try FREE for your first 5 teams</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-[#dd4a79]"></i>
                        <p>No card required</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-[#eb8541]"></i>
                        <p>No switching banks</p>
                    </div>
                </div>
            </div>

        </section>



        <footer class="bg-[#171717] px-[6vw] py-[5vh] shadow-md shadow-black/40">
            <div class="flex items-start  gap-[12vw] pb-10">
                <div>
                    <img class="w-[9vw]" src="{{ asset('images/newlogo.png') }}" alt="logo Image" >
                    {{-- text-[#929292] --}}
                    <p class="text-[#fff] pt-3 text-[15px]">Stay organized and productive with Tasker</p>
                </div>

                <div>
                    <p class="font-semibold text-[#fff] pb-5 ">Explore</p>
                    <div class="flex flex-col text-[#fff] gap-3 text-[15px] ">
                        <a href="#home">Home</a>
                        <a href="#features">Features</a>
                        <a href="#advantages">Advantages</a>
                    </div>
                </div>

                <div>
                    <p class="font-semibold text-[#fff] pb-5 ">Follow us</p>
                    <div class="flex gap-5">
                        <i class="fa-brands fa-instagram text-[23px] text-[#6dc48960] hover:text-[#6dc489] cursor-pointer transition duration-300"></i>
                        <i class="fa-brands fa-facebook-f text-[23px] text-[#dd4a7960] hover:text-[#dd4a79] cursor-pointer transition duration-300"></i>
                        <i class="fa-brands fa-x-twitter text-[23px] text-[#6737f560] hover:text-[#6737f5] cursor-pointer transition duration-300"></i>
                        <i class="fa-brands fa-linkedin-in text-[23px] text-[#eb854160] hover:text-[#eb8541] cursor-pointer transition duration-300"></i>
                    </div>
                    <p class="text-[#fff] text-[15px] pt-5">&copy; <span id="year"></span> Tasker. All rights reserved. By <span class="text-[#6737f5] font-semibold underline cursor-pointer">Imane El Ouannane</span></p>

                </div>
            </div>
            <div class="text-center ">
                  
                <script>
                document.getElementById("year").textContent = new Date().getFullYear();
                </script>

            </div>


        </footer>

        

        



    </body>
</html>
