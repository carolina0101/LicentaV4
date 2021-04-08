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


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$post = new Post();


		$id = $_SESSION['petbook_userid'];
		$result = $post->create_post($id, $_POST, $_FILES);


		if($result == "")
		{
			header("Location: index.php");
			die;
		}else
		{
			echo"<div style='text-align:center;font-size: 12px; color:white;background-color:grey;'>";
			echo "The following errors occured<br>";
			echo $result;
			echo"</div>";
		}

	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>NewsFeed | Petbook</title>
</head>
<style type="text/css">
	#purple_bar{
		height:72px;
		background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('bar.jpg');background-size: 800px; background-position: center;
		color: #33163c;
		font-size: 50px;
		font-weight:bold;
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
		cursor:pointer;
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

			<?php

				$image = "images/profileimage.jpg";

				if(file_exists($user_data['profile_image']))

				{
					$image = $image_class->get_thumb_profile($user_data['profile_image']);
				}
			?>

			<img id="profile_pic" src="<?php echo $image?>"><br/>
			<a href="profile.php" style="text-decoration:none;">
				<?php echo $user_data['first_name'] . "<br>" . $user_data['last_name'] ?>
			 </a>

			</div>
		</div>

		<!--cover postari-->
		<div style="min-height: 400px;flex:2.5;padding:20px; padding-right: 0px;">

			<div style="border:solid thin #aaa; padding: 10px;">
				<form method="post" enctype="multipart/form-data">

					<textarea name="post" placeholder="what are you doing today?"></textarea>
					<input type = "file" name="file">
					<input id="post_button" type="submit" value="post today">
				</form>

				<br>
			</div>

			<!--post-->
			<div id="post_bar">


				<?php

					$page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
					$page_number = ($page_number < 1) ? 1 : $page_number;
					//get current url
					$url = $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'];
					$url .= "?";

					$next_page_link = $url;
					$prev_page_link = $url;

					$num = 0;
					foreach($_GET as $key => $value)
					{
						$num++;

						if($num == 1)
						{
							if($key == "page")
							{
								$next_page_link .= $key . "=" . ($page_number + 1);
								$prev_page_link .= $key . "=" . ($page_number - 1);

							}else{
								$next_page_link .= $key . "=" . $value;
								$prev_page_link .= $key . "=" . $value;
							}
						}else{
							if($key == "page")
							{
								$next_page_link .= $key . "=" . ($page_number + 1);
								$prev_page_link .= $key . "=" . ($page_number - 1);

							}else
							{
								$next_page_link .= "&" . $key ."=" . $value;
								$prev_page_link .= "&" . $key ."=" . $value;
							}
						}
					}


					$limit = 6;
					$offset = ($page_number - 1) * $limit;

					$DB = new Database();
					$user_class = new User();
					$image_class = new Image();
					$posts="";

					$followers = $user_class->get_following($_SESSION['petbook_userid'], "user");

					$follower_ids = false;

					if(is_array($followers))
					{
						$follower_ids = array_column($followers, "userid");
						$follower_ids = implode("','", $follower_ids);
					}
					if($follower_ids)
					{
						$myuserid = $_SESSION['petbook_userid'];

						$sql = "select * from posts where parent = 0 and (userid = '$myuserid' || userid in('" .$follower_ids. "')) order by id desc limit $limit offset $offset";

						//$posts = $post->get_posts($id);

						$posts = $DB->read($sql);

					}

					if($posts)
					{

						foreach($posts as $ROW)
						{
							$user = new User();
							$ROW_USER = $user-> get_user($ROW['userid']);

							include("post.php");
						}
					}

				?>
				<a href="index.php?page=<?php echo ($page_number + 1) ?>">
				<input id = "post_button" type="button" value="Next Page" style="float: right;width:150px;">
				</a>
				<a href="index.php?page=<?php echo ($page_number - 1) ?>">
				<input id = "post_button" type="button" value="Prev Page" style="float: left;width:150px;">
				</a>
        </div>
	</div>
</div>

</body>
</html>