<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/21
 * Time: 21:31
 */

namespace Teacher\Controller;
use Think\Controller;

class IndexController extends Controller
{	

	

	public function index($value='')
	{	
		/*
		 *此处的作用是：
		 *判断用户是否登录
		 *
		 */
	
		if ( empty(session('tid'))) {
			$this->error('请先登录',U('Student/login/index'),3);
		}
		$this->assign('name',	session('tname')."老师");
		$t_course 				=  session('course');
		$this->assign('course',$t_course);

		/*
		 *此处的作用是：
		 *获得老师首页下每个课程对应的班级
		 *
		 */
		$student_info		= 	get_class_student(session('t_course'));
    	$this->assign('class_data',	$student_info['class_data']);
    	
    	$this->assign('t_course',session('temp_course'));
    	/*
    	 *此处的作用是：
    	 *获得老师对应的公告
    	 *
    	 */

   
    	$teacherModel 		= M('teacher');
    	$tid 				= session('tid');
    	$announcement 		= $teacherModel->where("tid=$tid")->getField('announcement');
    	$this->assign('announcement',$announcement);
    	$this->display();
	
	}

	/*
	 *此处的作用是：
	 *将老师发布的公告插入数据库
	 *
	 */
	public function insert_announce($value='')
	{
 		$teacherModel 			= M('teacher');

		$data['announcement']	= I('post.announce');
		$tid 					= session('tid');
		$is_suc 				= $teacherModel->where("tid=$tid")->save($data);
		if ($is_suc) {
		$response['msg']		= '公告插入成功';
		$response['flag']		= 1;
		$this->ajaxReturn($response,0);
		exit;
		}

	}
	/*
	 *此处的作用是：
	 *老师批量添加课程时，此函数调用数据库
	 *
	 */
		public function add_course($value='')
		{
			$teacher_course_Model 	= M('teacher_course');
			$tid 					= session('tid');
			$tname 					= session('tname');
			$course 				= I('post.course');
			if (empty($course)) {
			$response['flag']		= 0;
			$response['msg']		= "您没有选择课程" ;
			$this->ajaxReturn($response,0);
			}
			foreach ($course as $key => $value) {
			
			$insert_data['tid'] 	= $tid;
			$insert_data['cname']	= $value;
			$insert_data['tname']	= $tname;

			$is_exist				= $teacher_course_Model->where("tid='$tid' AND cname='$value'")->getField('id');
		
			if ($is_exist) {
				continue;
			}
		    $teacher_course_Model	-> add($insert_data);
			}
			$course_tea_data 		= $teacher_course_Model->where("tid=$tid")->getField('id,cname');
			foreach ($course_tea_data as $key => $value) {
			$course_arr[] 	= array('course'=>$value);
			}
			session('course', $course_arr);
			$response['flag']		= 1;
			$response['msg']		= "课程添加成功";
			$this->ajaxReturn($response,0);
		
		}

		/*
		 *此处的作用是：
		 *当学生手动添加课程时，此函数调用数据库
		 *
		 */
		public function add_one_course($value='')
		{
			$teacher_course_Model 	= M('teacher_course');
			$tid 					= session('tid');
			$course 				= I('post.course');
			$course 				= trim($course);
			// $tname 					= I('post.tname');
			// $tname 					= trim($tname);
			$tname 					= session('tname');
			$insert_data['tid']		= $tid;
			$insert_data['tname']	= $tname;
			$insert_data['cname'] 	= $course;
			$is_exist				= $teacher_course_Model->where("tid='$tid' AND cname='$course'")->find();
			if ($is_exist) {
			$response['flag']		= 0;
			$response['msg']		= "课程已存在";
			$this->ajaxReturn($response,0);
			}else{
			$teacher_course_Model	-> add($insert_data);

			$course_tea_data 		= $teacher_course_Model->where("tid=$tid")->getField('id,cname');
			foreach ($course_tea_data as $key => $value) {
			$course_arr[] 	= array('course'=>$value);
			}
			session('course', $course_arr);

			$response['flag']		= 1;
			$response['msg']		= "添加课程成功";
			$this->ajaxReturn($response,0);
			}
			
			
		}
		public function delete_course($value='')
		{
			$teacher_course_Model 	= M('teacher_course');
			$tid 					= session('tid');
			$tname 					= session('tname');
			$course 				= I('post.course');
			if (empty($course)) {
			$response['flag']		= 0;
			$response['msg']		= "您没有选择课程" ;
			$this->ajaxReturn($response,0);
			}
			foreach ($course as $key => $value) {
			
			$insert_data['tid'] 	= $tid;
			$insert_data['cname']	= $value;
			$insert_data['tname']	= $tname;

			$is_exist				= $teacher_course_Model->where("tid='$tid' AND cname='$value'")->getField('id');

			if ($is_exist) {
			$teacher_course_Model->where("id=$is_exist")->delete();
			}

			}
		
			$course_tea_data 		= $teacher_course_Model->where("tid=$tid")->getField('id,cname');
			foreach ($course_tea_data as $key => $value) {
			$course_arr[] 	= array('course'=>$value);
			}
			session('course', $course_arr);
			
			$response['flag']		= 1;
			$response['msg']		= "删除课程成功";
			$this->ajaxReturn($response,0);
		
		
	}

	public function logout($value='')
	{
		if ( I('get.logout') ) {
		session(null);
		$this->redirect('Student/login/index',array(), 1, '页面跳转中...');
		}
	}
	public function test($value='')
	{
		$this->display();
	}

}