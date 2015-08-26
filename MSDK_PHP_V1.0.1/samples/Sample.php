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
$appid = 'your appid';
$appkey = 'your appkey';

// 应用支付基本信息,需要替换为应用自己的信息，必须和客户端保持一致
// 需要登录腾讯开放平台管理中心 http://op.open.qq.com/，选择已创建的应用进入，然后进入支付结算，完成支付的接入配置
// @wiki：http://wiki.mg.open.qq.com/index.php?title=Android%E6%94%AF%E4%BB%98%E6%8E%A5%E5%85%A5%E6%B5%81%E7%A8%8B
$pay_appid = 'your appid for pay';
$pay_appkey = 'your appkey for pay';

// MSDK后台API的服务器域名
// 调试环境: msdktest.qq.com
// 正式环境: msdk.qq.com
$server_name = 'msdktest.qq.com';

// 用户的OpenID，从客户端MSDK登录返回的LoginRet获取
$openid = 'open_id from android/ios mobile msdk';

// 用户的openkey，从客户端MSDK登录返回的LoginRet获取
$openkey = 'eToken_QQ_Access from android/ios mobile msdk';

// 支付接口票据, 从客户端MSDK登录返回的LoginRet获取
$pay_token='eToken_QQ_Pay from android/ios mobile msdk';

// 支付接口票据, 从客户端MSDK登录返回的LoginRet获取
$pf='pf from android/ios mobile msdk';

// 支付接口票据, 从客户端MSDK登录返回的LoginRet获取
$pfkey= 'pf_key from android/ios mobile msdk';

// 支付分区, 需要先在open.qq.com接入支付结算，并配置了分区
// 注意是分区ID，默认为1，如果在平台配置了分区需要传入对应的分区ID！
$zoneId='your zoneid';

// 当前UNIX时间戳
$ts=time();

// 用户的IP，可选，默认为空
$userip = '';


// 初始化SDK配置
$sdk = new Api($appid, $appkey);
// 支付id 支付key
$sdk->setPay($pay_appid, $pay_appkey);
// 设置调用环境，测试环境 or 现网环境
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
$cookie = array(
    'session_id' => 'hy_gameid',
    'session_type' => 'st_dummy',
    'org_loc' => ''
);

// 调用平台接口
// verify_login($sdk, $params, $qs);

// end of script
