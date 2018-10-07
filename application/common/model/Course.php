<?php
/**
 * Created by PhpStorm.
 * User: 周叶青
 * Date: 2018/10/6 0006
 * Time: 21:57
 */
namespace app\common\model;
use think\Model;
class Course extends Model {
    public function klasses () {
        return $this->belongsToMany('Klass',config('database.prefix').'klass_course');
    }
    public function KlassCourses() {
        return $this->hasMany('KlassCourse');
    }
    public function getIsChecked ($Klass) {
        $courseId = (int)$this->id;
        $klassId = (int)$Klass->id;
        $map = array();
        $map['klass_id'] = $klassId;
        $map['course_id'] = $courseId;
        $klassCourse = KlassCourse::get($map);
        if (is_null($klassCourse)) {
            return false;
        } else {
            return true;
        }
    }
}