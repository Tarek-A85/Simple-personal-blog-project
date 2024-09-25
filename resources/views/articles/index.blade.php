<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Articles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                @auth

                @if(session('message'))

                <div class="bg-green-400 text-center font-semibold py-4">{{ session('message') }}</div> <br>

                @endif

             <x-primary-button class="bg-green-500 hover:bg-green-300"> <a href="{{route('articles.create', ['page' => $articles->lastPage()] )}}" >Create Article</a></x-primary-button>


                @endauth

                @if($articles->count())

                <div class="divide-y-4 divide-black ">
                    
                   @foreach($articles as $article)

                  <div class="py-4"> <a href="{{ route('articles.show',['page' => $articles->currentPage(),$article]) }}" class="hover:text-blue-300"> <h1 class="text-3xl text-blue-500">{{ $article->title }} </a> <small class="inline text-lg text-black font-bold">{{$article->created_at->diffForHumans()}}</small>
                  @auth
                  <x-primary-button><a href="{{ route('articles.edit', ['page' => $articles->currentPage(),$article]) }}">Edit</a></x-primary-button>
                  <form class="inline" action="{{ route('articles.destroy', ['page' => $articles->currentPage(), $article]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-primary-button class="bg-red-700 hover:bg-red-500" onclick="return confirm('Are you sure?')">Delete</x-primary-button>

                  </form>
                  @endauth
                
                </h1>
                   <small class="text-lg">( Category: {{ $article->category->type }} )</small>
                </div>

                   @endforeach

                   {{ $articles->links() }}
                </div>

                   @else
                   <h4 class="text-center text-lg font-semibold">There is no articles</h4>
                   @endif
                   </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
