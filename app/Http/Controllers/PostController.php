<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Follower;
use App\Models\Like;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\ArrayToXml\ArrayToXml;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->tokenCan('read_posts')){
            abort(403,"Unathorized Access. Token Error");
        }
         $users = User::all();
         $posts = Post::with('user')->get();
        
    

         return $posts; 
    }
    public function get_all_xml()
    {
        
         if(!auth()->user()->tokenCan('read_posts')){
            abort(403,"Unathorized Access. Token Error");
        }
        
        $posts = Post::with('user')->get()->toArray();
        $posts_list = array('posts'=>$posts);
        

        $posts_xml = ArrayToXml::convert($posts_list);
     

            return $posts_xml;
        
        
        

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $post= Post::create($request->all()) ;
       if($request->wantsJson()){
            return $this->index();

        }else{
             return redirect('dashboard');
        }

        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $posts = Post::with('user')->where('id','=',$id)->get();
               return $posts;
        
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if(!auth()->user()->tokenCan('update_posts')){
            abort(403,"Unathorized Access. Token Error");
        }
         $Post = Post::where('id','=',$id)->firstorFail();
        $Post->update($request->all());
        return $this->show($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(!auth()->user()->tokenCan('update_posts')){
            abort(403,"Unathorized Access. Token Error");
        }
        $Post = Post::where('id','=',$id)->firstorFail();
        return $post->destroy($id);
    }

    public function create_token(){

         if(!auth()->user()->tokenCan('update_post')){
            abort(403,"Unathorized Access. Token Error");
        }
        $user = Auth::user();
        $token = $user->createToken('developer-access',['create_post','read_posts','update_posts']);
        
        echo $token->plainTextToken;


    }
}
