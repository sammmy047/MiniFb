<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="profilepagestyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"> 
</head>
<body>
<?php
     require_once '_dbcreds.php';
     require_once 'functions.php';
     $con=new mysqli('localhost',$un,$pa,$db);
    
     if($con->connect_error) echo 'Couldnt connect to db';
     else
     {
        $uid=validate_user($con,$_COOKIE['Auth']);
         if($uid==null)
         header("/login_signup.php");
         else
         {
            $res=$con->query("select * from users where uid='$uid';");
            $res=$res->fetch_assoc();
            $uname=$res['uname'];
            $email=$res['email'];
            $res=$con->query("select * from user_profile where uid='$uid';");
            $res=$res->fetch_assoc();
            $hobbies=$res['hobbies'];
            $branch=$res['branch'];
            $sem=$res['sem'];
            $sec=$res['sec'];
            $skills=$res['skills'];
            $pLoc="ppUploads/".$uid.".png";
         }
     }
    ?>

    <!-- Navbar top -->
    <div class="navbar-top">
        <div class="title">
            <h1 style="color:black;">PROFILE</h1>
        </div>

       
       
    </div>

    
           <div class="sidenav">
        <div class="profile">
            <img src=<?php echo $pLoc;?> alt="" width="100" height="100">

            <div class="name">
                <?php echo $uname;?>
            </div>
           
        </div>

        <div class="sidenav-url">
            <div class="url">
                <a href="/homepage.php" class="active">Posts</a>
            </div>
           
        </div>
    </div>
   


    <div class="main">
        <h2 style="color:white;" >IDENTITY</h2>
        <div class="card">
            <div class="card-body">
                <a href="/profile.html"><i class="fa fa-pen fa-xs edit"></i></a>
                <table>
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><?php echo $uname;?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?php echo $email;?></td>
                        </tr>
                        <tr>
                            <td>Hobbies</td>
                            <td>:</td>
                            <td><?php echo $hobbies;?></td>
                        </tr>
                        <tr>
                            <td>Branch</td>
                            <td>:</td>
                            <td><?php echo $branch;?></td>
                        </tr>
                        <tr>
                            <td>Semester</td>
                            <td>:</td>
                            <td><?php echo $sem;?></td>
                        </tr>
                        <tr>
                            <td>Section</td>
                            <td>:</td>
                            <td><?php echo $sec;?></td>
                        </tr>
                        <tr>
                            <td>Skill</td>
                            <td>:</td>
                            <td><?php echo $skills;?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        
    </div>
   
 
</body>
</html>