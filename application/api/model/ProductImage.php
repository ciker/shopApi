<?php
/**
 * Created by PhpStorm.
 * User: ww
 * Date: 2017/11/5
 * Time: 14:26
 */

namespace app\api\model;


class ProductImage extends BaseModel
{
    protected $hidden = ['img_id','delete_time','product_id'];

    public function imgUrl()
    {
        return $this->belongsTo('Image','img_id','id');
    }


}