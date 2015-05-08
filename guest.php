    <?php
    include_once('./crud/retrieve.php');
    ?>
    <!DOCTYPE html>
    <head>
        <title>PHP留言板</title>
        <link rel="stylesheet" type="text/css" href="css.css"/>
        <script src="./jquery.js"></script>
        <script>
            $(document).ready(function(){
                $(".signin").hide();
                $("#login").click(function(){
                    $(".signin").fadeToggle();
                });
            });
        </script>
<!--        <script>-->
<!--            $(document).ready(function(){-->
<!--                $("button").click(function() {-->
<!--//                    e.preventDefault();-->
<!--                    var id = encodeURI($("#name").val());-->
<!--                    var pwd = encodeURI($("#password").val());-->
<!--//                    var url = "./crud/login.php";-->
<!--                    $.ajax(-->
<!--                        {//请求登陆处理页-->
<!--                            url:"./crud/login.php"//登陆处理页面-->
<!--                            dataType:"html",-->
<!--                            //传送请求数据-->
<!--                            data:{name:id,password:pwd},-->
<!--                            sussess:function(strValue){-->
<!--                                if(strValue=="True")-->
<!--                                $(".clsShow").html("登陆成功！"+strValue);-->
<!--                            }-->
<!--                            else{-->
<!--                                $("#").show().html("错误！",+strValue);-->
<!--                            }-->
<!--                        }-->
<!--                    }-->
<!--                    )-->
<!--                });-->
<!--        </script>-->
    </head>

    <a href="javascript:;" id="login">登录</a>
    <div class="signin">
        <div class="border start">
            <form method="post" action="./crud/login.php">
                <label for="name">用户名</label>
                <input name="name" id="name" type="text" placeholder="Username"  required oninvalid="setCustomValidity('请输入用户名')" oninput="setCustomValidity('')"/>
                <label for="password">密码</label>
                <input name="password" type="password"id="password" placeholder="Password"required oninvalid="setCustomValidity('请输入密码')" oninput="setCustomValidity('')"/>
<!--                <button type="button" id="dl">LOG IN</button>-->
                <input type="submit" id="dl" value="LOG IN"/>
            </form>
        </div>
    </div>

    <?php
    $p= $_POST['username'];
    echo "$p";
    ?>

    <div class="ds-post-main">
        <?php while($row=mysql_fetch_array($lock_info)){?>
        <div class="ds-comment-body">
            <div id="ip"><span><?php echo preg_replace('/(\d+)\.(\d+)\.(\d+)\.(\d+)/is',"$1.$2.*.*",$row['ip_user_post']); ?></span><?php
                echo date('Y-m-d',$row['time_post']);
                ?>
            </div>
            <div  class="br">
            <?php
//            echo htmlspecialchars($row['content'],ENT_QUOTES,UTF-8);
            echo $row['content'];
            ?>
            </div>
            <?php
            }
            ?>
        </div>
    </div>

    <div id="for">
        <?php
        for($i=1;$i<=$lock_pagenum;$i++){
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
         <input type="checkbox" name="secret" id="secret"/>
        <label for="secret">    私密留言(只有管理员能看到)</label>
    </form>

    <div class="search">
        <form method="GET" action="crud/search.php">
            <label>Search：<input type=search name="search"  placeholder="Search""/></label>
            <input type="submit" class="submit" value="Send" />
        </form>
    </div>
