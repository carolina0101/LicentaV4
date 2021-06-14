	<?php


		session_start();

		include("classes/connect.php");
		include("classes/login.php");
		include("classes/user.php");
		include("classes/post.php");
		include("classes/image.php");


		$login = new Login();
		$user_data = $login->check_login($_SESSION['petbook_userid']);


		//postarea incepe aici
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{


			if(isset($_FILES['file']['name']) && $_FILES['file']['name'] !="")
			{

				if ($_FILES['file']['type'] = "image/jpeg")
				{

					$allowed_size = (1024 * 1024) * 7;
					if($_FILES['file']['size'] < $allowed_size)
					{
						$folder = "uploads/" . $user_data['userid'] . "/";

						//create folder
						if(!file_exists($folder))
						{
							mkdir($folder, 0777, true);
						}

						$image = new Image();

						$filename = $folder . $image->generate_filename(15) . ".jpg";
						move_uploaded_file($_FILES['file']['tmp_name'], $filename);

						$change = "profile";

							if(isset($_GET['change']))
							{
								$change = $_GET['change'];
							}

						if($change == "cover")
						{
							if(file_exists($user_data['cover_image']))
							{
								unlink($user_data['cover_image']);
							}

							$image->resize_image($filename,$filename, 1500, 1500);
						}else
						{
							if(file_exists($user_data['profile_image']))
							{
								unlink($user_data['profile_image']);
							}
							$image->resize_image($filename,$filename, 1500, 1500);
						}

						if(file_exists($filename))
						{
							$userid = $user_data['userid'];

							if($change == "cover")
							{
								$query = "update users set cover_image = '$filename' where userid = '$userid' limit 1";
								$_POST['is_cover_image'] = 1;
							}else
							{
								$query = "update users set profile_image = '$filename' where userid = '$userid' limit 1";
								$_POST['is_profile_image'] = 1;
							}

							$DB = new Database();
							$DB->save($query);

							//create a post
							$post = new Post();
							$post->create_post($userid, $_POST, $filename);

							header(("Location: profile.php"));
							//die;
						}
						else
						{
							echo "<div style='text-align:center;font-size: 12px; color:white;background-color:grey;'>";
							echo  "The following errors occured<br><br>";
							echo  "add a valid image!only images of  jpeg type are allowed!";
							echo "</div>";
						}



					}
					else
					{
						echo "<div style='text-align:center;font-size: 12px; color:white;background-color:grey;'>";
						echo  "The following errors occured<br><br>";
						echo  "size too big!";
						echo "</div>";
					}



				}
				else
				{
					echo "<div style='text-align:center;font-size: 12px; color:white;background-color:grey;'>";
					echo  "The following errors occured<br><br>";
					echo  "add a valid image!only images of  jpeg type are allowed!";
					echo "</div>";
				}
			}
			else
			{
				echo "<div style='text-align:center;font-size: 12px; color:white;background-color:grey;'>";
				echo  "The following errors occured<br><br>";
				echo  "add a valid image!only images of  jpeg type are allowed!";
				echo "</div>";
			}

		}
	?>

	<!DOCTYPE html>
	<html>
	<head>
		<title>Change Profile Image | Petbook</title>
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

		#post_button{
			float: right;
			background-color: #876c64;
			border:none;
			color: white;
			padding: 7px;
			font-size: 14px;
			border-radius: 2px;
			width: 100px;

		}
		#post_bar{
			margin-top: 24px;
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
	<body style="font-family: tahoma; background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url('changebk.jpg'); ">
		<br>
		<?php include("header.php"); ?>
		<!--cover-->
		<div style="width: 700px; margin:auto; min-height: 400px;">

		<!--partea de jos-->
			<div style="display: flex;">

				<!--cover postari-->
				<div style="min-height: 400px;flex:2.5;padding:20px; padding-right: 0px;">

					<form method="post" enctype="multipart/form-data">
						<div style="border:solid thin #aaa; padding: 10px;background-color: white;">

							<input type="file" name="file">
							<input id="post_button" type="submit" value="Change image">
							<br>
							<div style="text-align: center;">
							<?php

								if(isset($_GET['change']) && $_GET['change'] == "cover")
								{
									$change = "cover";
									echo "<img src='$user_data[cover_image]' style='max-width:500px;'>";
								}else
								{
									echo "<img src='$user_data[profile_image]' style='max-width:500px;'>";
								}

							?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

	</body>
	</html>