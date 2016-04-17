<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="chinese">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>学生助手</title>

    <!-- Bootstrap Core CSS -->
    <link href="/studentMange/Public/startbootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="/studentMange/Public/sweetalert-master/dist/sweetalert.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="/studentMange/Public/sweetalert-master/dist/sweetalert.css">
    <script src="/studentMange/Public/sm/sm.js"></script>
    <!-- MetisMenu CSS -->
    <link href="/studentMange/Public/startbootstrap/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="/studentMange/Public/startbootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- DataTables CSS -->
    <link href="/studentMange/Public/startbootstrap/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">


    <link href="/studentMange/Public/startbootstrap/dist/css/sb-admin-2.css" rel="stylesheet">



</head>

<style>
    td{
        max-width:150px;
    }
</style>
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
        <div id="page-wrapper">
        <div class="row">
         <?php if(is_array($all_class)): $key = 0; $__LIST__ = $all_class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($key % 2 );++$key;?><div class="col-lg-3 col-md-6">
                    <div class="panel panel-<?php echo ($value["color"]); ?>">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                   <div class="huge"></div>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo ($value["class"]); ?></div>
                                    <div>New Tasks!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"><a href="<?php echo U('Teacher/class/index',array('course'=>$now_course,'tran_class'=>$value['class']));?>">查看此班级</a></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>

        </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          课程：<?php echo ($now_course); ?>   班级：<?php echo ($now_class); ?> 共<?php echo ($number); ?>人 
                          <div style="float:right;">最近一次作业标题:<?php echo ($task_title); ?></div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                        <th><span class="label label-warning">姓名</span></th>
                                     <th><span class="label label-warning">最近一次作业情况</span></th>
                                     <th><span class="label label-warning">查看作业</span></th>
                                    <th><span class="label label-warning">成绩查看</span></th>
                                  
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php if(is_array($now_class_student)): $key = 0; $__LIST__ = $now_class_student;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($key % 2 );++$key;?><tr class="odd gradeX">
                                      
                                        <td><a href="<?php echo U('Teacher/studenttask/index',array('sid'=>$value['0'],'course'=>$now_course));?>">
                                        <?php echo ($value[1]); ?>
                                        </a>
                                        </td>
                                           <?php if($value[2] == 0): ?><td> 未提交        </td>
                                            <td>无法查看</td>
                                            <?php else: ?>
                                            <td><font color="red">已提交</font>  </td>
                                           <td><font color="red"><a href="<?php echo U('Teacher/viewtask/index',array('stask_id'=>$value['stask_id'],'course'=>$now_course,'path'=>1));?>"><button type="button" class="btn btn-outline btn-warning">点击查看</button></a></font></font></td><?php endif; ?>
                                       <td><a href="<?php echo U('Teacher/scoreview/index',array('sid'=>$value['0'],'course'=>$now_course));?>"><button type="button" class="btn btn-outline btn-warning">查看</button></a></td>
                                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                   
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                          
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>


        <!-- Navigation -->
      

     
            <!-- /.row -->
         
            <!-- /.row -->
          
            <!-- /.row -->
        
                <!-- /.col-lg-6 -->
                
            <!-- /.row -->
          
                <!-- /.col-lg-6 -->
               
  
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="/studentMange/Public/startbootstrap/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/studentMange/Public/startbootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/studentMange/Public/startbootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="/studentMange/Public/startbootstrap/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/studentMange/Public/startbootstrap/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/studentMange/Public/startbootstrap/dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

</body>

</html>