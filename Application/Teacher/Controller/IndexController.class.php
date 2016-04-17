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
		$t_course 				=  session('t_course');

		foreach ($t_course as $key => $value) {

		$te_course[$key]['course'] 	= $value;
		$te_course[$key]['color'] 	= $color[$i];
		}
		
		$this->assign('course',$te_course);
	
		/*
		 *此处的作用是：
		 *获得老师首页下每个课程对应的班级
		 *
		 */
		$student_info		= 	get_class_student(session('t_course'));
    	$this->assign('class_data',	$student_info['class_data']);
    	
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