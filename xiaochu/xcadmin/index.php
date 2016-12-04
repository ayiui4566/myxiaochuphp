<?php
session_start();

if(!$_SESSION['adminLogin']){
    echo "<script>";
    echo "location.href='login.php';";
    echo "</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>消除游戏后台管理系统</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="js/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="js/bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="js/my.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/my.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">甜品消消乐</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">用户</a></li>
                <li ><a href="loseCause.php">关卡失败率</a></li>
                <li><a href="upay.php">付费信息</a></li>
                <li><a href="sendGemMail.php">运营活动</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container webconcent">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">u_user</h3>
        </div>
        <div class="panel-body">
            <div class="input-group">
                <span class="input-group-addon span_key" id="basic-addon1">UserId</span>
                <input type="text" class="form-control u_Id" aria-describedby="basic-addon1">
            </div>
            <div class="input-group">
                <span class="input-group-addon span_key" id="basic-addon1">nick</span>
                <input type="text" class="form-control u_nick" aria-describedby="basic-addon1">
            </div>
            <div class="input-group">
                <span class="input-group-addon span_key" id="basic-addon1">level</span>
                <input type="text" class="form-control u_level" aria-describedby="basic-addon1">
            </div>
            <div class="input-group">
                <span class="input-group-addon span_key" id="basic-addon1">gold</span>
                <input type="text" class="form-control u_gold" aria-describedby="basic-addon1">
            </div>
            <div class="input-group">
                <span class="input-group-addon span_key" id="basic-addon1">gems</span>
                <input type="text" class="form-control u_gems" aria-describedby="basic-addon1">
            </div>
            <div class="input-group">
                <button type="submit" class="btn btn-primary sbtn22">Find</button>
                <button type="submit" class="btn btn-primary sbtn23">update</button>
                <button type="submit" class="btn btn-primary sbtn24">清除memcache缓存</button>
            </div>
        </div>

    </div>

</div><!-- /.container -->

<div id="MsgTip" class="alert alert-warning alert-dismissable hide">
    <p>密码错误</p>
</div>

<script>
    $(function(){
        $('.sbtn23').attr('disabled',true);
        $(".sbtn22").click(function(){
            find();
            $('.sbtn23').attr('disabled',false);
        });
        $(".sbtn23").click(function(){
            update();
        });
        $(".sbtn24").click(function(){
            $.ajax({
                type:"POST",
                url:"action_flushall.php",
                data:{},
                success:
                    function (data){
                        var status = data;
                        if(status==-1){
                            $("#MsgTip").myAlert("清理失败!");

                        }else{
                            $("#MsgTip").myAlert("清理成功!");
                        }
                    }
            });
        });

        function login_focus(){
            $("#txtname").focus();
        }

        //find
        function find(){
            var u_Id = $(".u_Id").val();

            if(u_Id=='' || u_Id.length==0){
                $("#MsgTip").myAlert("提示\n\nUserId不能为空");
                $(".u_Id").focus();
                return false;
            }

            $.ajax({
                type:"POST",
                url:"action_updateData.php",
                data:{operate:'Find',u_Id:u_Id},
                success:
                    function (data){
                        var status = data;
                        if(status==-1){
                            $("#MsgTip").myAlert("没有此用户!");
                            $(".u_Id").focus();
                            $(".u_nick").val('');
                            $(".u_level").val('');
                            $(".u_gold").val('');
                            $(".u_gems").val('');
                        }else{
                            var obj = JSON.parse(data);
                            $(".u_nick").val(obj.nick);
                            $(".u_level").val(obj.level);
                            $(".u_gold").val(obj.gold);
                            $(".u_gems").val(obj.gems);
                        }
                    }
            });

        }

        //find
        function update(){
            var u_Id = $(".u_Id").val();
            var u_nick = $(".u_nick").val();
            var u_level = $(".u_level").val();
            var u_gold = $(".u_gold").val();
            var u_gems = $(".u_gems").val();
            //alert(u_gems);

            if(u_Id=='' || u_Id.length==0){
                $("#MsgTip").myAlert("提示\n\nUserId不能为空");
                $(".u_Id").focus();
                return false;
            }

            $.ajax({
                type:"POST",
                url:"action_updateData.php",
                data:{operate:'submit',u_Id:u_Id,u_nick:u_nick,u_level:u_level,u_gold:u_gold,u_gems:u_gems},
                success:
                    function (data){
                        var status = data;
                        if(status==-1){
                            $("#MsgTip").myAlert("没有此用户!");
                            $("#u_Id").focus();
                        }else{
                            $("#MsgTip").myAlert("更新成功!");
                        }
                    }
            });

        }




    });

</script>

</body>
</html>