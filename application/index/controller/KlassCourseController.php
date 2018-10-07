<?php
/**
 * Created by PhpStorm.
 * User: 周叶青
 * Date: 2018/10/7 0007
 * Time: 0:16
 */
namespace app\index\controller;
use think\Request;
use app\common\model\KlassCourse;
class KlassCourseController extends IndexController {
    public function index () {
        return '我是KlassCourse控制器index方法';
    }
}