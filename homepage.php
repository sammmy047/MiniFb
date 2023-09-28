
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
            <div class="title"><strong>POSTS</strong></div>

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
                      $res=$con->query("select * from posts order by pid desc;");
                          while($row=mysqli_fetch_assoc($res))
                          {
                            $msg=$row['t'];
                            $uid=$row['uid'];
                            $dop=$row['dop'];
                            $user=$con->query("select uname from users where uid='$uid';  ");
                            echo '<div class="post">
                            <div class="post__header">
                              <div class="post__info" id="un">
                                '.$user->fetch_assoc()['uname'].' @ '.$dop.'</h2>
                              </div>
                            </div>
                        
                            <div class="post__body">
                              <p>'.$msg.'</p>
                            </div></div>
                            <form action="subpost.php" method="GET">
                            <input type="hidden" name="post" value='.$row['pid'].'>
                            <input id="comment" type="submit" value="COMMENT"></input>
                            </form>
                            ';
                          }
                        
                     }
                    
                    else
                    display("No posts yet !!! /n Create one <a href='create_post.php'>here</a>");
                    
                }
                else
                lORs();
            }
            ?>
  </div>
    
  </body>
</html>

