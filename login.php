<?php

require_once '_dbcreds.php';
require_once 'functions.php';

$con=new mysqli('localhost',$un,$pa,$db);
if($con->connect_error) echo 'Couldnt connect to db';
else
{
    if(isset($_POST['u']) && isset($_POST['p']))
    {
        $u=sanitize($con,$_POST['u']);
        $p=sanitize($con,$_POST['p']);
        $hp=hash("ripemd128","#@$".$p."()^");
        $res=$con->query("select * from users where email='$u' and pass='$hp'");
        if(mysqli_num_rows($res)==0) display("Invalid credentials");
        else
        {
            $uid=$res->fetch_assoc()['uid'];
            echo $uid;
            setupCookie($con,$uid);
           // display("Login success <a href='/profile.php'>p</a>");
           //header("Location: http://localhost/profile.php"); 
        }
        
    }
    else
    {
        display("Invalid input");
    }
}
?>