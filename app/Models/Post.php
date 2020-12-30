<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeLiked;

class Post extends Model
{
    use HasFactory;
    

    protected $fillable = ['id',
    					   'caption',
    					   'user_id',
    					   'photo',
						   'likes',
						   'comments'];

	protected $primarykey =	'id';
    
    Protected $cast =['user_id' =>'integer']; 
    
	public function user(){

		return $this->belongsTo('App\Models\User','user_id','user_id');
	}

	 public function comment(){
        return $this->hasMany('App\Models\Comment');
    }		

    public function like(){
        return $this->hasMany('App\Models\Like');
    }

    public function liked($user = null,$liked = true)	{
        $this->likes()->updateOrCreate([
        'user_id' => $user? $user->id : auth()->id(),],[
        'likes' => $liked, ]);

    }		   
    public function dislike($user = null ) {
       return $this->like($user,false);

    } 
    //the next two functions dont work
    public function isLikedBy(User $user){

       return (bool) $user->like->where('post_id', $this->id)->where('likes',true)->count();

    }
    public function isDislikedBy(User $user){

        return (bool) $user->like->where('post_id', $this->id)->where('likes', false )->count();
    }        
}
