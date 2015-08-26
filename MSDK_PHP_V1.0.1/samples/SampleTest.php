<?php

/**
 * MSDK PHP SDK调用示例代码，基于OpenAPI V3 PHP SDK改造
 *
 */

require_once '../msdks/Api.php';
require_once '../msdks/Msdk.php';
require_once '../msdks/Payments.php';

// 应用基本信息，需要替换为应用自己的信息，必须和客户端保持一致
// 需要登录腾讯开放平台 open.qq.com，注册开发者，并创建移动应用，审核通过后可以获得APPID和APPKEY
// @wiki: http://wiki.mg.open.qq.com/index.php?title=%E6%B3%A8%E5%86%8C%E5%BC%80%E5%8F%91%E8%80%85
//        http://wiki.mg.open.qq.com/index.php?title=%E5%88%9B%E5%BB%BA%E6%B8%B8%E6%88%8F
$appid = '100703379';
$appkey = '4578e54fb3a1bd18e0681bc1c734514e';

// 应用支付基本信息,需要替换为应用自己的信息，必须和客户端保持一致
// 需要登录腾讯开放平台管理中心 http://op.open.qq.com/，选择已创建的应用进入，然后进入支付结算，完成支付的接入配置
// @wiki：http://wiki.mg.open.qq.com/index.php?title=Android%E6%94%AF%E4%BB%98%E6%8E%A5%E5%85%A5%E6%B5%81%E7%A8%8B
$pay_appid = 1450001744;
$pay_appkey = 'xAuVk9sPZXTpdYLH';

// MSDK后台API的服务器域名
// 调试环境: msdktest.qq.com
// 正式环境: msdk.qq.com
// 调试环境仅供调试时调用，调试完成发布至现网环境时请务必修改为正式环境域名
$server_name = 'msdktest.qq.com';

// 用户的OpenID，从客户端MSDK登录返回的LoginRet获取
$openid = '0EF80D52AE52324D51958FE6EDC3DBF3';
// 用户的openkey，从客户端MSDK登录返回的LoginRet获取
$openkey = '5FCBE90E15DF85CC093E3267481962E2';

// 支付接口票据, 从客户端MSDK登录返回的LoginRet获取
$pay_token='CC3CB5E77BDA623016CFA3162DA3EFA8';
// 支付接口票据, 从客户端MSDK登录返回的LoginRet获取
$pf='desktop_m_qq-73213123-android-73213123-qq-100703379-0EF80D52AE52324D51958FE6EDC3DBF3';
// 支付接口票据, 从客户端MSDK登录返回的LoginRet获取
$pfkey= '94d7e9a1f441b69f26b113214760100e';
// 支付分区, 需要先在open.qq.com接入支付结算，并配置了分区
// 注意是分区ID，默认为1，如果在平台配置了分区需要传入对应的分区ID！
$zoneId=1;

/// 当前UNIX时间戳
$ts=time();
// 用户的IP，可选，默认为空
$userip = '';

$pay_token='28BE9293E1E1F61714CDD198C57FC7A9';
$pf='desktop_m_qq-73213123-iap-1001-qq-1103557609-BDEDBB41B187CC7456BC9A85C5685C43';
$pfkey= 'ef166c03f806bc3af2429d423e89ae05';
$zoneid=60000001; //注意是分区ID！


// 一些其他接口用到的参数
$vip = 1;
$flag = 1;

$vcopenid = array(
    'B9EEA5EE1E99694146AC2700BFE6B88B'
);

$refreshToken = '';
$qqcore_param =array();
$accessToken = '';
$json = array();


// 创建MSDK实例
$sdk = new Api($appid, $appkey);
// 设置支付信息
$sdk->setPay($pay_appid, $pay_appkey);
// 设置MSDK调用环境
$sdk->setServerName($server_name);

// MSDK接口请求URI参数
$qs = array(
    'appid' => $appid,
    'timestamp' => $ts,
    'sig' => md5($appkey.$ts),
    'encode' => 1,
    'openid' => $openid,
);

// 支付接口请求cookie参数，org_loc这里传空，org_loc值会在类中更新
// IOS平台
$cookie = array(
    'session_id' => 'hy_gameid',
    'session_type' => 'st_dummy',
    'org_loc' => ''
);


// 安卓平台
//$cookie = array(
//    'session_id' => 'openid',
//    'session_type' => 'kp_actoken',
//    'org_loc' => ''
//);


$fun = 'get_balance_m';

if($fun == 'help'){
    echo_help();
}

