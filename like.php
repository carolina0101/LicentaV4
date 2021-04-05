<?php

session_start();

	//include("classes/autoload.php");

    include("classes/connect.php");
	include("classes/functions.php");
	include("classes/login.php");
	include("classes/user.php");
	include("classes/post.php");
	include("classes/image.php");
	include("classes/profile.php");
	include("classes/settings.php");
	$login = new Login();
	$user_data = $login->check_login($_SESSION['petbook_userid']);

if(isset($_SERVER['HTTP_REFERER']))
{
    $return_to = $_SERVER['HTTP_REFERER'];
}else
{
    $return_to = "profile.php";
}

    if(isset($_GET['type']) && isset($_GET['id']))
      {  // echo '<pre>' , var_dump($_GET) , '</pre>';
        // echo '<pre>' , var_dump($user_data) , '</pre>';

        if(is_numeric($_GET['id']))
        {
            $allowed[] = 'post';
            $allowed[] = 'user';
            $allowed[] = 'comment';


            if(in_array($_GET['type'], $allowed))
            {
                $post = new Post();
                $user_class = new User();

                // $DB=new Database();
				// $temp_var=$_GET['id'];

				// $query_follow_or_like = "select likes from likes where contentid='$temp_var' && likes!='' ";
				// var_dump($temp_var);
				// $query_result = $DB->read($query_follow_or_like);
                // echo '<pre>' , var_dump($query_result) , '</pre>';



                $post->like_post($_GET['id'],$_GET['type'], $_SESSION['petbook_userid']);

                if($_GET['type'] == "user")
                {
                     $user_class->follow_user($_GET['id'],$_GET['type'], $_SESSION['petbook_userid']);
                }

            }
        }
    }

header("Location: ". $return_to);
die;