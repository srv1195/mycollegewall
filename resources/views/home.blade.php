@extends('homemain')



@section('content')
	
		<div class="row">
			<div class="column col-md-6 ">
				<div class="jumbotron" id="mcw">
					<div class="media">
						<img src="img/cllg.jpg" class="pull-left" style="border-radius: 10px"; width="100%"  />
					</div>
					<h2 style="font-family: Impact, Charcoal, sans-serif; padding: 10 10 0 0px; font-size: 40px"> My College Wall </h2>
					    <p style="font-family: Impact, Charcoal, sans-serif; font-size:15px;"> 
					    	Everything at one place.<br> 
					      	Connect with your college friends on the college social network.
					    </p>
				</div>
		
			</div>

			<div class="column col-md-6">
				<div class="panel panel-default panel-custom">
					<div class="panel-heading"> Registration </div>
					<div class="panel-body">
						<form id="registration-form" role="form" action="#">
					<!--<input type="hidden" name="_token" value="{{ csrf_token() }}">-->
							<div class="form-group">
								<label class="control-label" for="fname">Name:</label>
									<div class="row">
										<div class="column col-md-6 mar-btm">
											<input type="text" class="form-control" id="fname"  name="fname" placeholder="First"/>
										</div>
										<div class=" col-md-6 mar-btm">
											<input type="text" class="form-control" id="lname" name="lname" placeholder="Last"/>
										</div>
						
									</div>
							</div>

							<div class="row">
								<div class="column col-md-6">
									<div class="form-group">
										<label class="control-lable" for="department" > Department: </label>
										<select id="department" name="department" class="form-control">
											<option value="0">---Select---</option>
											<option value="1">computer Science</option>
											<option value="2">Bio medical science</option>
											<option value="3">Instrumentaion</option>	
											<option value="4">Physics</option>
											<option value="5">Polymer science</option>
											<option value="6">Microbiology</option>
											<option value="7">Food technology</option>
											<option value="8">Electronics</option>
										</select>
									</div>
								</div>

								<div class="column col-md-6">
									<div class="form-group">
										<label class="control-label" for="year"> Year: </label>
										<select id="year" name="year" class="form-control">
											<option value="0">---Select---</option>
											<option value="1">First</option>
											<option value="2">Second</option>
											<option value="3">Third</option>
											<option value="4">Fourth</option>
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="column col-md-6">
									<div class="form-group">
										<label class="control-label" for="gender"> Gender: </label>
										<select id="gender" name="gender" class="form-control">
											<option value="0">---Select---</option>
											<option value="1">Male</option>
											<option value="2">Female</option>
											<option value="3">Others</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label" for="username">Username: </label>
										<input class="form-control" type="text" name="username" id="username" placeholder="Username">
									</div>
								</div>	
							</div>

							<div class="row">
								<div class="column col-md-12">
									<div class="form-group">
										<label class="control-label" for="email">E-mail:</label>
										<input type="text" class="form-control" id="email" placeholder="Email Address" name="email"/>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="column col-md-6">
									<div class="form-group">
										<label class="control-label" for="password"> Password:</label>
										<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off">
									</div>
								</div>

								<div class="column col-md-6">
									<div class="form-group">
										<label class="control-label" for="confirmpassword"> Confirm Password:</label>
										<input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Re-enter Password" autocomplete="off">
									</div>
								</div>

							</div>

							<div class="row">
								<div class="column col-md-12">
									<button class=" btn btn-success" id="submit" type="submit" name="submit"> Register </button>
									<div id="test"></div>
								</div>
							</div>



						</form>	

						<!--<div id="confirmation" class="alert alert-success hidden" style="background-color:#137117; border:none;">
							<span class="glyphicon glyphicon-star"></span> 
							<h4>Thank you for registering.</h4>
						</div>         iska no use ab--> 				

					</div>
				</div>
			</div>
			@endsection
		

		@section('jscript')
		$.ajaxSetup({
		headers: 
		{                  
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
		});
	$(document).ready(function(){
				var validator = $("#registration-form").bootstrapValidator({
					live: 'enabled',
					feedbackIcons: {
              			  	valid: 'glyphicon glyphicon-ok',
                			invalid: 'glyphicon glyphicon-remove',
                			validating: 'glyphicon glyphicon-refresh'
            		},
					fields: {
								fname : {
									message: "this field is required",
									validators : {
										notEmpty : {
											message : "this field is required"
										},
									stringLength: { 
										max: 20,
										message: "this field cannot be larger than 20 characters"
									}
								}
							},
							
							lname : {
								message : "This field is required",
								validators : {
									notEmpty : {
										message : "this field is required"
									},
									stringLength: { 
										max: 20,
										message: "this field cannot be larger than 20 characters"
								
									}
								}
							},
							
							department : {
								validators : {
									greaterThan : {
										value : 1,
										message : "choose one department"
									}
								}
							},
							
							year : {
								validators : {
									greaterThan : {
										value : 1,
										message : "select your current year"
									}
								}
							},
							
							gender : {
								validators : {
									greaterThan : {
										value : 1,
										message : "Select one"
									}
								}
							},


							email :{
								message : "Email address is required",
								validators : {
									notEmpty : {
										message : "Please provide an email address"
									}, 
									
									emailAddress: {
										message: "invalid email address"
									}
								}
							},

							password: {
								validators: {
									notEmpty: {
										message: "password is required"
									},

									stringLength: {
										min: 8,
										message : "password must be atleast 8 characters long"
									},

									different : {
										field: "email",
										message: "Email and password can't match"
									}
								}
							},

							confirmpassword:{
								validators: {
									notEmpty: {
										message: "This field is required."
									},

									identical : {
										field: "password",
										message: "password and confirmation must match"
									}
								}

							}

					}

				});

				validator.on('success.form.bv', function(event){
					event.preventDefault();
					$("#loadingdiv").removeClass("hidden");
					
					$.ajax({
					    url: 'register',
					    type: 'POST',
					    data: $("#registration-form").serialize()
					})
					.done(function(result) {
						$("#test").html(result)
						$("#loadingdiv").addClass("hidden"); 
					});

				});
				

			});

			


			


@endsection