if($fun == 'verify_login'){
    $params = array(
        'appid' => $appid,
        'openid' => $openid,
        'openkey' => $openkey,
        'userip' => $userip,
    );
    $ret = verify_login($sdk, $params, $qs);
    print_r("============== verify_login ================\n");
    print_r($ret);
}

elseif($fun == 'load_vip'){
    $params = array(
        'appid' => $appid,
        'openid' => $openid,
        'login' => 2, // 登录类型,默认填2
        'uin' => 0, // openid帐号体系,默认填0
        'vip' => $vip,
        'accessToken' => $openkey,
    );

    $ret = load_vip($sdk, $params, $qs);
    print_r("============== load_vip ================\n");
    print_r($ret);
}

elseif($fun == 'qqprofile'){
    $params = array(
        'appid' => $appid,
        'openid' => $openid,
        'accessToken' => $openkey,
    );

    $ret = qqprofile($sdk, $params, $qs);
    print_r("============== qqprofile ================\n");
    print_r($ret);
}

elseif($fun == 'qqfriends_detail'){
    $params = array(
        'appid' => $appid,
        'openid' => $openid,
        'accessToken' => $openkey,
        'flag' => $flag,
    );

    $ret = qqfriends_detail($sdk, $params, $qs);
    print_r("============== qqfriends_detail ================\n");
    print_r($ret);
}

elseif($fun == 'qqstrange_profile'){
    $params = array(
        'appid' => $appid,
        'openid' => $openid,
        'accessToken' => $openkey,
        'vcopenid' => $vcopenid,
    );

    $ret = qqstrange_profile($sdk, $params, $qs);
    print_r("============== qqstrange_profile ================\n");
    print_r($ret);
}


elseif($fun == 'qqfriends_vip'){
    $params = array(
        'appid' => $appid,
        'openid' => $openid,
        'accessToken' => $openkey,
        'vcopenid' => $vcopenid,
    );

    $ret = qqfriends_vip($sdk, $params, $qs);
    print_r("============== qqfriends_vip ================\n");
    print_r($ret);
}

elseif($fun == 'get_gift'){
    $params = array(
        'appid' => $appid,
        'openid' => $openid,
    );

    $ret = get_gift($sdk, $params, $qs);
    print_r("============== get_gift ================\n");
    print_r($ret);
}

elseif($fun == 'get_wifi'){
    $params = array(
        'appid' => $appid,
        'openid' => $openid,
    );

    $ret = get_wifi($sdk, $params, $qs);
    print_r("============== get_wifi ================\n");
    print_r($ret);
}

elseif($fun == 'qqscore_batch'){
    $params = array(
        'appid' => $appid,
        'openid' => $openid,
        'accessToken' => $openkey,
        'param' => $qqcore_param,
    );

    $ret = qqscore_batch($sdk, $params, $qs);
    print_r("============== qqscore_batch ================\n");
    print_r($ret);
}

elseif($fun == 'wx_refresh_token'){
    $params = array(
        'appid' => $appid,
        'refreshToken' => $refreshToken,
    );

    $ret = wx_refresh_token($sdk, $params, $qs);
    print_r("============== wx_refresh_token ================\n");
    print_r($ret);
}

elseif($fun == 'wx_check_token'){
    $params = array(
        'openid' => $openid,
        'accessToken' => $openkey,
    );

    $ret = wx_check_token($sdk, $params, $qs);
    print_r("============== wx_check_token ================\n");
    print_r($ret);
}

elseif($fun == 'wxfriends_profile'){
    $params = array(
        'openid' => $openid,
        'accessToken' => $accessToken,
    );

    $ret = wxfriends_profile($sdk, $params, $qs);
    print_r("============== wxfriends_profile ================\n");
    print_r($ret);
}

elseif($fun == 'wxprofile'){
    $params = array(
        'openid' => $openid,
        'accessToken' => $accessToken,
    );

    $ret = wxprofile($sdk, $params, $qs);
    print_r("============== wxprofile ================\n");
    print_r($ret);
}

elseif($fun == 'wxfriends'){
    $params = array(
        'openid' => $openid,
        'accessToken' => $accessToken,
    );

    $ret = wxfriends($sdk, $params, $qs);
    print_r("============== wxfriends ================\n");
    print_r($ret);
}

elseif($fun == 'wxuserinfo'){
    $params = array(
        'appid' => '',
        'openid' => $openid,
        'accessToken' => $accessToken,
    );

    $ret = wxuserinfo($sdk, $params, $qs);
    print_r("============== wxuserinfo ================\n");
    print_r($ret);
}

