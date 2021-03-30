<?php

session_start();

	include("classes/connect.php");
	include("classes/login.php");

	$email = "";
	$password = "";


	if($_SERVER['REQUEST_METHOD'] =='POST')
	{

		$login = new Login();
		$result = $login->evaluate($_POST);

		if($result !="")
		{
			echo"<div style='text-align:center;font-size: 12px; color:white;background-color:grey;'>";
			echo "The following errors occured<br>";
			echo $result;
			echo"</div>";
		} else
		{
			header("Location: profile.php");
			die;
		}

		$email = $_POST['email'];
		$password = $_POST['password'];

    }


?>


<html>
	<head>
		<title>Petbook | Login </title>
	</head>

	<style>
		#bar{
			height:72px;
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
			font-size: 30px;
			width: 800px;
			height: 270px;
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
			background-color: #c79d90

		}
	</style>

	<body  style="font-family: Optima;
				  background-color: #f3eff7;">
		<div id="bar">
			<div style="font-size: 35px;"> Petbook</div>
			<a href="signup.php">
			<div id="signup_button">SignUp</div>
			</a>
		</div>
		<div id="bar2">
			<form method = "post">
				Login to virtual house for animals<br><br>

				<input name="email" value="<?php echo $email ?>" type="text" id="text" placeholder="E-mail"><br><br>
				<input name="password" value="<?php echo $password ?>" type="password" id="text" placeholder="Password"><br><br>

				<input type="submit" id="button" value="Login">

			</form>

		</div>

	</body>
</html>
