<?php
        $actor = $User->get_user($notif_row['userid']);
        $owner = $User->get_user($notif_row['content_owner']);
        $id = esc($_SESSION['petbook_userid']);

        $link = "";

        if($notif_row['content_type'] == "post")
        {
            $link = "single_post.php?id=" . $notif_row['contentid'];
        }else
        if($notif_row['content_type'] == "profile")
        {

        }
        if($notif_row['content_type'] == "post")
        {

        }
    ?>
<a href="<?php echo $link ?>" style="text decoration: none;">
    <div id="notification">

    <?php
        if(is_array($actor) && is_array($owner))
        {
            echo "<img src='images/profileimage.jpg' style='width:40px;margin:4px;float:left;' />";
            if($actor['userid'] != $id)
            {
                echo $actor['first_name'] . " " . $actor['last_name'];
            }else
            {
                echo "You ";
            }

            if($notif_row['activity'] == "like")
            {
                echo " liked ";
            }else

            if($notif_row['activity'] == "followed")
            {
                echo " followed ";
            }


            if($owner['userid'] != $id)
            {
                echo $owner['first_name'] . "" . $owner['last_name'] . " 's ";
            }else
            {
                echo " your ";
            }


            echo $notif_row['content_type'];

            $date = date("jS/M/Y H:i:s a", strtotime($notif_row['date']));
            echo "<br>

                <span style='float:right;font-size:11px;color: #888; display:inline-block;margin-right: 2px;'>$date</span>

            ";
        }

    ?>
    </div>
</a>