<?php

/**
 * 获取客户端IP地址
 */
function GetClientIP() {
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
        $ip = getenv("HTTP_CLIENT_IP");
    else
    if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    else
    if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
        $ip = getenv("REMOTE_ADDR");
    else
    if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
        $ip = $_SERVER['REMOTE_ADDR'];
    else
        $ip = "null";
    return ($ip);
}

/**
 * 获取当前时间
 */
function GetCurrentDateTime() {
    date_default_timezone_set('Asia/Shanghai');
    return date("Y-m-d H:i:s");
}
function GetCurrentDateYmd(){
    date_default_timezone_set('Asia/Shanghai');
    return date("Y-m-d");
}

function convertip_full($ip, $ipdatafile) { //$ret = convertip_full($ip,'QQWry.Dat');
    if (!$fd = fopen($ipdatafile, 'rb')) {
        return '- Invalid IP data file';
    }

    $ip = explode('.', $ip);
    $ipNum = $ip[0] * 16777216 + $ip[1] * 65536 + $ip[2] * 256 + $ip[3];

    if (!($DataBegin = fread($fd, 4)) || !($DataEnd = fread($fd, 4)))
        return;
    @$ipbegin = implode('', unpack('L', $DataBegin));
    if ($ipbegin < 0)
        $ipbegin += pow(2, 32);
    @$ipend = implode('', unpack('L', $DataEnd));
    if ($ipend < 0)
        $ipend += pow(2, 32);
    $ipAllNum = ($ipend - $ipbegin) / 7 + 1;

    $BeginNum = $ip2num = $ip1num = 0;
    $ipAddr1 = $ipAddr2 = '';
    $EndNum = $ipAllNum;

    while ($ip1num > $ipNum || $ip2num < $ipNum) {
        $Middle = intval(($EndNum + $BeginNum) / 2);

        fseek($fd, $ipbegin + 7 * $Middle);
        $ipData1 = fread($fd, 4);
        if (strlen($ipData1) < 4) {
            fclose($fd);
            return '- System Error';
        }
        $ip1num = implode('', unpack('L', $ipData1));
        if ($ip1num < 0)
            $ip1num += pow(2, 32);

        if ($ip1num > $ipNum) {
            $EndNum = $Middle;
            continue;
        }

        $DataSeek = fread($fd, 3);
        if (strlen($DataSeek) < 3) {
            fclose($fd);
            return '- System Error';
        }
        $DataSeek = implode('', unpack('L', $DataSeek . chr(0)));
        fseek($fd, $DataSeek);
        $ipData2 = fread($fd, 4);
        if (strlen($ipData2) < 4) {
            fclose($fd);
            return '- System Error';
        }
        $ip2num = implode('', unpack('L', $ipData2));
        if ($ip2num < 0)
            $ip2num += pow(2, 32);

        if ($ip2num < $ipNum) {
            if ($Middle == $BeginNum) {
                fclose($fd);
                return '- Unknown';
            }
            $BeginNum = $Middle;
        }
    }

    $ipFlag = fread($fd, 1);
    if ($ipFlag == chr(1)) {
        $ipSeek = fread($fd, 3);
        if (strlen($ipSeek) < 3) {
            fclose($fd);
            return '- System Error';
        }
        $ipSeek = implode('', unpack('L', $ipSeek . chr(0)));
        fseek($fd, $ipSeek);
        $ipFlag = fread($fd, 1);
    }

    if ($ipFlag == chr(2)) {
        $AddrSeek = fread($fd, 3);
        if (strlen($AddrSeek) < 3) {
            fclose($fd);
            return '- System Error';
        }
        $ipFlag = fread($fd, 1);
        if ($ipFlag == chr(2)) {
            $AddrSeek2 = fread($fd, 3);
            if (strlen($AddrSeek2) < 3) {
                fclose($fd);
                return '- System Error';
            }
            $AddrSeek2 = implode('', unpack('L', $AddrSeek2 . chr(0)));
            fseek($fd, $AddrSeek2);
        } else {
            fseek($fd, -1, SEEK_CUR);
        }

        while (($char = fread($fd, 1)) != chr(0))
            $ipAddr2 .= $char;

        $AddrSeek = implode('', unpack('L', $AddrSeek . chr(0)));
        fseek($fd, $AddrSeek);

        while (($char = fread($fd, 1)) != chr(0))
            $ipAddr1 .= $char;
    } else {
        fseek($fd, -1, SEEK_CUR);
        while (($char = fread($fd, 1)) != chr(0))
            $ipAddr1 .= $char;

        $ipFlag = fread($fd, 1);
        if ($ipFlag == chr(2)) {
            $AddrSeek2 = fread($fd, 3);
            if (strlen($AddrSeek2) < 3) {
                fclose($fd);
                return '- System Error';
            }
            $AddrSeek2 = implode('', unpack('L', $AddrSeek2 . chr(0)));
            fseek($fd, $AddrSeek2);
        } else {
            fseek($fd, -1, SEEK_CUR);
        }
        while (($char = fread($fd, 1)) != chr(0))
            $ipAddr2 .= $char;
    }
    fclose($fd);

    if (preg_match('/http/i', $ipAddr2)) {
        $ipAddr2 = '';
    }
    $ipaddr = "$ipAddr1 $ipAddr2";
    $ipaddr = preg_replace('/CZ88\.NET/is', '', $ipaddr);
    $ipaddr = preg_replace('/^\s*/is', '', $ipaddr);
    $ipaddr = preg_replace('/\s*$/is', '', $ipaddr);
    if (preg_match('/http/i', $ipaddr) || $ipaddr == '') {
        $ipaddr = '- Unknown';
    }

    return $ipaddr;
}

/**
 * Utf-8、gb2312都支持的汉字截取函数
 * cut_str(字符串, 截取长度, 开始长度, 编码);
 * 编码默认为 utf-8
 * 开始长度默认为 0
 */
function cut_str($string, $sublen, $start = 0, $code = 'utf-8') {
    if ($code == 'utf8') {
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        preg_match_all($pa, $string, $t_string);

        if (count($t_string[0]) - $start > $sublen)
            return join('', array_slice($t_string[0], $start, $sublen)) . "...";
        return join('', array_slice($t_string[0], $start, $sublen));
    } else {
        $start = $start * 2;
        $sublen = $sublen * 2;
        $strlen = strlen($string);
        $tmpstr = '';

        for ($i = 0; $i < $strlen; $i++) {
            if ($i >= $start && $i < ($start + $sublen)) {
                if (ord(substr($string, $i, 1)) > 129) {
                    $tmpstr .= substr($string, $i, 2);
                } else {
                    $tmpstr .= substr($string, $i, 1);
                }
            }
            if (ord(substr($string, $i, 1)) > 129)
                $i++;
        }
        if (strlen($tmpstr) < $strlen)
            $tmpstr .= "...";
        return $tmpstr;
    }
}
/**
*中文截取无乱码。
*/
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix='') {
    if (strlen($str)<=3*$length) {
        return $str;
    }
    if (function_exists("mb_substr")) {
        return mb_substr($str, $start, $length, $charset) . $suffix;
    } elseif (function_exists('iconv_substr')) {
        return iconv_substr($str,$start,$length,$charset) . $suffix;
    }
    $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";

    preg_match_all($re[$charset], $str, $match);
    $slice = join("", array_slice($match[0], $start, $length));
    return $slice . $suffix;
}
/**
 * 中文字符 一个顶三个
 */
function my_substr(&$str,$start=0,$length)
{
	$str = substr($str,$start,$length/3);
}

?>
