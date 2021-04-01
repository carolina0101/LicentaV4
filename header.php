	<!--top bar-->
<?php

	$corner_image = " images/profileimage.jpg";
	if(isset($USER))
	{
			if(file_exists($USER['profile_image']))
			{
				$image_class = new Image();
				$corner_image = $image_class-> get_thumb_profile($USER['profile_image']);
			}else
			{
				if($USER['gender'] == "Female")
				{
					$corner_image = " images/profileimage.jpg";
				}
			}
	}

?>
	<div id="purple_bar">
			<form method="get" action="search.php">
				<div style="width: 980px; margin:auto; font-size: 38px;">
				<a href="index.php" style="color: #6b6554;">Petbook</a>

				&nbsp &nbsp <input type="text" id="search_box" name='find' placeholder="Search for another animals">


				<a href="login.php">

				<span style="font-size: 15px; float: right; margin:10px;color:white;">Logout</span>
				</a>


				<a href="profile.php">
				<img src="<?php echo $corner_image ?>" style="width: 71px; float: right;">
		 		</a>
				 <a href="notifications.php">
				<span style="display:inline-block;position:relative;">
				<img src = "notif.png" style="width:34px;float:right;margin-top: 20px; ">

				<?php

				function check_notifications()
				{
					$number = 0;

					$userid = $_SESSION['petbook_userid'];
					$DB = new Database();

					$query = "select * from notifications where userid != '$userid' && content_owner = '$userid' limit 30";
					$data = $DB->read($query);

					if(is_array($data))
					{
						foreach ($data as $row)
						{


							$query= "select * from notification_seen where userid = '$userid' && notification_id = '$row[id]' limit 1";
							$check = $DB->read($query);

							if(!is_array($check))
							{
							$number++;
							}
						}
					}

					return $number;
				}



					$notif = check_notifications();
				?>
				<?php if($notif > 0): ?>
				<div style="background-color: #e02510;color: black;position:absolute;margin-top:5px;right:-3px;width:15px;height:15px;border-radius: 50%;padding:4px;text-align:center;font-size:15px;"><?= $notif ?></div>
				<?php endif; ?>
				</span>
				</a>
		</div>
			</form>
	</div>
