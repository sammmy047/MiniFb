<?php
require_once '_dbcreds.php';
require_once 'functions.php';

$con=new mysqli('localhost',$un,$pa,$db);
if($con->connect_error) echo 'Couldnt connect to db';
$fName=$_FILES['pp']['name'];
$uid=validate_user($con,$_COOKIE['Auth']);
if($uid!=null)
{
    $ext=str_split($_FILES['pp']['type'],6)[1];
    move_uploaded_file($_FILES['pp']['tmp_name'],"ppUploads/".$uid.".png");
   
    $hobbies=htmlentities($_POST['hobbies']);
    $branch=htmlentities($_POST['branch']);
    $sem=htmlentities($_POST['semester']);
    $sec=htmlentities($_POST['section']);
    $skills=htmlentities($_POST['skills']);
    $res=  $con->query("select * from user_profile where uid='$uid';");
    if(mysqli_num_rows($res)==0)
    $con->query("insert into user_profile values('$uid','$hobbies','$branch','$sem','$sec','$skills');");
    else
    $con->query("update user_profile set hobbies='$hobbies',branch='$branch',sem='$sem',sec='$sec',skills='$skills' where uid='$uid';");
    header("Location: http://localhost/mainPage.php");
}
else
lORs();
?>