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


            .topButtons{border-color: #d3ecf5;border-width: 0 0 1px 0; border-style:solid;width: 760px;height: 25px;position: relative;background: #fff}
            .topButtons ul{position: absolute;bottom:1px;}
            .topButtons ul li{float: left}
            .topButtons ul li a{color:#545454; border:1px solid #d3ecf5;padding: 4px 10px;font-size: 13px;font-family: "宋体";border-bottom: none;}
            .bottominfo{font-family: "宋体";font-size:12px;color:#A9A9A9;background:transparent;}
            .bg_mod{background: #F3F8FB;padding-top: 5px;}
        </style>

        <script type="text/javascript" src="http://tianpin.bj.1252385524.clb.myqcloud.com/xiaochu/web/js/swfobject.js"></script>
        <script type="text/javascript" src="http://tianpin.bj.1252385524.clb.myqcloud.com/xiaochu/web/js/jquery.js"></script>
        <script type="text/javascript" charset="utf-8" src="http://fusion.qq.com/fusion_loader?appid=1105455691&platform=qzone"></script>

<script type="text/javascript"> 

function gethost(){
    //return "http://localhost:8080";
    return "http://tianpin.bj.1252385524.clb.myqcloud.com"
}
function getLocation() {
    return document.location.href;
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
    var parmstr = "/xiaochu/web/getGame.php?openid=" + getOpenId() + "&openkey=" + getOpenKey() + "&pfkey=" + getPfKey() + "&pf=" + getPf();
    document.location.href = gethost() + parmstr;
}

function buyGoods(url_param,token,shopid){
    fusion2.dialog.buy
    ({
        param : url_param,
        sandbox : false,
        context : token+"*"+shopid,
        onSuccess : function (opt) {
            var token = opt.context.split('*')[0];
            var shopid = opt.context.split('*')[1];
            if ($("#GameMain")[0].buyOkFun ) {
                $("#GameMain")[0].buyOkFun(shopid);
            }

            var url1 = gethost()+"/xiaochu/openApi/payConfirm.php";
            $.get(url1, { openid:getOpenId(),openkey:getOpenKey(),pf:getPf(),pfkey:getPfKey(),tokenId: token} );
        },
    });
}
function inviteFriend() {

    fusion2.dialog.invite({
        msg : "邀请你来玩甜品消消~",
        img : gethost()+"/xiaochu/web/images/invite.png",
        source : "openid=" + getOpenId(),
        context : "invite",
        onSuccess : function(opt) {
            if ($("#GameMain")[0].inviteOkFun ) {
                $("#GameMain")[0].inviteOkFun(opt.invitees.length);
            }
        }
    });
}
//免费送礼物或者请求接口,供flash调用
function request(msgstr,type,openid){

    var type1="";
    var title1="";
    var desc1 = "";
    var imgurl = "";
    switch(type){
        case "asklife":
            type1 = "request";
            title1 = "请求你帮忙";
            desc1 = "进入关卡需要心";
            imgurl = gethost()+"/xiaochu/web/images/help.png";
            break;
        case "askblock":
            type1 = "request";
            title1 = "请求你帮忙";
            desc1 = "用于解锁新地图";
            imgurl = gethost()+"/xiaochu/web/images/help.png";
            break;
        case "life":
            type1 = "freegift";
            title1 = "送你一颗心";
            desc1 = "进入关卡需要心";
            imgurl = gethost()+"/xiaochu/web/images/gift.png";
            break;
        case "gold":
            type1 = "freegift";
            title1 = "送你些金币";
            desc1 = "可以购买关卡前道具";
            imgurl = gethost()+"/xiaochu/web/images/gift.png";
            break;
    }

    fusion2.dialog.sendRequest
    ({
        type : type1,
        receiver : openid,
        title : title1,
        msg : msgstr,
        img:imgurl,
        desc : desc1,
        context : type,
        onSuccess : function (opt)
        {
            if ($("#GameMain")[0].requestOkFun ) {
                $("#GameMain")[0].requestOkFun(opt.receiver,type);
            }
        },
    });

}
//分享接口,供flash调用
function feed(titlestr,descstr,picurl){
    var msgstr = "快来一起玩甜品消消吧，我在这里等你哦~";
    var picurlx = gethost()+"/xiaochu/web/images/feed/"+picurl;
    fusion2.dialog.sendStory({
        title :titlestr,
        img:picurlx,
        summary :descstr,
        msg:msgstr,
        button :"进入应用",
        source :"ref=story&act=default",
        context:"send-story-12345",
        onSuccess : function (opt)
        {
            // opt.context：可选。opt.context为调用该接口时的context透传参数，以识别请求
//            alert("Succeeded: " + opt.context);
            //分享成功后调用flash
            if ($("#GameMain")[0].shareOkFun ) {
                $("#GameMain")[0].shareOkFun(opt);
            }
        }
    });

}


function  loadSwf(){
    console.log(getLocation());
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
    swfobject.createCSS("#flashContent", "display:block;text-align:left;");
}
</script>
    </head>
    <body>
        <div class="topButtons">
            <ul class="clearfix">
                <li><a href="javascript:void(0)" onclick="reload();">甜品消消</a></li>
                <li><a href="javascript:void(0)" onclick="inviteFriend();">邀请好友</a></li>
                <li><a href="javascript:void(0)" onclick="fusion2.dialog.checkBalance()">Q点查询</a></li>
                <li><a href="javascript:void(0)" onclick="fusion2.dialog.recharge()">Q点充值</a></li>
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
            <p class="p2">游戏ID：<?php echo "'".$_GET['openid']."'";?>打不开游戏的，多清理缓存</p>
        </div>

        <script>
            $(function(){
                loadSwf();
                //$.get('test1.php');

            })

            $(window).bind('beforeunload',function(e){
//        $.get('test1.php');
                //return "quit?";
            });

        </script>
   </body>

</html>
