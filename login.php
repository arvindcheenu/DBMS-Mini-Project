<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A Simple Movie Recommender Database System.">
    <meta name="author" content="Arvind Srinivasan">
	<title>WTF | Login</title>
    <!-- Bootstrap core CSS -->
	<link href="./css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/bebas" type="text/css"/>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<style>
@import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
body {
	text-align: left;
	align: left;
}
.login-block{
background-image:url('/img/slide3.jpg');
background-size: cover;
width:100%;
position: relative;
left: 30%;
top: 20%;
}
</style>
<body class="login-block">
    <div class="card bg-dark card-dark" style="border-radius:20px;">
	<div class="row card-body">
	<br/>
	<div class="col-md-4">
	<h2 class="text-left" style="color:white;font-family:'BebasNeueRegular';font-size:4em; margin-top:20px;">WTF<span class="text-primary">.db</span></h2>
	<h5 class="text-left" style="color:white;">A Movie Reccomender that infers from your unique taste.</h5>
	<br/>
	<form class="login-form" action="loginprocess.php" method="POST">
  <div class="form-group">
    <input type="text" required name="uname" class="form-control" placeholder="Enter Username">
  </div>
  <div class="form-group">
    <input type="password" required name="upassword" class="form-control" placeholder="Enter Password">
  </div>
  <button type="submit" name="sub" class="btn btn-block btn-primary">Login</button>
  </div>
  <div class="col-md-4">
	<h2 class="text-right" style="color:white;font-family:'BebasNeueRegular';font-size:4em; margin-top:20px;">Watch.<br/>Get Reccomended.<br/>Repeat.</h2>
	</div>
</form>
<?php 
if(isset($_REQUEST["err"]))
	$msg="Invalid username or Password";
?>
<p style="color:red;">
<?php if(isset($msg))
{
	
echo $msg;
}
?>
</div>
</div>	       
</div>
</div>
</div>
</body>



