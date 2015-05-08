<?php 
   session_start();
    header("refresh:2;url=../index.php");
//    echo $_SESSION['uuid'];
    unset($_SESSION['uuid']);
    unset($_SESSION['username']);
    session_destroy();
    echo "注销成功,正在跳转。。。";
?>
<title>PHP留言板</title>
<head>
    <link rel="stylesheet" type="text/css" href="../css.css"/>
</head>
