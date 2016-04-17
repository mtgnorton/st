<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <title>发布作业</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="/studentMange/Public/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="/studentMange/Public/umeditor/third-party/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/studentMange/Public/umeditor/umeditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/studentMange/Public/umeditor/umeditor.min.js"></script>
    <script type="text/javascript" src="/studentMange/Public/umeditor/lang/zh-cn/zh-cn.js"></script>
        <script src="/studentMange/Public/sweetalert-master/dist/sweetalert.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="/studentMange/Public/sweetalert-master/dist/sweetalert.css">
    <link rel="stylesheet" href="/studentMange/Public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/studentMange/Public/sm/sm.css">
    <script src="/studentMange/Public/sm/sm.js"></script>

      <link href="/studentMange/Public/startbootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/studentMange/Public/startbootstrap/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
  <link href="/studentMange/Public/startbootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom CSS -->
    <link href="/studentMange/Public/startbootstrap/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
  <!--   <link href="/studentMange/Public/startbootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  -->
    <!-- Bootstrap Core JavaScript -->
    <script src="/studentMange/Public/startbootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/studentMange/Public/startbootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/studentMange/Public/startbootstrap/dist/js/sb-admin-2.js"></script>
  
    <script  type="text/javascript">

   
    
    </script>

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
        <div id="page-wrapper" style="">
            <div class="container-fluid" >
           <div style="">
<!-- <button name="fanhui"  onclick="fanhui()">返回上一页</button> -->
</div>
   <div class="alert alert-warning">
   <div style="margin-top: 20px">
    <a href="<?php echo U('Student/Course/index',array('course'=>$course,'tname'=>$tname));?>"><button type="button" class="btn btn-warning" style="float:left;">返回上一页</button></a></div>
                                <h3 align="center">   <?php echo ($course); ?></h3>

                            </div>




<div class="panel panel-danger">
   <div class="panel-heading">
      <h3 class="panel-title">
         <strong>标题：</strong> <?php echo ($task_data['title']); ?> <span style="float: right;"> <strong>发布时间：</strong><?php echo date('n-j H:i 周L',$task_data['start_time']);?></span>
   </div>
   <div class="panel-body">
     <?php echo ($task_data['content']); ?>
   </div>
</div>



<!--style给定宽度可以影响编辑器的最终宽度-->
<script type="text/plain" id="myEditor" style="width:1000px;height:240px">
   
    <p id="default_c" onclick="clear_content('student')">将您要完成的作业写在这里</p>

</script>
<input type="hidden" name="modify_content" id="modify_content" value="<?php echo ($s_task_data['content']); ?>">
<input type="hidden" id="send_task" value="<?php echo U('Student/task/send_task',array('task_id'=>$task_data['id'],'task_type'=>$task_data['type']));?>">
<div align="center">
<?php if($is_mark == 1): ?><button name="send" onclick="sweetAlert('您已完成该作业','','error');">提交</button>
  <?php else: ?>
   <?php if($modify == 1 ): ?><button name="send" onclick="send_task(<?php echo ($s_task_data['id']); ?>)">提交</button>
    <?php else: ?>
    <button name="send" onclick="send_task()">提交</button><?php endif; endif; ?>
</div>
<div class="clear"></div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>


<script type="text/javascript">
    //实例化编辑器
  
    var um               = UM.getEditor('myEditor');
    um.addListener('blur',function(){
        $('#focush2').html('编辑器失去焦点了')
    });
    um.addListener('focus',function(){
        $('#focush2').html('')
    });
      var modify         = <?php echo ($modify); ?>;
      var modify_content = $('#modify_content').val();
    
    if (modify           == 1) {

      window.onload=function(){
      setTimeout('init()',100);
    }};
      function init(){
        $('#default_c').text('');    
        um.execCommand('insertHtml', modify_content);
    }

    function insertHtml() {
        var value = prompt('插入html代码', '');
        um.execCommand('insertHtml', value)  
    }
   

 
</script>

</body>
</html>