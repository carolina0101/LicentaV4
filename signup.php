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
			die;
		}

		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$gender = $_POST['gender'];
		$email = $_POST['email'];

    }


?>


<html>
	<head>
		<title>Petbook | SignUp </title>
	</head>

	<style>
		#bar{
			height:70px;
			background-color: #c79d90;
			color: #6b6554;
			font-size: 35px;
			font-weight:bold;
		}

		#signup_button{
			background-color: #f5e6ba;
			font-size: 18px;
			text-align: center;
			width: 73px;
			padding:4px;
			float:right;
			font-weight:bold;
			border-radius: 5px;

		}
		#bar2{
			background-color: #ede4e6;
			font-size: 20px;
			width: 800px;
			height: 510px;
			margin:auto;
			margin-top: 50px;
			padding: 20px;
			text-align: center;
		}

		#text{
			height: 40px;
			width: 300px;
			border-radius: 4px;
			border: solid 1px #888;
			padding: 4px;
			font-size: 14px;
		}

		#button{
			width: 300px;
			height: 40px;
			border-radius: 4px;
			font-weight: bold;
			background-color: #c79d90;

		}
	</style>

	<body  style="font-family: Optima;
				  background-color: #f3eff7;">
		<div id="bar">
			<div style="font-size: 35px;"> Petbook</div>
			<a href="login.php">
			<div id="signup_button">Login</div>
			</a>
		</div>
		<div id="bar2">
			Sign up to virtual house for animals<br><br>
			<form method="post" action="">

				<input value="<?php echo $first_name ?>" name="first_name" type="text" id="text" placeholder="First Name"><br><br>
				<input value="<?php echo $last_name ?>" name="last_name" type="text" id="text" placeholder="Last Name"><br><br>

				Gender:<br>
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
