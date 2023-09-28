
<?php
    require_once '_dbcreds.php';
    require_once 'functions.php';
    $con=new mysqli('localhost',$un,$pa,$db);
    if($con->connect_error) echo 'Couldnt connect to db';
    else
    {
        if(validate_user($con,$_COOKIE['Auth'])==null)
        header("Location: http://localhost/login_signup.php");
    }
  
        $uid=validate_user($con,$_COOKIE['Auth']);
        if($uid==null)
        header("/login_signup.php");
        else
        {
           $res=$con->query("select * from users where uid='$uid';");
           $res=$res->fetch_assoc();
           $email=$res['email'];
           $uname=$res['uname'];
           $pLoc="ppUploads/".$uid.".png";
        }
   ?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="homePage.css" />
    <title>MINI FACEBOOK</title>
  </head>
  <body>
    <div class="header">
     
        <!---<h1 style="color:black;margin-left:1%;">MINI FACEBOOK</h1>-->
      <div class="header__right">
        <div class="headerOption">

          <i class="material-icons headerOption__icon"> home </i>
          <a href="homepage.php" style="color:black;">Home</a>
        </div>
        <div class="headerOption">
          <i class="material-icons headerOption__icon"> account_circle </i>
          <a href="mainPage.php" style="color:black;">Me</a>
        </div>
        <div class="headerOption">
            <i class="material-icons headerOption__icon" > logout</i>
            <a href="signout.php" style="color:black;">Signout</a>
          </div>
          
      </div>
    </div>

    <div class="body__main">
      <div class="wrapper">
       <div class = "sidebar">
        
          
        <div class="profile">
        <img src=<?php echo $pLoc;?> alt="" />
        <h2><?php echo $uname;?></h2>
          <h4><?php echo $email;?></h4>
          <h3 style="color:black">Create post <a href='create_post.html'>here</a><h3>
        </div>

        
        </div>

  
      <div class="feed">
        <div class="feed__inputContainer">
            <div class="title"><strong>SUB POSTS</strong></div>

            <?php
 require_once '_dbcreds.php';
 require_once 'functions.php';
 $con=new mysqli('localhost',$un,$pa,$db);
 if($con->connect_error) echo 'Couldnt connect to db';
 else
 {
     if(validate_user($con,$_COOKIE['Auth'])==null)
     header("Location: http://localhost/login_signup.php");
     else
     {
        $pid=$_GET['post'];
        $q=$con->query("select * from posts where pid='$pid'");
        $res=$con->query("select * from subposts where pid='$pid';");
        $uid=$con->query("select uid from posts where pid='$pid'")->fetch_assoc()['uid'];
        $qq=$con->query("select uname from users where uid='$uid'");
        $dop=$q->fetch_assoc()['dop'];
        $q=$con->query("select * from posts where pid='$pid'"); 
        echo '<div style="background-color:gold;" class="post">
        <div class="post__header">
          <div class="post__info" id="un">
            '.$qq->fetch_assoc()['uname'].' @ '.$dop.'</h2>
          </div>
        </div>
    
        <div class="post__body">
          <p>'.$q->fetch_assoc()['t'].'</p>
        </div></div>';
        while($row=mysqli_fetch_assoc($res))
        {
            $uid=$row['uid'];
            $dop=$row['dop'];
            $uname=$con->query("select uname from users where uid='$uid';");
           # echo "<h3>".$uname->fetch_assoc()['uname']." : ".$row['t']."</h3>";
            echo '<div class="post">
            <div class="post__header">
              <div class="post__info" id="un">
                '.$uname->fetch_assoc()['uname'].' @ '.$dop.'</h2>
              </div>
            </div>
        
            <div class="post__body">
              <p>'.$row['t'].'</p>
            </div></div>
            <form>
            <input type="hidden" name="post" value='.$row['pid'].'>
            </form>
            ';
        }
        echo '<br><form action="subpostP.php" method="get">
        <input type="hidden" name="post" value='.$pid.'>
        <textarea  style="width:500px;height:300px" name="con"></textarea><br>
        <input style=" margin-top:0.1em;
        padding:0.5em;
        background-color: wheat;
        color:black;" type="submit" value="Comment">
        </form>';

     }
 }

?>
  </div>
    
  </body>
</html>

