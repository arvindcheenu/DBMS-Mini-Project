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
	<title>WTF | My Reccomendations</title>
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/bebas" type="text/css"/>
	<link href="./css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="./slick/slick-theme.css"/>
</head>
<style>
  .slick-slide {
	margin: 0 29px;
  }
  /* the parent */
  .slick-list {
    margin: 0 -29px;
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
        <li class="nav-item">
          <a class="nav-link" href="page2.php">Watchlist</a>
        </li>
        <li class="nav-item active">
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
<div class="container mt-5" style="padding-top:50px;">
<h2 class="text-left" style="color:white;font-family:'BebasNeueRegular';font-size:3em;"><span class="text-warning">GENRES</span> YOU MAY <span class="text-warning">♥</span></h2>
<div class="row">
<div class="col-sm-12" style="height:131px;width:233px;">
	<div class="slider center">
		<?php
		$temp=mysqli_connect("127.0.0.1","root","Bhooma123*","morecDB") or die("connection failed:".mysqli_error());
		$query = "with top_10_genres_you_may_like as (select genre_extract.title, count(title) as count from (with movie_genre_user as(select * from movie_genre where movieid in (select id from movies_metadata where id in (select movieid from ratings where userid=(select userid from users where username=\"".$_SESSION['login']."\")))) select movieid, genres.title from movie_genre_user, genres where genres.id=movie_genre_user.genreid) genre_extract group by title order by count desc limit 10) select title from top_10_genres_you_may_like";
		$res = mysqli_query($temp,$query);
		if($res){
			while ($row = mysqli_fetch_array($res)) {
				echo "<div class=\"card\" style=\"height:100%;box-shadow: 0px 0px 40px;border-radius:80px;background-image:url(./img/genres/".$row['title'].".jpg)\"></div>";
			}
		}
		?>
	</div>
	</div>
	</div>
	<div class="row mt-4">
	<h2 class="text-left" style="color:white;font-family:'BebasNeueRegular';font-size:3em;"><span class="text-warning">TOPICS</span> YOU MAY <span class="text-warning">♥</span></h2>
	</div>
	<?php
		$temp=mysqli_connect("127.0.0.1","root","Bhooma123*","morecDB") or die("connection failed:".mysqli_error());
		$query = "with tag_list as (select distinct tag from tags where movieid in (select id from movies_metadata where id in (select movieid from ratings where userid=(select userid from users where username=\"".$_SESSION['login']."\")))) select tag from tags where tag in (select tag from tag_list) group by tag order by count(movieid) desc limit 10";
		$res = mysqli_query($temp,$query);
		if($res){
			while ($row = mysqli_fetch_array($res)) {
				echo "<span class=\"badge badge-pill badge-warning\" style=\"font-size:1em;\"># ".$row['tag']."</span>&nbsp;&nbsp;";
			}
		}
		?>
<br/><br/>
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
		$temp=mysqli_connect("127.0.0.1","root","Bhooma123*","morecDB") or die("connection failed:".mysqli_error());
		$query = "select * from movies_metadata where id in (select movieid from (select movieid from tags where movieid not in (select movieid from ratings where userid=(select userid from users where username=\"".$_SESSION['login']."\")) and tag in (select tag from (with tag_list as (select distinct tag from tags where movieid in (select id from movies_metadata where id in (select movieid from ratings where userid=(select userid from users where username=\"".$_SESSION['login']."\")))) select tag from tags where tag in (select tag from tag_list) group by tag order by count(movieid) desc limit 10)tag_list) limit 20) movielist)";
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
<script src="./js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script type="text/javascript" src="./slick/slick.min.js"></script>
<script src="./js/popper.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script type="text/javascript">
$('.center').slick({
  centerMode: false,
  centerPadding: '60px',
  slidesToShow: 4,
  autoplay: true,
  dots: true,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 3
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
});
</script>
</body>
</html>