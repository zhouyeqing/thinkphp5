<?php
/**
 * Created by PhpStorm.
 * User: 周叶青
 * Date: 2018/10/3 0003
 * Time: 22:35
 */
namespace app\common\model;
use think\Model;
class Klass extends Model {
    protected $Teacher;
    public function Teacher () {   //班级表中获取当前老师对象
            return $this->belongsTo('Teacher');
    }
}