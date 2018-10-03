<?php
/**
 * Created by PhpStorm.
 * User: 周叶青
 * Date: 2018/10/3 0003
 * Time: 22:37
 */
namespace app\index\controller;
use app\common\model\Klass;
class KlassController extends IndexController {
    public function index () {
        $klasses = Klass::paginate();
        $this->assign('klasses',$klasses);
        return $this->fetch();
    }
}