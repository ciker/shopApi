<?php
/**
 * Created by PhpStorm.
 * User: ww
 * Date: 2017/10/30
 * Time: 20:26
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;
use think\Exception;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        //获取http传入的参数
        //对传入的参数做校验
        $request = Request::instance();
        $params = $request->param();

        $result = $this->batch()->check($params);
        if(!$result){
            $e = new ParameterException([
                'msg'   =>  $this->error,
            ]);
            throw $e;
        }else{
            return true;
        }
    }

    protected function isPositiveInteger($value, $rule = '', $data = '', $field = '')
    {
        //判断$value是否为正整数
        if(is_numeric($value) && is_int($value + 0) && ($value + 0) > 0){
            return true;
        }else{
            return false;
//            return $field.'必须是正整数';
        }
    }

    protected function isNotEmpty($value)
    {
        if(empty($value)){
            return false;
        }else{
            return true;
        }

    }

    protected function isMobile($value, $rule = '', $data = '', $field = '')
    {
        $rule = '^1(3|4|5|7|8)[0-9]\d{8}$^';
        $result = preg_match($rule,$value);
        if($result){
            return true;
        }else{
            return false;
        }

    }

    public function getDataByRule($arrays)
    {
        if(array_key_exists('user_id',$arrays) | array_key_exists('uid',$arrays)){
            //不允许包含user_id或者uid，防止恶意覆盖user_id外键
            throw new ParameterException([
                'msg' => '参数中含有非法的参数名user_id或uid'
            ]);
        }
        $newArray = [];
        foreach ($this->rule as $key => $value){
            $newArray[$key] = $arrays[$key];
        }
        return $newArray;
    }
    
    
}