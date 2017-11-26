<?php
/**
 * Created by PhpStorm.
 * User: ww
 * Date: 2017/11/7
 * Time: 13:50
 */

namespace app\api\controller\v1;

use app\api\service\Pay as PayService;
use app\api\service\WxNotify;
use app\api\validate\IDMustBePositiveInt;

class Pay extends BaseController
{
    protected $beforeActionList = [
        'checkElusiveScope' => ['only' => 'getPreOrder']
    ];

    //客户端要传递一个订单id
    public function getPreOrder($id='')
    {
        //向微信服务器发起预订单请求，微信服务器需要什么参数决定客户端需要传给我们什么参数

        (new IDMustBePositiveInt())->goCheck();

        $pay = new PayService($id);
        return $pay->pay();
    }

    //接收微信的通知
    public function receiveNotify()
    {
        //通知频率为15/15/30/180/1800/1800/1800/1800/3600 单位：秒

        //1.检查库存量  超卖
        //2.更新这个订单的status状态
        //3.减库存
        // 如果成功处理，我们返回微信成功处理的信息，否则，我们需要返回没有成功处理。（如果没有成功处理，微信还需不间断发消息给我们的接口）

        //微信的通知特点：post；xml格式；不会携带参数，即url问号携带的参数。
        $notify = new WxNotify();
        $notify->Handle();
    }

}