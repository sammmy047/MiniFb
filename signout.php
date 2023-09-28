<?php
if (isset($_COOKIE["Auth"])){
		setcookie("Auth",'', time() - (3600));
  }
  header("Location: http://localhost/index.html");
 ?>
