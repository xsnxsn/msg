<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PHP留言板</title>
</head><body>
<?php
//权限控制
//不同权限不同显示
if(!isset($_SESSION['userflag'])){
    $rights="2";
}elseif($_SESSION['userflag']==2){
    $rights="1";
}

$data=array("1"=>"admin.php",
    "2"=>"guest.php",
);
$tmp=$p="";
foreach($data as $val){
    $tmp.=$p.$val;
    $p=",";
}
$data["0"]=$tmp;
//合成超级权限显示的数据，合成的语言是方便扩展，不用亲自去定义超级权限对应的数据
//字符串分割成数组
$rights=explode(",",$rights);//分割权限
foreach($rights as $val){
    //  echo $val;
    $val=explode(",",$data[$val]);
    foreach($val as $file)
        include($file);//根据权限输出数据
    //用数组输出方便扩展，避免烦人的各种判断if或switch，你现在需要修改的仅仅是right
}
?>
</body>
</html>