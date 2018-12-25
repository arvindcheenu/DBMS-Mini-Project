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
	<title>WTF | Search Movies</title>
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/bebas" type="text/css"/>
	<link href="./css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
.bg-image {
	background-image: url('./img/slide3.jpg');
	background-size: cover;
  	filter: brightness(50%);
  	-webkit-filter: brightness(50%);
  	height: 100%; 
}
.bg-content {
  position: absolute;
  top: 49%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 2;
  width: 100%;
  text-align: center;
}
a {
	color: #F4D03F;
}
a:hover {
	color: goldenrod;
	text-decoration: none;
}
.header-fixed {
    width: 100% 
}

.header-fixed > thead,
.header-fixed > tbody,
.header-fixed > thead > tr,
.header-fixed > tbody > tr,
.header-fixed > thead > tr > th,
.header-fixed > tbody > tr > td {
    display: block;
}

.header-fixed > tbody > tr:after,
.header-fixed > thead > tr:after {
    content: ' ';
    display: block;
    visibility: hidden;
    clear: both;
}

.header-fixed > tbody {
    overflow-y: auto;
    height: 425px;
}

.header-fixed > thead {
	border-top-left-radius: 10px;
	border-top-right-radius: 10px;
}

.header-fixed > tbody > tr > td,
.header-fixed > thead > tr > th {
    width: 25%;
    float: left;
}
.borderless td, .borderless th {
    border: none;
}
</style>
<body class="bg-dark">
<div class="bg-image"></div>
<div class="bg-content">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" style="font-family:'BebasNeueRegular';" href="index.php">WTF.db</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home
        </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="page1.php">Search
		  </a>
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
<div class="container mt-3">
	<br/><br/><br/><br/>
<form action="page1.php" method="POST">
  <div class="input-group">
	<input name="searchInput" style="border-top-left-radius:20px; border-bottom-left-radius:20px" class="form-control" id="myInput" type="text" placeholder="Search..">
	<div class="input-group-append" style="border-radius:none;">
		<div class="input-group mb-3">
		<div class="input-group-prepend">
		<label style="border-radius:0px" class="input-group-text" for="filterSelect">Filter By</label>
		</div>
		<select name="filterSelect" style="border-radius:0px" class="custom-select" id="filterSelect">
		<option selected value="where title like ">Movie Title</option>
		</select>
		</div>
	</div>
	<div class="input-group-append">
		<div class="input-group mb-3">
		<div class="input-group-prepend">
		<label style="border-radius:0px" class="input-group-text" for="sortSelect">Sort By</label>
		</div>
		<select name="sortSelect" style="border-radius:0px" class="custom-select" id="sortSelect">
		<option selected></option>
		<option value="order by title ">Movie Title</option>
		<option value="order by popularity_percentile ">Popularity</option>
		<option value="order by year ">Year of Release</option>
		</select>
		</div>
	</div>
	<div class="input-group-append">
		<div class="input-group mb-3">
		<div class="input-group-prepend">
		<label style="border-radius:0px" class="input-group-text" for="orderSelect">Order By</label>
		</div>
		<select name="orderSelect" style="border-radius:0px" class="custom-select" id="orderSelect">
		<option selected></option>
		<option value="asc">Ascending</option>
		<option value="desc">Descending</option>
		</select>
		</div>
	</div>
  	<div class="input-group-append">
    <button name="submit" type="submit" style="height:38px; border-top-right-radius:20px; border-bottom-right-radius:20px" class="btn btn-success" id="searchbtn">Search Database</button>
    </div>
  </div> 
</form>
  <br>
  <table class="table borderless table-dark table-hover header-fixed bg-dark" style="padding:none; border-radius:10px;">
  <thead style="padding-bottom:-2px;" class="bg-secondary">
      <tr>
        <th>MovieID</th>
        <th>Title of the Movie</th>
		<th>Year of Release</th>
		<th>Popularity</th>
      </tr>
	</thead>
	<?php
		if ($_POST["searchInput"]!=""){
		$input = "\"%".$_POST["searchInput"]."%\"";
		} else { $input = ""; }
		$filterer = $_POST["filterSelect"];
		$sorter = $_POST["sortSelect"];
		$orderer = $_POST["orderSelect"];
		$sql = "select * from movies_metadata ".$filterer.$input.$sorter.$orderer;
		$temp=mysqli_connect("127.0.0.1","root","Bhooma123*","morecDB") or die("connection failed:".mysqli_error());
		$res = mysqli_query($temp,$sql);
		if($res){
			echo '<tbody>';
			while ($row = mysqli_fetch_array($res)) {
			echo '<tr>';
			echo '<td>'.$row["id"].'</td>';
			echo '<td>'.'<a target="_blank" href=https://www.imdb.com/title/tt0'.$row["imdbId"].'/>'.$row["title"].'</a>'.'</td>';
			echo '<td>'.$row["year"].'</td>';
			echo '<td>';
			echo '<div class="progress" style="height: 20px;border-radius:10px">';
			echo '<div class="progress-bar bg-warning progress-bar-striped" style="width:'.$row["popularity_percentile"].'%"><span style="font-weight:bolder;color:#1a1a1a;margin-left:120px">'.$row["popularity_percentile"].'</span></div>';
			echo '</div>';
			echo '</td>';
			echo '<tr>';
			}
			echo '</tbody>';
		}
		mysqli_close($temp);
	?>
  </table>
  </div>
  </div>
<script src="./js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="./js/popper.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script>
</script>
</body>
</html>