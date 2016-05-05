<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/21
 * Time: 21:31
 */

namespace Student\Controller;
use Think\Controller;


class LoginController extends Controller
{

    public function index()
    {
  
        $this->display();
    }
    public function verify() {
        $verify 				= new \Think\Verify();
        $verify ->userNoise		= false;
        $verify->useCurve		= false;
        $verify->codeSet 		= '0123456789'; 
        $verify->length   		= 4;
        $verify->imageW 		= 200;
        $verify->imageH 		= 50;
        $verify->entry();
    }
    public function login_judge($value='')
    {	
    	if (I('post.identity') == "student") {

    	$data['sid']		= I('post.sid');
    	$data['password']	= I('post.password');

    	$response 			= $this->login_student_judge($data);
    
    	$response['identity']	= 0;
   
    	}
    	else{

    	 
    	$data['tid']		= I('post.sid');

    	$data['password']	= I('post.password');
    	
    	$response 			= $this->login_teacher_judge($data);
    	
    	$response['identity']	= 1;	
    	}
    	$this->ajaxReturn($response,0);
    }
    public  function  login_student_judge($data=''){

    	$studentModel				=	M('student');
    	$student_course_Model		= 	M('student_course');
    	$sid						=  	$data['sid'];//'1208010126';	
    	$password					=   $data['password'];//
    	$code 						= 	I('post.verify');
		$verify 					= 	new \Think\Verify();    
	    $verify_result				= 	1;//$verify->check($code);
	    if ($verify_result			!=	1) {
	    	$response['msg']		= '验证码错误';
			$response['flag']		= 0;

	    }
	    else{

	   	
	  	$sname 					= $studentModel->where("sid=$sid")->getField('sname');
	 

	  	/*
	  	 *此处的作用是：
	  	 *如果数据库里没有此学生的信息，则到校网爬取
	  	 *
	  	 */
	  	if (empty($sname)) {

	  	$student_info 				= R('Spider/transfer',array($sid,$password));
	 
	  	if ($student_info['status'] == 0) {
	  	$response['msg']	= '用户登录失败，请检查您的用户名或者密码';
		$response['flag']	= 0;
		return $response;
	  	}

	  	 /*
	  	  *此处的作用是：
	  	  *学生为首次登陆时，将学生的个人信息和课表信息录入数据库
	  	  *
	  	  */
	  	if ($student_info['status'] == 1 ) {
	  		 $student_info['perinfo']['photo']          =  GrabImage($student_info['perinfo']['photo_add'],$sid,$student_info['perinfo']['class']);
	    	 $insert_per_data['sid']	 				 = $sid;
	    	 $insert_per_data['password']				 =crypt($password,$sid);

	    	 $insert_per_data['sname']	= $student_info['name'];
	    	 $insert_per_data['depart']	= $student_info['perinfo']['depart'];
	    	 $insert_per_data['profession']	= $student_info['perinfo']['profession'];
	    	 $insert_per_data['class'] 	= $student_info['perinfo']['class'];
	    	 $insert_per_data['phone']	= $student_info['perinfo']['phone'];
	    	 $insert_per_data['photo'] 	= $student_info['perinfo']['photo'];
	    	 $is_suc 					= $studentModel -> add($insert_per_data);
	    	 $temp_judge 				= 0;
	  
	    	
	    	 if ($is_suc ) {
			
	    	 session(array('name'=>'session_id','expire'=>3600));
	    	 session('sid',		$sid );
	    	 session('sname',	$student_info['name']);
	    	 session('temp_course',$student_info['courseinfo']);
	    	 $response['msg']	= '用户登录成功';
			 $response['flag']	= 1;
			 return $response;
			

	    	 }
	    	
	    }
	    else{
	    	$response['msg']	= '获取校网信息失败';
			$response['flag']	= 0;
			return $response;
			
	    }
	  	}
	  	else{
	  		/*
	  		 *此处的作用是：
	  		 *当数据库中有此学生的数据时，直接写入session，登录成功
	  		 *
	  		 */

	  		$password_database				= $studentModel->where("sid=$sid")->getField('password');
	  		if (crypt($password,$sid) == $password_database) {
	  			
	  		$course_tea_data 	= $student_course_Model->where("sid=$sid")->getField('cname,tname');
	  		$student_info 				= R('Spider/transfer',array($sid,$password));
	  		session(array('name'=>'session_id','expire'=>3600));
	  		session('sid'	, $sid);
	  		session('sname'	, $sname);
	  		session('temp_course',$student_info['courseinfo']);
	  		session('s_course', $course_tea_data);
	  		$response['msg']	= '用户登录成功';
			$response['flag']	= 1;
			return $response;
	
		}
		else{
			$response['msg']	= '用户密码错误';
			$response['flag']	= 0;
			return $response;	
		}
	  	}
	    
	    }
	   

}
	public function login_teacher_judge($data='')
	{
		$teacherModel				=	M('teacher');
    	$teacher_course_Model		= 	M('teacher_course');
    	$tid						=   $data['tid'];//'080135';	
    	$password					= 	$data['password'];//'0801357377';
    	$code 						= 	I('post.verify');
		$verify 					= 	new \Think\Verify();    
	    $verify_result				= 	1;//$verify->check($code);
	    if ($verify_result			!=	1) {
	    	$response['msg']		= '验证码错误';
			$response['flag']		= 0;

	    }
	    else{

	   
	  	$tname 					= $teacherModel->where("tid=$tid")->getField('tname');


	  	/*
	  	 *此处的作用是：
	  	 *如果数据库里没有此学生的信息，则到校网爬取
	  	 *
	  	 */
	  	if (empty($tname)) {

	  	$teacher_info 				= R('JsSpider/transfer',array($tid,$password));

	  	if ($teacher_info['status'] == 0) {
	  	$response['msg']	= '用户登录失败，请检查您的用户名或者密码';
		$response['flag']	= 0;
		return $response;
	  	}

	  	 /*
	  	  *此处的作用是：
	  	  *老师为首次登陆时，将老师的个人信息和课表信息录入数据库
	  	  *
	  	  */
	  	if ($teacher_info['status'] == 1 ) {

	    	 $insert_per_data['tid'] 	= $tid;
	    	 $insert_per_data['password'] =crypt($password,$tid);
	    	 $insert_per_data['tname'] 	= $teacher_info['name'];
	    	 $is_suc 					= $teacherModel -> add($insert_per_data);
	    	 $temp_judge 				= 0;

	    	 foreach ($teacher_info['courseinfo'] as $key => $value) {

	    	 $insert_course_data['cname']	=	$value;
	    	 $insert_course_data['tname']	= 	$teacher_info['name'];
	    	 $insert_course_data['tid'] 	= 	$tid;
	    	 $temp 							=   $teacher_course_Model->add($insert_course_data);
	    	 if (!$temp) {
	    	 	$temp_judge++;
	    	 }
	    	 }

	    	 /*
	    	  *此处的作用是：
	    	  *如果用户登录成功，写入session，session中包含学号和课程以及老师的信息
	    	  *
	    	  */
	    	 if ($is_suc and count($teacher_info['courseinfo']) == $temp_judge) {
	    	
	    	 session(array('name'=>'session_id','expire'=>3600));
	    	 session('tid',		$tid );
	    	 session('tname',	$teacher_info['name']);
	    	 session('t_course',	$teacher_info['courseinfo']);
	    	 $response['msg']	= '用户登录成功';
			 $response['flag']	= 1;
			 return $response;
		

	    	 }
	    	
	    }
	    else{
	    	$response['msg']	= '获取校网信息失败';
			$response['flag']	= 0;
			return $response;
			
	    }
	  	}
	  	else{

	  		/*
	  		 *此处的作用是：
	  		 *当数据库中有此老师的数据时，直接写入session，登录成功
	  		 *
	  		 */
	  		$password_database				= $teacherModel->where("tid=$tid")->getField('password');
	  		if (crypt($password,$tid) ==$password_database) {
	  			
	  		
	  		$course_tea_data 	= $teacher_course_Model->where("tid=$tid")->getField('cname',true);

	  		$student_info 				= R('JsSpider/transfer',array($tid,$password));
	  		session(array('name'=>'session_id','expire'=>3600));

	  		session('temp_course',$student_info['courseinfo']);
	  		session('tid'	, $tid);
	  		session('tname'	, $tname);
	  		session('t_course', $course_tea_data);
	  			
	  		// $this->redirect('Index/index_teacher','登录成功');
	  		// $this->success('登录成功', 'Index/index');
	  		$response['msg']	= '用户登录成功';
			$response['flag']	= 1;
			return $response;
			}else{
			$response['msg']	= '用户密码错误';
			$response['flag']	= 0;
			return $response;
			}

	  	}
	    
	    }
		
	} 

	
	

		public function logout($value='')
		{

			if (I('post.logout')) {
			session(null);
			$response['msg']=true;
			$response['message']='您已经成功退出';
			$this->ajaxReturn($response,0);
				}
		}
}