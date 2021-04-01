<?php

	session_start();

	include("classes/autoload.php");

	$login = new Login();
	$user_data = $login->check_login($_SESSION['petbook_userid']);

	$USER = $user_data;



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
				header("Location: single_post.php?id=$_GET[id]");

			}else
			{
				echo"<div style='text-align:center;font-size: 12px; color:white;background-color:grey;'>";
				echo "The following errors occured<br>";
				echo $result;
				echo"</div>";
			}


	}

    $postari = new Post();
    $ROW = false;
	$Post = "";


    $ERROR = "";

    if(isset($_GET['id']))
    {
		$ROW = $postari->get_single_post($_GET['id']);

	}else
    {
        $ERROR = "No post was found!";
    }



?>

<!DOCTYPE html>
<html>
<head>
	<title>Single Post | Petbook</title>
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


		<!--cover postari-->
		<div style="min-height: 400px;flex:2.5;padding:20px; padding-right: 0px;">

			<div style="border:solid thin #aaa; padding: 10px;">

                <?php
					//notification bar
					if(isset($_GET['notif']))
					{
						notification_seen($_GET['notif']);
					}

                    $image_class = new Image();
                    $user= new User();


                    if(is_array($ROW))
                    {

    					$ROW_USER = $user->get_user($ROW['userid']);

						include("post.php");
                    }


                ?>
            <br style="clear:both;">

			<div style="border:solid thin #aaa; padding: 10px;">

				<form method="post" enctype="multipart/form-data">

					<textarea name="post" placeholder="Post a comment"></textarea>
					<input type = "hidden" name="parent" value="<?php echo $ROW['postid'] ?>">
					<input type = "file" name="file">
					<input id="post_button" type="submit" value="post">
				</form>
				<br>
			</div>
					<?php

						$comments = $postari->get_comments($ROW['postid']);

						if(is_array($comments))
						{
							foreach ($comments as $ROW)
							{
								include("comment.php");
							}
						}

					?>

			</div>

         </div>
	</div>
</div>

</body>
</html>