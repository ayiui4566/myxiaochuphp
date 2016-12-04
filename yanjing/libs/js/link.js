//删除连接
function del(val){

$.ajax({
type:'post',
url:''+root_url+'admin200911/action_common_admin.php?action=del_link',
data:{id:val},
success:
function(data){
if(data==1){
	jum();
}else{
	alert('操作失败！');
}
}
});
}

//更新连接
function upd(id){
var name = $('#name'+id+'').val();
var url = $('#url'+id+'').val();

$.ajax({
type:'post',
url:''+root_url+'admin200911/action_common_admin.php?action=upd_link',
data:{name:name,url:url,id:id},
success:
function(data){
if(data==1){
	jum();
}else{
	alert('操作失败！');
}
}
});
}

//添加连接
function a_link(){
var name = $('#a_name').val();
var url = $('#a_url').val();

$.ajax({
type:'post',
url:''+root_url+'admin200911/action_common_admin.php?action=add_link',
data:{name:name,url:url},
success:
function(data){
if(data==1){
	jum();
}else{
	alert('操作失败！');
}
}
});
}

function jum(){
location.reload(true);
}