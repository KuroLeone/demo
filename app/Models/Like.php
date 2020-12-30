<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
     protected $fillable = ['id',
    					   'post_id',
    					   'user_id'
						   ];
    protected $primarykey = 'id';
    protected $guarded = [];
    public function post(){
        return $this->belongsTo('App\Models\Post');
    }

    public function user(){
    	return $this->belongsTo('App\Model\User');
    }

     public function like(){
        return $this->hasMany('App\Models\Like');
    }

    public function liked($user = null,$liked = true)   {
        $this->likes()->updateOrCreate([
        'user_id' => $user? $user->id : auth()->id(),],[
        'likes' => $liked, ]);

    }          
    public function dislike($user = null ) {
       return $this->like($user,false);

    } 
    //the next three functions dont work
    public function isLikedBy(User $user){

       return (bool) $user->like->where('post_id', $this->id)->where('likes',true)->count();

    }
    public function isDislikedBy(User $user){

        return (bool) $user->like->where('post_id', $this->id)->where('likes', false )->count();
    }   
    public function scopewithlikes(Builder $query)
    {
        $query->leftJoinSub(
            'select post_id, sum(liked) likes ,sum(!liked) dislikes from likes group by post_id',
            'likes',
            'likes.post_id',
            'post_id');
    }    
}
