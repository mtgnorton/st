<?php
/**
 * 
 * @authors  马廷广
 * @date    2016-04-01 17:34:20
 * 此控制器作用：
 */
namespace Teacher\Controller;
use Think\Controller;


class ViewtaskController extends Controller {

    public function index($stask_id='',$course='')
    {

    	if ( empty(session('tid'))) {
			$this->error('请先登录',U('Student/login/index'),3);
		}
		$this->assign('name',	session('tname')."老师");
	   $t_course               =  session('course');
        $this->assign('course',$t_course);
		$this->assign('now_course',$course);

    	$staskModel 	=	M('stask');
        if (I('get.path') == 1) {
            $this->assign('path',1);
        }

        /*
         *此处的作用是：
         *获得学生的作业
         *
         */

    	$sql 			= "select a.*,b.title,c.class from sm_stask a join sm_ttask b on a.task_id=b.id join sm_student c on a.sid=c.sid  where a.id=$stask_id";
    	$task_data 		= $staskModel->query($sql);
    	$task_data['0']['content']=htmlspecialchars_decode($task_data['0']['content']);
    	$this->assign('task_data',$task_data['0']);
        if ($task_data['0']['is_mark'] == 1) {
        $this->assign('modify',1);   
        }else{
        $this->assign('modify',0);
        }

    	
    	$this->display();
    	
    }

    /*
     *此处的作用是：
     *将老师的批改情况存到数据库
     *
     */
    public function mark_task($value='')
    {
    	$task_id 					= I('post.id');
    	$mark 						= I('post.mark');
    	$score 						= I('post.score');
    	$staskModel 				= M('stask');
    	$update_data['mark_reply']	= $mark;
    	$update_data['is_mark'] 	= 1;
    	$update_data['score'] 		= $score;
    	$is_suc 					= $staskModel->where("id=$task_id")->save($update_data);
    	if ($is_suc) {
    	$response['flag']	= 1;
    	$response['msg'] 	= "作业批改成功";
    	$this->ajaxReturn($response,0);
    	}
    	else{
    	$response['flag']	= 0;
    	$response['msg'] 	= "请不要重复提交";
    	$this->ajaxReturn($response,0);	
    	}
    	
    }

    /*
     *此处的作用是：
     *当老师批改作业时，点击下一个学生时，会向后台请求n个数据，交由js处理
     *
     */
    public function next_student_task($value='')
    {
     $task_id                    = I('post.task_id') ;
     $staskModel                 = M('stask');
     $sql                        = "select a.*,b.title,c.class from sm_stask a join sm_ttask b on a.task_id=b.id join  sm_student c on a.sid=c.sid  where a.is_mark=0 and a.task_id=$task_id order by c.class ,c.sid limit 3 ";
     $task_data                  = $staskModel->query($sql); 
     if (empty($task_data)) {
    $data                       = array('status'=>0);
    $data                       = json_encode($data, JSON_UNESCAPED_UNICODE );
    $this->ajaxReturn($data); 

     }else{

     foreach ($task_data as $key => $value) {

         $task_data[$key]['submit_time']    =   date('n-j H:i ',$task_data[$key]['submit_time']).'周'. date('N',$task_data[$key]['submit_time']);
         $task_data[$key]['content']        =   htmlspecialchars_decode($value['content']); 
     }
     $data                       = json_encode($task_data, JSON_UNESCAPED_UNICODE );
     $this->ajaxReturn($data);
    }
    }
 
}