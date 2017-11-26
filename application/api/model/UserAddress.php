<?php
/**
 * Created by PhpStorm.
 * User: ww
 * Date: 2017/11/5
 * Time: 19:55
 */

namespace app\api\model;


class UserAddress extends BaseModel
{
    protected $hidden = ['id','delete_time','user_id'];
}