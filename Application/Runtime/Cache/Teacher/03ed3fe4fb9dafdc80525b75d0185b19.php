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
  
    <!-- MetisMenu CSS -->
    <link href="/studentMange/Public/startbootstrap/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="/studentMange/Public/startbootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- DataTables CSS -->
    <link href="/studentMange/Public/startbootstrap/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">


    <link href="/studentMange/Public/startbootstrap/dist/css/sb-admin-2.css" rel="stylesheet">
   <script type="text/javascript" src="/studentMange/Public/jquery/jquery-2.1.1.min.js"></script>
    <style type="text/css">
        ${demo.css}
        </style>
 <script type="text/javascript">
    var mysqlSelectSortOptions = {
         
        chart: {
        renderTo: 'ph',
        },

        title: {
            
            x: -20 //center
        },
        xAxis: {
            reversed: false,
            title: {
                enabled: true,
                text: '作业'
            },
            gridLineWidth:      1,
            gridLineDashStyle:  'Dot',
         
            maxPadding:         0.05,
            showLastLabel:      true
        },
        yAxis: {
            title: {
                text:'分值',
            },

            plotLines:[{
            color:'red',           //线的颜色，定义为红色
            dashStyle:'dot',     //默认值，这里定义为实线
            value:60,               //定义在那个值上显示标示线，这里是在x轴上刻度为3的值处垂直化一条线
            width:2,                //标示线的宽度，2px
            label:{
            text:'60分及格线',     //标签的内容
            align:'left',                //标签的水平位置，水平居左,默认是水平居中center
            x:10                         //标签相对于被定位的位置水平偏移的像素，重新定位，水平居左10px
    },
     }],
            max:100,
            min:-2,
            labels:{
            step: 1,
              formatter:function(){
      if(this.value >=-2 && this.value < 1) { 
        return "未批改("+this.value+")";
      }else if(this.value  >= -1 && this.value <0) { 
        return "未提交("+this.value+")"; 
      }else if(this.value >0 && this.value<60){ 
        return "不及格("+this.value+")";
      }else if(this.value >=60 && this.value<90){
       return "良好("+this.value+")";
      }
      else if(this.value >=90 ){
      return "优秀("+this.value+")";
      }
            }
        },
           
  
            gridLineDashStyle:'Dash',
        },
        tooltip: {
            valueSuffix: '分',
             headerFormat: '<small>{point.key}作业</small><table><br/>',
            pointFormatter: function() {
                if (this.y  ==-2 ) {
                    this.y  = '未批改';
                }
                else if(this.y == -1){
                    this.y     = '未提交';
                }
            return '<span style="color:{'+this.series.color+'}"></span> '+
           this.series.name+': <b>'+this.y+'</b><br/>'
        }
        },
        plotOptions: {
        line: {
        dataLabels: {
            enabled: true
        }
    }   
    },
     credits:{
     enabled:false // 禁用版权信息
    },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
           name : "成绩",
           zones: [{
                value: 0,
                color: '#f7a35c',
                dashStyle: 'dot'
            }, {
                value: 60,
                color: '#7cb5ec'
            }, {
                color: '#90ed7d'
            }],
        
        },
        ]
        };
            

        var scoreArr    = [];
        var xArr        = [];
        var title       = <?php echo ($sname); ?>+"成绩统计";
        var url         =  <?php echo U('Teacher/Scoreview/index');?>;
        alert(url);

        function test (){                                                                                                                               
        $.ajax({

            url :   url,
            type:   "GET",
            cache: false,
            data:   {
            sid     : 1208010126,
            course  : 'UNIX程序设计',
            flag    : 1,
            },
            success: function (msg) {
             msg = eval('('+msg+')');
             console.log(msg);
               for(var p in msg){
             scoreArr.push(parseInt(msg[p].score));
                }
                console.log(scoreArr);
             for (var i = 0; i < msg.length; i++) {
             var temp = i+1;
             xArr.push("第"+temp+"次");
            }
            console.log(xArr);
            mysqlSelectSortOptions.series[0].data       = scoreArr;
            mysqlSelectSortOptions.xAxis.categories     = xArr;
            mysqlSelectSortOptions.title.text           = title;                                                                                                                                                                             
            var chart = new Highcharts.Chart(mysqlSelectSortOptions);
            $(".mask").show();
            $(".bomb_box").show();
            },
            
        });
    }


    </script>
    <style>
    .mask{
display:none;
width:100%;
position:absolute;
background:#fff;
z-index:10;
top:0;
left:0;
height:100%;
opacity:0.4;
}
 
/*弹框*/
.bomb_box {
display:none;
background:#fff;
position:absolute;
top:80px;
left:150px;
z-index:20;
}
</style>
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
                 
<button id="btn">name</button>
 
<!-- 弹框底层蒙版 -->
<div class="mask"></div>

 
<div class="bomb_box" id="ph"></div>
<div id="graph" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                          
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
    <button name="btn" id='btn'>sssss</button>
    <button name="pp" id="pp" onclick="test()">点击获取图表</button>

    
    <!-- jQuery -->
    <script src="/studentMange/Public/Highcharts-4.2.3/js/highcharts.js"></script>
    <script type="text/javascript" src="/studentMange/Public/Highcharts-4.2.3/js/themes/gray.js"></script>
    <script src="/studentMange/Public/Highcharts-4.2.3/js/modules/exporting.js"></script>
    <!-- <script src="/studentMange/Public/startbootstrap/bower_components/jquery/dist/jquery.min.js"></script> -->

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
   

</body>

</html>