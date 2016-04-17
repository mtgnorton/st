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

    <!-- Custom CSS -->
    <link href="/studentMange/Public/startbootstrap/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/studentMange/Public/startbootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
 
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
   <div class="alert alert-warning">
                                <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                                <h3 align="center"><?php echo ($now_course); ?>---发布作业</h3> </a>.
                            </div>
<h1 align="center"> </h1>
 <div class="form-group has-success" align="center">
                                            <label class="control-label" for="inputSuccess">请输入作业标题：</label>
                                          
<!-- <div align="center" id="biaoti"><font size="4">请输入作业标题：</font> -->
<?php if($modify == 1): ?><!-- <input type="text" name="title"
id="title" value="<?php echo ($task_data["title"]); ?>" size="50"> -->
  <input type="text" name="title"
id="title" class="form-control"  value="<?php echo ($task_data["title"]); ?>" style="width: 400px">

<?php else: ?>
  <input type="text" name="title"
id="title" class="form-control"  value="" style="width: 400px"><?php endif; ?>
    </div>
</div>

 <div align="center" id="div_type">
<?php if($modify == 1): if($task_type == 1): ?><button type="button" class="btn btn-outline btn-info">课前</button>
 <input type="radio" checked="checked" name="type" value="课前" style="width:40px" /> 
<button type="button" class="">课后</button>
 <input type="radio" name="type" value="课后" style="width:40px"/>
 <?php else: ?>
    <span class="label label-success">课前</span>
 <input type="radio" name="type" value="课前" style="width:40px" /> 
<span class="label label-success">课后</span>
 <input type="radio" checked="checked" name="type" value="课后" style="width:40px"/><?php endif; ?>
<?php else: ?>
    <button type="button" class="btn btn-outline btn-info">课前</button>
 <input type="radio" checked="checked" name="type" value="课前" style="width:40px" /> 
<button type="button" class="btn btn-outline btn-info">课后</button>
 <input type="radio" name="type" value="课后" style="width:40px"/><?php endif; ?>
 </div>

<input type="hidden"  id="insert_announce" value="<?php echo U('Teacher/Index/insert_announce');?>">
<input type="hidden" id="send_content" value="<?php echo U('Teacher/Course/send_content',array('course'=>$now_course));?>">

<!--style给定宽度可以影响编辑器的最终宽度-->
<script type="text/plain" id="myEditor" style="width:1000px;height:240px">
   
    <p id="old_content" onclick="clear_content('teacher')">将您要布置的作业写在这里</p>

</script>
<input type="hidden" name="modify_content" id="modify_content" value="<?php echo ($task_data['content']); ?>">
<div align="center">
    <?php if($modify == 1): ?><button name="send" onclick="send_content(<?php echo ($task_data['id']); ?>)">发布</button>
    <?php else: ?>
    <button name="send" onclick="send_content()">发布</button><?php endif; ?>
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
      var btn            = document.getElementById('btn');
    if (modify           == 1) {

      window.onload=function(){
      setTimeout('init()',100);
    }};
      function init(){
        $('#old_content').text('');    
        um.execCommand('insertHtml', modify_content);
    }

    function insertHtml() {
        var value = prompt('插入html代码', '');
        um.execCommand('insertHtml', value)  
    }
   

 
</script>

</body>
</html>