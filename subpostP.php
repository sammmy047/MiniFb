<?php
 require_once '_dbcreds.php';
 require_once 'functions.php';
 $con=new mysqli('localhost',$un,$pa,$db);
 if($con->connect_error) echo 'Couldnt connect to db';
 else
 {
    $uid=validate_user($con,$_COOKIE['Auth']);
     if($uid==null)
     header("Location: http://localhost/login_signup.php");
     else
     {
        $pid=htmlentities($_GET['post']);
        $t=htmlentities($_GET['con']);
        date_default_timezone_set('Asia/Calcutta');
        $ts=date("y-m-d G:i");
        $res=$con->query("insert into subposts values('$uid','$pid','$t','$ts')");
        header("Location: http://localhost/subpost.php?post=".$pid);
     }
    }
?>