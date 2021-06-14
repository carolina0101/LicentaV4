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


 	$postare = new Post();

    $ERROR = "";
    if(isset($_GET['id']))
    {

        $ROW = $postare->get_one_post($_GET['id']);


       if(!$ROW)
        {
        	$ERROR = "No such post was found!";
	    }else
		{

        	if($ROW['userid'] != $_SESSION['petbook_userid'])
        	{
				$ERROR = "access denied! you cant delete this file!";
			}
		}
	}


    if(isset($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "edit.php") )
    {
        $_SESSION['return_to'] = $_SERVER['HTTP_REFERER'];
    }

     //if something was posted
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $postare->edit_post($_POST, $_FILES);

        header("Location: ".$_SESSION['return_to']);
        //die;
    }


?>

<!DOCTYPE html>
<html>
<head>
	<title>Delete | Petbook</title>
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
<body style="font-family: tahoma; background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('indexbk.jpg');">
	<br>
	<?php include("header.php"); ?>
	<!--cover-->
	<div style="width: 700px; margin:auto; min-height: 400px;">


	<!--partea de jos-->
	<div style="display: flex;">


		<!--cover postari-->
		<div style="min-height: 400px;flex:2.5;padding:20px; padding-right: 0px;">

			<div style="border:solid thin #aaa; padding: 10px;">

                <form method="post" enctype="multipart/form-data">

                        <?php

                            if($ERROR !="")
                            {
                                 echo $ERROR;
                            }
                            else
                            {
                                echo "Edit post<br><br>";

                                echo '<textarea name="post" placeholder="what are you doing today?">' .$ROW['post'].'</textarea>
                                      <input type = "file" name="file">';

								echo "<input type='hidden' name='postid' value='$ROW[postid]'>";
								echo "<input id='post_button' type='submit' value='Save'>";

                                if(file_exists($ROW['image']))
                                {
                                    $image_class = new Image();
                                    $post_image = $image_class->get_thumb_post ($ROW['image']);

                                    echo "<br><div style='text-align:center;'><img src='$post_image' style='width:40%;' /></div>";
                                }
                            }
                        ?>
                    <br>
                </form>
			</div>

				</div>
         </div>
	</div>
</div>

</body>
</html>