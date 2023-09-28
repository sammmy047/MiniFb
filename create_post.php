<?php
    require_once '_dbcreds.php';
    require_once 'functions.php';
    $con=new mysqli('localhost',$un,$pa,$db);
   
    if($con->connect_error) echo 'Couldnt connect to db';
    else
    {
        $uid=validate_user($con,$_COOKIE['Auth']);
       # $pid=0;
        if($uid!=null)
        {
            $res=$con->query("select * from posts ;");
           # if($res->fetch_assoc()['pid']!=null)
           # $pid=$res->fetch_assoc()['pid']+1;
            $t=htmlentities(sanitize($con,$_POST['t']));
            
            date_default_timezone_set('Asia/Calcutta');
            $ts=date("y-m-d G:i");
            $res=$con->query("insert into posts(uid,t,dop) values('$uid','$t','$ts');");
            header("Location: http://localhost/homepage.php"); 
        }
        else
        lORs();
    }
?>