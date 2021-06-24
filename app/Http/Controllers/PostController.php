<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function create () {
        $tags = Tag::all();
        return view('posts.create',compact('tags'));
    }

    public function store(Request $request) {

        $post = Post::create([
            'title' => $request->get('title'),
            'author_name' => $request->get('author_name'),
            'post_text' => $request->get('post_text')
        ]);

        $post->tags()->sync($request->get('tags'));
        return redirect()->back();
    }


    public function edit($id) {
        $post = Post::findorfail($id);
        $list1 = [];
        foreach ($post->tags as $tag) {
            array_push($list1, $tag->id);
        }

        $tags = Tag::all();

        return view('posts.update',compact('post','list1','tags'));
    }

    public function update($id,Request $request) {
        $post = Post::findorfail($id);
        $post->update($request->all());
        $post->tags()->sync($request->get('tags'));

        return redirect()->back();
    }



    public function index() {
        $posts = Post::all();

        return view('posts.index',compact('posts'));
//        return $posts;
    }

    public function delete($id) {
        $post = Post::findorfail($id);
        $post->delete();
        return redirect()->back();
    }

}
