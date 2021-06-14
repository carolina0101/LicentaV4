<?php

$_SESSION['petbook_userid'] = isset($_SESSION['petbook_userid']) ? $_SESSION['petbook_userid'] : 0;
$login = new Login;
$user_data = $login->check_login($_SESSION['petbook_userid'], false);

if($_SESSION['petbook_userid'] == 0)
{
    $obj = (object)[];
    $obj->action = "like_post";

    echo json_encode($obj);

}

// $query_string = explode("?", $data->link);
// $query_string = end($query_string);

// $str = explode("&", $query_string);

// foreach($str as $value)
// {
//     $value = explode("=", $value);
//     $_GET[$value[0]] = $value[1];
// }

// $_GET['id'] = addslashes($_GET['id']);
// $_GET['type'] = addslashes($_GET['type']);

    if(isset($_GET['type']) && isset($_GET['id']))
    {
        $post = new Post();

        if(is_numeric($_GET['id']))
        {
            $allowed[] = 'post';
            $allowed[] = 'user';
            $allowed[] = 'comment';

            if(in_array($_GET['type'], $allowed))
            {

                $user_class = new User();

                $post->like_post($_GET['id'], $_GET['type'], $_SESSION['petbook_userid']);
                //die;


                if($_GET['type'] == "user")
                {

                    $user_class->follow_user($_GET['id'],$_GET['type'],$_SESSION['petbook_userid']);

                }
            }

        }
    //    / $likes = $post->get_likes($_GET['id'], $_GET['type']);
    }