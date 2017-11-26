<?php
/**
 * Created by PhpStorm.
 * User: ww
 * Date: 2017/10/31
 * Time: 13:50
 */

namespace app\api\model;


use think\Db;
use think\Exception;
use think\Model;

class Banner extends BaseModel
{
    protected $hidden = ['update_time','delete_time'];

    //去关联banner_item模型
    public function items()
    {
        return $this->hasMany('BannerItem','banner_id','id');
    }


    public static function getBannerById($id)
    {
        $banner = self::with(['items','items.img'])->find($id);
        return $banner;
    }
}