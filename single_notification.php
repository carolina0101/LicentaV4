<a href="" style="text decoration: none;">
    <div id="notification">

    <?php
        $actor = $User->get_user($notif_row['userid']);
        $owner = $User->get_user($notif_row['content_owner']);

        if(is_array($actor) && is_array($owner))
        {
            echo "<img src='images/profileimage.jpg' style='width:40px;margin:4px;float:left;' />";

            echo $actor['first_name'] . "" . $actor['last_name'];

            if($notif_row['activity'] == "like")
            {
                echo " liked ";
            }
            echo $owner['first_name'] . "" . $owner['last_name'];
            echo "'s ";
            echo $notif_row['content_type'];
        }

    ?>
    </div>
</a>