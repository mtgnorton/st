<?php 


function GrabImage($url,$filename="",$class) { 
	$class 	= iconv('utf-8', 'gb2312', $class);
	if (is_dir('./Public/photo_head/'.$class)) {
		
	}
	else{
		mkdir('./Public/photo_head/'.$class);
	}
	$filename='./Public/photo_head/'.$class.'/'.$filename.'.jpg';
	if (file_exists($filename)) {
		$filename 	= iconv('gb2312', 'utf-8', $filename);
		return $filename;
	}
	if($url=="") return false; 

	if($filename=="") { 
	$ext=strrchr($url,"."); 
	if($ext!=".gif" && $ext!=".jpg" && $ext!=".png") return false; 
	$filename=date("YmdHis").$ext; 
	} 

	ob_start(); 
	readfile($url); 
	$img = ob_get_contents(); 
	ob_end_clean(); 
	$size = strlen($img); 

	$fp2=@fopen($filename, "a"); 
	fwrite($fp2,$img); 
	fclose($fp2); 
	$filename 	= iconv('gb2312', 'utf-8', $filename);
	return $filename; 
} 
		
			
			/*
			 *此函数的作用是：
			 * 获得老师所教课程的班级和班级下的学生信息
			 *返回值：
			 *array(
			 *  class_data=>
			 *	=>
			 *  =>
			 *)
			 */
function get_class_student($course_array='',$one="")
{
		$studentModel				=	M('student');
    	$student_course_Model		= 	M('student_course');
		foreach ($course_array as $key => $cname) {
    	
    
    	$course_student_sid 		= 	$student_course_Model->where("cname='$cname'")->getField('sid',true);
    	foreach ($course_student_sid as $key => $value) {
    	$temp_data					= 	$studentModel->where("sid=$value")->getField('sname,class');
    	list($name,$class) 			=  	each($temp_data);
    	if (in_array($class, $class_data[$cname])) {
    		
    	}
    	else{
    		$class_data[$cname][]	= 	$class;
    	}
    	$temp_data 					=	array($class => array($value,$name));	
    	if ($one) {
    	$course_student[] 			= 	array('id'=>$value,'name'=>$name);
    	}
    	$course_student_data[$cname][]		=  	$temp_data;

    	}
    	}
    	if ($one) {
    		return $course_student;
    	}
    	return array(
    	'class_data'				=> $class_data,
    	'course_student_data'		=>	$course_student_data,
    		);
}
	
	/*
	 *此处的作用是：
	 *如果flag不为0，那么使用id查询，如果为0使用课程名和老师名结合查询
	 *
	 */
 function get_task_info($course='',$tname='',$flag)
{
		$taskModel 		= M('ttask');
		if ($flag) {
		$task_data 		= $taskModel->where("id='$course'")->select();	
		}
		else{
	 	
    	$task_data 		= $taskModel->where("course='$course' AND tname='$tname'")->select();
    }
    	return $task_data;
}
	