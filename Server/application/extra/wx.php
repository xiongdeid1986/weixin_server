<?php
/**
 * Created by PhpStorm.
 * User: code
 * Date: 1/12/2018
 * Time: 4:41 AM
 */

return [
    "session_key" => "https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",
    "message" => "https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token=%s",
    "token_expire" => 7000
];