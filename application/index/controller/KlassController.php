<?php
/**
 * Created by PhpStorm.
 * User: 周叶青
 * Date: 2018/10/3 0003
 * Time: 22:37
 */
namespace app\index\controller;
use app\common\model\Klass;
use app\common\model\Teacher;
use think\Request;
class KlassController extends IndexController {
    public function index () {
        $klasses = Klass::paginate();
        $this->assign('klasses',$klasses);
        return $this->fetch();
    }
    public function edit () {
        $klassId = Request::instance()->param('id/d');
        $Klass = Klass::get($klassId);
        $teachers = Teacher::all();
        $this->assign('teachers',$teachers);
        $this->assign('Klass',$Klass);
        return $this->fetch();
    }
    public function update () {
        $klass = Request::instance()->post();
        $Klass = new Klass();
        $resule = $Klass->validate(true)->isUpdate(true)->save($klass);
        if (false === $resule) {
            return $this->error('修改失败：'.$Klass->getError());
        } else {
            return $this->success('修改成功',url('index'));
        }
    }
    public function delete () {
        $klassId = Request::instance()->param('id/d');
        $Klass = Klass::get($klassId);
        if (is_null($Klass)) {
            return $this->error('不存在id为' . $klassId . '的课程');
        }
        if ($Klass->delete()) {
            return $this->success('删除成功！',url('index'));
        } else {
            return $this->error('删除失败：'.$Klass->getError());
        }
    }
    public function add () {
        $teachers = Teacher::all();
        $this->assign('teachers',$teachers);
        return $this->fetch();
    }
    public function save () {
        $klass = Request::instance()->post();
        $Klass = new Klass();
        $result = $Klass->validate(true)->save($klass);
        if ($result) {
            return $this->success('新增成功！新增课程id为'.$Klass->getData('id'),url('index'));
        } else {
            return $this->error('新增失败：'.$Klass->getError());
        }
    }
}