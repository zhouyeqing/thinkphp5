<?php
/**
 * Created by PhpStorm.
 * User: 周叶青
 * Date: 2018/10/5 0005
 * Time: 20:31
 */
namespace app\index\controller;
use think\Request;
use app\common\model\Student;
use app\common\model\Klass;
class StudentController extends IndexController {
    public function index () {
        $studentName = Request::instance()->get('name');
        if (!empty($studentName)) {
            Student::where('name','like','%'.$studentName.'%');
        }
        $students = Student::paginate();
        $this->assign('students',$students);
        return $this->fetch();
    }
    public function add () {
        $Klasses = Klass::all();
        $this->assign('Klasses',$Klasses);
        return $this->fetch();
    }
    public function save () {
        $student = Request::instance()->get();
        $Student = new Student();
        $result = $Student->validate(true)->save($student);
        if (false === $result) {
            return $this->error('新增失败：'.$Student->getError());
        } else {
            return $this->success('新增成功，新增学生id为：'.$Student->getData('id'),url('index'));
        }
    }
    public function edit () {
        $studentId = Request::instance()->param('id/d');
        $Student = Student::get($studentId);
        if (is_null($Student)) {
            return $this->error('不存在id为'.$studentId.'的学生');
        }
        $this->assign('Student',$Student);
        return $this->fetch();
    }
    public function update () {
        $student = Request::instance()->post();
        $Student = new Student();
        $result = $Student->validate(true)->isUpdate(true)->save($student);
        if (false === $result) {
            return $this->error('修改失败：'.$Student->getError());
        } else {
            return $this->success('修改成功',url('index'));
        }
    }
    public function delete () {
        $studentId = Request::instance()->param('id/d');
        $Student = Student::get($studentId);
        if (is_null($Student)) {
            return $this->error('不存在id为：'.$studentId.'的学生！');
        }
        $result = $Student->delete();
        if ($result) {
            return $this->success('删除成功',url('index'));
        } else {
            return $this->error('删除失败：'.$Student->getError());
        }
    }
}