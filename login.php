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
			padding: 90px;
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
					background-image: linear-gradient(rgba(0, 0, 0, 0.230), rgba(0, 0, 0, 0.5)), url('loginbk1.jpg'); ;">
		<div id="bar">
			<div style="font-size: 75px; font-family: Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; right: 10%;"> Petbook</div>
			<a href="signup.php">
			<div id="signup_button">SignUp</div>
			</a>
		</div>
		<div id="bar2">
			<form method = "post">
			<div style="font-size: 65px;font-weight: bold; color:#0e0b0e; font-family: American Typewriter, serif;">
				Login to virtual house for animals<br></div>

				<input name="email" value="<?php echo $email ?>" type="text" id="text" placeholder="E-mail"><br><br>
				<input name="password" value="<?php echo $password ?>" type="password" id="text" placeholder="Password"><br><br>

				<input type="submit" id="button" value="Login">

			</form>

		</div>

	</body>
</html>
