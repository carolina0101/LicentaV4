	<div id="post">
		<div>
			<?php

				$image ="images/profileimage.jpg";
				if($ROW_USER['gender']== "Male")
				{
					$image = "images/profileimage.jpg";
				}

				if(file_exists($ROW_USER['profile_image']))
				{
					$image = $image_class->get_thumb_profile($ROW_USER['profile_image']);
				}
			?>
			<img src="<?php echo $image?>" style="width: 75px; margin-right: 4px; border-radius:50%;">
		</div>
		<div style="width: 100%;">
			<div style="font-weight:bold;color: #6b222f; width: 100%;">
				<?php
					echo "<a href = 'profile.php?id=$ROW[userid]'>";
					echo $ROW_USER['first_name'] . " " . $ROW_USER['last_name'];
					echo "</a>";

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
						$post_image = $image_class->get_thumb_post ($ROW['image']);

						echo "<img src='$post_image' style='width:60%;' />";
					}

				?>

				<br/><br/>

				<?php
					$likes = "";
					$likes = ($ROW['likes'] > 0) ? "(" .$ROW['likes']. ")" : "" ;

				?>

				<a href="like.php?type=post&id=<?php echo $ROW['postid'] ?>">Like<?php echo $likes?></a> |
				<?php
					$comments = "";

					if($ROW['comments'] > 0)
					{
						$comments = "(" . $ROW['comments'] . ")";
					}
				?>
				<a href="single_post.php?id=<?php echo $ROW['id'] ?>"> Comment<?php echo $comments ?></a>
				<span style="color: #aaa;">
					<?php echo $ROW['date'] ?>
				</span>

				<?php

					if($ROW['has_image'])
					{
						echo "<a href='image_view.php?id=$ROW[postid]'> ";
						echo "Full Image";
						echo "</a>";
					}

				?>

				<span style = "color: #999;float:right">

					<a href="edit.php?id=<?php echo $ROW['postid'] ?>">
						Edit
					</a>.

					<a href="delete.php?id=<?php echo $ROW['postid'] ?>" >
						 Delete
					</a>

				</span>
					<?php
						$i_liked = false;
						if(isset($_SESSION['petbook_userid']))
						{

							$DB = new Database();

							$sql = "select likes from likes where type='post' && contentid = '$ROW[postid]' limit 1";
							$result = $DB->read($sql);

							if(is_array($result))
								{

									$likes = json_decode($result[0]['likes'], true);

									$user_ids = array_column($likes, "userid");

									if(in_array($_SESSION['petbook_userid'], $user_ids))
									{
										$i_liked = true;
									}
								}

							if($ROW['likes'] > 0)
							{
								echo "<br/>";

								echo "<a href='likes.php?type=post&id=$ROW[postid]'>";


								if($ROW['likes'] == 1)
								{
									if($i_liked)
									{
										echo "<div style='text-align:left;'> You liked this post </div>";
									}else
									{
										echo "<div style='text-align:left;'> 1 person liked this post </div>";
									}

								}else
								{
									if($i_liked)
									{

										$text = "others";
										if($ROW['likes'] - 1 == 1)
										{
											$text = "other";
										}

										echo "<div style='text-align:left;'> You and " . ($ROW['likes'] - 1) . " $text liked this post </div>";
									}else
									{
										echo "<div style='text-align:left;'>" . $ROW['likes'] . " other liked this post </div>";
									}


								}

								echo "</a>";
							}

						}
					?>
			</div>
		</div>

