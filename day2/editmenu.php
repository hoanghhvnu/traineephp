<head>
	<style>
    label{
        float: left;
        width: 100px;
    }
    input{
        margin-bottom: 5px;
    }
    select{
        margin-bottom: 5px;
    }
    .error{
        color:red;
    }
</style>
</head>
<?php
require ("config/connect_db.php");
session_start();
//echo "<pre>";
	//print_r($_SESSION['list_chil']);
	$available  = true;
	$optionedit = $_GET['option'];
	$ok = "";
	$edit_id = ($optionedit == 'edit_chil') ? $_GET['chil_id'] : $_GET['par_id'];
	$edit_value = ($optionedit == 'edit_chil') ? $_SESSION['list_chil']["$edit_id"]  : $_SESSION['list_par']["$edit_id"];
	$notavailable = array();
	foreach ($_SESSION['list_chil'] as $key => $value) {
		if ($value != $edit_value){
			$notavailable[] = $value;
		}
	}

	foreach ($_SESSION['list_par'] as $key => $value) {
		if ($value != $edit_value){
			$notavailable[] = $value;
		}
	}

	//$edit_value = $_SESSION["$listcheck"];
	if (isset($_POST['menuname']) && $_POST['menuname'] != ""){
		$ok = $_POST['menuname'];
		$available = !in_array($ok,$notavailable);
		if ($available){
			if($optionedit == 'edit_chil'){
				$sql = "UPDATE chil_menu SET chil_name = '" .$ok. "' WHERE chil_id = '". $edit_id . "'";
				//echo $sql;
			} else if($optionedit == 'edit_par'){
				$sql = "UPDATE par_menu SET par_name = '" .$ok. "' WHERE par_id = '". $edit_id . "'";
			}
			mysql_query($sql);
			header('location:index.php');
		} else{
			$errEdit = "Tên này đã tồn tại, vui lòng nhập tên khác!";
		}
			
	}

?>
<form action="" method="post" id = 'menuform'>
    <label>Menu name</label>
    <input type="text" name="menuname" value="<?php echo $available ? $edit_value : $ok ; ?>" />
    <span class="error">
        <?php  echo isset($errEdit) ? $errEdit : ""; ?>
    </span>
    <br/>
     <input type = "submit"/>
</form>