<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tags') }}
        </h2>
       
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                <div class="my-6">

                @if(session('message'))

                <div class="bg-green-400 text-center font-semibold py-4">{{ session('message') }}</div> <br>

                @endif

                <a href="{{route('tags.create',['page' => $tags->lastPage()])}}" class="text-blue-600 font-semibold"><u>Create a new tag?</u></a>

                </div>
    

                @if($tags->count())

                <table class="border">

                <tr>
                    <th class="border border-slate-500 px-32 py-4" >Tag</th>
                    <th class="border border-slate-500 px-32 py-4">Number of articles</th>
                    <th class="border border-slate-500 px-32 py-4">Modify</th>
                </tr>
                <tbody class="text-center">

                @foreach($tags as $tag)
                <tr>
                    <td class="py-4 border border-slate-500">{{$tag->name}}</td>
                    <td class="py-4 border border-slate-500">#{{$tag->articles_count}}</td>
                    <td class="py-4 border border-slate-500"> 
                        <x-primary-button><a href="{{route('tags.edit',[$tag, 'page' => $tags->currentPage()])}}">Edit</a></x-primary-button>
                       </form>
                        <form class="inline" action="{{route('tags.destroy',[$tag, 'page' => $tags->currentPage()])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-primary-button class="bg-red-700 hover:bg-red-500" onclick="return confirm('Are you sure?')">Delete</x-primary-button>
                        </form>
                </td>
                </tr>

                @endforeach

                </tbody>

                </table>
                <br>

               <div> {{ $tags->links() }} </div>
               

                 @else
                   <h4 class="text-center text-lg font-semibold">There is no tags</h4>

                @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
