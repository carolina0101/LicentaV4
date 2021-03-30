<?php

    function i_own_content($row)
    {
        $myid = $_SESSION['petbook_userid'];

        if(isset($row['gender']) && $myid = $row['userid'])
        {
            return true;
        }

        if(isset($row['postid']))
        {
            if($myid == $row['userid'])
            {
                return true;
            }else
            {
                $postare = new Post();
                $one_post = $postare->get_one_post($row['parent']);

                if($myid = $one_post['userid'])
                {
                    return true;
                }
            }
        }

        return false;
    }

    function add_notification($userid, $activity, $row)
    {
        $row = (object)$row;
        $userid = esc($userid);
        $activity = esc($activity);
        $content_owner =$row->userid;
        $date = date("Y-m-d H:i:s");
        $contentid = 0;
        $content_type ="";

        if(isset($row->postid))
        {
            $contentid = $row->postid;
            $content_type = "post";

            if($row->parent > 0)
            {
                $content_type = "comment";
            }
        }

        if(isset($row->gender))
        {
            $content_type = "profile";
        }

        $query = "insert into notifications(userid, activity, content_owner, date, contentid, content_type) values ('$userid', '$activity', '$content_owner', '$date', '$contentid', '$content_type') ";

        $DB = new Database();
        $DB->save($query);
    }

    function content_i_follow($userid, $row)
    {
        $userid = esc($userid);
        $date = date("Y-m-d H:i:s");
        $contentid = 0;
        $content_type ="";

        if(isset($row->postid))
        {
            $contentid = $row->postid;
            $content_type = "post";

            if($row->parent > 0)
            {
                $content_type = "comment";
            }
        }

        if(isset($row->gender))
        {
            $content_type = "profile";
        }

        $query = "insert into content_i_follow(userid, date, contentid, content_type) values ('$userid', '$date', '$contentid', '$content_type') ";
        $DB = new Database();
        $DB->save($query);
    }

    function esc($value)
    {
        return addslashes($value);
    }

