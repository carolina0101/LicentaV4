<?php

	session_start();

	include("classes/autoload.php");

	$login = new Login();
	$user_data = $login->check_login($_SESSION['petbook_userid']);

	$USER= $user_data;
	$DB = new Database;

	if(isset($_GET['id']))
	{
		$profile = new Profile();

		$profile_data = $profile->get_profile($_GET['id']);

		if(is_array($profile_data))

		{
			$user_data = $profile_data[0];
		}
	}

 	$postari = new Post();
	$User = new User();
	$image_class = new Image();


?>

<!DOCTYPE html>
<html>
<head>
	<title>Notifications | Petbook</title>
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

	#notification{
		height: 50px;
		background-color: #ede4e6;
		color: #c79d90;
		border: 1px solid #aaa;
		margin: 4px;

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

				$DB = new Database();
				$id = esc($_SESSION['petbook_userid']);
				//var_dump($id);
				$query = "select * from notifications where userid != '$id' && content_owner = '$id' order by id desc limit 30";
				$data = $DB->read($query);
				//var_dump($data);
			?>
			<?php if(is_array($data)) : ?>
			<?php foreach ($data as $notif_row):

				include("single_notification.php");
			 endforeach; ?>
			<?php else: ?>
				No notification were found!
			<?php endif; ?>
			</div>
        </div>
	</div>
</div>

</body>
</html>