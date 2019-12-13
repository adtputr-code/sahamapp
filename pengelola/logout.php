<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('id','',time()-3600*24*30*12);
setcookie('key','',time()-3600*24*30*12);

header("Location: login.php");
exit;
?>
