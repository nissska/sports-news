<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all()->sortByDesc('created_at');
        $categories = Category::all();
        return view('post.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'image'=>'nullable|mimes:png,jpg,jpeg,webp',
            'author'=>'required|string|max:255',
            'body'=>'required',
            'category_id'=>'required',       
            'language'=>'required|string|max:255'            
        ]);
        //Handling the images

        //Case when no image uploaded
        $filename = NULL;
        $path = NULL;

        if($request->has('image')){
            $file=$request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;

            $path = 'uploads/posts/';
            $file->move($path, $filename);
        }

        Post::create([
            'title' => $request->title,
            'image' => $path.$filename,
            'author'=>$request->author,
            'body'=>$request->body,
            'category_id'=>$request->category_id,
            'language'=>$request->language
        ]);

        return redirect('post')->with('status','Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'=>'required|string|max:255',
            'image'=>'nullable|mimes:png,jpg,jpeg,webp',
            'author'=>'required|string|max:255',
            'body'=>'required',
            'category_id'=>'required',       
            'language'=>'required|string|max:255'           
        ]);

        $post = Post::findOrFail($post->id);

        $filename = NULL;
        $path = NULL;

        if($request->has('image')){
            $file=$request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;

            $path = 'uploads/posts/';
            $file->move($path, $filename);

            if(File::exists($post->image)){
                File::delete($post->image);
            }
            
        }

        $post->update([
            'title' => $request->title,
            'image' => $path.$filename,
            'author'=>$request->author,
            'body'=>$request->body,
            'category_id'=>$request->category_id,
            'language'=>$request->language
        ]);

        return redirect('post')->with('status','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post = Post::findOrFail($post->id);
        if(File::exists($post->image)){
            File::delete($post->image);
        }
        $post->delete();
        return redirect('post')->with('status','Post deleted successfully');
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        $post = Post::findOrFail($id);

        $post->comments()->create([
            'author' => Auth::user()->name,
            'body' => $request->body,
            'published' => true,
        ]);

        return redirect()->route('post.show', $post->id)->with('status', 'Comment added successfully!');
    }
    }

