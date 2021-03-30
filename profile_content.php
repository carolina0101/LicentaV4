<div style="min-height: 400px;flex:1;">
			<div id="friends_bar">

				Following<br>

				<?php

					if($friends)
					{
						foreach($friends as $friend){

							$FRIEND_ROW = $user->get_user($friend['userid']);

							include("user.php");
						}
					}

				?>

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
			</div>
        </div>
	</div>