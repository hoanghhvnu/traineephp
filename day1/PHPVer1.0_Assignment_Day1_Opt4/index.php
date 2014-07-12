<?php
	session_start();
	if(isset($_GET['option'])){
		if( isset($_GET['key']));
			$key = $_GET['key'];
			//echo $key;
		
		if($_GET['option'] == 'delete'){
			//echo "delete";
			unset($_SESSION['user'][$key]);
		}
		else if($_GET['option'] == 'update'){
			header("location:updateSinhvien.php");
		}
		
	}

	
	echo "<table border = '1'>";
	echo "<th>userId</th>";
	echo "<th>username</th>";
	echo "<th>email</th>";
	echo "<th>address</th>";
	echo "<th>phone</th>";
	echo "<th>gender</th>";
	echo "<th>Delete</th>";
	echo "<th>Edit</th>";
	
	if(isset($_SESSION['user'])){
		foreach($_SESSION['user'] as $key => $element){
			echo "<tr>";
			echo "<td>" . $element['id'] . "</td>";
			echo "<td>" . $element['name'] . "</td>";
			echo "<td>" . $element['email'] . "</td>";
			echo "<td>" . $element['address'] . "</td>";
			echo "<td>" . $element['phone'] . "</td>";
			echo "<td>" . $element['gender'] . "</td>";
			//echo "<td>" . "<button name = 'delete' value = \"$key\" onclick = \"delete($key)\">Delete</button>" . "</td>";
			echo "<td>" . "<a href = \"index.php?option=delete&key=$key\">Delete</a>" . "</td>";
			echo "<td>" . "<a href = \"updateSinhvien.php?option=update&key=$key\">Update</a>" . "</td>";
			
			echo "</tr>";
		} // end foreach
	}
	echo "</table>";
	//session_destroy();
	function delete($id){
		unset($_SESSION['user'][$id]);
		header('location: listSinhvien.php');
	}
	/*
	echo "<pre>";
	print_r ($_SESSION['user'][0]);
	*/
?>
<a href='addSinhvien.php'>Them Sinh vien</a>