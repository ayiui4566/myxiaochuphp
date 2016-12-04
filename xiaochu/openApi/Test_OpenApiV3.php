<?php

/**
 * OpenAPI V3 SDK 示例代码，适用于大部分OpenAPI。如果是上传文件类OpenAPI，请参考本SDK包中的“Test_UploadFile.php”文件中的示例代码。
 *
 * @version 3.0.4
 * @author open.qq.com
 * @copyright © 2012, Tencent Corporation. All rights reserved.
 * @History:
 *               3.0.4 | coolinchen | 2012-09-07 10:20:12 | initialization
 */


require_once 'OpenApiV3.php';

// 应用基本信息
$appid = 1105455691;
$appkey = 'O6kZ7DRFSCmNJm2w';

// OpenAPI的服务器IP 
// 最新的API服务器地址请参考wiki文档: http://wiki.open.qq.com/wiki/API3.0%E6%96%87%E6%A1%A3 
$server_name = 'openapi.tencentyun.com';


// 用户的OpenID/OpenKey
$openid = '1471CCA71C53D2332E1772A32437E2CB';
$openkey = '5DDECD212475BCEEE23038FAD62427CE';

// 所要访问的平台, pf的其他取值参考wiki文档: http://wiki.open.qq.com/wiki/API3.0%E6%96%87%E6%A1%A3 
$pf = 'qzone';


$sdk = new OpenApiV3($appid, $appkey);
$sdk->setServerName($server_name);


$openid1 = $_GET['openid'];
$openkey1 = $_GET['openkey'];
$pf1 = $_GET['pf'];

$ret = get_user_info($sdk, $openid1, $openkey1, $pf1);
$ret2 = get_app_friends($sdk, $openid1, $openkey1, $pf1);
print_r("===========================<Br>");
print_r($ret);
print_r("===========================<Br>");
print_r($ret2);

/**
 * 获取好友资料
 *
 * @param object $sdk OpenApiV3 Object
 * @param string $openid openid
 * @param string $openkey openkey
 * @param string $pf 平台
 * @return array 好友资料数组
 */
function get_user_info($sdk, $openid, $openkey, $pf)
{
	$params = array(
		'openid' => $openid,
		'openkey' => $openkey,
		'pf' => $pf,
	);
	
	$script_name = '/v3/user/get_info';
	return $sdk->api($script_name, $params,'post');
	
	
}
function get_app_friends($sdk, $openid, $openkey, $pf)
{
	$params = array(
			'openid' => $openid,
			'openkey' => $openkey,
			'pf' => $pf,
	);

	$script_name = '/v3/relation/get_app_friends';
	return $sdk->api($script_name, $params, 'post');
}
// end of script
