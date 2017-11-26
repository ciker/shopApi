<?php
/**
 * Created by PhpStorm.
 * User: ww
 * Date: 2017/11/7
 * Time: 10:35
 */

namespace app\api\controller\v1;


use app\api\service\Token as TokenService;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\OrderPlace;
use app\api\service\Order as OrderService;
use app\api\model\Order as OrderModel;
use app\api\validate\PagingParameter;
use app\lib\exception\OrderException;

class Order extends BaseController
{
    //用户在选择商品时，向API提交包含它所选择商品的相关信息
    //服务器API在接收到信息后，需要检查订单相关商品的库存量
    //有库存，把订单数据存入数据库中=下单成功了，返回客户端消息，告诉客户端可以支付

    //调用我们的支付接口，进行支付
    //还需要再次进行库存量检测（允许在一定的时间段内支付，所以需要再次进行库存量检测
    //服务器调用微信的接口进行微信支付
    //小程序根据服务器发起的结果拉起微信支付
    //微信会返回给我们一个支付的结果（异步）
    //成功：也需要进行库存量的检测
    //成功：进行库存量的扣除   （微信会返回给客户端一个支付成功或失败的结果）
    protected $beforeActionList = [
        'checkElusiveScope' => ['only' => 'placeOrder'],
        'checkPrimaryScope' => ['only' => 'getSummaryByUser,getDetail']
    ];

    //获取订单列表
    public function getSummaryByUser($page=1,$size=15)
    {
        (new PagingParameter())->goCheck();
        $uid = TokenService::getCurrentUid();
        $pagingOrders = OrderModel::getSummaryByUser($uid,$page,$size);
        if($pagingOrders->isEmpty()){
            return [
                'data' => [],
                'current_page' => $pagingOrders->getCurrentPage()
            ];
        }
        $data = $pagingOrders->hidden(['snap_items','snap_address','prepay_id'])->toArray();
        return [
            'data' => $data,
            'current_page' => $pagingOrders->getCurrentPage()
        ];
    }

    //获取某个订单详情
    public function getDetail($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $orderDetail = OrderModel::get($id);
        if(!$orderDetail){
            throw new OrderException();
        }
        return $orderDetail->hidden(['prepay_id']);
    }

    public function placeOrder()
    {
        (new OrderPlace())->goCheck();
        $products = input('post.products/a');
        $uid = TokenService::getCurrentUid();

        $order = new OrderService();
        $status = $order->place($uid,$products);
        return $status;
    }

}