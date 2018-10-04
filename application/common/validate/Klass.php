<?php
/**
 * Created by PhpStorm.
 * User: 周叶青
 * Date: 2018/10/4 0004
 * Time: 22:17
 */
namespace app\common\validate;
use think\Validate;
class Klass extends Validate {
    protected $rule = [
        'name'  => 'require|length:2,25',
        'teacher_id' => 'require'
    ];
}