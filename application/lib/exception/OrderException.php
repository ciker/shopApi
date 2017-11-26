<?php
/**
 * Created by PhpStorm.
 * User: ww
 * Date: 2017/11/6
 * Time: 20:52
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $rule = 404;
    public $msg = '订单不存在，请检查ID';
    public $code = 80000;
}