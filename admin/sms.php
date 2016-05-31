<?php

/**
 * 鸿宇多用户商城 短信模块 之 控制器
 * ============================================================================
 * 版权所有 2015-2016 鸿宇多用户商城科技有限公司，并保留所有权利。
 * 网站地址: http://bbs.hongyuvip.com；
 * ----------------------------------------------------------------------------
 * 仅供学习交流使用，如需商用请购买正版版权。鸿宇不承担任何法律责任。
 * 踏踏实实做事，堂堂正正做人。
 * ============================================================================
 * $Author: Shadow & 鸿宇
 * $Id: sms.php 17217 2016-01-19 06:29:08Z Shadow & 鸿宇
 */

define('IN_ECS', true);
require(dirname(__FILE__) . '/includes/init.php');
include(ROOT_PATH . "sms/hy_config.php");

header("content-Type: text/html; charset=Utf-8"); //设置字符的编码是utp-8
error_reporting(0);

?>
    <html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>阿里大鱼短信管理</title>
    <style type="text/css" >
        :focus{outline:none;}
        .myem {font-size: 15px;color: black;font-weight: bold;}
        .main {padding-left: 60px;}
        .button {width: 150px;height: 35px;border-radius: 5px;border: none;background-color: #0E94D1;color: #FFF;margin-left: 66px;}
        .button:hover {cursor: pointer;}
        a{color: red;text-decoration: none;margin-left: 8px;}
        a:hover {color: red;text-decoration: underline;}
        .div1 {color: black;font-size: 14px;}
        input {padding: 3px 5px;font:12px "sans-serif", "Arial", "Verdana";line-height: 12px;}
        body{font:12px "sans-serif", "Arial", "Verdana";}
        span {line-height: 25px;color: gray;font-size: 13px;}
        h3{font-size: 18px;border-bottom: 1px solid #DCDCDC;padding: 10px 0;}
        p{font:12px "sans-serif", "Arial", "Verdana";}
    </style>
    <body>
    <h3 align="center">阿里大鱼短信管理 - 免费版</h3>
    <div class="main">
        <form method="post" action="">
            <div class="div1">
                <span class="myem">请填写阿里大鱼短信参数<a href="http://www.alidayu.com" target="_blank">申请账号</a></span>
                <p>　App Key&nbsp;：<input type="text" id="appkey" name="hy_appkey" value='<?php echo $hy_appkey ?>'/>
                <p>App Secret：<input type="text" id="secretkey" name="hy_secretkey" style="width: 228px;" value='<?php echo $hy_secretkey ?>'/><p>
                <p>　短信签名：<input type="text" id="sign" name="hy_sign" value='<?php echo $hy_sign ?>'/><i style="font-style: normal;margin-left: 15px;color: #808080;">注意：此处填写内容必须是阿里大鱼审核通过的签名，否则短信无法发送。</i></p>
                <p>　短信模板：<input type="text" id="sign" name="sms_register_tpl" value='<?php echo $sms_register_tpl ?>'/>
                    <i style="font-style: normal;margin-left: 15px;color: #808080;">模板申请格式 1.模板名称：用户注册验证码 2.模板类型：验证码 3.模板内容：验证码${code}，您正在进行${product}身份验证，打死不要告诉别人哦！</i></p>
                <p style="color: #808080;">　特别注意：① 阿里大鱼短信环境必须是：PHP5.3　MySQL5.1/5.5</p>
                <p style="color: #808080;">　　　　　　② 获取模板编号：管理中心 -> 短信模板管理 -> 模板ID(必须审批通过)</p>
				<p style="color: #808080;">　　　　　　③ 设置IP白名单：开发者控制台 -> 单击应用名 -> 安全中心 -> IP白名单设置</p>
                <p style="color: #808080;">　　　　　　④ 此版本为阿里大鱼免费版：因开发和维护成本较高，短信全版为收费版，如有需要请联系：鸿宇 & Shadow QQ：1527200768</p>
                <p style="color: #808080;">　　　　　　⑤ 点击查看<a href="http://bbs.hongyuvip.com/?/article/178" target="_blank" style="margin: 0 5px;">鸿宇免费版阿里大鱼短信使用教程</a></p>

            </div>

        <div class="div2">
            <span class="myem" >是否开启报错提示</span><br/>
            是<input type="radio" name="hy_showbug" value="1" <?php if($hy_showbug==1){echo 'checked';} ?>/>
            否<input type="radio" name="hy_showbug" value="0" <?php if($hy_showbug==0){echo 'checked';} ?>/><br/>
            <span>开启后，短信发送失败时，将提示详细错误信息。</span><p>
        </div>

            <input class="button" type="submit" name="submit" id="submit" value="提交修改"/><br/><br/><br/>
        </form>
    </div>
    <div style="width: 100%;line-height: 35px;font-size: 12px;color: #585858;text-align: center;position:fixed;bottom:0;border-top: 1px solid #DCDCDC;"><a href="http://hongyuvip.com" target="_blank" style="text-decoration: none;color: #585858;">Copyright © 2015 - 2016 鸿宇科技 版权所有 盗版必究 </a></div>
    </body>
    </html>

<?php
error_reporting(0);
if (isset($_POST['submit'])) {
    $file = "../sms/hy_config.php";
    $files = "../mobile/sms/hy_config.php";
    if (!is_writable($file)) {
        echo "<script>alert('sms目录下的hy_config.php文件不可写或不存在。请检查文件或目录权限');</script>";
    } else {
        file_put_contents($file, "");
        $config_str = "<?php";
        $config_str .= "\n\n";
        $config_str .= '$hy_appkey = "' . $_POST['hy_appkey'] . '";';
        $config_str .= "\n\n";
        $config_str .= '$hy_secretkey = "' . $_POST['hy_secretkey'] . '";';
        $config_str .= "\n\n";
        $config_str .= '$hy_sign = "' . $_POST['hy_sign'] . '";';

        $config_str .= "\n\n";
        $config_str .= '$sms_register_tpl = "' . $_POST['sms_register_tpl'] . '";';

        $config_str .= "\n\n";
        $config_str .= '$hy_showbug = "' . $_POST['hy_showbug'] . '";';

        $config_str .= "\n\n";
        $config_str .= "?>";
        $hy = fopen($file, "w+");
        fwrite($hy, $config_str);
        fclose($hy);
        file_put_contents($files, "");
        $hy_mobile = fopen($files, "w+");
        fwrite($hy_mobile, $config_str);
        fclose($hy_mobile);
    }
    echo "<script>alert('操作成功');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
}
?>