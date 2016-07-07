@extends('home1main')



@section('content')

		<div class="row">	
			<form id="post-form" role="form" action="#" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="panel panel-default" id="panel">
					<div class="panel-body">
						<textarea rows=3 class="form-control" name="mytext" id="mytext" placeholder="What are you up to?"></textarea>
					</div>
					<div class="panel-footer">
						<div class="fileUpload btn btn-primary">Upload
	    					<span class="glyphicon glyphicon-camera"></span>
	    					<input type="file" class="upload" name="image" />
						</div>
						<button name="post" id="post" type="submit" class="pull-right btn btn-info">Post</button>
					</div>
					<div id="test"></div>
				</div>
			</form>
	</div>

		
	@foreach($posts as $post)
	{{--*/$id=$post->id/*--}}
	<div class="row feed">
		<div class="panel panel-success">
		<div class="panel-heading ">
		<div class="row">
		<div class="col-md-2">
		{{--*/$pics=$users->where('username',$post->username)/*--}}
		@foreach($pics as $pic)
		{{--*/$pic_path=$pic->displaypic/*--}}

		@endforeach

		<img style="margin-left:5px" src="{{$pic_path}}"  class="img-circle profile-pic" style=" max-width:100%; max-height:100%;" width="50" height="50"/>
		</div>
		<div class="col-md-8">
		<div class="row" style="padding:10px"><b><em><a href="#" onclick="user_profile(event);">
		{{ $post->username}}</a></em></b>
		@if ($post->username==$user->username)

		<button class=" btn btn-danger btn-sm pull-right delButton" style="margin-bottom:5px;" type="button" id="delButton" value="{{$id}}" >
						<span class="glyphicon glyphicon-trash"/></button>
						@endif
						<br>
						<em>{{$post->created_at}}</em>
		</div>
		</div>
		</div>
		</div>
                </br>
		
		<div class="panel-body\">
		<div class="row" style="padding:20px;">{{$post->data}}</div>
               @if($post->path!=NULL)
           
		<div class="row" style="padding:20px; overflow:hidden"><a class="pop" onclick="pop('{{$post->path}}');" href="#"><img id="imagesource" class="thumbnail" style=" max-width:100%; max-height:404px; margin:auto;" src="{{$post->path}}"/></a></div>
                  @endif
                 </div>
             
		</div>
		</div>

		
		@endforeach
                        <div class="row text-center" id='posts'>
			{!! str_replace('/?', '?', $posts->render())!!}
		</div>
		
		
		
				@endsection


	
	
	@section('jscript')
	$.ajaxSetup({
		headers: 
		{                  
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
		});
	$(document).ready(function(e){
		
		//e.preventDefault();
		var validator=$("#post-form").bootstrapValidator({
			
			fields: {
				image : {
					validators : {
						file : {
							type :'image/jpeg,image/png,image/gif',
							message:"only image file can be uploaded"
						}
					}
				},
				mytext : {
					validators : {
						notEmpty : {
							message:"please enter something"
						}
					}
				}
			}
			
			
		})		
		.on("success.form.bv",function(e){
			e.preventDefault();

			$("#loadingdiv").removeClass("hidden");
			var formData = new FormData($("#post-form")[0]);
		$.ajax({
			url: "savedata",
			type:"POST",
			 
			data:formData,
			contentType: false,
			processData: false
			
			})
		.done(function(result){
		$("#post-form")[0].reset();
			if(result=='0')
			{
			window.location.replace('home');
			}
			else
			{
			$("#test").html(result)
			}
			$("#loadingdiv").addClass("hidden");

			
			});
		
			
		});
		
	
	});
	$(".profile-pic").on("error",function(){

		$(this).attr("src","profile_pic/default.png")
	});

	function user_profile(event){
			event.preventDefault();

			var user=$(event.target).text();
			alert(user);
			var url='userprofile/'+user;
			window.location.replace(url);
	}
	
	
	
	
	function pop(a)
	{
		//alert(a);
		//alert("hiii");
		
		$('#imagepreview').attr('src',a); // here asign the image to the modal when the user click the enlarge link
   $('#imagemodal').modal('show'); 
	}
			
	@endsection







				