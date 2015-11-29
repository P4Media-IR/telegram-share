<?php
session_start();

$userCaptcha = strtoupper($_POST['captcha']);



include('config.php');
if(isset($_POST['telegram_me']))
{
$newchat = test_input($_POST['telegram_me']);


$telegram =mysql_real_escape_string($newchat) ;

if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$telegram))
{
header("Location:index.php?EmailError=1");
}
$check = mysql_query('SELECT * FROM `tbl_tm` WHERE `telegram_me` = ("'.$telegram.'")');

if(mysql_num_rows($check) >=1)
{
header('Location:index.php?submit=3');

}else{
$result = mysql_query('INSERT `tbl_tm` (`telegram_me`) VALUES ("'.$telegram.'")') OR die(mysql_error());
if($result){
header('Location:index.php?submit=1');
}
else{
header('Location:index.php?submit=0');

}
}
}else{

header("Location:index.php?error=1");
}

function test_input($data)
{
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}

?>
