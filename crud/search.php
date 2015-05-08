<?php
//session_start();
include_once('conn.php');
?>
<title>PHP留言板</title>
<head>
    <link rel="stylesheet" type="text/css" href="../css.css"/>
    <script src="../jquery.js"></script>

</head>
<?php
if($_GET['search']==''){
    echo '请输入你所要查询的内容!';
    ?>
    <a href="../index.php" >返回</a>
    <?php
    exit;
}

$search = $_GET['search'];
//存储的数据是处理过的数据,此处在防范注入的同时将这些数据内容同步格式化,避免了无法查询特殊字符
$search = htmlspecialchars(addslashes($search),ENT_QUOTES,UTF-8);

echo $search;
//$search = htmlspecialchars(($search),ENT_QUOTES,UTF-8);
//$search = addslashes($search);
//echo $search;
//$query = "SELECT * FROM T_USER_MESSAGE WHERE lock_message='1' AND(title LIKE '%$search%' OR content LIKE '%$search%')";
//$search = (mysql_query($query,$mysql));
//if (!$search){
//    echo "查询出错!";
//}

$list=10;

$query = ("SELECT * FROM T_USER_MESSAGE WHERE lock_message='1'AND(title LIKE '%$search%' OR content LIKE '%$search%')");

//得到结果集
$num=mysql_query("$query");
//查询审核通过的条目数量
$num = mysql_num_rows($num);
//获取page的值，如不存在设为1
$page=($_GET['page']?intval($_GET['page']):1);
//页面数
$pagenum=ceil($num/$list);
//page越界就返回首第一页
if(($_GET['page'])>$pagenum){
    $page = 1;
}

//每页展示的数目
$search_pagenum=ceil($num/$list);

$offset=($page-1)*$list;//获取limit的第一个参数的值offset,分页的第一个参数的数字

$s_query = ("SELECT * FROM T_USER_MESSAGE WHERE lock_message='1'AND(title LIKE '%$search%' OR content LIKE '%$search%') ORDER BY message_id DESC LIMIT $offset,$list");
$search_b = (mysql_query($s_query,$mysql));
if (!$search_b){
    echo "查询出错!";
}

?>

    <div class="ds-post-main">
        <?php while($row=mysql_fetch_array($search_b)){?>
        <div class="ds-comment-body">

            <div id="ip"><span>
                <?php echo$row['ip_user_post']?> Says:</span><?php
                echo date('Y-m-d',$row['time_post']);
                ?>
            </div>
            <div id="hrs">
                <?php
                echo $row['content'];
                echo"<br/>";
                echo"<br/>";
                }
                ?>
            </div>
        </div>
    </div>
    <div id="for">
        <?php
        for($i=1;$i<=$search_pagenum;$i++){
            $show=($i!=$page)?"<a href='$self?page=".$i."&search=".$search."'>$i</a>":"<b>$i</b>";
            echo $show;
        }
        ?>
        <a href="../index.php" >返回主页</a>
    </div>

    <div class="search">
        <form method="GET" action=<?php echo $_SERVER['PHP_SELF']?>
            <label>Search：<input type=search name="search" placeholder="Search""/></label>
            <input type="submit" class="submit" value="Send" />
        </form>
    </div>
