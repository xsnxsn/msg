<?php
session_start();
?>
<title>PHP留言板</title>
<head>
    <link rel="stylesheet" type="text/css" href="../css.css"/>
</head>
<?php
if(!isset($_SESSION['userflag'])) {
    echo "您无权访问";
    echo "请<a href='./index.php'>点击</a>登陆";
    exit;
}
?>
<?php
include_once('conn.php');
header("refresh:0;url=../index.php");

if($_POST['lock']){
    $lock_id = $_POST['lock'];
    $upLock = "UPDATE T_USER_MESSAGE T SET T.lock_message=1 WHERE message_id=$lock_id";
    if(! mysql_query($upLock,$mysql)){
        echo "审核错误<br/>";
    }
}
//
//if($_POST['lock']){
//    foreach($_POST['lock']as $lock_id){
//        $upLock = "UPDATE T_USER_MESSAGE T SET T.lock_message=1 WHERE message_id=$lock_id";
//        if(! mysql_query($upLock,$mysql)){
//            echo "审核错误<br/>";
//        }
//
//    }
//        echo "审核完毕。。。";
//}else{
//    echo "请选择用户留言";
//}

?>
