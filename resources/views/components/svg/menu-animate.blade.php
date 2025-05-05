<button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2">
    <svg class="w-6 h-6 stroke-myblack transition-all duration-300 ease-in-out"
         viewBox="0 0 24 24"
         fill="none"
         stroke-width="2"
         stroke="currentColor"
         stroke-linecap="round"
         stroke-linejoin="round"
         xmlns="http://www.w3.org/2000/svg"
    >
        <line x1="4" y1="6" x2="20" y2="6"
              :class="mobileMenuOpen ? ' rotate-45 origin-center' : ''"
              class="transition-all duration-300"/>
        <line x1="4" y1="12" x2="20" y2="12"
              :class="mobileMenuOpen ? 'opacity-0' : ''"
              class="transition-all duration-300"/>
        <line x1="4" y1="18" x2="20" y2="18"
              :class="mobileMenuOpen ? '-translate-y-2 -rotate-45 origin-center' : ''"
              class="transition-all duration-300"/>
    </svg>
</button>
