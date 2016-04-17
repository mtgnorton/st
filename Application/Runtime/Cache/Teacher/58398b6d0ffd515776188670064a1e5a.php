<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<div class="container">
<?php if(is_array($class_data)): $key = 0; $__LIST__ = $class_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($key % 2 );++$key;?><div id="course" class="course" > 
	<a href="<?php echo U('Index/teacher_course',array('cname'=>$value));?>">
	<button type="button" class="btn btn-primary btn-lg">

	<?php echo ($value); ?>

	 </button>
	 <span class="badge">
	 50
	 </span>
	 </a>
	 </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
	
</body>
</html>