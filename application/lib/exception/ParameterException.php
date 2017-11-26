<?php
/**
 * Created by PhpStorm.
 * User: ww
 * Date: 2017/10/31
 * Time: 22:14
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    public $code = 400;
    public $msg = '参数错误';
    public $errorCode = 10000;
}