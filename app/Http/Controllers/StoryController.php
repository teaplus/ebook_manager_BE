<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Story;
use App\Models\User;




class StoryController extends Controller
{
    public function createStory(Request $request){
        $user = $request->user();

        // Kiểm tra xem người dùng đã xác thực chưa
        if ($user) {
            
            // $story = new Story();
            // $story->title = $request->input('title');
            // $story->image_background = $request->input('image_background');
            // $story->author = $request->input('author');
            // $story->description = $request->input('description');
            // $story->user_id = $user->only('id');
            // $story->save();
            // $story->categories()->attach($request->input('categories'));
            $title = $request->input('title');
            $img = $request->input('image_background');
            $user_id = $user->id;
            $author = $request->input('author');
            $des = $request->input('description');
            $status = $request->input('status');
            
            $story = Story::create([
                'title' => $title,
                'image_background'=>$img,
                'user_id'=>$user_id,
                'author_id' => $author, // ID của tác giả
                'description' => $des,
                'content' => 'gaffffffffffffffff',
                'status'=> $status
            ]);

            $category = $request->input('categories');

            $story->categories()->attach($category);



            return response()->json(['message' => 'Story created successfully', 'data' => $story], 201);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function addChapter(){

    }

    public function updateChapter(){

    }

    public function deleteChapter(){

    }

    public function deleteStory(){

    }
}
