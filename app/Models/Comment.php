<?php



namespace App\Http\Controllers;

use App\Comment;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    // Display a listing of the resource.
    
    public function index()
    {
        
    }

    // Show the form for creating a new resource.
   
    public function create()
    {
    }

    //Store a newly created resource in storage.
    
    public function store(Request $request)
    {
        if (Auth::check()) {
            Comment::create([
                'name' => Auth::user()->name,
                'comment' => $request->input('comment'),
                'user_id' => Auth::user()->id
            ]);

            return redirect()->route('home')->with('success','Comment Added..!');
        }else{
            return back()->withInput()->with('error','Something wrong');
        }


        
    }

    //Display the specified resource.
   
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    // Update the specified resource in storage.
   
    public function update(Request $request, Comment $comment)
    {
        
    }

    // Remove the specified resource from storage.
    public function destroy(Comment $comment)
    {
        if (Auth::check()) {

            $reply = Reply::where(['comment_id'=>$comment->id]);
            $comment = Comment::where(['user_id'=>Auth::user()->id, 'id'=>$comment->id]);
            if ($reply->count() > 0 && $comment->count() > 0) {
                $reply->delete();
                $comment->delete();
                return 1;
            }else if($comment->count() > 0){
                $comment->delete();
                return 2;
            }else{
                return 3;
            }

        }    
    }
}
