<?php

namespace app\api\model;

use think\Model;

class BaseModel extends Model
{
    public function prefixImgUrl($value,$data)
    {
        $finalUrl = $value;
        if($data['from'] == 1 ){
            $finalUrl = config('setting.img_prefix') . $value;
        }
        return $finalUrl;
    }
}
