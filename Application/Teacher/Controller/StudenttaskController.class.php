<?php
/**
 * 
 * @authors  马廷广
 * @date    2016-04-01 17:34:20
 * 此控制器作用：
 */
namespace Teacher\Controller;
use Think\Controller;


class StudenttaskController extends Controller {

    public function index($sid='',$course='')
    {	


	if ( empty(session('tid'))) {
			$this->error('请先登录',U('Student/login/index'),3);
		}
		$this->assign('name',	session('tname')."老师");
		/*
		 *此处的作用是：
		 *获得老师首页下每个课程对应的班级和学生
		 *
		 */
		$t_course 				=  session('t_course');
		foreach ($t_course as $key => $value) {

		$te_course[$key]['course'] 	= $value;
		$te_course[$key]['color'] 	= $color[$i];
		}
		
		$this->assign('course',$te_course);

    	$ttaskModel 		= M('ttask');
    	$tname 				= session('tname');
    	$studentModel 		= M('Student');
    	$sname 				= $studentModel->where("sid=$sid")->getField('sname');
    	$this->assign('sname', $sname);
    	// $sql1				= "select b3 from (select a.title as a1,b.sid as b1,b.score as b2 ,b.task_id as b3 from sm_ttask a left join sm_stask b on a.id=b.task_id where a.course='$course' and a.tname='$tname'  ) as c where b1=$sid order by b3";
    	$sql 				= "select c.*,b.submit_time,b.is_mark,b.score from (select title as title,id as task_id,start_time as stime from sm_ttask  where course='$course' and tname='$tname')as c LEFT JOIN sm_stask as b ON c.task_id=b.task_id and b.sid=$sid  order by c.stime desc";
    	$data 				= $ttaskModel->query($sql);
    	
    	$this->assign('recent_task',$data);
    	
    	$this->display();

    }
}