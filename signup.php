<?php
	include("classes/connect.php");
	include("classes/signup.php");

	$first_name = "";
	$last_name = "";
	$gender = "";
	$email = "";

	if($_SERVER['REQUEST_METHOD'] =='POST')
	{

		$signup = new Signup();
		$result = $signup->evaluate($_POST);

		if($result !="")
		{
			echo"<div style='text-align:center;font-size: 12px; color:white;background-color:grey;'>";
			echo "The following errors occured<br>";
			echo $result;
			echo"</div>";
		} else
		{
			header("Location: login.php");
			//die;
		}

		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$gender = $_POST['gender'];
		$email = $_POST['email'];

    }


?>


<html>
	<head>
		<title>Petbook | Login </title>
	</head>

	<style>
		#bar{
			height:82px;
			background-image: linear-gradient(rgba(0, 0, 0, 0.233), rgba(0, 0, 0, 0.3)), url('bar.jpg');background-size: 800px; background-position: center;
			color: #33163c;
			font-size: 50px;
			font-weight:bold;
		}

		#signup_button{
			background-color:#c4c0bf;
			font-size: 20px;
			text-align: center;
			margin-top: -55px;
			margin-right: 10px;
			width: 70px;
			padding:7px;
			float:right;
			font-weight:bold;
			border-radius: 10px;

		}
		#bar2{
			background-color: linear-gradient(rgb(241, 201, 252), rgb(241, 201, 252));
			font-size: 40px;
			width: 800px;
			height: 170px;
			margin:auto;
			margin-top: 1px;
			padding: 6px;
			text-align: center;
		}

		#text{
			height: 40px;
			width: 400px;
			border-radius: 4px;
			border: solid 1px #888;
			margin-right: 10px;
			padding: 4px;
			font-size: 14px;
		}

		#button{
			width: 200px;
			height: 40px;
			border-radius: 4px;
			font-weight: bold;
			background-color: #a4938e;

		}

	</style>

	<body  style="font-family: Optima;
					background-size: cover;
					background-position: center;
					background-image: linear-gradient(rgba(0, 0, 0, 0.230), rgba(0, 0, 0, 0.5)), url('signupbk.jpg'); ;">
		<div id="bar">
			<div style="font-size: 75px; font-family: Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; right: 10%;"> Petbook</div>
			<a href="login.php">
			<div id="signup_button">Login</div>
			</a>
		</div>
		<div id="bar2">
			<form method="post" action="">
			<div style="font-size: 45px;font-weight: bold; color:#0e0b0e; font-family: American Typewriter, serif;">
				Sign up to the virtual house for animals<br><br></div>
				<input value="<?php echo $first_name ?>" name="first_name" type="text" id="text" placeholder="First Name"><br><br>
				<input value="<?php echo $last_name ?>" name="last_name" type="text" id="text" placeholder="Nickname"><br>
				<div style="font-size: 30px">
				Gender:<br></div>
				<select id="text" name="gender">
					<option><?php echo $gender ?></option>
					<option>Female</option>
					<option>Male</option>
				</select>
				<br><br>
				<input name="email" type="text" id="text" placeholder="E-mail"><br><br>
				<input name="password" type="password" id="text" placeholder="Password"><br><br>
				<input name="password2" type="password" id="text" placeholder=" Retype Password"><br><br>
				<input type="submit" id="button" value="SignUp">

		</form>
		</div>

	</body>
</html>
