<h3>List Menu</h3>
<script type="text/javascript">
function myFunction() {
   // alert("Bạn có thực sự muốn xoá không?");
}
	
</script>

<?php
	require ("config/connect_db.php");
	session_start();
	$list_par = array();
	$querry_par = "SELECT * FROM par_menu";
	$result = mysql_query($querry_par);
	while($row = mysql_fetch_assoc($result)){
		$list_par[$row['par_id']] = $row['par_name'];
	}
	$_SESSION['list_par']= $list_par;

	//echo "<pre>";
	//print_r($_SESSION['list_par']);

	$list_chil = array();
	$list_chil_id = array();
	$querry_chil = "SELECT * FROM chil_menu";
	$result3 = mysql_query($querry_chil);
	while($row = mysql_fetch_assoc($result3)){
		$list_chil[$row['chil_name']] = $row['par_id'];
		$list_chil_id[$row['chil_name']] = $row['chil_id'];
	}

	$_SESSION['list_chil'] = array_flip($list_chil_id);
	if (isset($list_par) && !empty($list_par)){
		echo "<ul>";
		foreach ($list_par as $key_par => $value_par) {
		//echo "<a href = #>Edit</a>";
		echo "<li>";
		echo "<a  href = deletemenu.php?option=del_par&&par_id=" . $key_par . ">Delete-</a>";
		echo "<a  href = editmenu.php?option=edit_par&par_id=" . $key_par  .">Edit</a>";
		echo $value_par;

		//Kiem tra xem co con hay khong

		$list_menu_con = array();
		foreach ($list_chil as $key_chil => $value_chil) {
			if ($value_chil == $key_par){
				$list_menu_con[] = $key_chil;
			}
		}

		if (!empty($list_menu_con)){
			echo "<ul>";
			//echo "<pre>";
			//print_r($list_menu_con);
			foreach ($list_menu_con as $key => $value) {
				echo "<li>";
				echo "<span><a href = deletemenu.php?option=del_chil&&chil_id=" . $list_chil_id["$value"] . ">Delete-</a></span>";
				echo "<span><a href = editmenu.php?option=edit_chil&chil_id=" . $list_chil_id["$value"]  .">Edit</a>";
				//echo $value;
				echo $value;
				
				echo "</li>";
				
			}
			echo "</ul>";
		}
		
		echo "</li>";
		
		} // end for each list_par

	echo "</ul>";

	
	} // end if ton tai menu
	
?>
<a href = 'insertmenu.php'>Insert Menu</a>