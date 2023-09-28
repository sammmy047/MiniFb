<?php
session_start();
require_once '_dbcreds.php';
require_once 'functions.php';
$con=new mysqli('localhost',$un,$pa,$db);

if (isset($_POST['submit'])) {
    $pass = htmlentities(mysqli_real_escape_string($con, $_POST['pass']));
    $chpass = htmlentities(mysqli_real_escape_string($con, $_POST['chpass']));
    $email = htmlentities(mysqli_real_escape_string($con, $_POST['username']));
    $sec = htmlentities(mysqli_real_escape_string($con, $_POST['sec']));
    $select_user = "select * from users where email='$email' ";
    $query = mysqli_query($con, $select_user);
    $check_user = mysqli_num_rows($query);
    if(strlen($pass) <9 ){
        echo"<script>alert('Password should be minimum 9 characters!')</script>";
        echo "<script>window.open('forgotpassword.html', '_self')</script>";
    }
    if($pass != $chpass)
        {
          echo "<script>alert('Passwords are not matching !!!')</script>";
          echo "<script>window.open('forgotpassword.html', '_self')</script>";
        }

  
        if ($check_user == 1) {
              $_SESSION['email'] = $email;
       
        $result = mysqli_query($con, "SELECT sec_question FROM users WHERE email='$email'");
        $retrive = mysqli_fetch_array($result);
        $DOB = $retrive['sec_question'];
        $hp=hash("ripemd128","#@$".$pass."()^");
        if($sec==$DOB)
        {
            $newpass= $hp;
            mysqli_query($con, "UPDATE users SET pass='$hp' WHERE email='$email'");
            echo"<script>alert('Password Reset Success!!')</script>";
            echo "<script>window.open('login.html', '_self')</script>";
        }
        else{
            echo"<script>alert('Incorrect values')</script>";
            echo "<script>window.open('forgotpassword.html', '_self')</script>";
        }
    }
    else{
        echo"<script>alert('Email is not registered. Please signup!!!!!')</script>";
        echo "<script>window.open('signup.html', '_self')</script>";
    }
  }

?>