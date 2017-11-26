<?php
/**
 * Created by PhpStorm.
 * User: ww
 * Date: 2017/10/30
 * Time: 15:22
 */

namespace app\api\controller\v1;


use app\api\validate\IDMustBePositiveInt;
use app\api\model\Banner as BannerModel;
use app\lib\exception\BannerMissException;
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

        (new IDMustBePositiveInt())->goCheck();
        $banner = BannerModel::getBannerById($id);

        //会抛出BannerMissException的异常给render()方法，从而进行异常处理
        if(!$banner){
            throw new BannerMissException();
        }
        return $banner;
    }
}