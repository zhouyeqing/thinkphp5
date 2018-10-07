<?php
/**
 * Created by PhpStorm.
 * User: 周叶青
 * Date: 2018/10/5 0005
 * Time: 20:28
 */
namespace app\common\model;
use think\Model;
class Student extends Model{
    protected $Klass;
    protected $type = [   //类型自动转换
    //    'create_time'=>'datetime'
    ];
    public function Klass () {   //获取班级信息，对象直接调用->Klass,获取相对应的班级对象
            return $this->belongsTo('Klass');
    }
    public function getSexAttr ($value) {   //属性获取器，类似类型装换，即将属性按照自定规则装换
        $status = ['0'=>'男','1'=>'女'];
        $sex = $status[$value];
        if (isset($sex)) {
            return $sex;
        } else {
            return $status[0];
        }
    }
}