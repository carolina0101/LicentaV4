<?php

	session_start();

	include("classes/autoload.php");

	$login = new Login();
	$user_data = $login->check_login($_SESSION['petbook_userid']);

	if(isset($_GET['find']))
	{
		$find = addslashes($_GET['find']);

		$sql = "select * from users where first_name like '%$find%' || last_name like '%$find%' limit 30";
		$DB = new Database();
		$results = $DB->read($sql);
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>People who like| Petbook</title>
</head>
<style type="text/css">
	#purple_bar
	{
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
<body style="font-family: tahoma; background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('searchbk.jpg');">
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

                    $image_class = new Image();
                    $User= new User();


                    if(is_array($results))
                    {
                        foreach($results as $row)
                        {
                            $FRIEND_ROW = $User->get_user($row['userid']);
                            include("user.php");
                        }
                    }else
					{
						echo "no results were found";
					}


                ?>
            <br style="clear:both;">



			</div>
         </div>
	</div>
</div>

</body>
</html>