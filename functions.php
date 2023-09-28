<?php
function sanitize($c,$s)
{
    return $c->real_escape_string($s);
}
function setupCookie($con,$uid)
{
    //gen only if not expired
    $res=$con->query("select * from user_session where uid='$uid'");
    if(mysqli_num_rows($res)!=0)    //~None
    {
        $currCook=$res->fetch_assoc()['exp'];
        if(strtotime($currCook)>time()) 
        {
            $res=$con->query("select * from user_session where uid='$uid'");
            setcookie('Auth',$res->fetch_assoc()['cook'],strtotime($currCook),'/');
            //display("Login success <a href='/profile.php'>p</a>"); 
            header("Location: http://localhost/mainPage.php"); 
        }
        else 
            goto regenCook;
        
        exit(0);
    }
    else
    display("Session expired <a href='/login.php'> login again </a>");

    
    regenCook:
            $cook=bin2hex(random_bytes(20));

    $res=$con->query("select uid from user_session where cook='$cook'");
    if(mysqli_num_rows($res)!=0) goto regenCook;
    
    date_default_timezone_set('Asia/Calcutta');
    
    $exp=time()+60*60;
    setcookie('Auth',$cook,$exp,'/');

    $ts=date("y-m-d G:i",strtotime('+1 hours'));
    //if already exists,u else i
    $res=$con->query("select uid from user_session where uid='$uid'");
        
    if(mysqli_num_rows($res)==0)
        $res=$con->query("insert into user_session values('$uid','$cook','$ts')");
    else
        $res=$con->query("update user_session set cook='$cook',exp='$ts' where uid='$uid'");
        
}

function display($ms)
{
    echo "<body style='color:white;font-size:50;background-color:#23242a;'><center><b>".strtoupper($ms)."</b></center></body>";
}

function validate_user($con,$cook)
{
    $res=$con->query("select * from user_session where cook='$cook'");
    if(mysqli_num_rows($res)>0)
    {
        //if($res->fetch_assoc()['exp'])
        return $res->fetch_assoc()['uid'];
    }
    return null;
}
function lORs()
{
    display("Please <a href='/login.html'>login</a> or <a href='/signup.html'>sign up</a>");
}
?>