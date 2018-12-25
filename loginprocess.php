<?php
session_start ();
$cser=mysqli_connect("127.0.0.1","root","Bhooma123*","morecDB") or die("connection failed:".mysqli_error());

if(isset($_REQUEST['sub']))
{
$a = $_REQUEST['uname'];
$b = $_REQUEST['upassword'];

$res = mysqli_query($cser,"select* from users where username='$a'and password='$b'");
$result=mysqli_fetch_array($res);
if($result)
{
	
	$_SESSION["login"]=$a;
	header("location:index.php");
}
else	
{
	header("location:login.php?err=1");
	
}
}
?>