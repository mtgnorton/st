<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/21
 * Time: 21:31
 */

namespace Student\Controller;
use Think\Controller;


class TempController extends Controller
{
	public function index($value='')
	{
		$class = array('131','132','133','134');
		
		$course= array('操作系统原理A','操作系统实验','UNIX程序设计');

		$studentModel				=	M('student');
    	$student_course_Model		= 	M('student_course');
    	for ($i=0; $i <100 ; $i++) { 
    		$temp=rand(0,3);

    			$temp_t=rand(0,2);
    		    	 $insert_per_data['sid']	= rand(1000000000,9999999999);
	     $insert_per_data['sname']	= $this->test1();
	     $insert_per_data['depart']	= "信息科学技术学院";
	     $insert_per_data['profession']	= "计算机科学与技术";
	     // $insert_per_data['phone']	= $student_info['perinfo']['phone'];
	     // $insert_per_data['photo'] 	= $student_info['perinfo']['photo'];
	     $insert_per_data['class'] 		= $class[$temp];
	     $studentModel ->add($insert_per_data);
	     $insert_course_data['cname']	=	$course[$temp_t];
	     $insert_course_data['tname']	= 	'曹玲';
	     $insert_course_data['sid'] 	= 	 $insert_per_data['sid'];
	     $student_course_Model->add($insert_course_data);
    	}


	}
	public function test($value='')
	{
		$result=rand(1000000000,9999999999);
		echo $result;
	}
	public function test1($value='')
	{
		
		$length=5;
    // 密码字符集，可任意添加你需要的字符
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    $password = '';
    for ( $i = 0; $i < $length; $i++ ) 
    {
        // 这里提供两种字符获取方式
        // 第一种是使用 substr 截取$chars中的任意一位字符；
        // 第二种是取字符数组 $chars 的任意元素
        // $password .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        $password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
    }


    return $password;

	}

}