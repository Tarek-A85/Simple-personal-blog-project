<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create a new Article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   
        
                  <form action="{{route('articles.store', ['page' => $page] )}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <x-input-label for="title" class="text-xl">Article's Title*</x-input-label>
                    <input type="text" name="title" value="{{ old('title') }}"  autofocus autocomplete="title" required> <br><br>
                    
                    @error('title')
                    <div class="text-red-500"> *{{$message}} </div> <br>
                    
                    @enderror
                    <x-input-label for="text" class="text-xl">Article's Text*</x-input-label>
                    <textarea name="text" cols="75" rows="10"  >{{ old('text') }}</textarea> <br><br>
                    
                    @error('text')
                    <div class="text-red-500"> *{{$message}} </div> <br>
                    
                    @enderror
                   <x-input-label for="category_id" class="text-xl">Article's Category*</x-input-label>
                   <select name="category_id" value="{{ old('category_id') }}" required>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : ''}} >{{ $category->type }}</option>
                    @endforeach
                   </select>
                   <br><br>
                   @error('category_id')

                 <div class="text-red-500"> *{{$message}} </div> <br>

                  @enderror

                   <x-input-label for="tags" class="text-xl">Article's Tags <small>(divided by a comma)</small></x-input-label>
                   <textarea  name="tags" cols="40" rows="10" > {{ old('tags') }} </textarea> <br><br>
                   @error('tags')
                   <div class="text-red-500"> *{{$message}} </div> <br>
                   @enderror

                    <x-input-label for="image" class="text-xl">Article's Image</x-input-label>
                    <input type="file" name="image"> <br><br>
                    
                    @error('image')
                    <div class="text-red-500"> *{{$message}} </div> <br>
                    @enderror
                   
                    <x-primary-button>Submit</x-primary-button>

                  </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
