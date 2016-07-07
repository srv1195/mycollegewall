@if(!(Auth::check()))

<script type="text/javascript">

//alert("hey");
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Your description here">
    <meta name="author" content="Your Name">
    <title> My College Wall </title>
    <link rel="shortcut icon" href="img/favicon.ico" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<link href="css/style1.css" rel="stylesheet" />
	
	
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
    <![endif]-->
</head>
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
                <li id="home" class="active btn-sm"><a href="../"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li id="contact" class="btn-sm"><a href="#" onClick="show_mod()"><span class="glyphicon glyphicon-phone"></span> Contact us</a></li>
                <li id="about" class="btn-sm"><a href="#"><span class="glyphicon glyphicon-book"></span> About </a></li>
            </ul>

        <div class="pull-right" >
        <form class="navbar-form navbar-default navbar-left" role="form" id="login-form" >
        <div class="input-group " >
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-user"></span>
            </span>
            <input type="text" name="username" id="username" class="form-control" placeholder="Username"/>
        </div>
        <div class="input-group">
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-lock"></span>
        </span>
        <input type="password" name="password" class="form-control" placeholder="Password" />
        </div>
        
        <button class="btn btn-success" type="submit" id="login" name="login">login</button>
        <div class="row">
        <div class="col-md-6" id="bad-login"></div>
        <div class="col-md-6" >
            <a href="password/reset">forget your password?</a>

        </div>

        </div>
        

        </form>
        </div>
        </div>
        </div>
    </nav>


        <div class="modal modal fade modal-fullscreen modal-transparent" id="contactmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
      <div class="pull-right"><a href="#" onclick="close_mod()"><span class="glyphicon glyphicon-remove"></span></a></div>
        <h4 style="text-align:center">If you have any problems or query then feel free to contact us at: </h4>
        <h5 style="text-align:center" >alppha@gmail.com</h5>
      </div>
    </div>
  </div>
</div>
<div id="loadingdiv" class="hidden" style="margin:auto; padding: 0px; display: block; position: fixed; right: 0px; top: 0px; width: 100%; height: 100%; background-color: rgb(102, 102, 102); z-index: 30001; opacity: 0.6;">
<p style="position: absolute; top: 50%; left: 50%;">
<img src="img/ajax-loader.gif"/>
</p>
</div>


    <div class="container" style="padding-top: 50px;">

    @yield('content')
    </div>

</body>


<script type="text/javascript">

@yield('jscript')

function show_mod(){
    $('#contactmodal').modal('show');
    $('#home').removeClass('active');
    $('#contact').addClass('active');


}
function close_mod(){
    $('#contactmodal').modal('hide');
    $('#home').addClass('active');
    $('#contact').removeClass('active');
}

$("#login").on("click",function(event){
        
            event.preventDefault();
            $.ajax({
                url: "login",
                type: "POST",
                data: $("#login-form").serialize()
            })
            .done(function(result){
                if(result=='0')
                {
                 window.location.replace('home');
                }

                else if(result=='1'){
                $("#bad-login").html('incorrect username password')  
                }
                else if(result=='2')
                {
                 $("#bad-login").html('both fields required')   
                }
                else
                {
                 $("#bad-login").html('cannot login')   
                }
            });
        });


</script>

</html>

@else 
<script type="text/javascript">
window.location.replace('home');
</script>
@endif



