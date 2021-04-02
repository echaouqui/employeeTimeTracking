@php
    $b = "border-green-500";
    if ($session->status == "end")
    {
        $b = "border-red-500";
    }
@endphp
<x-sessions class="{{ $b }}  border-l-4 items-center flex" style="min-height: 104px">
    <x-slot name="content">
    <div class="flex-row w-full flex justify-center items-center">
        <div class="flex-shrink-0 mr-3">
            @if ($desktop)
                <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="h-12 w-12 text-gray-500">
                    <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="h-12 w-12 text-gray-500">
                    <path d="M0 0h24v24H0z" stroke="none"></path><rect x="7" y="4" width="10" height="16" rx="1"></rect><path d="M11 5h2M12 17v.01"></path>
                </svg>
            @endif
        </div>
        <div class="flex flex-col flex-1">
            <span class="text-gray-400 dark:text-white text-xs font-medium mr-2">
                {{ $ip }} - {{ $browser }} - {{ $platform }}
            </span>
            <span class="text-gray-600 dark:text-white text-lg font-medium mr-2">
                start at: {{ $session->start }}
            </span>
            @if ($session->end)
            <span class="text-gray-600 dark:text-white text-lg font-medium mr-2">
                end at: {{ $session->end }}
            </span>
            @endif
        </div>
        <div  class=" flex flex-initial ">
            @if ($session->status != "end")
            <button wire:click="session_end({{ $session->id }})" type="button" class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                End
            </button>
            @endif
        </div>
    </div>
    </x-slot>
</x-sessions>


