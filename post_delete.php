<div id="post">
		<div>
			<?php
                $image = new Image();
				$image_string ="images/profileimage.jpg";
				if($ROW_USER['gender']== "Male")
				{
					$image_string = "images/profileimage.jpg";
				}

				if(file_exists($ROW_USER['profile_image']))
				{
					$image_string = $image->get_thumb_profile($ROW_USER['profile_image']);
				}
			?>
			<img src="<?php echo $image_string ?>" style="width: 75px; margin-right: 4px; border-radius:50%;">
		</div>
		<div style="width: 100%;">
			<div style="font-weight:bold;color: #6b222f; width: 100%;">
				<?php

					echo $ROW_USER['first_name'] . " " . $ROW_USER['last_name'];

					if($ROW['is_profile_image'])
					{
						$pronun = "his";
						if($ROW_USER['gender'] == "Female")
						{
							$pronun = "her";
						}
						echo"<span style='font-weight:normal; color: #aaa;'> updated $pronun profile image</span>";

					}

					if($ROW['is_cover_image'])
					{
						$pronun = "his";
						if($ROW_USER['gender'] == "Female")
						{
							$pronun = "her";
						}
						echo"<span style='font-weight:normal; color: #aaa;'> updated $pronun cover image</span>";

					}

				?>
			</div>

				<?php echo $ROW ['post'] ?>
				<br><br>

				<?php
					if(file_exists($ROW['image']))
					{
						$post_image = $image->get_thumb_post($ROW['image']);

						echo "<img src='$post_image' style='width:60%;' />";
					}

				?>
		</div>
	</div>

</div>