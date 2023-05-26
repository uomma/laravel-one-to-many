<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $post = Post::all();
     return view('admin.posts.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $data = $request-> validated();
        $post = new Post();
        $post->fill($data);
        $post->slug=Str::slug($data['title']);

        if(isset($data['cover_img']))
        {
            $path_img= Storage::put('uploads/posts', $data['cover_img']);
            $post->cover_img = $path_img;            
        };
        $post->save();

        return redirect()->route('admin.posts.index')->with('message', 'bravo hai creato un nuovo post'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
       /*  $posts = Post::where('slug', $slug)->get(); */
     
        return view('admin.posts.show', compact('post'));                                                         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
       return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {


        $data = $request->validated();
        $post->update($data);
        $post->slug=Str::slug($data['title']);
        $post->save();

        return redirect()->route('admin.posts.index')->with('message','bravo hai modificato un  post'); 

    }

    /**
     * Remove the specified resource from storage.  
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    { 
        
      $old_id = $post->id;
      $post->delete();
      
      return redirect()->route('admin.posts.index')->with('message',"bravo hai eliminato $old_id"); 

    }
}
