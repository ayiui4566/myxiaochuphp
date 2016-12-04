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
    <link rel="stylesheet" href="js/easyui/themes/bootstrap/easyui.css">
    <link rel="stylesheet" href="js/easyui/themes/icon.css">
    <link rel="stylesheet" href="js/my.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/easyui/jquery.easyui.min.js"></script>
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
                <li ><a href="index.php">用户</a></li>
                <li ><a href="loseCause.php">关卡失败率</a></li>
                <li><a href="upay.php">付费信息</a></li>
                <li class="active"><a href="sendGemMail.php">运营活动</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container webconcent">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">清档</h3>
        </div>
        <div class="panel-body">
            <button type="submit" class="btn btn-primary sbtn_all sbtn1">开始</button>
        </div>

    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">送钻石,到邮箱里</h3>
        </div>
        <div class="panel-body">
            <div class="input-group">
                <span class="input-group-addon span_key" id="basic-addon1">UserId</span>
                <input type="text" class="form-control u_Id" aria-describedby="basic-addon1">
                <span class="input-group-addon span_key" id="basic-addon1">数量</span>
                <input type="text" class="form-control gem_num" aria-describedby="basic-addon1">
            </div>
            <button type="submit" class="btn btn-primary sbtn_all sbtn2">送钻石</button>
            <button type="submit" class="btn btn-primary sbtn_all sbtn3">全服送钻石</button>
        </div>

    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">每次送10颗心,到邮箱里</h3>
        </div>
        <div class="panel-body">
            <div class="input-group">
                <span class="input-group-addon span_key" id="basic-addon1">UserId</span>
                <input type="text" class="form-control u_Id2" aria-describedby="basic-addon1">
            </div>
            <button type="submit" class="btn btn-primary sbtn_all sbtn4">送心</button>
        </div>

    </div>
    <div class="panel panel-default">

        <div class="panel-heading">
            <h3 class="panel-title">生成cdk新手侻换码</h3>
        </div>
        <div class="panel-body">
            <div class="input-group">
                <span class="input-group-addon span_key" id="basic-addon1">数量</span>
                <input type="text" class="form-control generateNum" aria-describedby="basic-addon1">
            </div>
            <button type="button" class="btn btn-primary sbtn_all sbtn5">生成</button>
            <button type="button" class="btn btn-primary sbtn_all sbtn6">生成txt</button>
        </div>

    </div>



</div><!-- /.container -->

<div id="MsgTip" class="alert alert-warning alert-dismissable hide">
    <p>密码错误</p>
</div>

<script>
    $(function(){
        $(".sbtn1").click(function(){
            if(confirm("确定清空所有玩家信息吗？")){
                $.ajax({
                    type:"POST",
                    dataType:"json",
                    url:"action_sendMail.php",
                    data:{operate:'clearall'},
                    success:
                        function (data){
                            var status = data;
                            if(status==-1){
                                $("#MsgTip").myAlert(data.msg);
                                $("#u_Id").focus();
                            }else{
                                $("#MsgTip").myAlert("清档成功!");
                            }
                        }
                });
            }
        });

        $(".sbtn2").click(function(){
            //find

            var u_Id = $(".u_Id").val();
            var num = $(".gem_num").val();
            //alert(u_gems);

            if(u_Id=='' || u_Id.length==0){
                $("#MsgTip").myAlert("提示\n\nUserId不能为空");
                $(".u_Id").focus();
                return false;
            }

            $.ajax({
                type:"POST",
                dataType:"json",
                url:"action_sendMail.php",
                data:{operate:'gem',u_Id:u_Id,num:num},
                success:
                    function (data){
                        var status = data.status;
                        if(status==-1){
                            $("#MsgTip").myAlert(data.msg);
                        }else{
                            $("#MsgTip").myAlert("发送成功!");
                        }
                    }
            });
        });

        $(".sbtn3").click(function(){
            //find

            var num = $(".gem_num").val();
            //alert(u_gems);

            $.ajax({
                type:"POST",
                dataType:"json",
                url:"action_sendMail.php",
                data:{operate:'gem_all',num:num},
                success:
                    function (data){
                        var status = data.status;
                        if(status==-1){
                            $("#MsgTip").myAlert(data.msg);
                            $("#u_Id").focus();
                        }else{
                            $("#MsgTip").myAlert("发送成功!");
                        }
                    }
            });
        });

        $(".sbtn4").click(function(){
            //find

            var u_Id = $(".u_Id2").val();
            //alert(u_gems);

            if(u_Id=='' || u_Id.length==0){
                $("#MsgTip").myAlert("提示\n\nUserId不能为空");
                $(".u_Id2").focus();
                return false;
            }

            $.ajax({
                type:"POST",
                dataType:"json",
                url:"action_sendMail.php",
                data:{operate:'life',u_Id:u_Id,num:10},
                success:
                    function (data){
                        var status = data.status;
                        if(status==-1){
                            $("#MsgTip").myAlert(data.msg);
                            $("#u_Id").focus();
                        }else{
                            $("#MsgTip").myAlert("发送成功!");
                        }
                    }
            });
        });

        $(".sbtn5").click(function(){
            var uNum = $(".generateNum").val();
            //find
            $.ajax({
                type:"POST",
                dataType:"json",
                url:"action_sendMail.php",
                data:{operate:'generateCode',num:uNum},
                success:
                    function (data){
                        var status = data.status;
                        if(status==-1){
                            $("#MsgTip").myAlert(data.msg);
                            $("#u_Id").focus();
                        }else{
                            $("#MsgTip").myAlert("生成成功!");
                        }
                    }
            });
        });
        $(".sbtn6").click(function(){
            var uNum = $(".generateNum").val();
            if(uNum>0){
                window.open('getcodeTxt.php?num='+uNum);
            }
//            $.get('test.php',{operate:'gotxt',num:uNum});

            //find
//            $.get({
//                type:"GET",
//                url:"action_sendMail.php",
//                data:{operate:'gotxt',num:uNum},
//                success:
//                    function (data){
//                        var status = data;
//                        if(status==-1){
//                            $("#MsgTip").myAlert("没有此用户!");
//                            $("#u_Id").focus();
//                        }else{
//                            $("#MsgTip").myAlert(status);
//                        }
//                    }
//            });
        });





    });

</script>

</body>
</html>