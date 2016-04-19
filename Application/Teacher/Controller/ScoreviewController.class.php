<?php
/**
 * 
 * @authors  马廷广
 * @date    2016-04-01 17:34:20
 * 此控制器作用：
 */
namespace Teacher\Controller;
use Think\Controller;


class ScoreviewController extends Controller {

    public function index()
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
		$this->assign('now_course',$course);


		/*
		 *此处的作用是：
		 *成绩统计
		 *
		 */
		$temp 			= I('get.flag');
		if ($temp == 1) {
			
			

    
    }
    $this->display();
	}
}