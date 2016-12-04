<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/23
 * Time: 23:15
 */

?>

<!DOCTYPE html>
<html>
<head>
    <title>登陆</title>
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
<div class="panel panel-primary loginPanel">
    <div class="panel-heading">
        <h3 class="panel-title">登陆</h3>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <span class="glyphicon glyphicon-user"></span>
            <input type="username" id="InputUserName" placeholder="UserName">
        </div>
        <div class="form-group">
            <span class="glyphicon glyphicon-lock"></span>
            <input type="password" id="InputPassword" placeholder="Password">
        </div>

        <button type="submit" class="btn btn-default sbtn">Submit</button>
    </div>
</div>


<div id="MsgTip" class="alert alert-warning alert-dismissable hide">
    <p>密码错误</p>
</div>

<script>
    $(function(){

        $("#InputPassword").keydown(function(event){
            if(event.keyCode == 13) {
                login();
            }
        });

        $(".sbtn").click(function(){
            login();
        });


        function login_focus(){
            $("#txtname").focus();
        }

        //登陆检测
        function login(){
            var username = $("#InputUserName").val();
            var userpwd = $("#InputPassword").val();


            if(username=='' || username.length==0){
                $("#MsgTip").myAlert("提示\n\n请输入用户名");
                $("#InputUserName").focus();
                return false;
            }

            if(userpwd=='' || userpwd.length==0){
                $("#MsgTip").myAlert("提示\n\n请输入密码");
                $("#InputPassword").focus();
                return false;
            }

            $.ajax({
                type:"POST",
                url:"action_login.php",
                data:{t_username:username,t_passward:userpwd},
                success:
                    function (data){
                        var status = data;
                        if(status==1){

                            jump_info();
                        }else{
                            $("#MsgTip").myAlert("用户名或密码错误!");
                            $("#InputPassword").val("");
                            $("#InputPassword").focus();

                        }
                    }
            });

        }

        //修改密码检测
        function updatePwd(){
            var t_passward = $("#t_passward").val();
            var t_passward2 = $("#t_passward2").val();

            /*//对电子邮件的验证
             var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
             if(!myreg.test(t_username))
             {
             alert('提示\n\n请输入有效的E_mail！');
             $("#t_username").focus();
             return false;
             }*/
            if(t_passward=='' || t_passward.length==0){
                alert("提示\n\n请输入密码");
                $("#t_passward").focus();
                return false;
            }
            if(t_passward2=='' || t_passward2.length==0){
                alert("提示\n\n请输入确认密码");
                $("#t_passward2").focus();
                return false;
            }
            if(t_passward != t_passward2){
                alert("提示\n\n确认密码不正确");
                $("#t_passward2").focus();
                return false;
            }

            $.ajax({
                type:"POST",
                url:"action_update_user.php",
                data:{t_passward:t_passward},
                success:
                    function (data){

                        if(data==1){

                            alert('提示\n\n修改成功');
                            window.parent.location.href ='index.php';
                        }else{
                            alert('提示\n\n操作失败');
                            $("#txtname").focus();

                        }
                    }
            });

        }

        //跳转到音乐列表
        function jump_info(){
            location.href="index.php";
            //alert("fsdfsdf");
        }
    });
</script>

</body>
</html>