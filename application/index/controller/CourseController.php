<?php
/**
 * Created by PhpStorm.
 * User: 周叶青
 * Date: 2018/10/6 0006
 * Time: 22:01
 */
namespace app\index\controller;
use app\common\model\Course;
use think\Request;
class CourseController extends IndexController {
    public function index () {
        $Courses = Course::paginate();
        $this->assign('Courses',$Courses);
        return $this->fetch();
    }
    public function add () {
        $this->assign('Course',new Course);
        return $this->fetch();
    }
    public function save () {
        $courseName = Request::instance()->post('name');
        if (empty($courseName)) {
            return $this->error('请输入课程名字！');
        }
        $Course = new Course();
        $Course->name = $courseName;
        $result1 = $Course->validate(true)->save();
        if (false === $result1) {
            return $this->error('课程保存出错：'.$Course->getError());
        }
        $klass_ids = Request::instance()->post('klass_id/a');
        if (empty($klass_ids)) {
            return $this->error('请选择班级！');
        } else {
            $result2 = $Course->klasses()->saveAll($klass_ids);
            if (!$result2) {
                return $this->error('课程-班级信息保存错误：'.$Course->klasses()->getError());
            }
        }
        unset($Course);
        return $this->success('操作成功',url('index'));
    }
    public function edit () {
        $id = Request::instance()->param('id/d');
        $Course = Course::get($id);
        if (is_null($Course)) {
            return $this->error('不存在ID为' . $id . '的记录');
        }
        $this->assign('Course', $Course);
        return $this->fetch();
    }
    public function update () {
        $courseId = Request::instance()->post('id/d');
        $Course = Course::get($courseId);
        $courseName = Request::instance()->post('name');
        if (empty($courseName)) {
            return $this->error('请输入课程名字');
        } else {
            $Course->name = $courseName;
            $result1 = $Course->validate(true)->save();
            if (false === $result1) {
                return $this->error('课程信息更新发生错误：'.$Course->getError());
            }
        }
        $map = ['course_id'=>$courseId];
        $result2 = $Course->KlassCourses()->where($map)->delete();
        if (false === $result2) {
            return $this->error('删除班级课程关联信息发生错误：'.$Course->KlassCourses()->getError());
        }
        $courseIds = Request::instance()->post('klass_id/a');
        $result3 = $Course->klasses()->saveAll($courseIds);
        if (false === $result3) {
            return $this->error('添加班级课程关联信息发生错误：'.$Course->Klasses()->getError());
        }
        return $this->success('信息修改成功',url('index'));
    }
    public function delete () {
        $courseId = Request::instance()->param('id/d');
        $Course = Course::get($courseId);
        $result1 = $Course->delete();
        if ($result1 === false) {
            return $this->error('课程删除失败：'.$Course->getError());
        }
        $map = ['course_id'=>$courseId];
        $result2 = $Course->KlassCourses()->where($map)->delete();
        if ($result2 === false) {
            return $this->error('课程班级关联信息删除失败：'.$Course->KlassCourses()->getError());
        }
        return $this->success('课程删除成功',url('index'));
    }
}