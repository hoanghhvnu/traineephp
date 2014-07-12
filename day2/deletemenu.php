<script type="text/javascript">
	alert("Bạn có thực sự muốn xoá không?");
</script>

<?php
	require ("config/connect_db.php");
	$optiondel = $_GET['option'];
	if($optiondel == 'del_chil'){
		$del_id = $_GET['chil_id'];
		//echo "del_chil" . $del_id;
		$sqldel = "DELETE FROM chil_menu
					WHERE chil_id = '" . $del_id . "'";
		//echo $sqldel;
		mysql_query($sqldel);
		header('location:index.php');
	} else if ($optiondel == 'del_par'){
		$del_id = $_GET['par_id'];
		//echo "del_par" . $del_id;
		$sqldel = "DELETE FROM chil_menu
					WHERE par_id = '" . $del_id . "'";
		mysql_query($sqldel);

		$sqldel = "DELETE FROM par_menu
					WHERE par_id = '" . $del_id . "'";
		mysql_query($sqldel);

		header('location:index.php');
	}
	
?>