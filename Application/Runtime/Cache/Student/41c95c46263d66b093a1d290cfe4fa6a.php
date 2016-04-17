<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>学习助手</title>

    <!-- Bootstrap Core CSS -->
    <link href="/studentMange/Public/startbootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/studentMange/Public/startbootstrap/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/studentMange/Public/startbootstrap/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/studentMange/Public/startbootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="/studentMange/Public/startbootstrap/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/studentMange/Public/startbootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/studentMange/Public/startbootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/studentMange/Public/startbootstrap/dist/js/sb-admin-2.js"></script>
   
       <script src="/studentMange/Public/sweetalert-master/dist/sweetalert.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="/studentMange/Public/sweetalert-master/dist/sweetalert.css">
    <link rel="stylesheet" href="/studentMange/Public/index_select_course/css/jquery-labelauty.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
 <style>
ul { list-style-type: none;}
.check_one .check_two { display: inline-block;}
.check_one .check_two { margin: 10px 0;}
input.labelauty + label { font: 12px "Microsoft Yahei";}
</style>

</head>

<body>
<input type="hidden" id="add_course"     value="<?php echo U('Student/index/add_course');?>">
<input type="hidden" id="add_one_course" value="<?php echo U('Student/index/add_one_course');?>">
<input type="hidden" id="delete_course"  value="<?php echo U('Student/index/delete_course');?>">
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
                <div class="">
                    <!-- <div class="col-lg-12" align="center" id=""> -->
                    <div class="row-fluid" style="margin-bottom: 70px">
                        <h3 align="center">请选择您的专业课</h3>
                        <ul class="dowebok">
    <?php if(is_array($t_course)): $key = 0; $__LIST__ = $t_course;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($key % 2 );++$key;?><div class="span4">
    <li style="float: left;margin-right: 30px;margin-bottom: 20px"><input checkcourse="" type="checkbox" name="checkbox" class="check_one" data-labelauty="<?php echo ($key); ?>-<?php echo ($value); ?>" value="<?php echo ($key); ?>-<?php echo ($value); ?>"></li>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>
    
    </ul>

   
     </div>
     <div align="center" style=""> 
     <button style="" type="button" class="btn btn-success" onclick="get_checkbox()">提交</button>
          </div>    
                    <!-- /.col-lg-12 -->
                     <div align="center" style="margin-top: 50px"><h3>如果以上课程有缺失，请在下方手动添加(可重复添加)</h3></div>
                     <div align="center" style="margin-top: 2px"><h4> <font color="red">    请确保您的输入没有错误 </font></h4></div>
                    <div >  
                    <span  class="label label-warning" style="float: left;margin-left: 25%;margin-top:10px">课程名:</span>
                    <input type="text" class="form-control" id="one_course" style="width: 200px;float: left;">
                    <span  style="float: left;margin-top:10px">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <span  class="label label-warning" style="float: left;margin-top:10px">老师名:</span>
                    <input type="text" class="form-control" id="one_tname" style="width: 80px;float: left"></div>
                    <span  style="float: left;margin-top:10px">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <button type="button" class="btn btn-success btn-xs" style="float: left;margin-top:7px" onclick="get_one_course()">提交</button>
                </div>
                <ul>
                 <div align="center"  style="margin-top: 50px" id=""><h3>如果您想删除您已经选的课，请在下方修改</h3>
                 <?php foreach($s_course as $key => $value) :?>
                 <!-- <volist name="s_course" id="value" key="key" > -->
             <!--     <li style="float: left;margin-right: 30px;margin-bottom: 20px"><input checkcourse="" type="checkbox" name="checkbox" class="check_two" data-labelauty="<?php echo ($key); ?>-<?php echo ($value); ?>" value="<?php echo ($key); ?>-<?php echo ($value); ?>"></li> -->
             <div class="span4">
                  <li style="float: left;margin-right: 30px;margin-bottom: 20px"><input checkcourse="" type="checkbox" name="checkbox" class="check_two" data-labelauty="<?php echo $key.'-'.$value?>" value="<?php echo $key.'-'.$value?>"></li>
            </div>
                 <?php endforeach; ?>
                    
                 </div>

                </ul>

                <!-- /.row -->

            </div>
              <div  align="center" style=""><button type="button" class="btn btn-success" onclick="delete_checkbox()">提交</button></div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <!-- <script src="js/jquery-1.8.3.min.js"></script> -->
<script src="/studentMange/Public/index_select_course/js/jquery-labelauty.js"></script>
<script>
$(function(){
    $(':input').labelauty();
});
</script>
<div style="text-align:center;clear:both;">
<!-- <script src="/studentMange/Public/index_select_course/gg_bd_ad_720x90.js" type="text/javascript"></script> --> <script src="/studentMange/Public/sm/sm.js"></script>
<script src="/studentMange/Public/index_select_course/follow.js" type="text/javascript"></script>
</div>

</body>

</html>