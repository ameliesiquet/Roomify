@props(['icon' => null, 'message', 'linkText' => null, 'linkHref' => null, 'time' => null])
<section class="flex flex-col gap-2 w-fit mb-6">
    <div class="flex flex-col items-start gap-1 bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
        <p class="text-sm text-gray-800 whitespace-pre-line">{{ $message }}</p>
        @if($linkText && $linkHref)
            <a href="{{ $linkHref }}" class="text-turquoise hover:underline underline text-sm inline-flex items-center">
                {{ $linkText }}
                <x-svg.arrow-right/>
            </a>
        @endif
    </div>

</section>
