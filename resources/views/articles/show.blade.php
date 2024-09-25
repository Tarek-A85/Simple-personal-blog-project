<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Specific article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-blue-700 text-center text-5xl font-bold">
                 {{$article->title}}
                </div>
                <div class="text-blue-500 text-xl py-4">
                @forelse($article->tags as $tag)
                #{{$tag->name}} 
                @empty

                @endforelse
                </div>
                <img @if(isset($article->image)) height="500" width="500" @endif  src="{{ asset('storage/' . $article->image) }}" alt="" class="mx-auto"> <br>
                <p class="p-6 text-2xl font-semibold">{{$article->text}}</p>
                <p class="p-2 text-lg font-semibold">Published {{ $article->created_at->diffForHumans() }}</p>

            </div>
        </div>
    </div>
</x-app-layout>
