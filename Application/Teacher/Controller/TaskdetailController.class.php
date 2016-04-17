<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/21
 * Time: 21:31
 */

namespace Teacher\Controller;
use Think\Controller;

class TaskdetailController extends Controller
{	

	

	public function index($id='',$course='')

	{
		
		if ( empty(session('tid'))) {
			$this->error('请先登录',U('Student/login/index'),3);
		}
		$this->assign('name',	session('tname')."老师");
		$t_course 				=  session('t_course');
		foreach ($t_course as $key => $value) {

		$te_course[$key]['course'] 	= $value;
		$te_course[$key]['color'] 	= $color[$i];
		}
		
		$this->assign('course',$te_course);
		$this->assign('now_course',$course);
		/*
		 *此处的作用是：
		 *获得老师首页下每个课程对应的班级
		 *
		 */
		$student_info		= 	get_class_student(session('t_course'));
    	$this->assign('class_data',	$student_info['class_data']);
		$staskModel 	= M('stask');
		
		/*
		 *此处的作用是：
		 *sm_stask和sm_student联合查询获得学生表的班级。
		 *
		 */
		$sql 	=	"select a.*,b.class from sm_stask a inner join sm_student b on a.sid = b.sid where a.task_id = $id order by b.class , b.sid";
		$task_data 	= $staskModel->query($sql);
		$this->assign('task_data',$task_data);

		/*
		 *此处的作用是：
		 *传递作业标题
		 *
		 */
		$task_title 	= I('get.title');
		$this->assign('task_title',$task_title);
	
		$this->display();
	}

}