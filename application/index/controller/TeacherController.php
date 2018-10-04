<?php
/**
 * Created by PhpStorm.
 * User: 周叶青
 * Date: 2018/9/21 0021
 * Time: 15:04
 */
namespace app\index\controller;
use think\Request;
use app\common\model\Teacher;

class TeacherController extends IndexController {
    public function index () {
        $name = Request::instance()->get('name');
        $pageSize = 5;
        $Teacher = new Teacher();
        if (!empty($name)) {
            $Teacher->where('name','like','%'.$name.'%');
        }
        $teachers = $Teacher->paginate($pageSize,false,['query'=>['name'=>$name]]);
        $this->assign('teachers',$teachers);
        $htmls = $this->fetch();
        return $htmls;
    }
    public function save () {
        $postData = Request::instance()->post();
        $Teacher = new Teacher();
        $Teacher->name = $postData['name'];
        $Teacher->sex = $postData['sex'];
        $Teacher->username = $postData['username'];
        $Teacher->email = $postData['email'];
        $result = $Teacher->validate(true)->save($Teacher->getData());
        if ($result === false) {
            return $this->error('新增失败：'.$Teacher->getError());
        } else {
            return $this->success('新增成功，新增户id为'.$Teacher->getData('id'),url('index'));
        }
    }
    public function add () {
        $htmls = $this->fetch();
        return $htmls;
    }
    public function delete () {
        //   第一种方法
        $id = Request::instance()->param('id/d');   //   /d表示将数值化为整形
        if (is_null($id) || 0 === $id) {
            return $this->error('未获取到id信息');
        }
        $Teacher = Teacher::get($id);
        if (is_null($Teacher)) {
            return $this->error('不存在id为'.$id.'的教师，删除失败');
        }
        if (!$Teacher->delete()) {
            return $this->error('删除失败：'.$Teacher->getError());
        }
        return $this->success('删除成功',url('index'));
        //   第二种方法
    //    $state = Teacher::destroy(10);
    //    return '删除记录数为：' . $state;
    }
    public function edit () {
        $id = Request::instance()->param('id/d');
        $Teacher = Teacher::get($id);
        if (is_null($Teacher)) {
            return $this->error('id:'.$id.'不存在');
        }
        $this->assign('Teacher',$Teacher);
        $htmls = $this->fetch();
        return $htmls;
    }
    public function update () {
        $teacher = Request::instance()->post();
        $Teacher = new Teacher();
        $result = $Teacher->validate(true)->isUpdate(true)->save($teacher);
        if (false === $result) {
            return $this->error('修改失败：'.$Teacher->getError());
        } else {
            return $this->success('修改成功',url('index'));
        }
    }
}