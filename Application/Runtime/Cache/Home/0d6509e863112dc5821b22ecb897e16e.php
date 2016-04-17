<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/youju/Public/bootstrap/css/bootstrap.min.css" />
	<script type="text/javascript" src="/youju/Public/jquery/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="/youju/Public/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
  <p>ffffff</p>
 
<?php if($user == 111): elseif($user == 222): ?>
222
<?php else: ?>
333<?php endif; ?>
<?php switch($$user): case "111": ?>switch 1111<?php break;?>
<?php case "222": ?>switch2222<?php break;?>
<?php default: ?>error</br><?php endswitch;?>
<?php if(($password) < "1"): ?>compare 1111<?php endif; ?>

<table border='2' cellpadding="20" class="table table-striped">
<tr align="center"><th>id</th> <th align="center">&nbsp;sentence</th><th>originpath</th> </tr>
<?php if(is_array($result_image)): $i = 0; $__LIST__ = array_slice($result_image,2,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$arr): $mod = ($i % 2 );++$i;?><tr align="center">
<!-- <td><?php echo ($i); ?></td> -->
<td><a href="<?php echo U('Home/Image/index',array('id'=>$arr['sentence'],'type'=>'id'));?>"><?php echo ($arr["id"]); ?></a></td><td><?php echo ($arr["sentence"]); ?></td><td><?php echo ($arr["originpath"]); ?></td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>
<?php $__FOR_START_9308__=2;$__FOR_END_9308__=40;for($i=$__FOR_START_9308__;$i < $__FOR_END_9308__;$i+=2){ echo ($i); ?>&nbsp;<?php } ?>


</table>
</body>
</html>