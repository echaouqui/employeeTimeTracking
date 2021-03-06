<x-app-layout>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <h1 class="text-3xl font-bold text-gray-900">
            Dashboard
          </h1>
        </div>
    </header>

    @if (auth()->id() == 1)
      @livewire("admin-component") 
    @else
      @livewire("dashboard-component")
    @endif
    

</x-app-layout>
