<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
use Request;
use Auth;
use Illuminate\Support\Facades\View;
class PagesController extends Controller{

	public function getHome(){
		$check=Auth::check();
		
		return view('home')->with('check',$check);
	}
	public function getHome1(){
		$user=Auth::user();
		$user_all=User::all();
		$posts=Post::orderBy('created_at','desc')->paginate(5);
		return view('home1')->with('posts',$posts)->with('users',$user_all)->with('user',$user);
	}
	public function test(){
		echo 'hello';
	}

	public function getProfile(){
		$user=Auth::user();
		$posts=Post::where('username',$user->username)->orderBy('created_at','desc')->paginate(5);
		return view('profile')->with('posts',$posts)->with('user',$user);

	}
public function getRandomProfile($user){
		$active_user=Auth::user();
			if($user==$active_user->username)
			{		
					return redirect("profile");
			}
			else
			{
		$users=User::where('username',$user)->get();
		foreach($users as $user1)
		{
			$id=$user1->id;
		}
		$user=User::find($id);
		$posts=Post::where('username',$user->username)->orderBy('created_at','desc')->paginate(5);
		return view('random_profile')->with('posts',$posts)->with('user',$active_user)->with("searched_user",$user);

	}
}

}


?>