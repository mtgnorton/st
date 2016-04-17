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
		$staskModel 	= M('stask');
		$sid 			= I('get.sid');
		$tid			= session('tid');
		$now_course		= I('get.course');
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
		$this ->assign('data',$data);
    	$this->display();
	}
}