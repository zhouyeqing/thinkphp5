<?php
/**
 * Created by PhpStorm.
 * User: 周叶青
 * Date: 2018/9/21 0021
 * Time: 15:04
 */
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\common\model\Teacher;
use traits\think\Instance;

class TeacherController extends Controller {
    public function index () {
        $Teacher = new Teacher();
        $teachers = $Teacher->select();
        $this->assign('teachers',$teachers);
        $htmls = $this->fetch();
        return $htmls;
    }
    public function insert () {
        $postData = Request::instance()->post();
        $Teacher = new Teacher();
        $Teacher->name = $postData['name'];
        $Teacher->sex = $postData['sex'];
        $Teacher->username = $postData['username'];
        $Teacher->email = $postData['email'];
        $result = $Teacher->validate(true)->save($Teacher->getData());
        if ($result === false) {
            return '新增失败'.$Teacher->getError();
        } else {
            return '新增成功,新增id为：'.$Teacher->id;
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
            return $this->error('删除失败'.$Teacher->getError());
        }
        return $this->success('删除成功',url('index'));

        //   第二种方法
    //    $state = Teacher::destroy(10);
    //    return '删除记录数为：' . $state;
    }

}