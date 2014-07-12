<html>
<head>
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
</head>
<body>
<?php
	session_start();
    $name = $email = $address = $phone = $gender = "";
	$userinfo = array();
	// generate id
	
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
			/*
			foreach($_SESSION['user'] as $key => $element){
				if($_POST['txtemail'] == $element['email']){
					$errorEmail = "Email đã được sử dụng, vui lòng sử dụng email khác!";
				} else{
			*/		$email = $_POST['txtemail'];
					$userinfo['email'] = $email;
				//}
			//}
            
        }
        
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
		
		
		// In thong tin khach hang
		if ($validInfo){
			echo "<label>Fullname: </label>" . $name . "<br/>";
			echo "<label>Email: </label>" . $email . "<br/>";
			echo "<label>Address: </label>" . $address . "<br/>";
			echo "<label>Phone: </label>" . $phone . "<br/>";
			echo "<label>Gender: </label>";
			if ($gender == 1){
				echo "Nam". "<br/>";
			}
			else{
				echo "Nữ". "<br/>";
			}
				
		}
		
		
		// lam viec voi san pham
		$validProduct = false;
		$validAmount = false;
		$validPrice = false;
		if(isset($_POST['product_name'])) {
			$tongtien = 0;
			$pro_name = $_POST['product_name'];
			if ($validInfo){
				echo "<table border = '1'>";
				echo "<th>Tên sản phẩm</th>";
				echo "<th>Số lượng</th>";
				echo "<th>Giá</th>";
				echo "<th>Thành Tiền</th>";
			
				//echo "<pre>";
				//print_r($pro_name);
				foreach($pro_name as $key => $value){
					if ($value != ""){
						$validProduct = true;
						echo "<tr>";
						echo "<td>";
						echo $value;
						echo "</td>";
						if(isset($_POST['product_amount'])){
							$pro_amount = $_POST['product_amount'];
							if ($pro_amount[$key] != 'Số lượng' && is_numeric($pro_amount[$key])){
								$validAmount = true;
								echo "<td>";
								echo $pro_amount[$key];
								echo "</td>";
								if(isset($_POST['product_price'])){
								$pro_price = $_POST['product_price'];
								if($pro_price[$key] != 'Giá' && is_numeric($pro_price[$key])){
									$validPrice = true;
									echo "<td>";
									echo $pro_price[$key];
									echo "</td>";
									
									echo "<td>";
									echo $pro_price[$key]*$pro_amount[$key];
									echo "</td>";
									
									$tongtien += $pro_price[$key]*$pro_amount[$key];
									// In thong tin san pham
									
								}
								else{
									$errorProduct = "Vui lòng nhập giá sản phẩm!";
								}
							}
							} else{
								$errorProduct = "Vui lòng nhập số lượng!";
							}
							
						}
						
						//echo "Ten san pham: " . $value . "<br/>";
					}
					
					
					echo "</tr>";
				}
				
				
				echo "</table>";
				if ($gender == 2){
				$tongtien *=0.75;
				echo "<hr>Bạn là khách hàng nữ nên được giảm 25% hoá đơn.<br/>";
				}
				echo "Tổng số tiền phải thanh toán là: " . $tongtien;
			} // end if valid info
			
		} // end isset product name
		//echo "<tr><td></td><td></td><td></td><td>". $tongtien . "</td></tr>";
		
		if (!$validProduct){
				$errorProduct = "Vui lòng nhập thông tin sản phẩm cần mua!";
			}
		//$userinfo['id'] = $_SESSION['id'];
		
		
		/*
		echo "<pre>";
		print_r($_SESSION['user']);
		*/
		//session_destroy();
    } // end isset button submit

?>
<!-- Thong tin khách hang -->
<hr>
<form action="" method="post">
    <label>Fullname</label>
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
    Famale&nbsp;<input type="radio" name="gender" value="2" <?php echo $gender && $gender == 2 ? "checked='checked'" : ""; ?>/>
    <span class="error">
        <?php echo isset($errorGender) ? $errorGender : ""; ?>
    </span>
    <br />
    <label>&nbsp;</label>
    


<!-- Thong tin đơn hàng -->
<b>NHẬP SẢN PHẨM</b><br>
Product 1 <input type = 'text' name = "product_name[]">
		   <input type = 'text' name = "product_amount[]" value = "Số lượng" size = 10>
		   <input type = 'text' name = "product_price[]" value = "Giá" size = 10>
		   <span class="error">
			<?php echo isset($errorProduct) ? $errorProduct : ""; ?>
			</span></br>
Product 2 <input type = 'text' name = "product_name[]">
		   <input type = 'text' name = "product_amount[]" value = "Số lượng" size = 10>
		   <input type = 'text' name = "product_price[]" value = "Giá" size = 10><br>
		   
Product 3 <input type = 'text' name = "product_name[]">
		   <input type = 'text' name = "product_amount[]" value = "Số lượng" size = 10>
		   <input type = 'text' name = "product_price[]" value = "Giá" size = 10><br>
		   
Product 4 <input type = 'text' name = "product_name[]">
		   <input type = 'text' name = "product_amount[]" value = "Số lượng" size = 10>
		   <input type = 'text' name = "product_price[]" value = "Giá" size = 10><br>
		   
Product 5 <input type = 'text' name = "product_name[]">
		   <input type = 'text' name = "product_amount[]" value = "Số lượng" size = 10>
		   <input type = 'text' name = "product_price[]" value = "Giá" size = 10><br>
		   

<input type="submit" name="btnok" value="Xuất thông tin đơn hàng" />
</form>
</body>
</html>
<?php
// Hoang Huy Hoang
// bai2.php


?>