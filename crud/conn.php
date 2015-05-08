<?php
   $mysql_server_name = 'localhost';//服务器名称
   $mysql_username = 'wy';//链接数据库的用户名
   $mysql_password = 'system';//密码
   $mysql_database = 'book_db';//数据库名

   //链接数据库服务器并选择一个数据库
   $mysql = mysql_connect($mysql_server_name,$mysql_username,$mysql_password);

   if(!$mysql){
    echo "数据库连接错误<br/>";
   }

   if (!mysql_select_db("$mysql_database",$mysql)){
    echo "设置活动数据库失败<br/>";
   }
?>
