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
	$menuname = isset($_POST['menuname']) ? $_POST['menuname'] : "";
	$menutype = isset($_POST['menutype']) ? $_POST['menutype'] : "";
	//echo $menuname;
	$list_chil = array();
	$list_par = array();
	//$list_par_id = array();
	$errPar = $errChil = $errType = "";

	$validInput = true;
	$validName = true;

	if ( !isset($_POST['menutype']) || ($_POST['menutype'] == "") ){
		$errType = "Vui lòng chọn loại Menu!";
		$validInput = false;
	}

	if (!isset($_POST['menuname']) || ($_POST['menuname'] == "")){
		$errName = "Vui lòng nhập tên menu!";
		$validInput = false;
	}

	if ($validInput){
		// Xu ly khi chon menu Cha
		$querry_par = "SELECT * FROM par_menu";
		$result1 = mysql_query($querry_par);
		while($row = mysql_fetch_assoc($result1)){
			$list_par[$row['par_id']] = $row['par_name'];
			//$list_par_id[] = $row['par_id'];
		}

		// Kiem tra danh sach menu con
		$querry_chil = "SELECT * FROM chil_menu";
		$result2 = mysql_query($querry_chil);
		while($row = mysql_fetch_assoc($result2)){
			$list_chil[$row['chil_id']] = $row['chil_name'];
			//$list_par_id[] = $row['par_id'];
		}



		// Kiem tra ten menu dax ton tai chua
		if (!in_array($menuname, $list_par) && !in_array($menuname, $list_chil)){
			if ($menutype == 'par'){
				$insertpar = "INSERT INTO par_menu (par_name) VALUES ('". $menuname . "')";
				mysql_query($insertpar);
				//echo $insertpar;
				header("location: index.php");
			} else if ($menutype == "chil" && isset($_POST['select_par_id'])){
				$select_par_id = $_POST['select_par_id'];
				$insertchil = "INSERT INTO chil_menu(chil_name,par_id) VALUES ('". $menuname . "','". $select_par_id ."')";
				//echo $insertchil;
				mysql_query($insertchil);
				header("location: index.php");
			}
		} else{
			$validName = false;
			$errName = "Tên menu đã tồn tại, vui lòng nhập tên khác!";
		}
	
		

		
		
	} // end if $validInput


	

	

?>
<form action="" method="post" id = 'menuform'>
    <label>Menu name</label>
    <input type="text" name="menuname" value="<?php echo $menuname; ?>" />
    <span class="error">
        <?php echo isset($errName) ? $errName : ""; ?>
    </span>
    <br/>
    <label>Menu type</label>
    <?php echo ($menutype != 'chil') ? "<span>Cha</span><input type = \"radio\" name = \"menutype\" value = \"par\" />"  : "";?>
    <span>Con</span><input type = "radio" name = "menutype" value = "chil" <?php if ($menutype == 'chil') echo "checked"; ?>/>
    <span class="error">
        <?php echo isset($errType) ? $errType : ""; ?>
    </span>
    <br/>
    <?php
    	if ($menutype == 'chil' && !empty($list_par) && $validName){
    		echo "<label>Choose parent</label>";
    		echo "<select name = 'select_par_id' form = 'menuform'>";
    		foreach ($list_par as $key => $value) {
    			echo "<option value=" . $key . ">" . $value . "</option>";
    		}
    		
    		echo "</select>";
    	}
    ?>
    <input type = "submit"/>

    
</form>
