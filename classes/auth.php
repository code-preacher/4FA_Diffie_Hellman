<?php
include_once 'config.php';
require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Auth extends Config
{

	function __construct()
	{
		parent::__construct();

	}

	public function check1($post)
	{
		$email=$this->sanitize($_POST['email']);
		$password=md5($this->sanitize($_POST['password']));

		//Validate for email and Password
		$query = "SELECT * FROM login WHERE email= '$email' and password='$password'";
		$result = $this->con->query($query);

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$this->setval(1,$row['email']);
			$this->redirect('login2');
		}else{
			$this->redirect('login');
		}

	}


	public function check2($file)
	{
		$img1=$_FILES['img1']['name'];
		$img2=$_FILES['img2']['name'];
		$img3=$_FILES['img3']['name'];

		//Validate for images
		$query = "SELECT * FROM login WHERE image1='$img1' and image2='$img2' and image3='$img3'";
		$result = $this->con->query($query);

		$email = $_SESSION['id'];
		$otp = $this->generateOTP();
		if ($result->num_rows > 0) {
			$query2 = "INSERT INTO otp(user_id,otp_code) VALUES('$email','$otp')";
			$this->con->query($query2);
			$this->sendMail($email,$otp);
			$this->redirect('login3');
		}else{
			$this->redirect('login2_2');
		}

	}


	public function check3($post)
	{
		$otp=$this->sanitize($_POST['otp']);
		$email = $_SESSION['id'];

		//Validate for otp
		$query = "SELECT * FROM otp WHERE user_id= '$email' and otp_code='$otp'";
		$result = $this->con->query($query);

		if ($result->num_rows > 0) {
			$query = "DELETE FROM otp WHERE user_id='$email' and otp_code='$otp'";
			$result2 = $this->con->query($query);

			if ($result2 == true) {
				$system_ip = $_SERVER['REMOTE_ADDR'];
				$device_name = gethostbyaddr($system_ip);
				//Validate for device
				$query = "SELECT * FROM login WHERE email= '$email' and device_name='$device_name'";
				$result3 = $this->con->query($query);

				if ($result3->num_rows > 0) {
					$this->redirect('user');
				}else{
					$this->redirect('login4');
				}
			}else{
				$this->redirect('login3_2');
			}

		}else{
			$this->redirect('login3_2');
		}

	}

	public function getQuestion(){
		$email = $_SESSION['id'];
		$query = "SELECT * FROM login WHERE email = '$email'";
		$result = $this->con->query($query);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			return $row['question'];
		}else{
			return "No found records";
		}
	}

	public function check4($post){

		$answer=$this->sanitize($_POST['answer']);
		$email = $_SESSION['id'];
		$system_ip = $_SERVER['REMOTE_ADDR'];
		$device_name = gethostbyaddr($system_ip);

		//Validate
		$query = "SELECT * FROM login WHERE email='$email' and answer='$answer'";
		$result = $this->con->query($query);

		//Validate for image
		$query2 = "UPDATE login set device_name='$device_name' where email = '$email'";
		$result2 = $this->con->query($query2);


		if ($result->num_rows > 0 && $result2 == true) {
			$row = $result->fetch_assoc();
			$this->setval(3,$row['email']);
			$this->redirect('user');
		}else{
			$this->redirect('login4_2');
		}

	}


	public function adminCheck($post)
	{
		$email=$this->sanitize($_POST['email']);
		$password=md5($this->sanitize($_POST['password']));

		//Validate for email and Password
		$query = "SELECT * FROM login WHERE email= '$email' and password='$password' and role=1";;
		$result = $this->con->query($query);

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$this->setval(1,$row['email']);
			$this->redirect('admin');
		}else{
			$this->redirect('admin_login');
		}

	}


	public function generateOTP(){
		$alphabet = "ABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array();
		$alphaLength = strlen($alphabet) - 1;
		for ($i = 0; $i < 6; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass);

	}

	public function sendMail($email,$otp){

		$mail = new PHPMailer(true);

		try {
			// Server settings
			$mail->isSMTP();
			$mail->Host       = 'smtp.gmail.com';
			$mail->SMTPAuth   = true;
			$mail->Username   = 'isahodohsamuel@gmail.com';
			$mail->Password   = 'olctwcseasjztcqk';
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port       = 587; //465

			// Recipients
			$mail->setFrom('isahodohsamuel@gmail.com', '4FA System');
			$mail->addAddress($email);

			// Content
			$mail->isHTML(true);
			$mail->Subject = 'OTP Verification';
			$mail->Body    = 'Your Otp for verification is '.$otp;

			$mail->send();
			echo 'Email sent successfully.';
		} catch (Exception $e) {
			echo "Mailer Error: {$mail->ErrorInfo}";
		}


	}


	public function setval($login,$id)
	{
		$_SESSION['login'] = $login;
		$_SESSION['id'] = $id;
	}

	public function role($val)
	{
		$value=(int)$val;
		if ($value === 1) {
			$this->redirect('admin');
		} elseif ($value === 2) {
			$this->redirect('supervisor');
		} elseif ($value === 3) {
			$this->redirect('user');
		}else{
			return "invalid role";
		}

	}



	public function redirect($type)
	{
		if ($type === 'user') {
			header("location:user/dashboard.php");
		} else if ($type === 'admin') {
			header("location:admin/dashboard.php");
		}else if ($type === 'supervisor') {
			header("location:supervisor/dashboard.php");
		} elseif ($type === 'login') {
			header("location:login.php?msg=Invalid email or password or data!&type=error");
		} elseif ($type === 'login2') {
			header("location:login2.php?msg=First Stage is correct, verify images below!&type=success");
		}elseif ($type === 'login2_2') {
			header("location:login2.php?msg=Wrong Image Combination,please select the right images, in their right sequence!&type=error");
		}elseif ($type === 'login3') {
			header("location:login3.php?msg=Second Stage is correct, provide otp below!&type=success");
		}elseif ($type === 'login3_2') {
			header("location:login3.php?msg=Incorrect Otp, try again!&type=error");
		}elseif ($type === 'login4') {
			header("location:login4.php?msg=New Device detected!&type=error");
		}elseif ($type === 'login4_2') {
			header("location:login4.php?msg=Incorrect Security Answer!&type=error");
		}elseif ($type === 'admin_login') {
			header("location:admin-login.php?msg=Invalid email or password or You are not an Admin!&type=error");
		}else {
			header("location:login.php?msg=No info found!&type=info");
		}

	}



	public function sanitize($str='')
	{
		#$Data = preg_replace('/[^A-Za-z0-9_-]/', '', $Data); /** Allow Letters/Numbers and _ and - Only */
		$str = htmlentities($str, ENT_QUOTES, 'UTF-8'); /** Add Html Protection */
		$str = stripslashes($str); /** Add Strip Slashes Protection */
		if($str!=''){
			$str=trim($str);
			return mysqli_real_escape_string($this->con,$str);
		}

	}




}
?>
