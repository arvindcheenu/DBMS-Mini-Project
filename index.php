<?php 
session_start ();
if(!isset($_SESSION["login"]))
	header("location:login.php"); 

?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A Simple Movie Recommender Database System.">
    <meta name="author" content="Arvind Srinivasan">
    <title>WTF | Home Page</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/bebas" type="text/css"/>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
.carousel-item {
  height: 100vh;
  min-height: 350px;
  background: no-repeat center center scroll;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style>
<body class="bg-dark">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" style="font-family:'BebasNeueRegular';" href="">WTF.db</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="page1.php">Search</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="page2.php">Watchlist</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="page3.php">Reccomendations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Logout.php">Logout</a>
        </li>
        <li class="nav-item" style="padding-top:8px;">
          <span class="text-white" style="font-size:0.8em;">Logged in as (<?php echo $_SESSION["login"] ?>)</span>
		  </li>
      </ul>
    </div>
  </div>
</nav>
<header>
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <!-- Slide One - Set the background image for this slide in the line below -->
      <div class="carousel-item active" style="background-image: url('http://hdqwalls.com/wallpapers/venom-movie-5k-xr.jpg')">
        <div class="carousel-caption d-none d-md-block">
          <h2 class="display-4">Watch That Flick.</h2>
        </div>
      </div>
      <!-- Slide Two - Set the background image for this slide in the line below -->
      <div class="carousel-item" style="background-image: url('https://images4.alphacoders.com/909/thumb-1920-909185.jpg')">
        <div class="carousel-caption d-none d-md-block">
          <h2 class="display-4">Get Recommended.</h2>
        </div>
      </div>
      <!-- Slide Three - Set the background image for this slide in the line below -->
      <div class="carousel-item" style="background-image: url('https://i.pinimg.com/originals/11/5e/2c/115e2cbc6b31a3bbeeb4d5e68d9920d3.jpg')">
        <div class="carousel-caption d-none d-md-block">
          <h2 class="display-4">Repeat.</h2>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
  </div>
</header>
<script src="./js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="./js/popper.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
</body>
</html>