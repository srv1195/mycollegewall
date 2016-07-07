@extends('home1main')

@section('content')

<div class="row jumbotron" style="padding:20px" >
	
	<div class="col-md-4">
	<div class="row" id="profile_img">
	<img style="margin-left:20px" src="{{$user->displaypic}}" onError="pic_error()" id="profile-pic" class="img-circle profile-pic" style=" max-width:100%; max-height:100%;" width="180" height="180"/>
	</div>
	<form id="pic-form" role="form" enctype="multipart/form-data" action="#">
<div class="row">
	
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="fileUpload btn-xs btn btn-primary">Upload
	    					<span class="glyphicon glyphicon-camera"></span>
	    					<input type="file" class="upload" name="pic" id="pic"/>
						</div>
						<button name="post" id="post" type="submit" class="pull-right btn-xs btn-info">update</button></div>
						</form>
	</div>
	<div class="col-md-7 col-md-offset-1">
	
	<div id="profile-details">
	<div id="user-details" >
	<em><h3>{{$user->fname}} {{$user->lname}}</h3></em>
	<h5>{{$user->username}}</h5>
	<h5>{{$user->email}}</h5>
	<br>
	</div>
	</div>
	<button id="update-button" class="btn btn-sm btn-success "><span class="glyphicon glyphicon-cog"></span> Update Profile</button>
	
	
	
	
	
	
	<div id="profile-settings" class="hidden" style="padding:10px;">
	<div class="panel panel-success">
	<div class="panel-heading">
	<button id="back-button" class="btn btn-success btn-sm">	
	<span class="glyphicon glyphicon-arrow-left"></span> Back</button>
		<p style="text-align:center;">Update Profile</p>
	</div>
	<form id="update-profile" role="form" >
	<div class="panel-body">
	
		<div class="form-group">
			<label class="control-label">Name</label>
			<div class="row">
				<div class="col-sm-6"><input type="text" name="fname" placeholder="fname" class="form-control"></div>
				<div class="col-sm-6">
				<input type="text" name="lname" placeholder="lname" class="form-control">
				</div>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label">date of birth</label>
					
					<input type="date" name="dob" class="form-control">
				
					</div>
					<div class="form-group">
					<label class="control-label">Contact no.</label>
				
				<input type="number" name="contact" placeholder="10-digit" class="form-control">
				
			</div>
			</div>
		
		<div class="panel-footer">
			<button id="save-profile" type="submit" class="btn btn-success btn-sm">Update info</button>		
		</div>


	</form>
	</div>
	</div>
	</div>
</div>
@foreach($posts as $post)
	{{--*/$pid=$post->id/*--}}
	<div class="row feed" >
		<div class="panel panel-default">
		<div class="panel-heading">
		<div class="row">
		<div class="col-md-2">

		<img style="margin-left:5px" src="{{$user->displaypic}}"  class="img-circle profile-pic" style=" max-width:100%; max-height:100%;" width="50" height="50"/>
		</div>
		<div class="col-md-8">
		<div class="row" style="padding:10px"><b><em>
		{{ $post->username}}</em></b>

		<button class=" btn btn-danger btn-sm pull-right delButton" style="margin-bottom:5px;" type="button" id="delButton"value="{{$pid}}" >
						<span class="glyphicon glyphicon-trash"/></button>
						
						<br>
						<em>{{$post->created_at}}</em>
		</div>
		</div>
		</div>
		</div>
		
		<div class="panel-body\">
		<div class="row" style="padding:20px;">{{$post->data}}</div>
                 @if($post->path!=NULL)
		<div class="row" style="padding:20px; overflow:hidden"><a class="pop" onclick="pop('{{$post->path}}');" href="#"><img id="imagesource" class="thumbnail" style=" max-width:100%; max-height:404px;" src="{{$post->path}}"/></a></div>
		@endif
                 </div>
		</div>
		</div>

		
		@endforeach
		<div class="row text-center" id='posts'>
			{!!str_replace('/?', '?', $posts->render());!!}
		</div>

@endsection

@section('jscript')

$.ajaxSetup({
		headers: 
		{                  
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
		});
	$(document).ready(
	function(e){
		
		//e.preventDefault();
		var validator=$("#pic-form").bootstrapValidator({
			
			fields: {

				pic : {
					validators : {
						file : {
							type :'image/jpeg,image/png,image/gif',
							message:'only image file can be uploaded'
						},
						notEmpty : {
							message:'upload some image first'
						}
					}
				}
				
					
				}
			
		})		
		.on("success.form.bv",function(e){
			e.preventDefault();
			$("#loadingdiv").removeClass("hidden");
			var id={{$user->id}};
			var formData = new FormData($("#pic-form")[0]);

		$.ajax({
			url: "updatepic/"+id,
			type:"POST",
			 
			data:formData,
			contentType: false,
			processData: false
			
			})
		.done(function(result){
		if(result==0)
		
			$("#profile_img").load(window.location + " #profile-pic");			
			});
			$("#loadingdiv").addClass("hidden");
		
			
		});
		
	
	});


$(document).ready(function(){
	$("#home").removeClass("active");
	$("#profile").addClass("active");
});


$(".profile-pic").on("error",function(){

		$(this).attr("src","profile_pic/default.png")
	});
	function pic_error(){
	$("#profile-pic").attr("src","profile_pic/default.png")
	}

$("#update-button").on("click",function(e){
	e.preventDefault();
	$(this).addClass("hidden");
	$("#user-details").addClass("hidden");
	$("#profile-settings").removeClass("hidden");

});

$("#back-button").on("click",function(e){
	e.preventDefault();
	$("#update-button").removeClass("hidden");
	$("#user-details").removeClass("hidden");
	$("#profile-settings").addClass("hidden");

});	




$(document).ready(function(e){
		
		//e.preventDefault();
		var validator1=$("#update-profile").bootstrapValidator({
			
			fields: {

				contact : {
					validators : {
						phone : {
							country: 'US',
							message:'enter a 10 dig mobile number'
						}
					}
				},
				dob : {

					validators : {
						date : {
							format: 'DD/MM/YYYY',
							max : '2001-01-01',
							message : 'enter correct date of birth'
						}

						}
					}
				}
				
					
				
			
		})		
		.on("success.form.bv",function(e){

			e.preventDefault();
			//$("#loadingdiv").removeClass("hidden");
			$.ajax({
				url: "updateprofile",
				type:"POST",
				
				data: $("#update-profile").serialize()
			})
			.done(function(result){
				if(result==0)
				{
	$("#profile-details").load(window.location + " #user-details");
	$("#profile-settings").addClass("hidden");
	$("#update-button").removeClass("hidden");
				}			
			});
			
		});
		
	
	});




@endsection