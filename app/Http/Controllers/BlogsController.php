<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

class BlogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=> [
            'index', 'show'
        ]]);
    }


    public function index() {
        $blogs = Blog::orderBy('updated_at', 'desc')->get();    

        return view('blogs.index', ['blogs'=>$blogs]);
    }

    public function create() {
        return view('blogs.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title'=>'required',
            'body'=>'required',
            'img'=>'image|nullable|max:1999'
        ]);

        // handle file upload
        if($request->hasFile('img')) {
            // get filname and ext
            $fileNameWithExt = $request->file('img')->getClientOriginalName();
            // get only filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // get only ext
            $extension = $request->file('img')->getClientOriginalExtension();
            // file name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('img')->storeAs('public/blog_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimg.jpg';
        }

        $blog = new Blog();
        $blog->title = $request->input('title');
        $blog->body = $request->input('body');
        $blog->user_id = auth()->user()->id;
        $blog->img = $fileNameToStore;
        $blog->save();

        return redirect('/blogs')->with('success', 'blog was created');
    }

    public function show($id) {
        $blog = Blog::findOrFail($id);

        return view('blogs.show', ['blog'=>$blog]);        
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'title'=>'required',
            'body'=>'required',
            'img' => 'image|nullable|max:1999'
        ]);

        // handle file upload
        if ($request->hasFile('img')) {
            // get filname and ext
            $fileNameWithExt = $request->file('img')->getClientOriginalName();
            // get only filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // get only ext
            $extension = $request->file('img')->getClientOriginalExtension();
            // file name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('img')->storeAs('public/blog_images', $fileNameToStore);
        }


        $blog = Blog::findOrFail($id);
        $blog->title = $request->input('title');
        $blog->body = $request->input('body');
        if($request->hasFile('img')) {
            $blog->img = $fileNameToStore;
        }
        $blog->save();
        
        return redirect('/blogs')->with('success', 'blog was updated');
    }

    public function edit($id) {
        $blog = Blog::findOrFail($id);

        if(auth()->user()->id !== $blog->user_id) {
            return redirect('/blogs')->with('error', 'you can\'t edit other user\'s blog');
        }

        return view('blogs.edit', ['blog' => $blog]);
    }

    public function destroy($id) {
        $blog = Blog::findOrFail($id);

        if (auth()->user()->id !== $blog->user_id) {
            return redirect('/blogs')->with('error', 'you can\'t delete other user\'s blog');
        }

        if($blog->img !== 'noimg.jpg') {
            Storage::delete('public/blog_images/'.$blog->img);
        }

        $blog->delete();

        return redirect('/blogs')->with('success', 'blog was deleted');
    }
}
