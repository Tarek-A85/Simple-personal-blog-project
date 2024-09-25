<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::withCount('articles')->paginate(5);

        if(request()->filled('page') && request()->input('page') > $tags->lastPage()){

            return redirect()->route('tags.index', ['page' => $tags->lastPage()])->with('message', 'Tag deleted successfully');
         }

         return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
        return view('tags.create', ['page' => request()->query('page')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {

        Tag::create($request->validated());


        return redirect()->route('tags.index', ['page' => request()->query('page')])->with('message', 'Tag ' . $request->validated('name') .' is added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        $page = request('page');


        return view('tags.edit', compact('tag', 'page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());

        return redirect()->route('tags.index', ["page" => request()->query('page')])->with('message', 'The tag is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        $page = request()->query('page');

        return redirect()->route('tags.index', ['page' => $page])->with('message', 'The tag is deleted successfully');
    }
}
