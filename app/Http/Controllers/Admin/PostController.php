<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        
        $posts = Post::orderBy('id','DESC')->paginate(10);
        
        return view('admin.posts.index',[
            'posts' => $posts
        ]);
    }

    public function create(Post $post){
        
        return view('admin.posts.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'post_title' => 'required',
            'post_body' => 'required'
        ]);

        Post::create([
            'post_title' => $request->post_title,
            'post_body' => $request->post_body
        ]);

        return redirect()->route('admin.post')
                ->withSuccess(__('Post added successfully.'));

    }

    public function destroy(Post $post, $id)
    {   
        $post = Post::find($id);
        if ($post) {
            if($post->delete()){
                return redirect()->route('admin.post')
                ->withSuccess(__('Post delete successfully.'));
            }
        }
    }

    public function edit(Post $post, $id)
    {   
        $post = Post::find($id);
        return view('admin.posts.edit',[
            'post' => $post
        ]);
    }

    public function update(Request $request, $id = 0)
    {
        $this->validate($request,[
            'post_title' => 'required',
            'post_body' => 'required'
        ]);

        $post = Post::findOrNew($id);
        $post->fill($request->all());
        $post->save();

        return redirect()->route('admin.post')
                ->withSuccess(__('Post edited successfully.'));
    }
}
