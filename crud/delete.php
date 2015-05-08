<?php
session_start();
if(!isset($_SESSION['userflag'])) {
    echo "您无权访问";
    echo "请<a href='../index.php'>点击</a>登陆";
    exit;
}
?>
<?php
//此处要做URL注入检测
    header("refresh:0;url=../index.php");
?>
<title>PHP留言板</title>
<head>
    <link rel="stylesheet" type="text/css" href="../css.css"/>
</head>
 <?php
    session_start();
    include_once('conn.php');
    if(!isset($_SESSION['userflag'])){
        echo "请管理员登陆后删除";
        exit;
    }else{
    $id = $_POST['id'];
        echo $id;
    $delete = "DELETE FROM T_USER_MESSAGE WHERE message_id = $id";
//    echo '删除成功<br/>';
    if (!mysql_query($delete,$mysql)){
        echo "删除失败!";
    }
}
?>
