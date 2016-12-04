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
            body { margin:0; padding:0; overflow:auto; text-align:left;background: url(bg6.jpg) repeat;background-color: #a4d8ff;}
            object:focus { outline:none; }
            #flashContent { display:none; }


            .container{width: 760px;margin: 0 auto;}
            .topButtons{border-color: #d3ecf5;border-width: 0 0 1px 0; border-style:solid;width: 760px;height: 25px;position: relative;background: #fff}
            .topButtons ul{position: absolute;bottom:1px;}
            .topButtons ul li{float: left}
            .topButtons ul li a{color:#545454; border:1px solid #d3ecf5;padding: 4px 10px;font-size: 13px;font-family: "宋体";border-bottom: none;}
            .bottominfo{font-family: "宋体";font-size:12px;color:#A9A9A9;background:transparent;}
            .bg_mod{padding-top: 5px;}
        </style>

        <script type="text/javascript" src="http://www.ldy845.com/xiaochu6533/web/js/swfobject.js"></script>
        <script type="text/javascript" src="http://www.ldy845.com/xiaochu6533/web/js/jquery.js"></script>

<script type="text/javascript">

function getAppName(){
    return 'xiaochu6533';
}
function getPf(){
    return '6533';
}
function gethost(){
    //return "http://localhost:8080";
    return "http://www.ldy845.com"
}
function gethostAndAppName(){
    return gethost()+"/"+getAppName();
}
function getLocation() {
    return document.location.href;
}
function getOpenId() {
    return <?php echo "'".$_GET['uid']."'";?>;
}
function getQuNum(){
    return <?php echo "'".$_GET['sid']."'";?>;
}
function getPfTime(){
    return <?php echo "'".$_GET['time']."'";?>;
}
function getOpenKey() {

    <?php
        if(isset($_GET['sign']) && $_GET['sign']!=''){
            echo "return '".$_GET['sign']."'";
        }else{
            echo "return '".md5(uniqid('n',true))."'";
        }
    ?>
}
function getPfKey() {
    return <?php echo "'".$_GET['pfkey']."'";?>;
}

function reload() {
    var parmstr = "/"+getAppName()+"/web/getGame3.php?uid=" + getOpenId() + "&sign=" + getOpenKey() + "&pf=" + getPf();
    document.location.href = gethost() + parmstr;
}

function buyGoods(url_param,token,shopid){
    return;
}
function inviteFriend() {
    return;
}
//免费送礼物或者请求接口,供flash调用
function request(msgstr,type,openid){
   return;
}
//分享接口,供flash调用
function feed(titlestr,descstr,picurl){
    return;
}

function changeP(){
    document.getElementById('ptest').innerHTML = 'ppppp';
}
function payOk(){
    document.getElementById('ptest').innerHTML = '支付成功';
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
        <div class="container">
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
                <p class="p2">游戏ID：<?php echo "'".$_GET['uid']."'";?>  &nbsp;&nbsp;打不开游戏的，多清理缓存&nbsp;&nbsp;充值之后请刷新页面</p>
                <p id="ptest"></p>
            </div>
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
