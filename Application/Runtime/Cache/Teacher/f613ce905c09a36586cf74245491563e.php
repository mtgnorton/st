<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <title>发布作业</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
 
    <script type="text/javascript" src="/studentMange/Public/umeditor/third-party/jquery.min.js"></script>

        <script src="/studentMange/Public/sweetalert-master/dist/sweetalert.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="/studentMange/Public/sweetalert-master/dist/sweetalert.css">
    <link rel="stylesheet" href="/studentMange/Public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/studentMange/Public/sm/sm.css">
    <script src="/studentMange/Public/sm/sm.js"></script>

      <link href="/studentMange/Public/startbootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/studentMange/Public/startbootstrap/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/studentMange/Public/startbootstrap/dist/css/sb-admin-2.css" rel="stylesheet">

    <link href="/studentMange/Public/startbootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap Core JavaScript -->
    <script src="/studentMange/Public/startbootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/studentMange/Public/startbootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/studentMange/Public/startbootstrap/dist/js/sb-admin-2.js"></script>
  
    
   
<!-- 
    <link rel="stylesheet" type="text/css" href="/studentMange/Public/input_beautify/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="/studentMange/Public/input_beautify/css/component.css" /> 
    <link rel="stylesheet" type="text/css" href="/studentMange/Public/input_beautify/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="/studentMange/Public/input_beautify/fonts/font-awesome-4.2.0/css/font-awesome.min.css" /> -->

</head>
<body>



 <div id="wrapper">

 
 

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo U('Teacher/index/index');?>">学习助手</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
              
                <!-- /.dropdown -->
          
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>              
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>查看所有作业</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> 欢迎您<?php echo ($name); ?></a>
                        </li>
                       
                        <li class="divider"></li>
                        <li><a href="<?php echo U('Teacher/index/logout',array('logout'=>1));?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                   <?php if(is_array($course)): $key = 0; $__LIST__ = $course;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($key % 2 );++$key;?><li>
                    

                            <a class="sssss" href="<?php echo U('Teacher/Course/index',array('course'=>$value['course']));?>"><i class="fa fa-bar-chart-o fa-fw"></i> <?php echo ($value['course']); ?><span class="fa arrow"></span></a>
                          
                            <ul class="nav nav-second-level">

                               <li>
                                    <a  href="<?php echo U('Teacher/Course/index',array('course'=>$value['course']));?>">近期作业统计</a>
                                </li>
                                  <li>
                                  <a href="javascript:void(0)" onclick="send_announce('<?php echo ($value["course"]); ?>');return false">发布公告</a>
                                </li>
                                  <li>
                                    <a href="<?php echo U('Teacher/Course/send_work',array('course'=>$value['course']));?>">发布作业</a>
                                </li>
                                  <li>
                                    <a href="<?php echo U('Teacher/Class/index',array('course'=>$value['course']));?>">班级查看</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <input type="hidden" id="announce_path" value="<?php echo U('Teacher/course/insert_announce');?>">

        <!-- Page Content -->
        <div id="page-wrapper" style="">
            <div class="container-fluid" >
           <div style="">
<!-- <button name="fanhui"  onclick="fanhui()">返回上一页</button> -->
</div>
   <div class="alert alert-warning" style="padding-bottom: 4%">

                                <h3 align="center">   <?php echo ($now_course); ?>- 姓名：<span id='task_sname'> <?php echo ($task_data["sname"]); ?></span> 班级：<span id='task_class'><?php echo ($task_data["class"]); ?></span></h3>
                                <?php if($path == 1): ?><a href="<?php echo U('Teacher/class/index',array('course'=>$now_course));?>"><button type="button" class="btn btn-warning" style="float:left;">返回上一页</button></a>
                                <?php else: ?>
                                <a href="<?php echo U('Teacher/taskdetail/index',array('id'=>$task_data['task_id'],'course'=>$now_course));?>"><button type="button" class="btn btn-warning" style="float:left;">返回上一页</button></a><?php endif; ?>
                                <button type="button" class="btn btn-danger"onclick="next_task5(<?php echo ($task_data["task_id"]); ?>)" style="float: right;">下一个学生</button>

                
                            </div>


<input type="hidden" id="next_student_task" value="<?php echo U('Teacher/viewtask/next_student_task');?>">

<div class="panel panel-danger">
   <div class="panel-heading">
      <h3 class="panel-title">
         <strong>作业标题:</strong><span id='task_title'> <?php echo ($task_data['title']); ?></span> 
         <span style="float: right;"> <strong>提交时间：</strong>
         <span id='task_submit_time'><?php echo date('n-j H:i 周L',$task_data['submit_time']);?>
         </span>
       </span>
   </div>
   <div class="panel-body" id="task_content">
     <?php echo ($task_data['content']); ?>
   </div>
</div>


<input type="hidden" name="modify_content" id="modify_content" value="<?php echo ($s_task_data['content']); ?>">
<input type="hidden" id="send_task" value="<?php echo U('Student/task/send_task',array('task_id'=>$task_data['id'],'task_type'=>$task_data['type']));?>">

<?php if($modify == 0): ?><div class="form-group" align="center">
 <label>请将您的批改情况填在下框</label>
 <textarea class="form-control" rows="3" id="mark" style="width: 30%">已批改</textarea>
 <div class="form-group has-error">
 <label class="control-label" for="inputError">请输入成绩</label>
<input type="text" class="form-control" id="score" style="width: 30%">
  </div>
</div>
<?php else: ?>

<div class="form-group" align="center">
 <label>您的批改内容</label>
 <textarea class="form-control" rows="3" id="mark" style="width: 30%"><?php echo ($task_data['mark_reply']); ?></textarea>
 <div class="form-group has-error">
 <label class="control-label" for="inputError">您的批改成绩</label>
<input type="text" class="form-control" id="score" style="width: 30%" value="<?php echo ($task_data['score']); ?>">
  </div>
</div><?php endif; ?>
<input type="hidden" id="s_task_id" value="<?php echo ($task_data['id']); ?>">


<div align="center">
  
    <button name="send" onclick="mark_task()">提交</button>

</div>
 <input type="hidden" id="mark_task" value="<?php echo U('Teacher/viewtask/mark_task');?>">


</body>
</html>