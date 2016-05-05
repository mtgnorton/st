<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/21
 * Time: 21:31
 */

namespace Teacher\Controller;
use Think\Controller;

	/*
	 *此处的作用是：
	 *该页面属于老师
	 *
	 */

class ClassController extends Controller
{	

	
	public function index($course='',$tran_class='')
	{
		/*
		 *此处的作用是：
		 *当点击首页的班级后，显示对应课程下班级的学生
		 *
		 */

	if ( empty(session('tid'))) {
			$this->error('请先登录',U('Student/login/index'),3);
		}
		$this->assign('name',	session('tname')."老师");
		/*
		 *此处的作用是：
		 *获得老师首页下每个课程对应的班级和学生
		 *
		 */
		$t_course 				=  session('course');
		$this->assign('course',$t_course);
		
		$this->assign('now_course',$course);
		/*
		 *此处的作用是：
		 *获得每个课程对应的所有班级，并对他们添加颜色all_class
		 *
		 */
		$student_info				= get_class_student(array($course));	
    	$class 						= $student_info['class_data'][$course];
    	asort($class);
    	$color=array( 'primary' , 'green' , 'yellow' , 'red' );
    	$i=0;
    	foreach ($class as $key => $value) {
    		$class[$key] 	= array('class'=>$value,'color'=>$color[$i]);
    		$i++;
    		if ($i == 3) {
    			$i = 0;
    		}
    	}
   
    	$this->assign( 'all_class' , $class);
    	reset($class);
    	list($temp,$value)=each($class);
    	$now_class=$value['class']; 
		$this->assign( 'now_class' ,$now_class);

		/*
		 *此处的作用是：
		 *获得默认班级下所有的学生now_class_student和数量number
		 *
		 */
		if (!empty($tran_class)) {
			$now_class = $tran_class;
			$this->assign('now_class',$now_class);
		}
		$all_student 				= $student_info['course_student_data'][$course];	
		foreach ($all_student as $key => $value) {
			
		list($temp_class,$info) 	= 	each($value);
		if ($temp_class  			== $now_class) {
			$now_class_student[] 	= $info;
		}
		}
		$now_class_student_number 	= count($now_class_student);
		$this->assign('number' , $now_class_student_number);
		

		/*
		 *此处的作用是：
		 *先在ttask表中查到当前课程和当前老师下最近的一次作业id，然后根据此id和学生的sid来
		 *查找stask表中学生是否完成了此课程下最近的一次作业
		 */
		$ttaskModel 				= M('ttask');
		$tname 						= session('tname');
		$sql 						= "select id,title from sm_ttask where course='$course' and tname='$tname' order by start_time desc limit 1";
		$recent_data				= $ttaskModel->query($sql);

		$recent_id 					= $recent_data['0']['id'];
		$this->assign('task_title', $recent_data['0']['title']);#获得最后一次作业的标题
		$staskModel 				= M('stask');

		foreach ($now_class_student as $key => $value) {
		$temp 						= $value['0'];
		$is_suc 					= $staskModel->where("sid=$temp AND task_id=$recent_id")->getField('id');
		if ($is_suc) {
			$now_class_student[$key]['stask_id'] 	= $is_suc;
			$now_class_student[$key][]	 			= 1;
		}
		else{
			$now_class_student[$key]['stask_id'] 	= 0;
			$now_class_student[$key][]	 			= 0;
		}
		}
		
		$this->assign('now_class_student', $now_class_student);
		$this->assign('now_course',$course);
		$this->display();
	
	}
	
	public function getScore()
	{
		$staskModel 	= M('stask');
		$sid 			= I('post.sid');
		$tid			= session('tid');
		$now_course		= I('post.course');
		$sql 			= "select score,sname,is_mark,b.tid,b.title from sm_stask as a right join (select id as tid ,title as title,start_time as time from sm_ttask where tid=$tid and course='$now_course') as b on a.task_id=b.tid and a.sid=$sid order by time asc ";
		$data 			= $staskModel->query($sql);
		foreach ($data as $key => $value) {
			if (empty($value['score']) ) {
				if (empty($value['sname'])) {
					$data[$key]['score'] 	= -1;#-1代表未提交作业
				}
				else{
					$data[$key]['score'] 	= -2;#-2代表未批改作业
				}
			}
		}
		$studentModel 	= M('student');
		$sname 			= $studentModel->where("sid=$sid")->getField('sname');
		$this->assign('sname',json_encode($sname,JSON_UNESCAPED_UNICODE));
		$data 			= json_encode($data,JSON_UNESCAPED_UNICODE);
		$this->ajaxReturn($data,0);
	}
}