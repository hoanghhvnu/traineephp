<?php
	$hostname = "localhost";
	$username = "root";
	$userpassword = "";
	$database = "cart";
	$connect = mysql_connect("$hostname","$username","$userpassword");

	//mysql_query("CREATE DATABASE cart");
	mysql_select_db($database, $connect);
?>