<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	/* ['id',
    					   'caption',
    					   'user_id',
    					   'photo',
						   'likes',
						   'comments'];
						   'username' => $input['username'],
*/
        DB::table('posts')->Insert([[  'caption' => 'mood',
        	    'user_id' => '001',
        		'photo' => 'Images/cloud.jpeg',
        		'likes' => '100',
        		'comments' =>'btr',
        		'created_at' =>date('Y-m-d H:i:s'),
        		'updated_at' =>date('Y-m-d H:i:s')
        		],
        	[  'caption' => 'eat',
        	   'user_id' => '001',
        		'photo' => 'Images/donut.jpeg',
        		'likes' => '100',
        		'comments' =>'wow'
        		,
        		'created_at' =>date('Y-m-d H:i:s'),
        		'updated_at' =>date('Y-m-d H:i:s')
        		],
        	[  'caption' => 'drink',
        	   'user_id' => '001',
        		'photo' => 'Images/coke.jpeg',
        		'likes' => '150',
        		'comments' =>'lol'
        		,
        		'created_at' =>date('Y-m-d H:i:s'),
        		'updated_at' =>date('Y-m-d H:i:s')
        		],
        	[  'caption' => 'view',
        	'user_id' => '001',
        		'photo' => 'Images/window.jpeg',
        		'likes' => '100',
        		'comments' =>'yeah'
        		,
        		'created_at' =>date('Y-m-d H:i:s'),
        		'updated_at' =>date('Y-m-d H:i:s')
        		],
        	]);
    }
}
