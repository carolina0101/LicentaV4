<?php

	session_start();

	include("classes/autoload.php");

	$login = new Login();
	$user_data = $login->check_login($_SESSION['petbook_userid']);

	$USER= $user_data;

	if(isset($_GET['id']))
	{
		$profile = new Profile();


		$profile_data = $profile->get_profile($_GET['id']);


		if(is_array($profile_data))

		{
			$user_data = $profile_data[0];
		}
	}


		//start posting

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		if(isset($_POST['first_name']))
		{

			$settings_class = new Settings();
			$settings_class->save_settings($_POST, $_SESSION['petbook_userid']);

		}else
		{
			$post = new Post();
			$id = $_SESSION['petbook_userid'];

			$result = $post->create_post($id, $_POST, $_FILES);

			if($result == "")
			{
				header("Location: profile.php");
				die;
			}else
			{
				echo"<div style='text-align:center;font-size: 12px; color:white;background-color:grey;'>";
				echo "The following errors occured<br>";
				echo $result;
				echo"</div>";
			}
		}

	}

	//collect posts
	$post = new Post();

	$id = $user_data['userid'];
	$posts = $post->get_posts($id);

	//collect friends

	$user = new User();

	$friends = $user->get_following($user_data['userid'], "user");

	$image_class = new Image();

	if(isset($_GET['notif']))
	{
		notification_seen($_GET['notif']);
	}


?>


<!DOCTYPE html>
<html>
<head>
	<title>Interface | Petbook</title>
</head>
<style type="text/css">
	#purple_bar{
		height:72px;
		background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('bar.jpg');background-size: 800px; background-position: center;
		color: #33163c;
		font-size: 50px;
		font-weight:bold;
	}

	#textbox{
		width: 100%;
		height: 25px;
		border-radius: 7px;
		border: none;
		padding: 4px;
		font-size: 14px;
		border: solid thin grey;
		margin: 8px;


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
		margin-top:-200px;
		border-radius: 50%;
		border: solid 1px white;
	}

	#menu_buttons{
		width: 80px;
		display: inline-block;
		margin: 1px;
	}

	#friends_img{

		width:75px;
		float: left;
		margin: 8px;

	}

	#friends_bar{
		background-color: #ede4e6;
		min-height: 400px;
		margin-top:20px;
		color: black;
		padding:8px;
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
		min-width: 50px;
		cursor: pointer;
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

		<div style=" background-color: white; text-align: center;color: black">

			<?php

				$image = "images/cover_image.jpg";
				if(file_exists($user_data['cover_image']))

				{
					$image = $image_class->get_thumb_cover($user_data['cover_image']);
				}
			?>

			<img src="<?php echo $image?>" style="width:100%;">

			<span style="font-size: 12px;">

				<?php

					$image = "images/profileimage.jpg";

					if(file_exists($user_data['profile_image']))

					{
						$image = $image_class->get_thumb_profile($user_data['profile_image']);
					}
				?>

				<img id="profile_pic" src="<?php echo $image?>"><br/>
				<a  style="text-decoration: none; color:#a1705f" href="change_profile_image.php?change=profile">change profle image</a> -||-
				<a  style="text-decoration: none; color:#a1705f" href="change_profile_image.php?change=cover"> change cover</a>
			</span>
			<br>
			<div style="font-size:20px;">
			<a href="profile.php?id=<?php echo $user_data['userid'] ?>">
				<?php echo $user_data['first_name'] ." " . $user_data['last_name']?></div>
			</a>
			<?php
				$mylikes = "";
				if($user_data['likes'] > 0)
				{
					$mylikes = "(" . $user_data['likes']. " Followers)";
				}

			?>
			<br>

			<a href="like.php?type=user&id=<?php echo $user_data['userid'] ?>">
			<input id="post_button" type = "button" value="Follow<?php echo $mylikes ?>" style="margin-right:5px; background-color: #9e6378; width:135px;">
			</a>

			<br>



			<a href="index.php"><div id="menu_buttons">News Feed </div></a>
			<a href="profile.php?section=about&id=<?php echo $user_data['userid'] ?>"><div id="menu_buttons"> About </div></a>
			<a href="profile.php?section=followers&id=<?php echo $user_data['userid'] ?>"><div id="menu_buttons"> Followers </div></a>
			<a href="profile.php?section=following&id=<?php echo $user_data['userid'] ?>"><div id="menu_buttons"> Following </div></a>
			<a href="profile.php?section=photos&id=<?php echo $user_data['userid'] ?>"><div id="menu_buttons"> Photos </div></a>

			<?php
				if($user_data['userid'] == $_SESSION['petbook_userid'])
				{
					echo '<a href="profile.php?section=settings&id='.$user_data['userid'].'"><div id="menu_buttons"> Settings </div></a>';
				}



			?>
	</div>
	<!--partea de jos-->
	<div style="display: flex;">

		<!--cover prieteni-->
			<?php
				$section = "default";
				if(isset($_GET['section']))
				{
					$section = $_GET['section'];
				}

				if($section == "default")
				{
					include("profile_content.php");

				}elseif($section == "following")
				{
					include("profile_content_following.php");

				}elseif($section == "followers")
				{
					include("profile_content_followers.php");

				}elseif($section == "about")
				{
					include("profile_content_about.php");

				}elseif($section == "settings")
				{
					include("profile_content_settings.php");

				}elseif($section == "photos")
				{
					include("profile_content_photos.php");
				}

			?>
	</div>
</div>

</body>
</html>