<?php
    include_once('conn.php');
    $list = 10;//每页显示数量
    $query = "SELECT * FROM T_USER_MESSAGE";
    $result = mysql_query($query,$mysql);

    if(!$result){
        echo '查询数据库错误!';    
    }

    $num = mysql_num_rows($result);
//////////////////////////////////////////////////////////
    //获取page的值，如不存在设为1
    $page=($_GET['page']?intval($_GET['page']):1);
    //页面数
    $pagenum=ceil($num/$list);
    //page越界就返回首第一页
    if(($_GET['page'])>$pagenum){
        $page = 1;
    }

   $offset=($page-1)*$list;//获取limit的第一个参数的值offset,分页的第一个参数的数字
    $info=mysql_query("SELECT * FROM T_USER_MESSAGE ORDER BY message_id DESC  LIMIT $offset,$list");

    if(!$info){
        echo '查询数据库错误!';    
    }

    /***************************************************/

    //显示审核通过的条目
   $lock_offset=($page-1)*$list;//获取limit的第一个参数的值offset,分页的第一个参数的数字
    $cl=mysql_query("SELECT * FROM T_USER_MESSAGE WHERE lock_message=1");
    $lock_info=mysql_query("SELECT * FROM T_USER_MESSAGE WHERE lock_message=1 ORDER BY message_id DESC LIMIT $lock_offset,$list");

    $lock_num = mysql_num_rows($cl);

    $lock_pagenum=ceil($lock_num/$list);
    if(!$lock_info){
        echo '查询数据库错误！';
    }
    /***************************************************/
    //显示待审核条目
   $locked_offset=($page-1)*$list;//获取limit的第一个参数的值offset,分页的第一个参数的数字
 $co=mysql_query("SELECT * FROM T_USER_MESSAGE WHERE lock_message=0 ");
 $locked_info=mysql_query("SELECT * FROM T_USER_MESSAGE WHERE lock_message=0 ORDER BY message_id DESC LIMIT $locked_offset,$list");
    //
    $locked_num = mysql_num_rows($co);

    $locked_pagenum=ceil($locked_num/$list);
    if(!$locked_info){
        echo '查询数据库错误！';
    }
?>
