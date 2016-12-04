<?php
require_once '../Amfphp/app/util/Mpdo.class.php';
require_once '../Amfphp/app/util/StringUtil.class.php';
require_once "../Amfphp/app/UserModel.class.php";
require_once "../Amfphp/app/UserMailModel.class.php";
require_once "../Amfphp/app/MsgModel.class.php";
require_once "../Amfphp/app/UserOtherModel.class.php";
require_once "../Amfphp/app/UserLevelInfoModel.class.php";
require_once "../Amfphp/app/InviteModel.class.php";
require_once "../Amfphp/app/LoseCause.class.php";
require_once "../Amfphp/app/GameConfig.class.php";
require_once "../Amfphp/app/Services/Game.php";
require_once "../Amfphp/app/util/MMysql.class.php";


test39();
function test42(){
	$parm = array("uid"=>2014);
	$game = new Game();
	$res = $game->init((object)$parm);

	var_dump($res);
}
function test41(){
	$parm = array("uid"=>2014,"lv"=>261,"result"=>1,"star"=>3);
	$game = new Game();
	$res = $game->init((object)$parm);

	var_dump($res);
}
function test40(){
	$str = '{"uid":2030,"code":"fedec3ae369cc6d53e235bfe31f54845"}';
	$parm = json_decode($str);

	$game = new Game();
	$res = $game->getCD_key((object)$parm);
	var_dump($res);
}
function test39(){
	$uid = '2014';
	$rank = -1;
	$clist = GameConfig::getRankList();
	$ary = $clist->data1;
	var_dump($ary);
	for($i=0;$i<count($ary);$i++){
		if($ary[$i]['uid'] == $uid){
			$rank = $i;
			break;
		}
	}
	echo 'rank:'.$rank;

}
function test38(){

	$parm = array("uid"=>2030,"lv"=>261,"result"=>1,"star"=>3);
	$game = new Game();
	$res = $game->init((object)$parm);

	var_dump($res);
}

function test37(){
	$res = MsgModel::getAll();
	echo date("Y-m-d H:i:s");echo "<br>";
	var_dump($res);
}
function test36(){
	$lev = GameConfig::getUserVipLevel('0000000000000000000000001A2EFFFC');
	var_dump($lev);
}
function test35(){
	$uid= '0000000000000000000000001A2EFFFC';
	$db = new MMysql();
	$res = $db->doSql("select sum(addgems) as all1 from u_pay where openid='$uid'");
	var_dump($res[0]['all1']);
}
function test34(){
	$ary = GameConfig::getVipLevel(8000);
	var_dump($ary);
}
function test33(){
	$db=new MMysql();
	$res2 = $db->field('yuevip')->where(array('uid'=>2011))->select("u_user");
	var_dump($res2[0]['yuevip']);
}
function test32(){
	$res = GameConfig::testbug();
	var_dump($res);
}
function test31(){
	$db=new MMysql();
	$res2 = $db->field('yuevip')->where(array('uid'=>2011))->select("u_user");
	var_dump($res2[0]['yuevip']);
}
function test30(){
	$data = UserMailModel::getByMailId(27);
	var_dump($data);
}
function test29(){

	$openids = array();
	$openids[] = "1471CCA71C53D2332E1772A32437E2CB";
	$friends_ls = UserLevelInfoModel::getFriendLevelInfo($openids);
	echo json_encode($friends_ls);
}
function test28(){
	return GameConfig::getRankingList2(2);
}
function test27(){
	$parm = array("uid"=>'2030',"lv"=>2,"result"=>0,"score"=>0,"star"=>0,"track"=>array(1));
	$game = new Game();
	$res = $game->init((object)$parm);
	var_dump($res);
}
function test26(){
	$str = '{"uid":2016,"fid":2014,"gt":"block","mailId":93,"name":"name2016","pic":""}';
	$parm = json_decode($str);
	$game = new Game();
	$res = $game->receive($parm);

}
function test25(){
	$str = "2012|1|5|2,2013|2|0|800,2017|0|4|90";
	$resunAry = StringUtil::strToClassArray($str,"BaoModel");
	$str2 = StringUtil::classArrayToStr($resunAry);
	var_dump($resunAry);
}
function test24(){
	$str = '{"uid":2024,"id":1}';
	$parm = json_decode($str);
	$game = new Game();
	$res = $game->buy($parm);

	var_dump($res);
}
function test23(){
	$ls = LoseCause::getByLevel(24);
	$ls->total++;
	$ls->lose++;
	$ls->loseType[5] = 6;
	$ls->update();
	var_dump($ls);
}
function test22(){
	$game = new Game();
	$game->recover(array("uid"=>2020));
}
function test21(){
	$str = UserMailModel::getById("2014");
	var_dump($str);
}
function test20(){
	$str = UserOtherModel::getOtherInfo("2005");
	var_dump($str);
}
function test19(){
	echo "test19<br>";
	$game = new Game();
	$game->init(array("uid"=>2015));
//	UserModel::getById("2011");
}
function test18(){
	$game = new Game();
	$parms = array(
		"uid"=>2014,
		"itemid"=>2017
	);

	$res = $game->useitem($parms);
	var_dump($res);
}
function test17($parm){
	$str = UserOtherModel::sendliftToStr($parm);
	var_dump($str);
}
//test15(['uid'=>2014,name=>'i2014',gt=>'life',fid=>'2005',pic=>"1.jpg"]);

