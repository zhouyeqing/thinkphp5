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
    public function getTeacher () {   //班级表中获取当前老师对象
        $teacherId = $this->getData('teacher_id');
        $Teacher = Teacher::get($teacherId);
        if ($Teacher === null) {   //防止报错
            $temp = new IndexController();
            return $temp;
        }
        return $Teacher;
    }
}