<?php
/**
 * Created by PhpStorm.
 * User: ww
 * Date: 2017/11/6
 * Time: 18:20
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;

class OrderPlace extends BaseValidate
{
    //这里是伪代码 方便阅读 客户端传递过来的订单数据
    protected $products = [
        [
            'product_id' => 1,
            'count'   => 1
        ],
        [
            'product_id' => 2,
            'count'   => 2
        ],
        [
            'product_id' => 3,
            'count' => 3
        ]
    ];

    protected $rule = [
        'products' => 'checkProducts'
    ];

    protected $singleRule = [
        'product_id' => 'require|isPositiveInteger',
        'count'      => 'require|isPositiveInteger'
    ];


    protected function checkProducts($values)
    {
//        if(is_array($values)){
//            throw new ParameterException([
//                'msg' => '商品参数不正确'
//            ]);
//        }
        if(empty($values)){
            throw new ParameterException([
                'msg' => '商品列表不能为空'
            ]);
        }
        foreach($values as $value){
            $this->checkProduct($value);
        }
        return true;
    }

    protected function checkProduct($value)
    {
        $validate = new BaseValidate($this->singleRule);
        $result = $validate->check($value);
        if(!$result){
            throw new ParameterException([
                'msg' => '商品列表参数错误'
            ]);
        }
    }
}