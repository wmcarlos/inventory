<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['pass']);
unset($_SESSION['type']);
$d = $_GET["desde"];
$l = $_GET["logro"];
if($d == "cambio" and $l == "si"){
	header("location: ../index.php?valido=si");
}else{
	header("location: ../index.php");
}
?>