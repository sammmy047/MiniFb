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
        $e=sanitize($con,$_POST['email']);
        $g=sanitize($con,$_POST['gender']);
        $sec = sanitize($con, $_POST['sec']);
        $hp=hash("ripemd128","#@$".$p."()^");
        $res=$con->query("select email from users where email='$e';");
        if($res->fetch_assoc()['email']==null)
            $res=$con->query("insert into users(uname,pass,email,gender,sec_question) values('$u','$hp','$e','$g','$sec')");
        else
        {
            display("Username already exist, please log in - <a href='/login.html'>here</a>");
            return;
        }
       
        $res=$con->query("select uid from users where uname='$u' and pass='$hp'");
        setupCookie($con,$res->fetch_assoc()['uid']);
        display("Sign up , success");
        header("Location: http://localhost/profile.html"); 
    }
    
    
    else
        display("Invalid input");
}
?>