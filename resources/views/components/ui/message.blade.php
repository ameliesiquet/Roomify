@props(['icon' => null, 'message', 'linkText' => null, 'linkHref' => null, 'time' => null])
<section class="flex flex-col gap-2 w-fit">
    <h2 class="relative after:content-[''] after:block after:w-full after:h-[1px] after:bg-sand after:mt-2">
        <div class="flex items-baseline gap-2">
                <span class="p-2 rounded-full shadow-sm w-10 h-10 flex justify-center items-center">
                  {{ $icon }}
                </span>
            Roomify Chat
        </div>
    </h2>
    <div class="flex flex-col items-start gap-1 bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
        <p class="text-sm text-gray-800 whitespace-pre-line">{{ $message }}</p>

    @if($linkText && $linkHref)
            <a href="{{ $linkHref }}" class="text-turquoise hover:underline underline text-sm inline-flex items-center">
                {{ $linkText }}
                <x-svg.arrow-right/>
            </a>
        @endif
    </div>
    @if($time)
        <p class="text-xs text-gray-400 mt-1">{{ $time }}</p>
    @endif
</section>
