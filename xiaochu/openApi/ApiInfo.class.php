<?php
//header('Content-Type:text/html;charset=utf-8');
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

class ApiInfo
{
    // 应用基本信息
    public $appid = 1105455691;
    public $appkey = 'O6kZ7DRFSCmNJm2w';

    // OpenAPI的服务器IP
    // 最新的API服务器地址请参考wiki文档: http://wiki.open.qq.com/wiki/API3.0%E6%96%87%E6%A1%A3
//    public $server_name = '119.147.19.43';
    public $server_name = 'openapi.tencentyun.com';


    // 用户的OpenID/OpenKey
    public $openid = '2541D0905A9B6CF713474E84051F6D9F';
    public $openkey = 'FA2E3848C7D350DDA990C7B11A689E69';

    // 所要访问的平台, pf的其他取值参考wiki文档: http://wiki.open.qq.com/wiki/API3.0%E6%96%87%E6%A1%A3
    public $pf = 'qzone';
    public $pfkey;
    public $fids;

    public $sdk;

    public function __construct($openid,$openkey,$pf,$pfkey)
    {
        $this->openid = $openid;
        $this->openkey = $openkey;
        $this->pf = $pf;
        $this->pfkey = $pfkey;

        $this->sdk = new OpenApiV3($this->appid, $this->appkey);
        $this->sdk->setServerName($this->server_name);
    }
    /**
     * 获得好友资料
     */
    public function getFriendInfos(){

        $ret = $this->get_app_friends();

        $fids = array();
        for ($i = 0;
             $i<count($ret["items"]);
             $i++)
        {
            $fids[] = $ret["items"][$i]['openid'];
        }

        $onestr = implode('_', $fids);

        if($this->pf == "qzone") {
            $ret = $this->get_multi_info($onestr);
        }elseif($this->pf == "3366"){
            return $ret;
        }
        return $ret;
    }
    /**
     * 获取自己的资料
     */
    public function getMyInfo(){
        $ret = $this->get_user_info();
        return $ret;
    }
    /***
     * 发起确认订单
     */
    public function confirm_delivery($payitem,$token_id,$billno,$zoneid,$provide_errno,$amt,$payamt_coins){

        $params = array(
            'openid' => $this->openid,
            'openkey' => $this->openkey,
            'pf' => $this->pf,
            'pfkey' => $this->pfkey,
            'ts' => time(),
            'payitem'=>$payitem,
            'token_id'=>$token_id,
            'billno'=>$billno,
            'zoneid'=>$zoneid,
            'provide_errno'=>$provide_errno,
            'amt'=>$amt,
            'payamt_coins' =>$payamt_coins,
        );
        $script_name = '/v3/pay/confirm_delivery';
        return $this->sdk->api($script_name, $params, 'post','https');
    }
    /***
     * 发起Q点直购
     */
    public function buy_goods($payitem,$goodsmeta,$goodsurl)
    {
        $sdk = new OpenApiV3($this->appid, $this->appkey);
        $sdk->setServerName($this->server_name);

        $params = array(
            'openid' => $this->openid,
            'openkey' => $this->openkey,
            'pf' => $this->pf,
            'pfkey' => $this->pfkey,
            'ts' => time(),
            'payitem'=>$payitem,
            'goodsmeta'=>$goodsmeta,
            'goodsurl'=>$goodsurl,
        );
        if($this->pf=="3366"){
            $params['platform'] = 30006;
        }
        $script_name = '/v3/pay/buy_goods';
        return $sdk->api($script_name, $params, 'post','https');
    }
    /**
     * 获取好友资料
     *
     * @param object $sdk OpenApiV3 Object
     * @param string $openid openid
     * @param string $openkey openkey
     * @param string $pf 平台
     * @return array 好友资料数组
     */
    private function get_user_info()
    {
        $params = array(
            'openid' => $this->openid,
            'openkey' => $this->openkey,
            'pf' => $this->pf,
        );

        $script_name = '/v3/user/get_info';
        return $this->sdk->api($script_name, $params, 'post');
    }

    /**
     * 获取好友关系链openids
     */
    private function get_app_friends()
    {
        $params = array(
            'openid' => $this->openid,
            'openkey' => $this->openkey,
            'pf' => $this->pf,
        );

        $script_name = '/v3/relation/get_app_friends';
        return $this->sdk->api($script_name, $params, 'post');
    }

    /**
     * 批量根据openids获取基本资料
     */
    private function get_multi_info($fopenids)
    {
        $params = array(
            'openid' => $this->openid,
            'openkey' => $this->openkey,
            'pf' => $this->pf,
            'fopenids' => $fopenids
        );

        $script_name = '/v3/user/get_multi_info';
        return $this->sdk->api($script_name, $params, 'post');
    }
    /**
     * 批量根据openid获取VIP信息用于3366平台
     */
    private function totalVipInfo(){
        $params = array(
            'openid' => $this->openid,
            'openkey' => $this->openkey,
            'pf' => $this->pf,
        );

        $script_name = '/v3/user/total_vip_info';
        return $this->sdk->api($script_name, $params, 'post');
    }
}

// end of script
