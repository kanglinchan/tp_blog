<?php
/**
 * Created by PhpStorm.
 * User: kanglin
 * Date: 2016/9/3
 * Time: 23:05
 */

namespace Admin\Model;
use Think\Model;


class AttributeModel extends Model{
    


    protected $_validate    =  array(
        array('name','require','验证码必须！'),
        array('value','require','验证码必须！'),
    );


}