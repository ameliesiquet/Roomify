<div class="flex flex-col bg-sand text-sm">
    {{-- Mobile sidebar menu --}}
    <aside x-data="{ mobileMenuOpen: false }"
           class="lg:hidden"
    >
        <h2 role="heading" aria-level="2" class="sr-only">Menu de navigation principal</h2>

        {{-- Divider with space --}}
        <div class="relative h-15"></div>

        {{-- Navigation header --}}
        <div class="fixed top-0 left-0 w-full pl-5 pr-3.5 py-4 h-15 z-50 flex justify-between items-center bg-sand">
            <a href="{{ route('dashboard') }}"
               title="Retour à l'accueil"
               class="flex items-center justify-start"
               wire:navigate>
                <x-app-logo class="w-6 h-6"/>
            </a>

            <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-md cursor-pointer">
                <x-svg.menu-animate/>
            </button>
        </div>

        <!-- Sidebar -->
        <div x-cloak
             x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-x-full"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 translate-x-full"
             class="fixed top-15 right-0 h-screen w-screen bg-sand z-40 overflow-y-auto"
        >

            <!-- Content -->
            <div class="flex flex-col gap-4 px-4 pt-5 pb-4 h-[calc(100%-4rem)] min-h-175">
                <!-- Principal links -->
                <x-sidebar.links menu-variable="mobileMenuOpen"/>

                <!-- Bottom links -->
                <x-sidebar.bottom-links />
            </div>
        </div>
    </aside>

    {{-- Desktop sidebar menu --}}
    <aside
        class="hidden lg:flex lg:flex-col lg:fixed h-full bg-sand transition-all duration-300 z-50"
        style="width: {{ session('sidebar_expanded', true) ? '16rem' : '5rem' }};"
    >
        <div class="h-full px-4.5 pt-6 pb-4 flex flex-col justify-between gap-4 overflow-y-visible rounded-tr-[16px] rounded-br-[16px] bg-sand">

            <!-- Navigation header -->
            <div x-data="{ showTooltip: false }" class="relative flex items-center justify-between pl-2.5">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center"
                   title="Retour à l'accueil"
                   @mouseenter="showTooltip = true"
                   @mouseleave="showTooltip = false"
                   wire:navigate
                >
                    <x-app-logo class="w-6 h-6"/>
                </a>
            </div>

            <!-- Principal links -->
            <x-sidebar.links />

            <!-- Bottom links -->
            <x-sidebar.bottom-links />
        </div>
    </aside>
</div>
