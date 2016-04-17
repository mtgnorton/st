<?php
/**
 * 
 * @authors  马廷广
 * @date    2016-03-28 21:04:32
 * 此控制器作用：学生课程下的页面
 */
namespace Student\Controller;
use Think\Controller;


class CourseController extends Controller {

    public function index($course='',$tname='')
    {
    	   
        if (empty(session('sid'))) {

        $this->error('请先登录',U('Student/login'),3);
        }
        $this->assign('name',session('sname')."同学");
        $this->assign('course',$course);
        $now_course          = $course;
        
        /*
         *此处的作用是：
         *将学生的课程信息对应的老师信息和是否有作业，传递到首页
         *
         */
        
        $course             = session('s_course');

        $taskModel          = M('ttask');
        foreach ($course as $key => $value) {
        $is_suc         = $taskModel->where("course='$key' AND tname='$value'")->find();
        if ($is_suc) {

        $course_task_data[] = array('course'=>$key,'tname'=>$value,'is_task'=>1);
        }else{

        $course_task_data[] = array('course'=>$key,'tname'=>$value,'is_task'=>0);
        }
        }
        
        $this->assign('course_task_data',$course_task_data);
        

    	$task_data		 = get_task_info($now_course,$tname);

    	$staskModel 	 = M('stask');
    	$sid 			 = session('sid');
    	$color 			 = array('active','success','warning','danger');
    	$i 				 = 0;
    	/*
    	 *此处的作用是：
    	 *取出学生作业对应的数据，判断此学生该作业是否完成，并取出作业id当学生需要修改作业
    	 *时，传递该id
    	 */
    	foreach ($task_data as $key => $value) {

    	$tid 			 = $value['id'];
    	$stask_data 			 = $staskModel->where("sid=$sid AND task_id=$tid")->getField('id,is_mark,mark_reply,score');
      
    	$task_data[$key]['color'] 	  = $color[$i];
    	$i++;
    	if ($i 	== 4 ) {
    		$i=0;
    	}

    	if ($stask_data) {
        list($id,$other_data)   = each($stask_data);
        $task_data[$key]['is_mark']     = $other_data['is_mark'];
        $task_data[$key]['mark_reply']  = $other_data['mark_reply'];
        $task_data[$key]['score']       = $other_data['score'];
    	$task_data[$key]['is_finish']   = 1;

    	}

    	else{

    	$task_data[$key]['is_finish'] = 0; 

    	}
    	$task_data[$key]['s_task_id'] = $id;
    	}
        /*
         *此处的作用是：
         *输出照片
         *
         */
        $sid                = session('sid');
        $studentModel       = M('student');
        $photo_head         = $studentModel->where("sid=$sid")->getField('photo');
        $this->assign('photo_head',__ROOT__.$photo_head);

    	$this->assign('name',session('sname')."同学");
    	$this->assign('task_data',$task_data);
        
    	$this->assign('is_announce',1);
    	$this->display();
    }
}