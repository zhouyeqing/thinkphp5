<?php
/**
 * Created by PhpStorm.
 * User: 周叶青
 * Date: 2018/10/7 0007
 * Time: 0:00
 */
namespace app\common\validate;
use think\Validate;
class KlassCourse extends Validate {
    protected $rule = [
        'klass_id'  => 'require',
        'course_id' => 'require'
    ];
}