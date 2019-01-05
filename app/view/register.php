<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!---*************welcome this is my simple empty strap by John Niro Yumang ******************* -->

<!DOCTYPE html>
<html lang="en">
	<style type="text/css">
		body {background-color:#eee;}
		.container-fluid {padding:50px;}
		.container{background-color:white;padding:50px;   }
		#title{font-family: 'Lobster', cursive;}
	</style>
	<title>Register and Login to your panel</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<head>	

	<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
		<!---- Font awesom link local ----->
	<script type="text/javascript">
		$(document).ready(function() 
			{
				if ($.cookie('id') != null && $.cookie('user_name') != null) 
				{
					window.location = "user";
				}
			}
		);
		function registerForm()
		{
			var user_name 	= $('#register').find('input[name="user_name"]').val();
			var email 	= $('#register').find('input[name="email"]').val();
			var password 	= $('#register').find('input[name="password"]').val();
			var password2	= $('#register').find('input[name="password2"]').val();
		    $.ajax(
		    {
			  url: "?register",
			  type: "post",
			  data: "user_name="+user_name+"&email="+email+"&password="+password+"&password2="+password2,
			}
			).done(function(data) 
			{
			  alert(data);
			}
			);
		}
		function loginForm()
		{
			var user_name 	= $('#login').find('input[name="user_name"]').val();
			var password 	= $('#login').find('input[name="password"]').val();
		    $.ajax(
		    {
			  url: "?login",
			  type: "post",
			  data: "user_name="+user_name+"&password="+password,
			}
			).done(function(data) 
			{
				if (data == "Ok") 
				{
					window.location = "user";
				}
				else
				{
					alert(data);
				}
			}
			);
		}
	</script>
	</head>
	<body>
	<div class="container-fluid">
		<div class="container">
			<h2 class="text-center" id="title">Online Adhan and notify sound player</h2>
 			<hr>
			<div class="row">
				<div class="col-md-5">
 					<form id="register" method="post" action="?register">
						<fieldset>							
							<p class="text-uppercase pull-center"> SIGN UP.</p>	
 							<div class="form-group">
								<input type="text" name="user_name" class="form-control input-lg" placeholder="user name">
							</div>

							<div class="form-group">
								<input type="email" name="email" class="form-control input-lg" placeholder="Email Address">
							</div>
							<div class="form-group">
								<input type="password" name="password" class="form-control input-lg" placeholder="Password">
							</div>
								<div class="form-group">
								<input type="password" name="password2" class="form-control input-lg" placeholder="Re-Password">
							</div>
 							<div>
								<input type="button" class="btn btn-lg btn-primary" width="50px" height="25px"  value="Register" onclick="registerForm()">
 							</div>
						</fieldset>
					</form>
				</div>
				
				<div class="col-md-2">
					<!-------null------>
				</div>
				
				<div class="col-md-5">
 				 		<form id="login" method="post" action="?login">
						<fieldset>							
							<p class="text-uppercase"> Login using your account: </p>	
 								
							<div class="form-group">
								<input type="text" name="user_name" class="form-control input-lg" placeholder="user name">
							</div>
							<div class="form-group">
								<input type="password" name="password" class="form-control input-lg" placeholder="Password">
							</div>
							<div>
								<input type="button" class="btn btn-md" width="50px" height="25px"  value="login" onclick="loginForm()">
							</div>
								 
 						</fieldset>
				</form>	
				</div>
			</div>
		</div>
		<p class="text-center">
			<small id="passwordHelpInline" class="text-muted"> Developer:<a href="https://github.com/geeksesi/">Mohammad Javad Ghasemy</small>
		</p>
	</div>
	</body>
	 

</html>