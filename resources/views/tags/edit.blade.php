<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Tag') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                <form action="{{route('tags.update',[$tag, 'page' => $page])}}" method="POST">
                @csrf    
                @method('PUT')
                <x-input-label for="name" class="text-xl">Tag Name*</x-input-label>
                <input type="text" name="name" value="{{$tag->name}}" autofocus autocomplete="name"> <br><br>
                @error('name')

                <div class="text-red-500">*{{$message}}</div> <br>

                @enderror
                <x-primary-button>Submit</x-primary-button>
                </form>
                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
