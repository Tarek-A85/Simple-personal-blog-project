<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                @if(session('message'))

                <div class="bg-gray-400 text-center font-semibold py-4">{{ session('message') }}</div> <br>

                @endif

                <form action="{{route('articles.update',[$article, 'page' => $page])}}" method="POST" enctype="multipart/form-data">
                @csrf    
                @method('PUT')
                <x-input-label for="title" class="text-xl">Article title*</x-input-label>
                <input type="text" name="title" value="{{$article->title}}" autofocus autocomplete="title"> <br><br>
                @error('title')

                <div class="text-red-500">*{{$message}}</div> <br>

                @enderror
                <x-input-label for="text" class="text-xl">Article Text*</x-input-label>
                <textarea name="text" cols="75" rows="10">{{$article->text}}</textarea> <br><br>
                @error('text')

                <div class="text-red-500">*{{$message}}</div> <br>

                @enderror
                  <x-input-label for="category_id" class="text-xl">Article Category*</x-input-label>
                  <select name="category_id">
                    @foreach($categories as $category)
                    <option value="{{$category->id}}" {{($category->id == $article->category_id ? 'selected' : '')}} >{{$category->type}}</option>
                    @endforeach
                  </select> <br><br>
                  @error('category_id')

                <div class="text-red-500">*{{$message}}</div> <br>

                  @enderror
                  <x-input-label for="tags" class="text-xl">Article's tags</x-input-label>
                  <textarea name="tags" cols="40" rows="10">{{$tags}}</textarea> <br><br>
                  @error('tags')

                 <div class="text-red-500">*{{$message}}</div> <br>

                  @enderror
                  <figure> 
                    <img @if(isset($article->image)) height="300" width="300" @endif src="{{ asset('storage/' . $article->image) }}" alt="No image"> 
                    <input type="checkbox" name="delete_image"> Delete this image <br>

                    <div class="py-4">

                    <x-input-label for="image" class="text-xl">Choose a picutre</x-input-label>
                    
                    <input type="file" name="image">

                    </div>
                    
                  
                </figure> <br><br>
                @error('image')

                <div class="text-red-500">*{{$message}}</div> <br>

                  @enderror
                 
                <x-primary-button>Submit</x-primary-button>
                </form>
                    
                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
