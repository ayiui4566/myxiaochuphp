/*****************
*后台登陆
******************/

//加载界面聚焦文本框
String.prototype.Trim = function()    
{    
   return this.replace(/(^\s*)|(\s*$)/g, "");    
}    

function login_focus(){
	$("#txtname").focus();
}

//登陆检测
function login(){
	var username = $("#txtname").val();
	var userpwd = $("#txtpwd").val();
	
	
	if(username=='' || username.length==0){
		alert("提示\n\n请输入用户名");
		$("#txtname").focus();
		return false;
	}

	if(userpwd=='' || userpwd.length==0){
		alert("提示\n\n请输入密码");
		$("#txtpwd").focus();
		return false;
	}
	
	$.ajax({
		type:"POST",
		url:"action_login_user.php",
		data:{t_username:username,t_passward:userpwd},
		success:
		function (data){
			var status = data.Trim();
			if(status==1){
				
				jump_info();
			}else{
				alert('用户名或密码错误!');
				$("#txtpwd").val("");
				$("#txtname").focus();
				
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