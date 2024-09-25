<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{

   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with('category:id,type')->latest()->select('id', 'created_at', 'title', 'image', 'category_id')->paginate(10);


        if(request()->filled('page') && request()->input('page') > $articles->lastPage()){

            return redirect()->route('articles.index', ['page' => $articles->lastPage()])->with('message', 'Article deleted successfully');
         }

         return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('type')->get();

        $tags = Tag::get();

        return view('articles.create', ['page' => request()->query('page'),
                                        'categories' => $categories,
                                        'tags' => $tags ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $path = null;

        if($request->hasFile('image')){

           $path = $request->file('image')->store('articles', 'public');
        }

      $article =  Article::create($request->validated());

      $article->update(['image' => $path]);

      if($request->filled('tags')){

        $tags = explode(',', $request->tags);

        foreach($tags as $tag){

           $add_tag = Tag::firstOrCreate(['name' => $tag]);

           $article->tags()->attach($add_tag->id);
        }

      }

        return redirect()->route('articles.index', ['page' =>request()->query('page')])->with('message', 
                                                                            'Article with title (' . $article->title . ') is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $article->load('tags', 'category');

        return view('articles.show', ['article' => $article, 'page' => request()->query('page')] );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $categories = Category::get();

        $tags = $article->tags->implode('name', ',');

       return view('articles.edit', ['article' => $article, 'page' => request()->query('page'),
                                     'categories' => $categories, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
       
        $article->update($request->safe()->except(['image', 'tags']));



        if($request->has('delete_image') && $request->delete_image == 'on' && isset($article->image)){

            Storage::disk('public')->delete($article->image);

            $article->update([
                'image' => null,
            ]);
        }

        if($request->hasFile('image')){
            if(isset($article->image))
           Storage::delete('articles/' . $article->image);

          $path = $request->file('image')->store('articles', 'public');

          $article->update([
            'image' => $path,
          ]);
         }
         $tags = explode(',', $request->tags);

         $ids = [];

         foreach($tags as $tag){
            $add = Tag::firstOrCreate(['name' => $tag])->id;

            array_push($ids, $add);
         }


         $article->tags()->sync($ids);

         return redirect()->route('articles.index', ['page' => request()->query('page')])->with('message', 'Article is updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index', ['page' => request()->query('page')])->with('message', 'Article is deleted successfully');
    }
}
