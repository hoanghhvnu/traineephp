<meta charset="utf-8" />
<style>
    label{
        float: left;
        width: 100px;
    }
    input{
        margin-bottom: 5px;
    }
    .error{
        color:red;
    }
</style>
<?php
	session_start();
    $name = $email = $address = $phone = $gender = "";
	$userinfo = array();
	// generate id
	
	$userinfo['id'] = 0;
	$validInfo = true;
	
    if(isset($_POST['btnok'])){
        if($_POST['txtname'] == "") {
            $errorName = "Vui lòng nhập tên";
			$validInfo = false;
        }else{
            $name = $_POST['txtname'];
			$userinfo['name'] = $name;
        }
        
        if($_POST['txtemail'] == "") {
            $errorEmail = "Vui lòng nhập email";
			$validInfo = false;
		}else{
			
			foreach($_SESSION['user'] as $key => $element){
				//echo "email: " . $element['email'] . "<br/>";
				if($_POST['txtemail'] == $element['email']){
					$errorEmail = "Email đã được sử dụng, vui lòng sử dụng email khác!";
					$validInfo = false;
				} else{
					$email = $_POST['txtemail'];
					$userinfo['email'] = $email;
				}
			}
            
        } // end email validation
        
        if($_POST['txtaddress'] == "") {
            $errorAddress = "Vui lòng nhập address";
			$validInfo = false;
        }else{
            $address = $_POST['txtaddress'];
			$userinfo['address'] = $address;
        }
        
        if($_POST['txtphone'] == "") {
			$validInfo = false;
            $errorPhone = "Vui lòng nhập phone";
        }else if(!is_numeric($_POST['txtphone']) || strlen($_POST['txtphone']) > 11 || strlen($_POST['txtphone']) < 10){
            $errorPhone = "Số điện thoại phải đúng định dạng";
			$validInfo = false;
        }else{
            $phone = $_POST['txtphone'];
			$userinfo['phone'] = $phone;
        }
        
        if(!isset($_POST['gender']) || $_POST['gender'] == ""){
            $errorGender = "Vui lòng chọn giới tính";
			$validInfo = false;
        }else{
            $gender = $_POST['gender'];
			$userinfo['gender'] = $gender;
			
        }
		//$userinfo['id'] = $_SESSION['id'];
		if ($validInfo){
			if (isset($_SESSION['id'])){
				$_SESSION['id'] ++;
		
			}
			else {
				$_SESSION['id'] = 0;
				//echo $_SESSION['id'];
			}
			$userid = $_SESSION['id'];
			$userinfo['id'] = $_SESSION['id'];
			$_SESSION['user'][$userid] = $userinfo;
			header('location:index.php');
		}
		
		/*
		echo "<pre>";
		print_r($_SESSION['user']);
		*/
		//session_destroy();
    } // end isset button submit

?>
<form action="" method="post">
    <label>username</label>
    <input type="text" name="txtname" value="<?php echo $name ? $name : ""; ?>" />
    <span class="error">
        <?php echo isset($errorName) ? $errorName : ""; ?>
    </span>
    <br />
    <label>Email</label>
    <input type="text" name="txtemail" value="<?php echo $email ? $email : ""; ?>" />
    <span class="error">
        <?php echo isset($errorEmail) ? $errorEmail : ""; ?>
    </span>
    <br />
    <label>Address</label>
    <input type="text" name="txtaddress" value="<?php echo $address ? $address : ""; ?>" />
    <span class="error">
        <?php echo isset($errorAddress) ? $errorAddress : ""; ?>
    </span>
    <br />
    <label>Phone</label>
    <input type="text" name="txtphone" value="<?php echo $phone ? $phone : ""; ?>" />
    <span class="error">
        <?php echo isset($errorPhone) ? $errorPhone : ""; ?>
    </span>
    <br />
    <label>Gender</label>
    Male&nbsp;<input type="radio" name="gender" value="1" <?php echo $gender && $gender == 1 ? "checked='checked'" : ""; ?> />
    Famale&nbsp;<input type="radio" name="gender" value="2" <?php echo $gender && $gender == 2 ? "checked='checked'" : ""; ?> />
    <span class="error">
        <?php echo isset($errorGender) ? $errorGender : ""; ?>
    </span>
    <br />
    <label>&nbsp;</label>
    <input type="submit" name="btnok" value="Add" />
</form>
