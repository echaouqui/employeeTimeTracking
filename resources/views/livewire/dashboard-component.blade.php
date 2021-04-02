<main>
    <div class=" flex flex- max-w-7xl mx-auto my-6 sm:px-6 lg:px-8">
        <p class="flex flex-initial text-gray-800 py-2 px-4 text-xl font-medium bg-green-100 rounded-2xl">
            hours of work: <span class="font-bold ml-1"> {{ $hours }} </span>
        </p>
        <div class="flex-grow">
            <!-- This item will grow -->
          </div>
        <div  class=" flex flex-initial float-right">
            @if ($stat)
            <button wire:click="session_start" type="button" class="py-2 px-4 float-right bg-green-600 hover:bg-green-700 focus:ring-green-500 focus:ring-offset-green-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                Start
            </button>
            @endif
        </div>
    </div>
    <div class="max-w-7xl mx-auto pb-6 sm:px-6 lg:px-8">
      <div class="px-4 sm:px-0">
        <div class="border-4 border-dashed border-gray-200 rounded-lg min-h-full">
            
            @forelse ($sessions as $session)
                @livewire('sessions-component', ['session' => $session], key($session->id))
            @empty
                
            @endforelse
        </div>
      </div>
    </div>
</main>
