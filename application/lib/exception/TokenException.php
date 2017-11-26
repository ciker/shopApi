<?php
/**
 * Created by PhpStorm.
 * User: ww
 * Date: 2017/11/5
 * Time: 11:51
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 401;
    public $msg = "Token已过期或已无效Token";
    public $errorCode = 10001;
}