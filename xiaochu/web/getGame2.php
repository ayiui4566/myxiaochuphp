<!DOCTYPE html>
<html>
    <head>
        <title>甜品消消</title>
        <meta name="google" value="notranslate" />         
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css" media="screen">
            body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,span,fieldset,input,p,blockquote,table,th,td,embed,object {margin:0;padding:0; font-family:"Microsoft YaHei";}
            fieldset,img,abbr {border:0; color:#333333;}
            address,caption,cite,code,dfn,em,strong,th,var {font-weight:normal;font-style:normal;}
            ul,ol {list-style:none;}
            table {border-collapse:collapse;border-spacing:0;}
            a {text-decoration:none;cursor:pointer;color:#b2b2b2;}
            a:hover {text-decoration:none;outline:none;}
            .left{float:left;}
            .right{float:right;}
            .clear{clear: both;}
            .hide{display: none;}
            /*clearfix-浮动清理*/
            .clearfix:after { content:"."; display:block; height:0; clear:both; visibility:hidden }
            .clearfix { display:inline-block }
            * html .clearfix { height:1% }
            .clearfix { display:block}
            html, body  { height:100%; }
            body { margin:0; padding:0; overflow:auto; text-align:left;}
            object:focus { outline:none; }
            #flashContent { display:none; }


            .topButtons{border-color: #d3ecf5;border-width: 0 0 1px 0; border-style:solid;width: 760px;height: 25px;position: relative;background: #fff;margin: 0 auto;}
            .topButtons ul{position: absolute;bottom:1px;}
            .topButtons ul li{float: left}
            .topButtons ul li a{color:#545454; border:1px solid #d3ecf5;padding: 4px 10px;font-size: 13px;font-family: "宋体";border-bottom: none;}
            .bottominfo{font-family: "宋体";font-size:12px;color:#A9A9A9;background:transparent;text-align: center}
            .bg_mod{background: #F3F8FB;padding-top: 5px;text-align: center}
        </style>

        <script type="text/javascript" src="js/swfobject.js"></script>
        <script type="text/javascript" charset="utf-8" src="http://www.3366.com/js/jquery.js"></script>
        <script type="text/javascript" charset="utf-8" src="http://www.3366.com/js/jquery.pm.js"></script>
        <script type="text/javascript" charset="utf-8" src="http://www.3366.com/js/module/openapilib.js"></script>


        <script type="text/javascript">

function gethost(){
    //return "http://localhost:8080";
    return "http://tianpin.bj.1252385524.clb.myqcloud.com"
}
function getLocation() {
    return document.location.href;
}
function getAppId(){
    return 1105455691;
}
function getOpenId() {
    return <?php echo "'".$_GET['openid']."'";?>;
}
function getAppName(){
    return 'xiaochu';
}
function getOpenKey() {
    return <?php echo "'".$_GET['openkey']."'";?>;
}
function getPfKey() {
    return <?php echo "'".$_GET['pfkey']."'";?>;
}
function getPf(){
    return <?php echo "'".$_GET['pf']."'";?>;
}
function reload() {
    var parmstr = "/xiaochu/web/getGame2.php?openid=" + getOpenId() + "&openkey=" + getOpenKey() + "&pfkey=" + getPfKey() + "&pf=" + getPf();
    document.location.href = gethost() + parmstr;
}
function getUrl(){
    var parmstr = "/xiaochu/web/getGame2.php?openid=" + getOpenId() + "&openkey=" + getOpenKey() + "&pfkey=" + getPfKey() + "&pf=" + getPf();
    var str = gethost() + parmstr;
    return str;
}
function kaiTongBlueVip(){
    Open3366API.NewOpenGameVIPService.show (
        getAppId(),
        function() {},
   		'myaid',
        3,
        5
    );
}
function buyGoods(url_param,token,shopid){
    var appid = getAppId();

    Open3366API.Pay.show (
        appid,
        url_param,
        0,
        "购买钻石",
        function() {
        },
        function() {
            if ($("#GameMain")[0].buyOkFun ) {
                $("#GameMain")[0].buyOkFun(shopid);
            }

            var url1 = gethost()+"/xiaochu/openApi/payConfirm.php";
            $.get(url1, { openid:getOpenId(),openkey:getOpenKey(),pf:getPf(),pfkey:getPfKey(),tokenId: token} );
        },
        0,
        true
    );
}
function inviteFriend() {
    var appid = getAppId();
    var opt = {
        title:'邀请你来玩甜品消消~',
        source:"openid=" + getOpenId(),
        onSuccess : function(opt) {
            if ($("#GameMain")[0].inviteOkFun ) {
                $("#GameMain")[0].inviteOkFun(opt.invitees.length);
            }
        }
    };
    Open3366API.Invite.show(appid,opt);
}
//免费送礼物或者请求接口,供flash调用 3366平台没有这个接口
function request(msgstr,type,openid){}
//分享接口,供flash调用
function feed(titlestr,descstr,picurl){
//    alert(titlestr+"..."+titlestr+"..."+picurl);
    var picurlx = gethost()+"/xiaochu/web/images/feed/"+picurl;
    var opt = {
        summary:'快来一起玩甜品消消吧，我在这里等你哦~',
        title :titlestr,
        desc:descstr,
        pics:picurlx,
        context:"share",
        onSuccess : function (opt)
        {
            if ($("#GameMain")[0].shareOkFun ) {
                $("#GameMain")[0].shareOkFun(opt);
            }
        }
    }
    Open3366API.dialog.share(opt);
}


function  loadSwf(){
//    console.log(getLocation());
    var swfVersionStr = "10.2.0";
    var xiSwfUrlStr = "playerProductInstall.swf";
    var flashvars = {};
//2014-2020;
    flashvars.uid = getOpenId();
    flashvars.appName = getAppName();
    flashvars.openid = getOpenId();
    flashvars.openkey = getOpenKey();
    flashvars.pf = getPf();
    flashvars.pfkey = getPfKey();
    flashvars.ver = "2016112802";
    var swfurl = "GameMain.swf?v="+flashvars.ver;
    flashvars.host = gethost();
    flashvars.cdn = "";
    var params = {};
    params.quality = "high";
    params.bgcolor = "#ffed76";
    params.allowscriptaccess = "always";
    params.allowfullscreen = "true";
    var attributes = {};
    attributes.id = "GameMain";
    attributes.name = "GameMain";
    attributes.align = "middle";
    swfobject.embedSWF(
        swfurl, "flashContent",
        "760", "650",
        swfVersionStr, xiSwfUrlStr,
        flashvars, params, attributes);
// JavaScript enabled so display the flashContent div in case it is not replaced with a swf object.
    swfobject.createCSS("#flashContent", "display:block;text-align:center;");
}
</script>
    </head>
    <body>
        <div class="topButtons">
            <ul class="clearfix">
                <li><a href="javascript:void(0)" onclick="reload();">甜品消消</a></li>
                <li><a href="javascript:void(0)" onclick="inviteFriend();">邀请好友</a></li>
                <li><a href="http://pay.qq.com/ipay/index.shtml?n=60&c=qqacct_save&ch=qqcard,kj,weixin&aid=pay.index.header.paycenter" target="_blank">Q点充值</a></li>
                <li><a href="http://bbs.open.qq.com/forum.php?mod=forumdisplay&action=list&fid=5251" target="_blank">论坛</a></li>
            </ul>
        </div>
        <div class="bg_mod">
            <div id="flashContent">
                <p>
                    To view this page ensure that Adobe Flash Player version
                    11.1.0 or greater is installed.
                </p>
                <script type="text/javascript">
                    var pageHost = ((document.location.protocol == "https:") ? "https://" : "http://");
                    document.write("<a href='http://www.adobe.com/go/getflashplayer'><img src='"
                                    + pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>" );
                </script>
            </div>

        </div>

        <div class="bottominfo clearfix">
            <p>此应用由“北京乐斗游”提供，遇到问题请联系客服qq:474956804,官方玩家交流群:198450331</p>
            <p>游戏ID：<?php echo "'".$_GET['openid']."'";?>进群互加好友，满10个给你大惊喜</p>
        </div>

        <script>
            $(function(){
                loadSwf();
                //$.get('test1.php');
                Open3366API.Canvas.setHeight(730);
            })

            $(window).bind('beforeunload',function(e){
//        $.get('test1.php');
                //return "quit?";
            });

        </script>
   </body>

</html>
