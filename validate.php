<?php
	session_start();
	

	function form($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	$msg="";
	$err="";
	if( isset( $_POST['asubmit'] ) ){
		/* validation for Name*/
		if(empty($_POST["uname"])){
			$msg.="Name is required<br>";
		}else{
			$name=form($_POST["uname"]);
			if(!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
			  $msg.= "Only letters and white space allowed in Name<br>";
			}
		}
		// validaiton for email
		if(empty($_POST['uemail'])){
			$msg.="Enter Email<br>";
		}else{
			$email=form($_POST['uemail']);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL )){
			$msg.="Invalid Email Format<br>";
			}
		}
		/* validation for mobile*/
		if(empty($_POST["umobile"])){
			$msg.="Mobile Number is required<br>";
		}else{
			$mobile=form($_POST["umobile"]);
			if(!preg_match("/^[0-9]*$/",$mobile)) {
			  $msg.= "Only Digits allowed in Mobile<br>";
			}
		}
		//validation for gender
		if(empty($_POST['ugen']) ){
			$msg.="Select Gender<br>";
		}else{
			$gender=form($_POST["ugen"]);
		}
		//validation for Date OF birth
		if(empty($_POST["udob"])){
			$msg.="Date of birth is Required<br>";
		}else{
			$date=form($_POST["udob"]);
		}
		// validation for pwd
		if(empty($_POST["upwd"])){
			$msg.="password is required<br>";
		}else{
			$password=form($_POST["upwd"]);
		}
		// validation for address
		if(empty($_POST["uadd"])){
			$msg.="Address is required<br>";
		}else{
			$address=form($_POST["uadd"]);
			if(!preg_match("/^[a-zA-Z-' ]*$/",$address)) {
			  $msg.= "Only letters and white space allowed in address<br>";
			}
		}
		/* validation for pincode*/
		if(empty($_POST["upincode"])){
			$msg.="pincode Number is required<br>";
		}else{
			$pincode=form($_POST["upincode"]);
			if(!preg_match("/^[0-9]*$/",$pincode)) {
			  $msg.= "Only  Digits allowed in pincode<br>";
			}
			$pin=strlen($pincode);
			if($pin!=6) {
				$msg.="Only 6 digit number is required in pincode<br>";
			}	
		}
		/* validation for pancard*/
		if(empty($_POST["upancard"])){
			$msg.="pancard Number is required<br>";
		}else{
			$pancard=form($_POST["upancard"]);
			if(!preg_match("/^[0-9]*$/",$pincode)) {
			  $msg.= "Only  Digits allowed in pancard<br>";
			}
			$pan=strlen($pancard);
			if($pan!=8) {
				$msg.="Only 8 digit number is required pancard <br>";
			}	
		}
		/* validation for adhar*/
		if(empty($_POST["uadhar"])){
			$msg.="Adhar Number is required<br>";
		}else{
			$adhar=form($_POST["uadhar"]);
			if(!preg_match("/^[0-9]*$/",$adhar)) {
			  $msg.= "Only  Digits allowed in adhar<br>";
			}
			$adh=strlen($adhar);
			if($adh!=8) {
				$msg.="Only 8 digit number is required in adhar <br>";
			}	
		}
		
		/* validation for bank name*/
		if(empty($_POST["ubankname"])){
			$msg.="Bank name is required<br>";
		}else{
			$bankname=form($_POST["ubankname"]);
			if(!preg_match("/^[a-zA-Z-' ]*$/",$bankname)) {
			  $msg.= "Only letters and white space allowed in bankname<br>";
			}
		}
		
		/* validation for account number*/
		if(empty($_POST["uaccount"])){
			$msg.="Account Number is required<br>";
		}else{
			$account=form($_POST["uaccount"]);
			if(!preg_match("/^[0-9]*$/",$account)) {
			  $msg.= "Only  Digits allowed in account<br>";
			}
			$acc=strlen($account);
			if($acc!=8) {
				$msg.="Only 8 digit number is required account <br>";
			}
		}
		/* validation for Ifsc code*/
		if(empty($_POST["uifsc"])){
			$msg.="Ifsc code is required<br>";
		}else{
			$Ifsc=form($_POST["uifsc"]);
			$ifs=strlen($Ifsc);
			if($ifs!=8) {
				$msg.="Only 8 digit number is required ifsc <br>";
			}	
		}
		/* validation for Account Type*/
		if(empty($_POST["uactype"])){
			$msg.="Select Account Type";
		}else{
			$actype=form($_POST["uactype"]);	
		}
		if($msg==""){
			$dor=date('Y-m-d');
			$con=mysqli_connect('localhost','root','','Bank');
			$sql= "INSERT INTO `uacc` (`uname`, `uemail`, `umobile`, `ugender`, `udate`, `pwd`, `uaddress`, `upincode`, `upancard`, `uadhar`, `ubank`, `uaccount`, `uifsc`,`uactype`,`udor`) VALUES ('$name', '$email', '$mobile', '$gender', '$date', '$password', '$address', '$pincode', '$pancard', '$adhar', '$bankname', '$account', '$Ifsc','$actype','$dor')";
			if(mysqli_query($con,$sql) ){
				echo " successfull";
			}else{
				echo "Error: ".$sql."<br>".mysqli_error($con);
			}
		}	
	}

	
	
	if(isset($_POST['lgbtn'])) {
		if(empty($_POST["uaccount"])) {
				$err .= "Account Number is required<br>";
		} else {
				$account = form($_POST["uaccount"]);
				if(!preg_match("/^[0-9]*$/", $account)) {
							$err .= "Only Digits allowed in Mobile<br>";
					}
				}
			
			if(empty($_POST["pwd"])) {
					$err .= "Password is required<br>";
			} else {
					$password = form($_POST["pwd"]);
			}

			if($err == "") {
					$con = mysqli_connect('localhost', 'root', '', 'Bank');

					if(!$con) {
							die("Connection failed: " . mysqli_connect_error());
					}

					$sql = "SELECT * FROM uacc WHERE uaccount=? AND pwd=?";
					$stmt = mysqli_stmt_init($con);

					if(mysqli_stmt_prepare($stmt, $sql)) {
							mysqli_stmt_bind_param($stmt, "ss", $account, $password);
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);

							if(mysqli_num_rows($result) == 1) {
									$row = mysqli_fetch_assoc($result);
									$_SESSION['uaccount'] = $row['uaccount'];
									header('location: user_login.php');
									exit();
							} else {
									$err .= "Invalid Account No/Password";
							}
					} else {
							$err .= "Error: Unable to prepare SQL statement";
					}

					mysqli_stmt_close($stmt);
					mysqli_close($con);
			}
	}

	
?>
