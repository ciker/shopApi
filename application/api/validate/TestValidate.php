<?php
/**
 * Created by PhpStorm.
 * User: ww
 * Date: 2017/10/30
 * Time: 18:47
 */

namespace app\api\validate;


use think\Validate;

class TestValidate extends Validate
{
    protected $rule = [
        'name' => 'require|max:10',
        'email'=> 'email',
    ];
}