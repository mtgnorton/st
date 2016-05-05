<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/21
 * Time: 21:31
 */
/*
	 *此处的作用是：
	 *该页面属于老师
	 *
	 */

namespace Teacher\Controller;
use Think\Controller;

class CourseController extends Controller
{
	public function index($course='')
	{	
	
		if ( empty(session('tid'))) {
			$this->error('请先登录',U('Student/login/index'),3);
		}
		$this->assign('name',	session('tname')."老师");
		$t_course 				=  session('course');
		$this->assign('course',$t_course);
	
		$this->assign('now_course',$course);
		/*
		 *此处的作用是：
		 *获得老师首页下每个课程对应的班级
		 *
		 */
		$student_info		= 	get_class_student(session('t_course'));
    	$this->assign('class_data',	$student_info['class_data']);

		$student_info 					= get_class_student(array($course),1);


		

    	/*
    	 *此处的作用是：
    	 *将以布置的作业在数据库中读取出来
    	 */
    	$tid 							=session('tid');
    	$ttaskModel 					= M('ttask');
    	$task_result 					= $ttaskModel->where("tid=$tid AND status=0 AND course='$course'")->select();
    	$this->assign('recent_task',$task_result);			
		$this->display();
	}

		/*
		 *此处的作用是：
		 *对应老师发布作业的页面和修改作业的页面
		 *
		 */
	public function send_work($course='')

	{

		if ( empty(session('tid'))) {
			$this->error('请先登录',U('Student/login/index'),3);
		}
		$this->assign('name',	session('tname')."老师");
		$t_course 				=  session('t_course');

		foreach ($t_course as $key => $value) {
		$te_course[$key]['course'] 	= $value;
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

		$this->assign('modify',0);
		if (I('get.modify') == 1) {

		/*
		 *此处的作用是：
		 *修改作业的操作
		 *
		 */
		$ttaskModel 		= M('ttask');
		$task_id 			= I('get.task_id');
		$task_data 			= $ttaskModel->where("id=$task_id")->find();
		$this->assign('modify',1);
		$this->assign('task_data',$task_data);
		if ($task_data['type'] == '课前') {
		$this->assign('task_type',1);
		}
		}
		$this->assign('name',	session('tname')."老师");
		
	  
	   	$this->assign('announce',1);
		$this->display();
	}

		/*
		 *此处的作用是：
		 *将老师布置的作业存入数据库
		 *
		 */
	public function send_content($value='')
	{	
		$ttaskModel 					= M('ttask');
		$task_id 						= I('post.id');
		if ( $task_id	!= '') {

		$update_data['title']			= I('post.title');
		$update_data['content'] 		= I('post.content');
		$update_data['type']			= I('post.type');
		$is_suc 						= $ttaskModel->where("id=$task_id")->save($update_data);
			if ($is_suc) {
		$response['msg']				= '更新作业成功';
		$response['flag']				= 1;
		$this->ajaxReturn($response,0);
		}
		else{
		$response['msg']				= '更新作业失败';
		$response['flag']				= 0;
		$this->ajaxReturn($response,0);
		}
		}
		
		$course 						= I('get.course');
		$student_info 					= get_class_student(array($course),1);

		$student_number 				= count($student_info);	
		$insert_data['title'] 			= I('post.title');
		$insert_data['content']			= I('post.content');
		$insert_data['course']			= I('get.course');
		$insert_data['tid'] 			= session('tid');
		$insert_data['tname'] 			= session('tname');
		$insert_data['start_time']		= time();
		$insert_data['total_number']	= $student_number;
		$insert_data['complete_number']	= 0;
		$insert_data['status'] 			= 0;
		$insert_data['type'] 			= I('post.type');
		$is_suc 						= $ttaskModel->add($insert_data);
		if ($is_suc) {
		$response['msg']				= '布置作业成功';
		$response['flag']				= 1;
		$this->ajaxReturn($response,0);
		}
		else{
		$response['msg']				= '布置作业失败';
		$response['flag']				= 0;
		$this->ajaxReturn($response,0);
		}
		
	}

	/*
	 *此处的作用是：
	 *将老师发布的公告插入数据库
	 *
	 */
	public function insert_announce()
	{


		$announcementModel 				= M('announcement');
		$tid 							= session('tid');
		$course 						= I('post.course');
		$is_exist 						= $announcementModel->where("tid=$tid AND course='$course'")->getField('id');
		if ($is_exist) {
		$update_data['content'] 		= I('post.announce');
		$update_data['start_time']		= time();
		$is_suc 						= $announcementModel->where("id=$is_exist")->save($update_data);
 		}
		else{
		$insert_data['tid'] 			= $tid;
		$insert_data['tname']			= session('tname');
		$insert_data['course'] 			= $course; 	
		$insert_data['start_time']	 	= time();
		$insert_data['content'] 		= I('post.announce');
		$is_suc 						= $announcementModel->add($insert_data);
	
		}
		if ($is_suc) {
		$response['msg']				= '公告发布成功';
		$response['flag']				= 1;
		$this->ajaxReturn($response,0);
		}
		else{
		$response['msg']				= '公告发布失败';
		$response['flag']				= 0;
		$this->ajaxReturn($response,0);
		}

	}
}