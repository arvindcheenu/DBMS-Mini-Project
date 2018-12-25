<?php 
session_start ();
if(!isset($_SESSION["login"]))
	header("location:login.php");
?>
<!-------------------------------BEGIN CODE FOR WATCHLIST----------------------------------------->
<?php
function alert($message){
	echo "<script type='text/javascript'>alert('$message');</script>";
}
$input = $_POST["url"];
$rating = $_POST["rating"];
$add = $_POST["add"];
$remove = $_POST["remove"];
$imdbid = substr($input,30,6);
if (is_numeric($imdbid)) {
	$temp=mysqli_connect("127.0.0.1","root","Bhooma123*","morecDB") or die("connection failed:".mysqli_error());
	$get_query="select id, title, year from movies_metadata where imdbid=".$imdbid;
	$row = mysqli_fetch_array(mysqli_query($temp, $get_query));
	$get_user="select userid from users where username=\"".$_SESSION["login"]."\"";
	$userid = mysqli_fetch_array(mysqli_query($temp, $get_user));
	if (isset($add)){
	$del = "DELETE FROM ratings WHERE userid = ".$userid['userid']." AND movieid =".$row['id'];
	mysqli_query($temp, $del);
	$sql = "INSERT INTO ratings (userId, movieid, rating) VALUES (".$userid['userid'].",".$row['id'].",".$rating.")";
	} else {
	$sql = "DELETE FROM ratings WHERE userid = ".$userid['userid']." AND movieid =".$row['id'];
	}
	if (mysqli_query($temp, $sql)) {
		alert("Records Updated Successfully");
	 } else {
		alert("Error: " . $sql . "" . mysqli_error($conn));
	 }
	mysqli_close($temp);
} else {
	$temp=mysqli_connect("127.0.0.1","root","Bhooma123*","morecDB") or die("connection failed:".mysqli_error());
	$get_query="select id from movies_metadata where title=\"".$input."\"";
	$row = mysqli_fetch_array(mysqli_query($temp, $get_query));
	$get_user="select userid from users where username=\"".$_SESSION["login"]."\"";
	$userid = mysqli_fetch_array(mysqli_query($temp, $get_user));
	if (isset($add)){
	$del = "DELETE FROM ratings WHERE userid = ".$userid['userid']." AND movieid =".$row['id'];
	mysqli_query($temp, $del);
	$sql = "INSERT INTO ratings (userId, movieid, rating) VALUES (".$userid['userid'].",".$row['id'].",".$rating.")";
	} else {
	$sql = "DELETE FROM ratings WHERE userid = ".$userid['userid']." AND movieid =".$row['id'];
	}
	if (mysqli_query($temp, $sql)) {
		alert("Records Updated Successfully");
	 } else {
		alert("Error: " . $sql . "" . mysqli_error($conn));
	 }
	mysqli_close($temp);
}
?>
<!----------------------------------END CODE FOR WATCHLIST----------------------------------------->
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A Simple Movie Recommender Database System.">
    <meta name="author" content="Arvind Srinivasan">
	<title>WTF | My Watchlist</title>
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
  top: 48%;
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
    height: 200px;
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
    <a class="navbar-brand" style="font-family:'BebasNeueRegular';" href="#">WTF.db</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home
        </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="page1.php">Search
		  </a>
        </li>
        <li class="nav-item active">
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
<h2 class="text-right" style="color:white;font-family:'BebasNeueRegular';font-size:4em; margin-top:13%;">MOVIES YOU'VE WATCHED</h2>
	<br/><br/><br/><br/>
  <form action="page2.php" method="POST">
	<div class="input-group">
	<input name="url" style="border-top-left-radius:20px; border-bottom-left-radius:20px" class="form-control" id="myURL" type="text" placeholder="Enter Movie Title to Add.. (or enter IMDB url)">
	<div class="input-group-append">
	<input name="rating" class="form-control" id="myRating" type="text" placeholder="Enter Rating">
	</div>
	<div class="input-group-append">
    <button name="remove" value="remove" class="btn btn-danger" id="searchbtn" type="submit">Remove Movie from Watchlist</button>
    </div>
	<div class="input-group-append">
    <button name="add" value="add" style=" border-top-right-radius:20px; border-bottom-right-radius:20px" class="btn btn-success" id="searchbtn" type="submit">Add Movie to Watchlist</button>
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
		<th>Given Rating</th>
      </tr>
	</thead>
	<?php
		$temp=mysqli_connect("127.0.0.1","root","Bhooma123*","morecDB") or die("connection failed:".mysqli_error());
		$query = "select id, title, year, imdbid, rating from
		(select id, title, year, imdbid from movies_metadata where id in (select movieid from ratings where userid=(select userid from users where username=\"".$_SESSION["login"]."\"))) sub1,
		(select movieid, rating from ratings where userid=(select userid from users where username=\"".$_SESSION["login"]."\")) sub2
		where sub1.id = sub2.movieid;";
		$res = mysqli_query($temp,$query);
		if($res){
			echo '<tbody>';
			while ($row = mysqli_fetch_array($res)) {
			echo '<tr>';
			echo '<td>'.$row["id"].'</td>';
			echo '<td>'.'<a target="_blank" href=https://www.imdb.com/title/tt0'.$row["imdbId"].'/>'.$row["title"].'</a>'.'</td>';
			echo '<td>'.$row["year"].'</td>';
			echo '<td>';
			echo '<div class="progress" style="height: 20px;border-radius:10px">';
			echo '<div class="progress-bar bg-warning progress-bar-striped" style="width:'.$row["rating"]*20 .'%"><span style="font-weight:bolder;color:#1a1a1a">'.$row["rating"].'</span></div>';
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
</body>
</html>