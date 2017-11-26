<?php
/**
 * Created by PhpStorm.
 * User: ww
 * Date: 2017/11/4
 * Time: 18:22
 */

namespace app\api\model;



class Category extends BaseModel
{
    public function img()
    {
        return $this->belongsTo('Image','topic_img_id','id');
    }

    protected $hidden = ['delete_time','create_time','update_time'];




}