<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<script src="/studentMange/Public/jquery/jquery-2.1.1.js"></script>
    <script src="/studentMange/Public/jquery/jquery-2.1.1.min.js"></script>
    <script src="/studentMange/Public/bootstrap/js/bootstrap.min.js"></script>
    <script src="/studentMange/Public/sweetalert-master/dist/sweetalert.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="/studentMange/Public/sweetalert-master/dist/sweetalert.css">
	<link rel="stylesheet" href="/studentMange/Public/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/studentMange/Public/sm/sm.css">
	<title>Document</title>
	<script src="/studentMange/Public/sm/sm.js"> </script>
</head>
<body>
<div class="container">
<input type="hidden"  id="insert_announce" value="<?php echo U('Home/Index/insert_announce');?>">

 <div class="row clearfix" id="header">

          
            <div class="col-md-12 column">
                <h1 id='threed' class="text-center" style="">
                <?php if($index_path == 'index_teacher'): ?><a href="<?php echo U('Home/Index/index_teacher');?>"><img src="/studentMange/Public/picture/logo.png" href="" alt=""></a> 
              <?php else: ?>
                <a href="<?php echo U('Home/Index/index_student');?>"><img src="/studentMange/Public/picture/logo.png" href="" alt=""></a><?php endif; ?>
                    </h1>
                <div >
                    <div style="float:left">
                  <button type="button" class="btn btn-danger" onclick="announce()">发布公告</button>
                  <div style="max-width:10px"><font size='5'><span id="announce_dis"><?php echo ($announcement); ?></span></font> </div>
                    </div>
 
                </div>

              <!--   <ul class="nav nav-pills" style="margin-left:80px">
                    <li class="active">
                        <a href="<?php echo U('Home/Manage');?>"> <span class="badge pull-right"></span>个人中心</a>
                    </li>
                    <li class="active" id="showLeft">
                        <a href="#"> <span class="badge pull-right" id="cart_value"><?php echo ($sum); ?></span> 购物车</a>

                    </li>
                       <?php if($coin == 'coin' ): else: ?>
                          <li class="active">
                        <a href="#"> <span class="badge pull-right" id="now_coin"><?php echo ($coin); ?></span> coin:</a>

                    </li><?php endif; ?>
                </ul> -->
              
                <blockquote class="pull-right">
                <?php if($username == 1 ): ?><div>
   <button type="button" class="btn btn-success" id="login" onclick="window.location='<?php echo U('Home/Login');?>';">登录</button>
     <button type="button" class="btn btn-warning" id="register" onclick="register()">注册</button>
    </div>
    <?php else: ?> 
    <div>
      <button type="button" class="btn btn-success" id="login">欢迎您<?php echo ($name); ?>
       <button type="button" class="btn btn-warning" id="register" onclick="send_logout()">登出</button>
     
      </button>
    </div><?php endif; ?>
                    <p>
                       O ever youthful,O ever weeping.
                    </p> <small>杰克·凯鲁亚克 <cite>达摩流浪者</cite></small>
                </blockquote>
            </div>
        </div>
     
     
<?php echo ($course); ?>  <a href="<?php echo U('Home/Course/send_work');?>">   发布作业</a>

<table class="table">
   <caption>近期作业情况统计</caption>
   <thead>
      <tr>
         <th>时间</th>
         <th>作业类型</th>
         <th>完成人数</th>
         <th>未完成人数</th>
         <th>本次作业设定为完成</th>
      </tr>
   </thead>
   <tbody>
   <?php if(is_array($student)): $key = 0; $__LIST__ = $student;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($key % 2 );++$key;?><tr class="active">
         <td><a href="<?php echo U('Index/teacher_course',array('cname'=>$value));?>">
		<?php echo ($value[1]); ?>
		 </a>
         </td>
         <td>上次：已提交->更多</td>
         <td>查看</td>
         <td>无</td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
         </tbody>
</table>
	
</div>
 
	
</body>
</html>