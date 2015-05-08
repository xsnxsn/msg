<?php
    include_once('conn.php');
if(''==$_POST[pwd]||''==$_POST[name]){
    echo "请输入用户名密码";
    exit;

}
    //客户端IP
    $ipReg = $_SERVER[REMOTE_ADDR];
    //设置标准时区 
    date_default_timezone_set("PRC");
    $timeReg = date("Y-m-d H:i:s");

    $insert ="INSERT INTO T_USER_LOGIN(username,password,ip_reg,time_reg)VALUES('$_POST[name]','$_POST[pwd]','$ipReg','$timeReg')";
    echo $insert;
    if(! mysql_query($insert,$mysql)){
        echo "用户注册失败<br/>";
    }

?>
