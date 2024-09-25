<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
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

                <a href="{{route('categories.create', ['page' => $categories->lastPage()] )}}" class="text-blue-600 font-semibold"><u>Create a new category?</u></a>

                </div>
    

                @if($categories->count())

                <table class="border">

                <tr>
                    <th class="border border-slate-500 px-32 py-4" >Type</th>
                    <th class="border border-slate-500 px-32 py-4">Number of articles</th>
                    <th class="border border-slate-500 px-32 py-4">Modify</th>
                </tr>
                <tbody class="text-center">

                @foreach($categories as $category)
                <tr>
                    <td class="py-4 border border-slate-500">{{$category->type}}</td>
                    <td class="py-4 border border-slate-500">#{{$category->articles_count}}</td>
                    <td class="py-4 border border-slate-500"> 
                        <x-primary-button><a href="{{route('categories.edit',[$category, 'page' => $categories->currentPage()])}}">Edit</a></x-primary-button>
                       </form>
                        <form class="inline" action="{{route('categories.destroy',[$category, 'page' => $categories->currentPage()])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-primary-button class="bg-red-700 hover:bg-red-500" onclick="return confirm('delete this category and all related articles?')">Delete</x-primary-button>
                        </form>
                </td>
                </tr>

                @endforeach

                </tbody>

                </table>
                <br>

               <div> {{ $categories->links() }} </div>
               

                 @else
                   <h4 class="text-center text-lg font-semibold">There is no categories</h4>

                @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
