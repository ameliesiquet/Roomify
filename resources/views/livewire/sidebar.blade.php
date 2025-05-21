<div class="flex flex-col text-sm">
    {{-- Mobile--}}
    <aside x-data="{ mobileMenuOpen: false }"
           class="lg:hidden"
    >
        <h2 role="heading" aria-level="2" class="sr-only">Principal Navigation Menu</h2>
        {{-- Navigation header --}}
        <div class="fixed top-0 left-0 w-full pl-5 pr-3.5 py-4 h-15 z-50 flex justify-between items-center bg-mywhite p-4 shadow-md ">
            <a href="{{ route('dashboard') }}"
               title="Back to Homepage"
               class="flex items-center justify-start"
               wire:navigate>
                <x-app-logo class="w-30 h-30"/>
            </a>
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-md cursor-pointer">
                <x-svg.menu-animate/>
            </button>
        </div>
        <div
                x-show="mobileMenuOpen"
                x-transition:enter="transition ease-in-out duration-200"
                x-transition:enter-start="opacity-0 translate-x-full"
                x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-x-0"
                x-transition:leave-end="opacity-0 translate-x-full"
                class="fixed top-15 right-0 h-screen w-screen bg-sand z-40 overflow-y-auto flex flex-col items-center gap-8 pt-8"
        >
            <div class="flex flex-col items-center gap-6">
                <!-- Principal links -->
                <x-sidebar.links menu-variable="mobileMenuOpen"/>

                <!-- Bottom links -->
                <x-sidebar.bottom-links />
            </div>
        </div>

    </aside>

    {{-- Desktop--}}
    <aside
            class="hidden lg:flex lg:flex-col lg:fixed h-full transition-all duration-300 z-50"
            style="width: 14rem; overflow: visible;"
    >
        <div class="h-full pt-6 pb-4 flex flex-col justify-between gap-4 overflow-visible rounded-tr-[16px] rounded-br-[16px] ">
        <!-- Navigation header -->
            <div class="relative flex items-center pl-2.5 h-[5vh] self-center">
                <a href="{{ route('dashboard') }}"
                   title="Back to Homepage"
                   class="flex items-center"
                   wire:navigate>
                    <x-app-logo class="w-50 h-50 " />
                </a>
            </div>
            <div class="bg-sand min-h-[90vh] py-14 px-4 flex flex-col justify-between">
                <!-- Principal links -->
                <x-sidebar.links/>
                <!-- Bottom links -->
                <x-sidebar.bottom-links />
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-white underline hover:text-zinc-900 w-full text-left">
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </aside>

</div>

