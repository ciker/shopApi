<?php
/**
 * Created by PhpStorm.
 * User: ww
 * Date: 2017/11/6
 * Time: 17:40
 */

namespace app\api\controller\v1;

use app\api\service\Token as TokenService;

use think\Controller;

class BaseController extends Controller
{
    //验证scope权限的方法
    protected function checkPrimaryScope()
    {
        TokenService::needPrimaryScope();
    }

    protected function checkElusiveScope()
    {
        TokenService::needExclusiveScope();
    }
}