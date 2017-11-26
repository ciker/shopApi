<?php
/**
 * Created by PhpStorm.
 * User: ww
 * Date: 2017/10/30
 * Time: 15:22
 */

namespace app\api\controller\v2;


use think\Exception;

class Banner
{
    /**
     * 获取指定id的banner信息
     * @url /banner/:id
     * @http GET
     * @id banner的id号
     *
     */
    public function getBanner($id,$version)
    {
        
        return 'This is V2 Version';
    }
}