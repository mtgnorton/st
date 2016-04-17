<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>学生助手</title>

    <!-- Bootstrap Core CSS -->
    <link href="/studentMange/Public/startbootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/studentMange/Public/startbootstrap/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="/studentMange/Public/startbootstrap/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">



    <!-- Custom CSS -->
    <link href="/studentMange/Public/startbootstrap/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/studentMange/Public/startbootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="/studentMange/Public/sweetalert-master/dist/sweetalert.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="/studentMange/Public/sweetalert-master/dist/sweetalert.css">
         <script src="/studentMange/Public/sm/sm.js"></script>

<script type="text/javascript">
      
</script>
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
                <a class="navbar-brand" href="<?php echo U('Student/index/index');?>">学习助手</a>
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
                        <li class="sidebar-search" style="min-height: 90px">
                        <span>欢迎您<?php echo ($name); ?></span>
                            <div style="float: right; " ><img src="<?php echo ($photo_head); ?>"  width="70" height="70" alt=""></div>
                            <!-- /input-group -->
                        </li>
                  <?php if(is_array($course_task_data)): $i = 0; $__LIST__ = $course_task_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><li>
                            <a href=""><i class="fa fa-bar-chart-o fa-fw"></i> <?php echo ($value['course']); ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                              
                                  <li>
                                    <a href="<?php echo U('Student/Course/index',array('course'=>$value['course'],'tname'=>$value['tname']));?>">
                                    查看近期作业</a>
                               <li>
                                  <a href="javascript:void(0)" onclick="view_announce('<?php echo ($value["course"]); ?>','<?php echo ($value["tname"]); ?>');return false">查看公告</a>
                                </li>
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
        <input type="hidden" id="view_announcement" value="<?php echo U('Student/index/view_announcement');?>">

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <?php echo ($course); ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                        <th><span class="label label-info">时间</span></th>
                                     <th><span class="label label-info">作业标题(点击查看作业)</span></th>
                                     <th><span class="label label-info">作业类型</span></th>
                                    <th><span class="label label-info">是否已完成</span></th>
                                     <th><span class="label label-info">是否已批改</span></th>
                                     <th><span class="label label-info">查看回复</span></th>
                                     <th><span class="label label-info">成绩</span></th>
                                   
                                        </tr>
                                    </thead>
                                    <tbody>
                                  <?php if(is_array($task_data)): $i = 0; $__LIST__ = $task_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?><tr class="odd gradeX">
                                            <td><?php echo date('n-j H:i D',$value['start_time']);?></td>
                                           <td> <a href="<?php echo U('Student/task/index',array('task_id'=>$value['id'],'course'=>$course,'is_mark'=>$value['is_mark']));?>"><?php echo ($value['title']); ?></a></td>
                                            <td><?php echo ($value['type']); ?></td>
                                         <?php if($value['is_finish'] == 1): if($value['is_mark'] == 1): ?><td>以批改-不可修改</td>
                                         <?php else: ?>
                                         <td> <a href="<?php echo U('Student/task/index',array('s_task_id'=>$value['s_task_id'],'task_id'=>$value['id'],'course'=>$course));?>"><button type="button" class="btn btn-outline btn-info">已完成-点击修改</button></a></td><?php endif; ?>
                                        <?php else: ?>
                                         <td>未完成</td><?php endif; ?>

                                        <?php if($value['is_mark'] == 1): ?><td><font color="red">已批改</font></td>
                                         <td><button type="button" class="btn btn-outline btn-success" onclick="swal('<?php echo ($value['mark_reply']); ?>')">查看回复</button></td>
                                         <td><?php echo ($value['score']); ?></td>
                                         <?php else: ?>
                                         <td>未批改</td>
                                         <td>未批改</td>
                                         <td>未批改</td><?php endif; ?>
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