function test16(){

	$parm = array("uid"=>2005);
	$game = new Game();
	$res = $game->init($parm);

	var_dump($res);
}


function test15($parm){
	$from = $parm->uid;
	$name = $parm->name;
	$pic = $parm->pic;
	$to = $parm->fid;
	$gt = $parm->gt;

	$game = new Game();
	$res = $game->sendgift($parm);

	var_dump($res);
}

function test14($parm){
	$game = new Game();
	$res = $game->mailbox($parm);

	var_dump($res);
}

function test13($parm){
	$game = new Game();
	$res = $game->useitem($parm);

	var_dump($res);
}
function test12(){
	$obj = UserModel::getById("2005");
	$obj->gold = 201;
	$res = $obj->update();
	var_dump($res);
}
function test11(){
	$parm = array("uid"=>2005,"lv"=>4,"score"=>900,"star"=>2);
	$obj = UserLevelInfoModel::updateLevelInfo((object)$parm);
	echo($obj);
}

function test10(){
	$data = array(
		'sc'=>'sc+100',
		'st'=>2
	);
	$db = new MMysql();
	$db->where(array('uid'=>2005,'level'=>2))->update('d_user_levelinfo',$data);
	echo $db->getLastSql();
}

function test9(){
	var_dump( GameConfig::getPropsConfig() );
}

function test8(){
	$md = UserOtherModel::getOtherInfo(2010);
	var_dump($md);
}
function test7(){
	$db = new MMysql();
	$uid = '2005';
	$res = $db->where("uid=$uid")->select("d_user_other");
	var_dump($res);

	echo $db->getLastSql();
	$db->close();
}
function test6(){
	$user = UserModel::getById("2010");
	var_dump($user);
}

function test1(){
	$pdo = MySQLUtil::getConnection();
	$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$uid = "2005";
	$sql = "select * from u_user where uid=:uid";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':uid', $uid,PDO::PARAM_STR);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	var_dump($results);
	if(count($results) > 0){
		echo "true";
	}else{
		echo "false";
	}
}

function test4(){
	$mysqliObj = new mysqli("localhost","root","wdf123","xiaochu");
	if(mysqli_connect_errno()){
		echo "连接失败".mysqli_connect_error();
		exit();
	}
	$mysqliObj->query("set name utf-8");
	$sql = "select * from c_props";
	$result = $mysqliObj->query($sql);
//	while ($row = $result->fetch_assoc()){
//		var_dump($row);
//	}
	$r = $result->fetch_all(MYSQLI_ASSOC);
	$mysqliObj->close();
	var_dump($r);
}
function test5(){
	$con=mysqli_connect("localhost","root","wdf123","xiaochu");
// Check connection
	if (mysqli_connect_errno($con))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$sql="select * from c_props";
	$result=mysqli_query($con,$sql);

// Fetch all
	$rr = mysqli_fetch_all($result,MYSQLI_ASSOC);

// Free result set
	mysqli_free_result($result);

	mysqli_close($con);
	var_dump($rr);
}


function test2(){
	$pdo = MySQLUtil::getConnection();
	$arry = array(
		1=>array("score"=>1000,"st"=>3),
		2=>array("score"=>1000,"st"=>3),
		3=>array("score"=>1000,"st"=>3),
		4=>array("score"=>1000,"st"=>3),
	);
	$arry_jsonstr = json_encode($arry);
	$uid = "2005";
	$sql = "insert into d_user(id,levelinfo) values(:uid,:levelinfo)";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':uid', $uid,PDO::PARAM_STR);
	$stmt->bindParam(':levelinfo', $arry_jsonstr,PDO::PARAM_STR);
	$stmt->execute();
	echo $stmt->rowCount();
}

function test3(){
	$pdo = MySQLUtil::getConnection();
	$uid = "2005";
	$sql = "select * from d_user where id=:uid";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':uid', $uid,PDO::PARAM_STR);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	$json_str = $result[0]["levelinfo"];
	$levelinfoAry = json_decode($json_str,true);
	var_dump($levelinfoAry);
	$levelinfoAry[5] = array("score"=>2000,"st"=>1);
	var_dump($levelinfoAry);
//	foreach($result as $key=>$value){
//		$arr = json_decode($value);
//
//	}

}
?>