<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use File;

use App\Http\Requests;
use App\Post;
use Auth;

class PostController extends Controller
{
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     
     */


    public function store(Request $request)
    {


        if(isset($_POST["mytext"])&& !empty($_POST["mytext"]))
        {
        $Text=$_POST["mytext"];

        $User=Auth::user();
        $post1=new Post;
        $post1->username=$User->username;
        $post1->email=$User->email;
        $post1->data=$Text;
        if(Input::hasFile('image'))
        {
        $image=Input::file('image');
        $image_name=time().$image->getClientOriginalName();
            $image->move('uploads',$image_name);
            $post1->path='uploads/'.$image_name;
            $post1->save();
            echo '0';

            }
            else
            {
                $post1->save();
                echo '0';
            }
        
    }
    else
    {
        echo "enter something first";
    }



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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $post=Post::find($id);
        $image=$post->path;
        $post->delete();
        if($image!=NULL)
        File::delete($image);



    
    
        //
    }
}
