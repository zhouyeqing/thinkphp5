<?php
/**
 * Created by PhpStorm.
 * User: 周叶青
 * Date: 2018/9/21 0021
 * Time: 15:36
 */
namespace app\common\model;
use think\Model;
class Teacher extends Model {
    static public function login ($username,$password) {   //Teacher模型的login方法，用于处理登陆界面数据
        $temp = ['result'=>false,'resultmessage'=>'错误未知！'];
        if (empty($username)) {
            $temp['result'] = false;
            $temp['resultmessage'] = '请输入你的用户名！';
            return $temp;
        } else if (empty($password)) {
            $temp['result'] = false;
            $temp['resultmessage'] = '请输入你的密码！';
            return $temp;
        } else if (is_null($Teacher =self::get(array('username'=>$username)))) {
            $temp['result'] = false;
            $temp['resultmessage'] = '你输入的用户名不存在！';
            return $temp;
        } else if (!$Teacher->checkPassword($password)) {   //运用Teacher类中继承的checkPassword方法，检测密码是否正确
            $temp['result'] = false;
            $temp['resultmessage'] = '你输入的密码有误！';
            return $temp;
        } else {
            session('teacherId',$Teacher->getData('id'));
            session('teacherName',$Teacher->getData('name'));
            $temp['result'] = true;
            $temp['resultmessage'] = '登陆成功！';
            return $temp;
        }
    }
    public function checkPassword ($password) {   //对象方法，判断密码是否正确
        if ($this->getData('password') === $this::encryptPassword($password)) {
            return true;
        } else {
            return false;
        }
    }
    static public function encryptPassword ($password) {   //密码加密
        return sha1(md5($password).'zhouyeqing');
    }
    static public function logOut () {   //登出
        session('teacherId',null);
        session('teacherName',null);
        return true;
    }
    static public function isLogin () {   //判断是否登陆
        $teacherId = session('teacherId');
        if (isset($teacherId)) {
            return true;
        }
    }
}