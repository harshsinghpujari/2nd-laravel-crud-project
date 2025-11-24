<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function deletePost(Post $post) {

        //authorization check
        if(auth()->user()->id === $post['user_id']){
            $post->delete();
        }
        
        return redirect('/');
    }

    //method to update the post
    public function actuallyUpdatePost(Post $post, Request $request) {
        //once again validating the user
         if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }

        //making sure the incoming data is there
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        //preventing xss attacks
        $incomingFields['title'] = strip_tags($incomingFields['title']);        
        $incomingFields['body'] = strip_tags($incomingFields['body']);   
        
        //using update method directly on $post to update the table 
        $post->update($incomingFields);
        return redirect('/');

    }
    
    //method to only show Edit Screen to user
    public function showEditScreen(Post $post) {

        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }
        return view('edit-post', ['post' => $post]);
    }

    //Method to create Post
    public function createPost(Request $request) {

        //validating by making fields required 
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['title'] = strip_tags($incomingFields['title']);//strip_tags method ensures only plain text is stored eliminate risk of xss attacks
        $incomingFields['body'] = strip_tags($incomingFields['body']);


        $incomingFields['user_id'] = auth() -> id();//storing id of the logged in user to the foreign key 'user_id'of the posts table

        Post::create($incomingFields);// this create is an Eloquent method to inserts the complete array incomingFields as a new record into the post table.
        return redirect('/');
    }

}
