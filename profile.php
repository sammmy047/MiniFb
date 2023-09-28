
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
   
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile setup</title>
</head>
<body>
<form method='POST' action='set_up_profile.php' enctype='multipart/form-data' >
    <h1>Set up your profile</h1>
    <input type='file' name='pp' accept='image/png'/>
    <input type="text" name='hobbies'/>
    <input type="text" name='branch'/>
    <input type="text" name='semester'/>
    <input type="text" name='section'/>
    <input type="text" name='skills'/>
    <input type='submit' value='Upload' >
    </form>
</body>
</html>