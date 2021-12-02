<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostBookmarks;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::with('bookmarks')->orderBy('id','DESC')->paginate(10)->toArray();
        
        return view('posts',[
            'posts' => $posts
        ]);
    }   

    public function bookmarkpost(Request $request){        
        $findUserBookmark = PostBookmarks::where(['post_id'=>$request->post_id,'user_id'=>auth()->id()])->first();        
        if(empty($findUserBookmark)){             

            $insertData = PostBookmarks::create([
                'post_id'=> $request->post_id,
                'user_id'=> auth()->id()
            ]);

            $resData = [
                'status' => 200,
                'msg' => 'Successfully bookmarked',
                'action' => 'bookmark',
                'postbookmark' => $insertData
            ];
            return response()->json($resData);
        }else{
            //delete code
            $deletedRows = PostBookmarks::where(['post_id'=>$request->post_id,'user_id'=>auth()->id()])->delete();
            $resData = [
                'status' => 200,
                'msg' => 'unbookmarked',
                'action' => 'unbookmark',
                'postbookmark' => $deletedRows
            ];
            return response()->json($resData);
        }
    }
}
