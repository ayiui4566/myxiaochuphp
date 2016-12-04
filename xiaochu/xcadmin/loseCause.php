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
                <li class="active"><a href="loseCause.php">关卡失败率</a></li>
                <li><a href="upay.php">付费信息</a></li>
                <li><a href="sendGemMail.php">运营活动</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container webconcent">
    <p>目前总玩家数量为：<span id="span2"></span><button type="submit" class="btn btn-primary clearBtn">清空表</button></p>
    <table id="dg12" class="easyui-datagrid" title="关卡失败率" style="width:580px;height:700px"
           data-options="singleSelect:true,collapsible:true,
				remoteSort:false,
				multiSort:true
			">
        <thead>
        <tr>
            <th data-options="field:'level',width:50,sortable:false">关卡ID</th>
            <th data-options="field:'passusers',width:80,sortable:false">通过人数</th>
            <th data-options="field:'subusers',width:80,sortable:false">递减人数</th>
            <th data-options="field:'total',width:80">总次数</th>
            <th data-options="field:'percent',width:100,sortable:false">失败率</th>
            <th data-options="field:'reason',width:150,align:'left'">原因(类型|失败次数)</th>
        </tr>
        </thead>
    </table>


</div><!-- /.container -->

<div id="MsgTip" class="alert alert-warning alert-dismissable hide">
    <p>密码错误</p>
</div>

<script>
    $(function(){
        $.ajax({
            type:"POST",
            url:"action_loseCause.php",
            success:
                function (data){
                    var status = data;
                    if(status==-1){
                        $("#MsgTip").myAlert("服务器出错!");

                    }else{
                        var obj = JSON.parse(data);
                        $('#dg12').datagrid({data:obj});
                        $('#span2').text(obj.usersno);
                    }
                }
        });

        $(".clearBtn").click(function() {
            $.ajax({
                type:"POST",
                url:"action_loseCause_clear.php",
                success:
                    function (data){
                        var status = data;
                        if(status==-1){
                            $("#MsgTip").myAlert("服务器出错!");

                        }else{
                            $("#MsgTip").myAlert("已清空!"+status);
                        }
                    }
            });
        });


    });

</script>

</body>
</html>