<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

        protected $fillable = [ 'id',
    					   		'user_id',
    					   		'follower_id'];

    	protected $primarykey = 'id';

    	
    public function user(){
    	return $this->belongsTo('App\Model\User');
    }
}
