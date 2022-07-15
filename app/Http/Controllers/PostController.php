<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller {

    public function index() {
        
        $posts = Post::all();

        return view('post.index',compact('posts'));
    }


    public function create() {
        return view('post.create');
    }

    public function store(Request $request) {

        if ($request->hasFile('file')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png'
            ]);

            $request->file->store('post', 'public');
            
            $post = new Post([
                "image" => $request->file->hashName(),
                'caption' => $request->get('caption'),
                'user_id' => User::find(auth()->user()->id),
            ]);
            $user = User::find(auth()->user()->id);
            $user->posts()->save($post);
        }

        return redirect()
        ->route('home')
        ->with('success','new post added')
        ;
    }

    public function edit(Post $post) {
        return view('post.edit',compact('post'));
    }

    public function update(Request $request, Post $post) {

        if ($request->hasFile('file')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png'
            ]);

            $request->file->store('post', 'public');

            $post->image = $request->file->hashName();

        }

        $post->caption = $request->get('caption');
        $post->save();

        if(auth()->user()->is_admin && !$post->user->is_admin) { 

            return redirect()
            ->route('user.show',$post->user)
            ->with('success','post edited')
            ;

        } else {
            return redirect()
            ->route('home')
            ->with('success','post edited')
            ;
        }
    }

    public function destroy(Post $post) {
        
        $post->delete();

        if(auth()->user()->is_admin && !$post->user->is_admin) { 

            return redirect()
            ->route('user.show',$post->user)
            ->with('success','post deleted')
            ;

        } else {
            return redirect()
            ->route('home')
            ->with('success','post deleted')
            ;
        }
    }

    public function like(Post $post) {

        $post->like = ($post->like)+1;
        $post->save();

        // return redirect()
        // ->route('post.index');

        // return redirect()
        // ->route('home');

        // return redirect()
        // ->route('user.show');

        return redirect()->back();
    }
}
