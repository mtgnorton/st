<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/21
 * Time: 21:31
 */

namespace Student\Controller;
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
		if (empty(session('sid'))) {

		$this->error('请先登录',U('Student/login'),3);
		}
		$this->assign('name',session('sname')."同学");
		
		
		/*
		 *此处的作用是：
		 *将学生的课程信息对应的老师信息和是否有作业，传递到首页
		 *
		 */
		
		
		$course 			= session('s_course');
		$taskModel 			= M('ttask');
		foreach ($course as $key => $value) {
		$is_suc 		= $taskModel->where("course='$key' AND tname='$value'")->find();
		if ($is_suc) {

		$course_task_data[]	= array('course'=>$key,'tname'=>$value,'is_task'=>1);
		}else{

		$course_task_data[]	= array('course'=>$key,'tname'=>$value,'is_task'=>0);
		}
		}
		
		$this->assign('course_task_data',$course_task_data);
		$this->assign('t_course',session('temp_course'));
		$this->assign('s_course',session('s_course'));

		/*
		 *此处的作用是：
		 *输出照片
		 *
		 */
		$sid 				= session('sid');
		$studentModel 		= M('student');
		$photo_head 		= $studentModel->where("sid=$sid")->getField('photo');
		$this->assign('photo_head',__ROOT__.$photo_head);

		$this->display();
	}

	public function logout($value='')
	{
		if ( I('post.logout') ) {
		session(null);
		$response['flag']=1;
		$response['message']='您已经成功退出';
		$this->ajaxReturn($response,0);
		}
	}

	/*
	 *此处的作用是：
	 *学生查看公告时，此函数查询数据库
	 *
	 */
	public function view_announcement($value='')
	{
		$course 				= I('post.course');
		$tname 					= I('post.tname');
		$announcementModel		= M('announcement');
		$announcement_content 	= $announcementModel->where("course='$course' AND tname='$tname'")->getField('content');

		if ($announcement_content) {
			$response['flag'] 	= 1;
			$response['msg'] 	= $announcement_content;
			$this->ajaxReturn($response,0);
		}
		else{
			$response['flag'] 	= 0;
			$response['msg'] 	= '无';
			$this->ajaxReturn($response,0);
		}

	}

	/*
	 *此处的作用是：
	 *学生批量添加课程时，此函数调用数据库
	 *
	 */
		public function add_course($value='')
		{
			$student_course_Model 	= M('student_course');
			$sid 					= session('sid');

			$course 				= I('post.course');
			if (empty($course)) {
			$response['flag']		= 0;
			$response['msg']		= "您没有选择课程" ;
			$this->ajaxReturn($response,0);
			}
			foreach ($course as $key => $value) {
			$arr=explode('-', $value);
			$insert_data['sid'] 	= $sid;
			$insert_data['cname']	= $cname	= $arr['0'];
			$insert_data['tname']	= $tname 	= $arr['1'];
			$is_exist				= $student_course_Model->where("sid=$sid AND cname='$cname' AND tname='$tname'")->find();
			if ($is_exist) {
				continue;
			}
		    $student_course_Model	-> add($insert_data);
			}
			$course_tea_data 	= $student_course_Model->where("sid=$sid")->getField('cname,tname');
			session('s_course', $course_tea_data);
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
			$student_course_Model 	= M('student_course');
			$sid 					= session('sid');
			$course 				= I('post.course');
			$course 				= trim($course);
			$tname 					= I('post.tname');
			$tname 					= trim($tname);
			$insert_data['sid']		= $sid;
			$insert_data['tname']	= $tname;
			$insert_data['cname'] 	= $course;
			$is_exist				= $student_course_Model->where("sid=$sid AND cname='$course' AND tname='$tname'")->find();
			if ($is_exist) {
			$response['flag']		= 0;
			$response['msg']		= "课程已存在";
			$this->ajaxReturn($response,0);
			}else{
			$student_course_Model	-> add($insert_data);
			$course_tea_data 	= $student_course_Model->where("sid=$sid")->getField('cname,tname');
			session('s_course', $course_tea_data);
			$response['flag']		= 1;
			$response['msg']		= "添加课程成功";
			$this->ajaxReturn($response,0);
			}
			
			
		}
		public function delete_course($value='')
		{
			$student_course_Model 	= M('student_course');
			$sid 					= session('sid');

			$course 				= I('post.course');
			if (empty($course)) {
			$response['flag']		= 0;
			$response['msg']		= "您没有选择课程" ;
			$this->ajaxReturn($response,0);
			}
			foreach ($course as $key => $value) {
			$arr=explode('-', $value);
			$insert_data['sid'] 	= $sid;
			$insert_data['cname']	= $cname	= $arr['0'];
			$insert_data['tname']	= $tname 	= $arr['1'];
			$is_exist				= $student_course_Model->where("sid=$sid AND cname='$cname' AND 
				tname='$tname'")->getField('id');
		
			if ($is_exist) {
			$student_course_Model->where("id=$is_exist")->delete();
			$course_tea_data 	= $student_course_Model->where("sid=$sid")->getField('cname,tname');
			session('s_course', $course_tea_data);
			$response['flag']		= 1;
			$response['msg']		= "删除课程成功";
			$this->ajaxReturn($response,0);
			}

		}
			
		}
		public function test($value='')
		{
			$temp = array('sadf'=>123);
			list($aa,$cc)= each($temp);
			echo $cc;
		}
}