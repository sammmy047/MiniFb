<?php
    require_once '_dbcreds.php';
    require_once 'functions.php';
    $con=new mysqli('localhost',$un,$pa,$db);
    if($con->connect_error) echo 'Couldnt connect to db';
    else
    {
        $uid=validate_user($con,$_COOKIE['Auth']);

        if($uid!=null)
        {
            $res=$con->query("select * from posts ;");
            if($res->fetch_assoc()['pid']!=null)
            {
                $res=$con->query("select * from posts where uid!='$uid'");
            }
            else
            display("No posts yet !!! /n Create one <a href='create_post.php'>here</a>");
            
        }
        else
        lORs();
    }
?>