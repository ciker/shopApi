<?php
/**
 * Created by PhpStorm.
 * User: ww
 * Date: 2017/10/30
 * Time: 19:24
 */

namespace app\api\validate;


use think\Validate;

class IDMustBePositiveInt extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger',
    ];

    protected $message = [
        'id' => 'id必须是正整数！'
    ];
}