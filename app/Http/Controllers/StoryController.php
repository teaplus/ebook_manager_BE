<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Category;
use App\Models\Story;
use App\Models\User;
use App\Models\Author;
use App\Models\Chapter;





class StoryController extends Controller
{

    public function getListStory(Request $request) {
        $name = $request->query('name');
        $stories = Story::where('title', 'LIKE', "%$name%")->with(['categories:id,category_name', 'authors:id,author_name'])->get();

        return response()->json(['data' => $stories]);
    }

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

    public function listChapter($story_id){
        $chapters = Chapter::where('story_id', $story_id)->get();
        return response()->json(['data' => $chapters], 200);
    }

    public function addChapter(Request $request, $id){


        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        // Create unique name for chapter
        $fileName = uniqid() . '.txt';

        // save content of chapter to text file.
        Storage::disk('local')->put($fileName, $validatedData['content']);

          // return url of file chapter
        $filePath = 'app/' . $fileName;
        $absolutePath = storage_path($filePath);

        $chapter = Chapter::create([
            'story_id'=>$id,
            'chapter_number'=>$request->input('chapter_number'),
            'title'=>$request->input('title'),
            'content'=> $fileName
        ]);
            return response()->json(['message' => 'Story chapter add successfully', 'data' => $chapter], 201);
        
    }

    public function updateChapter(Request $request, $id){
        $Story = Story::find($id);
        if (Gate::allows('edit-chapter', $Story)) {
            // Người dùng có quyền chỉnh sửa bài viết
            return 'Người dùng có quyền chỉnh sửa bài viết';
        } else {
            // Người dùng không có quyền chỉnh sửa bài viết
            return "Người dùng không có quyền chỉnh sửa bài viết";
        }
    }

    public function deleteChapter(){

    }

    public function deleteStory(){

    }
}
