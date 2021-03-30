<?php


	session_start();

	include("classes/autoload.php");


	$login = new Login();
	$user_data = $login->check_login($_SESSION['petbook_userid']);
?>

<!DOCTYPE html>
<html>
<head>
	<title>NewsFeed | Petbook</title>
</head>
<style type="text/css">
	#purple_bar{
		height:72px;
		background-color: #c79d90;
		color: #6b6554;
	}

	#search_box{
		width: 400px;
		height: 25px;
		border-radius: 7px;
		border: none;
		padding: 4px;
		font-size: 14px;
		background-image: url(search.png);
		background-repeat: no-repeat;
		background-position: right;


	}

	#profile_pic{
		width: 150px;
		border-radius: 50%;
		border: solid 1px white;
	}

	#menu_buttons{
		width: 100px;
		display: inline-block;
		margin: 2px;
	}

	#friends_img{

		width:75px;
		float: left;
		margin: 8px;
	}

	#friends_bar{

		min-height: 400px;
		margin-top:20px;
		padding:8px;
		text-align: center;
		font-size: 20px;
		color: black;
	}
	#friends{
		clear: both;
		font-size: 12px;
		font-weight:bold;
		color: #6b222f;
	}

	textarea{
		width: 100%;
		border: none;
		font-family: tahoma;
		color: black;
		height: 65px;

	}

	#post_button{
		float: right;
		background-color: #c79d90;
		border:none;
		color: white;
		padding: 7px;
		font-size: 14px;
		border-radius: 2px;
		width: 80px;
	}
    #post_bar{
    	margin-top: 20px;
    	background-color:#ede4e6;
    	padding: 10px;
    }

    #post{
    	padding: 4px;
    	font-size: 13px;
    	display: flex;
    	margin-bottom: 20px;
    }


</style>
<body style="font-family: tahoma; background-color: #f3eff7">
	<br>
	<?php include("header.php"); ?>
	<!--cover-->
	<div style="width: 700px; margin:auto; min-height: 400px;">


	<!--partea de jos-->
	<div style="display: flex;">

		<!--cover prieteni-->
		<div style="min-height: 400px;flex:1;">
			<div id="friends_bar">

				<img src="whiskey.png" id="profile_pic"><br>
			<a href="profile.php" style="text-decoration:none;">
				<?php echo $user_data['first_name'] . "<br>" . $user_data['last_name'] ?>
			 </a>

			</div>
		</div>

		<!--cover postari-->
		<div style="min-height: 400px;flex:2.5;padding:20px; padding-right: 0px;">

			<div style="border:solid thin #aaa; padding: 10px;">

				<textarea placeholder="what are you doing today?"></textarea>
				<input id="post_button" type="submit" value="post today">
				<br>
			</div>

			<!--post-->
			<div id="post_bar">
				<!--post 1-->
				<div id="post">
					<div>
						<img src="papagal.jpg" style="width: 75px;margin-right: 4px;">
					</div>
					<div>
					<div style="font-weight:bold;color: #6b222f">Papos</div>

						ce faci frumosule?
						<br/><br/>
						<a href="">Like</a> |<a href=""> Comment</a> |<span style="color: #aaa;"> Martie 20 2020</span>
					</div>
				</div>

			<!--post 2-->
				<div id="post">
					<div>
						<img src="iepure.png" style="width: 75px; margin-right: 4px;">
					</div>
					<div>
					<div style="font-weight:bold;color: #6b222f">Iepurila</div>

						ce faci frumosule?
						<br/><br/>
						<a href="">Like</a> |<a href=""> Comment</a> |<span style="color: #aaa;"> Martie 20 2020</span>
					</div>
				</div>
         </div>
	</div>
</div>

</body>
</html>