elseif($fun == 'wxscore'){
    $params = array(
        'appid' => '',
        'openid' => $openid,
        // 授权类型，默认使用：“client_credential”
        'grantType' => 'client_credential',
        'score' => $score,
        'expires' => $expires
    );
    $qs = array(
        'appid' => $appid,
        'timestamp' => $ts,
        'sig' => md5($appkey.$ts),
        'encode' => 1,
        'openid' => $openid,
    );
    $ret = wxscore($sdk, $params, $qs);
    print_r("============== wxscore ================\n");
    print_r($ret);
}

elseif($fun == 'wxbattle_report'){
    $params = array(
        'appid' => '',
        'openid' => $openid,
        'json' => $json
    );

    $ret = wxbattle_report($sdk, $params, $qs);
    print_r($ret);
}

elseif($fun == 'wxget_vip'){
    $params = array(
        'appid' => '',
        'openid' => $openid,
        'accessToken' => $openkey,
        'json' => $wx_vip_data
    );

    $ret = wxget_vip($sdk, $params, $qs);
    print_r("============== wxget_vip ================\n");
    print_r($ret);
}

elseif($fun == 'guest_check_token'){
    $params = array(
        'guestid' => $guestid,
        'accessToken' => $accessToken,
    );

    $ret = guest_check_token($sdk, $params, $qs);
    print_r("============== guest_check_token ================\n");
    print_r($ret);
}

elseif($fun == 'share_qq'){
    $params = array(
        'appid' => '',
        'openid' => $openid,
        'access_token' => $openkey,
        'userip' => '',
        'act' => $act,
        'oauth_consumer_key' => $oauth_consumer_key,
        'dst' => 1001,
        'flag' => 1,
        'image_url' => 'www.qq.com',
        'src' => 0,
        'summary' => 'test',
        'target_url' => 'www.qq.com',
        'title' => 'test',
        'fopenids' => '',
        'previewText' => ''
    );

    $ret = share_qq($sdk, $params, $qs);
    print_r("============== share_qq ================\n");
    print_r($ret);
}

elseif($fun == 'upload_wx'){
    $params = array(
        'flag' => 1,
        'appid' => '',
        'secret' => $appkey,
        'access_token' => '',
        'type' => 'thumb',
        'filename' => '',
        'filelength' => '',
        'content_type' => '',
        'binary' => '',
    );

    $ret = upload_wx($sdk, $params, $qs);
    print_r("============== upload_wx ================\n");
    print_r($ret);
}

elseif($fun == 'share_wx'){
    $params = array(
        'openid' => 1,
        'fopenid' => '',
        'access_token' => '',
        'extinfo' => '',
        'title' => 'thumb',
        'description' => '',
        'media_tag_name' => '',
        'thumb_media_id' => '',
    );

    $ret = share_wx($sdk, $params, $qs);
    print_r($ret);
}

elseif($fun == 'get_balance_m'){
    $params = array(
        'openid' => $openid,
        'openkey' => $openkey,
        'pay_token' => $pay_token,
        'ts' => $ts,
        'pf' => $pf,
        'pfkey' => $pfkey,
        'zoneid' => $zoneid,
    );

    $ret = get_balance_m($sdk, $params, $cookie);
    print_r("============== get_balance_m ================\n");
    print_r($ret);
}

elseif($fun == 'pay_m'){
    $amt = 10;
    $params = array(
        'openid' => $openid,
        'openkey' => $openkey,
        'pay_token' => $pay_token,
        'ts' => $ts,
        'pf' => $pf,
        'pfkey' => $pfkey,
        'zoneid' => $zoneid,
        'amt' => $amt,
    );

    $ret = pay_m($sdk, $params, $cookie);
    print_r("============== pay_m ================\n");
    print_r($ret);
}

elseif($fun == 'present_m'){
    $discountid = '';
    $giftid = '';
    $presenttimes = 50;
    $params = array(
        'openid' => $openid,
        'openkey' => $openkey,
        'pay_token' => $pay_token,
        'ts' => $ts,
        'pf' => $pf,
        'pfkey' => $pfkey,
        'zoneid' => $zoneid,
        'discountid' => $discountid,
        'giftid' => $giftid,
        'presenttimes' => $presenttimes
    );

    $ret = present_m($sdk, $params, $cookie);
    print_r("============== present_m ================\n");
    print_r($ret);
}


else{
    print_r("=============fun参数缺失或者输入参数错误==============\n");
    echo_help();
}


function echo_help(){
    print_r("============MSDK PHP SDK测试帮助===============\n");
    print_r("============fun=verify_login验证openkey==================\n");
    print_r("============fun=load_vipVIP信息接口===============\n");
    print_r("============fun=qqprofile个人信息接口===============\n");
    print_r("============fun=get_balance_m查询余额接口============\n");
}

// end of script
