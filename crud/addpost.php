<?php
header("refresh:2;url=../index.php");
?>
<title>PHP留言板</title>
<head>
    <link rel="stylesheet" type="text/css" href="../css.css"/>
</head>
<?php
if(''==$_POST[content]){
    echo "请输入留言!";
    exit;
}
    include_once('conn.php');
    //客户端IP
    $ipUserPost = $_SERVER[REMOTE_ADDR];
    //设置标准时区 
    date_default_timezone_set("PRC");
    $timePost=date("Y-m-d H:i:s");
//标准时间转换为时间戳
    if(!$timePost=(strtotime($timePost))){
        echo '时间戳转换失败!';
    }

$content= $_POST[content];
//$content = htmlspecialchars(addslashes($_POST[$content]),ENT_QUOTES,UTF-8);
$content = htmlspecialchars(addslashes($content),ENT_QUOTES,UTF-8);
//echo $content;

if(isset($_POST[secret])){
    $insert = "INSERT INTO T_USER_MESSAGE(message_id,ip_user_post,title,content,time_post,time_last_change) VALUES('','$ipUserPost','$_POST[title]','$content','$timePost','')";
    if(! mysql_query($insert,$mysql)){
        echo "插入数据失败<br/>";
//        exit;
    }
    echo '老王已收到你的秘密留言<br/>2秒后返回！';
}else{
    $insert = "INSERT INTO T_USER_MESSAGE(message_id,ip_user_post,title,content,time_post,time_last_change,lock_message) VALUES('','$ipUserPost','$_POST[title]','$content','$timePost','','1')";
    if(! mysql_query($insert,$mysql)){
        echo "插入数据失败<br/>";
    }
    echo '发布成功<br/>2秒后返回！';

}

//exit;
//    echo $insert;

//        exit;
?>
