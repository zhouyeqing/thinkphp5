<?php
/**
 * Created by PhpStorm.
 * User: 周叶青
 * Date: 2018/10/3 0003
 * Time: 22:35
 */
namespace app\common\model;
use app\index\controller\IndexController;
use think\Model;
class Klass extends Model {
    protected $Teacher;
    public function getTeacher () {   //班级表中获取当前老师对象
        if (is_null($this->Teacher)) {
            $teacherId = $this->getData('teacher_id');
            $this->Teacher = Teacher::get($teacherId);
            return $this->Teacher;
        } else {
            return $this->Teacher;
        }
    }
}