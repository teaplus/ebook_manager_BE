<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;
use App\Models\User;
use App\Models\Story;


class CommentController extends Controller
{
    //
    public function listComment($id){

        $comments = Story::findOrFail($id)->comments;
        return response()->json(['data'=>$comments]);
    }

    public function createComment(Request $request, $id){
        $user = $request->user();

        if($user){
            $Comment = Comment::create([
                'content'=> $request->input('content'),
                'story_id'=> $id,
                'user_id'=> $user->id
            ]);
            return response()->json(['message' => 'Comment created successfully', 'data' => $Comment], 201);    
        }
        return response()->json(['message' => 'Unauthorized'], 401);
        // return 'hihi';
    }

    public function editComment(){

    }

    public function deleteComment(){

    }
}
