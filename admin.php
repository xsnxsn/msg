<?php
session_start();
include_once('./crud/retrieve.php');
?>
<!DOCTYPE html>
<head lang="zh" xmlns="http://www.w3.org/1999/html">
    <meta charset="UTF-8">
    <title>PHP留言板</title>
        <link rel="stylesheet" type="text/css" href="css.css"/>
        <script src="./jquery.js"></script>
<!--        <script>-->
<!--            $(document).ready(function(){-->
<!--                $(".signin").hide();-->
<!--                $("#login").click(function(){-->
<!--                    $(".signin").fadeToggle();-->
<!--                });-->
<!--            });-->
<!--        </script>-->

    <script>
        function delete_msg(msg_id){
            $(document).ready(function(){
            confirm_ = confirm('确认删除?');
            if(confirm_){
                $.ajax({
                    type:"POST",
                    url:"./crud/delete.php",
                    //name=id
                    data:"id="+msg_id,
                    success:function(msg){
                        location.reload();
//                    $(".ds-comment-body"+msg_id).css("display","none");
//                        $(".search").css("display","none");
//                        alert(msg_id);
//                        alert(msg);
                    }
//                    dataType:"html"
                });
            }
            });


        };
    </script>

    <script>
        function pass_msg(lock_id){
            $(document).ready(function(){
                confirm_ = confirm('确认通过?');
                if(confirm_){
                    $.ajax({
                        type:"POST",
                        url:"./crud/lock.php",
                        //name=id
                        data:"lock="+lock_id,
                        success:function(msg){
                            location.reload();
//                            $("."+msg_id).css("display","none");
//                            alert("成功通过");
//                            alert(msg);

                        }
                    });
                }
            });


        };
    </script>

    </head>

    <?php
    session_start();
    if(!isset($_SESSION['userflag'])) {
        echo "您无权访问";
        echo "请<a href='./index.php'>点击</a>登陆";
        exit;
    }
    ?>
    <a href="./crud/logout.php" id="logout">注销</a>
    <div id="hello">
        <?php echo 你好;echo  $_SESSION['username']; echo "&nbsp"?>
    </div>
<div class="ds-post-main">
   <?php while($row=mysql_fetch_array($info)){?>
    <div class="ds-comment-body" >
    <div class="ds-comment-body<?php echo $row['message_id'] ?>" >
        <div id="ip"><span>
                <?php echo$row['ip_user_post']?></span><?php
            echo date('Y-m-d',$row['time_post']);
            ?>
             审核状态:

             <?php
                if(1==$row['lock_message']){
                    echo "通过";
                }
                else{
                    ?>
<table name="pass" class="pass<?php echo $row['message_id'] ?>">
                    <form method="post" action="crud/lock.php">
                        <input type="hidden" name="lock[]" id="nb" value=<?php echo $row['message_id']?> />
                        <a href="javascript:;"  onclick="pass_msg(<?php echo $row['message_id'] ?>)">通过</a>
<!--                        <input type='submit' name='submit' value='通过'/>-->
                    </form>
                    <?php
                }
             ?>
<!--             <a href='./crud/delete.php?id=--><?php //echo $row['message_id']?><!--'>删除</a>-->

    <a href="javascript:;"  onclick="delete_msg(<?php echo $row['message_id'] ?>)">删除</a>
</table>
        </div>
        <div  class="br">
            <?php
//            echo stripslashes(htmlspecialchars($row['content'],ENT_QUOTES,UTF-8));
            echo($row['content']);
            ?>
        </div>
        <?php
        }
        ?>
        </div>
</div>
</div>
    <div id="for">
    <?php
    for($i=1;$i<=$pagenum;$i++){
    $show=($i!=$page)?"<a href='$self?page=".$i."'> $i </a>":"<b>$i</b>";
    echo $show;
    }
   ?>
        </div>
<!--    <button class ="reply" id="reply"> 回复</button>-->
    <form action="./crud/addpost.php" method="post" class="elegant-aero">
        <h1>留言板
            <span>Please fill all the texts in the fields.</span>
        </h1>

        <label>
            <span>Message :</span>
            <textarea id="content" name="content" placeholder="请输入留言" required oninvalid="setCustomValidity('请输入留言')" oninput="setCustomValidity('')"></textarea>
        </label>
        <label>
            <span>&nbsp;</span>
        </label>
        <input type="submit" class="submit" value="Send" />
       <label> <input type="checkbox" name="secret"/>私密留言(只有管理员能看到)</label>
    </form>

    <div class="search">
        <form method="GET" action="crud/search.php">
            <label>Search：<input type=search name="search" placeholder="Search""/></label>
            <input type="submit" class="submit" value="Send" />
        </form>
    </div>

