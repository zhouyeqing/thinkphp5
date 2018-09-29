<?php
/**
 * Created by PhpStorm.
 * User: 周叶青
 * Date: 2018/9/28 0028
 * Time: 22:07
 */
namespace app\common\validate;
use think\Validate;
class Teacher extends Validate {
    protected $rule = [
        'username' => 'require|unique:teacher|length:4,25',
        'name' => 'require|length:2,25',
        'sex' => 'in:0,1',
        'email' => 'email'
    ];
}