<?php
/**
 * Created by PhpStorm.
 * User: 周叶青
 * Date: 2018/10/3 0003
 * Time: 13:47
 */
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\common\model\Teacher;
class LoginController extends Controller{
    public function index () {   //显示登陆表单页面
        $htmls = $this->fetch();
        return $htmls;
    }
    public function login () {   //处理用户提交的登陆数据
        $replay = Teacher::login(Request::instance()->post('username'),Request::instance()->post('password'));
        if ($replay['result']) {
            return $this->success($replay['resultmessage'],url('Teacher/index'));
        } else {
            return $this->error($replay['resultmessage']);
        }
    }
    public function logOut () {
        if (Teacher::logOut()) {
            return $this->success('登出成功！',url('index'));
        } else {
            return $this->error('登出错误！',url('index'));
        }
    }
}