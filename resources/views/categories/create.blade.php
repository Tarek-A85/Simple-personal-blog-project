<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a new category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   
        
                  <form action="{{route('categories.store', ['page' => $page] )}}" method="POST">
                    @csrf
                    <x-input-label for="type" class="text-xl">Category Type*</x-input-label>
                    <input type="text" name="type" value="{{ old('type') }}" placeholder="ex.Sport" autofocus autocomplete="type"> <br><br>
                    @error('type')
                    <div class="text-red-500"> *{{$message}} </div> <br>
                    @enderror
                    <x-primary-button>Submit</x-primary-button>

                  </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
