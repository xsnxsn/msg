<?php
    session_start();

    include_once('conn.php');
 /*   if(!isset($_SESSION['userflag'])){
        echo '请登录';
        exit;
    }*/
header("refresh:2;url=../index.php");

?>
<title>PHP留言板</title>
<head>
    <link rel="stylesheet" type="text/css" href="../css.css"/>
</head>

<?php
if(''==$_POST[name]||''==$_POST[password]){
    echo "请输入用户名密码";
    exit;
}
    $username = $_POST['name'];
    $password = $_POST['password'];
//得到处理过的特殊字符串 因为特殊字符不允许注册,能防范一定攻击
$username = htmlspecialchars(addslashes($username),ENT_QUOTES,UTF-8);
//echo $username;
$password = htmlspecialchars(addslashes($password),ENT_QUOTES,UTF-8);

    $query = mysql_query("SELECT uuid,permission FROM T_USER_LOGIN WHERE username='$username' and password='$password' limit 1",$mysql);
    if($result = mysql_fetch_array($query)){
        #print_r($result);

        //存入session
        $_SESSION['username'] = $username;
        $_SESSION['uuid'] = $result['uuid'];
        $_SESSION['userflag'] = $result['permission'];
        if($_SESSION['userflag']==1 or $_SESSION['userflag']==2){
            echo '欢迎回来';
            echo $_SESSION['username'];
            echo "<br/>";
            echo "正在跳转。。。";
        }else{
            echo "无权限";
        }
   
    }else{ 
            echo "错误的用户名或者密码";
 }
    /*  
    //注销登陆
    echo action;
    if($_GET['action']=='logout'){
        unset($_SESSION['uuid']);
        unset($_SESSION['username']);
        echo "注销成功,点击<a href='../login.php'>登陆</a>";
        exit;
    }*/
?>
