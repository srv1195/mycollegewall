

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Your description here">
    <meta name="author" content="Your Name">
    <title>My College Wall</title>
    <link rel="shortcut icon" href="img/favicon.ico" />


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <link href="css/basic-template.css" rel="stylesheet" />
	<link href="css/style1.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" type="text/css" href="/css/fileButton.css">	

	
	
	<!-- BootstrapValidator CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css" rel="stylesheet"/>
	
    <!-- jQuery and Bootstrap JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-rc1/jquery.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js" type="text/javascript"></script>
		
	<!-- BootstrapValidator -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js" type="text/javascript"></script>
	
		
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]--></head>
<body>
		<body>
	<nav class="nav navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-container">
					<span class="sr-only">Show and Hide the Navigation </span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="home">
					<li style="font-family: Impact, Charcoal, sans-serif;font-size: 25px; padding: 0 10 0 10px;">My College Wall</li>
				</a>
			</div>
			<div class="collapse navbar-collapse" id="navbar-container">
				<ul class="nav navbar-nav nav-pills">
					<li id="home" class="active btn-sm"><a href="{{asset('home')}}"><span class="glyphicon glyphicon-home"></span> Home</a></li>
					<li id="profile" class="btn-sm"><a href="{{asset('profile')}}"><span class="glyphicon glyphicon-user"></span> Hello {{$user->username}}</a></li>
					<li class="btn-sm"><a href="#" ">Confessions</a></li>
					<li class="btn-sm"><a href="logout">Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>

	
	<!--modal-->
	<div class="modal modal fade modal-fullscreen modal-transparent" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <img src="" id="imagepreview" style="width: 100%; height: 100%;" />
      </div>
    </div>
  </div>
</div>
	<div id="loadingdiv" class="hidden" style="margin:auto; padding: 0px; display: block; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.6;">
<p style="position: absolute; top: 50%; left: 50%;">
<img src="img/ajax-loader.gif"/>
</p>
</div>


	<div class="container" style=" margin-top:60px">

	<div class="row">
	<div class="col-md-7 col-md-offset-2">

	@yield('content')
	</div>
	<div class="col-md-3">
	<div id="test">
		<button id="new">new post</button>
	</div>
		
	</div>
	</div>
	</div>
	<script type="text/javascript">

$("#new").on("click",function(e){
e.preventDefault();
$.ajax({

	url: "http://quotesondesign.com/wp-json/posts?filter[orderby]=rand&filter[posts_per_page]=1",
	type: "GET",
	dataType:'json'

})
.done(function(result){
		alert("hello");
});

});

@yield('jscript')





$(".delButton").on("click",function(event){
						event.preventDefault();
						$("#loadingdiv").removeClass("hidden");
						var el=$(this);
				var id=$(this).val();
				
				$.ajax({
				url:'delete/'+id,
				type:'DELETE',
				data: { "_token": "{{ csrf_token() }}" }

				})
			.done(function(result){

				/*if(window.location.href.indexOf("home") > -1)
				{
					window.location.replace('home');
		}
			else if(window.location.href.indexOf("profile") > -1)
			{
				window.location.replace('profile');
			}
			*/
			//alert($(this).parent(".feed").val());
			el.parents(".feed").fadeOut("slow",function(){
				this.remove();
			});

			$("#loadingdiv").addClass("hidden");


			});

				
	});
function pop(a)
	{
		//alert(a);
		//alert("hiii");
		
		$('#imagepreview').attr('src',a); // here asign the image to the modal when the user click the enlarge link
   $('#imagemodal').modal('show'); 
	}
</script>
</body>
</html>