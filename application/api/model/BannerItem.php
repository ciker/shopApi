<?php

namespace app\api\model;

use think\Model;

class BannerItem extends BaseModel
{
    protected $hidden = ['id','img_id','delete_time','update_time','banner_id'];

    public function img()
    {
        return $this->belongsTo('Image','img_id','id');
    }
}
