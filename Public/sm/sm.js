	
    /*
     *此函数的作用是：
     *获得html页面中隐藏的跳转页面url
     *
     */
    function del_suffix (pre) {
	  var temp = pre.indexOf('shtml');
	      pre = pre.substr(0, temp - 1);
	      return pre;
	}

    /*
     *此函数的作用是：
     *send_form和announce函数结合起来完成公告的发布和动态更新
     * 
     */
 	function send_form(announce,course) {
        // url     = del_suffix($('#announce_path').val())
        // alert(url)
        // alert(announce)
        // alert(course)
        $.ajax({
            cache: true,
            type: "POST",
            url: del_suffix($('#announce_path').val()),
            data: {
            announce :announce,	
            course:course,
            }, // 你的formi
            error: function(data) {
                alert("Connection error");
            },
            success: function(response) {
            if (response.flag   ==    0) 
                    {
                         
                     sweetAlert(response.msg, "", "error");
                     return;
            }else{
                     // $("#announce_dis").text(announce);
                     
                    
             }
             
            }
        });

    }
	function send_announce(course){
    
		 swal({   
		 title: "请输入公告!",  
		 // text: "Write something interesting:",  
		 type: "input", 
		 showCancelButton: true, 
		 closeOnConfirm: false,  
		 animation: "slide-from-top", 
		 inputPlaceholder: "在这里输入" }, 
		 function(inputValue){   
		 if (inputValue === false)
		 return false;      
		 if (inputValue === "") {  
		 swal.showInputError("您没有输入!"); 
		  return false  
		  }  
		 response = send_form(inputValue,course);

        swal("已完成!", "您发布的公告为： " + inputValue, "success");
         
		 
 });
		}

        /*
         *此函数的作用是：
         *将老师布置的作业ajax到后台
         *调用页面view/course/send_work.html
         */
	function send_content(id) {
        if (id == null && id  == undefined && id == "" ) {
            id='';
        }
		var content 	= UM.getEditor('myEditor').getContent();
        var type        = $('#div_type input[name="type"]:checked ').val();
        var title       = $('#title').val();
        if (title == null || title == undefined || title == ""  ) {
            sweetAlert('请输入标题','','error');
            return;
        }
        if (content == null || content == undefined || content == ""  ) {
            sweetAlert('请输入作业内容','','error');
            return;
        }
        $.ajax({
            cache: true,
            type: "POST",
            url: del_suffix($('#send_content').val()),
            data: {
            content : content,	
            type    : type,
            title   : title,
            id      : id,
            }, // 你的formid
            async: false,
            error: function(data) {
                alert("Connection error");
            },
            success: function(response) {
            if (response.flag   ==    0) 
                    {
                    sweetAlert(response.msg, "", "error");
            }else{
                    swal(response.msg, "", "success");
             }
             
            }
        });

    }

        /*
         *此处的作用是：
         *退出登录
         *
         */
         function send_logout(announce) {

        $.ajax({
            cache: true,
            type: "POST",
            url: del_suffix($('#send_logout').val()),
            data: {
            logout : 1, 
            }, // 你的formid
            async: false,
            error: function(data) {
                alert("Connection error");
            },
            success: function(response) {
            if (response.flag   ==    0) 
                    {
                     sweetAlert(response.msg, "", "error");
            }else{
                      url =    del_suffix($('#login_page').val()) ;
                      window.location.href = url;  
             }
             
            }
        });

    }

    /*
     *此处的作用是：
     *学生提交作业 和修改作业
     *
     */
     function send_task(id) {
        if (id == null && id  == undefined && id == "" ) {
            id='';
        }
        var content     = UM.getEditor('myEditor').getContent();
        $.ajax({
            cache: true,
            type: "POST",
            url: del_suffix($('#send_task').val()),
            data: {
            content : content,  
            id      : id,
            }, // 你的formid
            async: false,
            error: function(data) {
                alert("Connection error");
            },
            success: function(response) {
            if (response.flag   ==    0) 
                    {
                    sweetAlert(response.msg, "", "error");
            }else{
                    swal(response.msg, "", "success");
             }
             
            }
        });

    }

    /*
     *此处的作用是：
     *老师批改作业
     *
     */
  function mark_task() {
     var id         = $('#s_task_id').val(); 
     var mark       = $('#mark').val();
     var score      = $('#score').val();
    if (!isNaN(score) && score<=100  && score>=0) {
     
    }else{
    sweetAlert('请输入正确的成绩值0-100', "", "error"); 
    return;
    }

   
    $.ajax({
        cache   : false,
        type    : "POST",
        url     : del_suffix($('#mark_task').val()),
        data    : {
        id      : id,
        mark    : mark,
        score   : score,
        },
        async   : false,
        error   : function (data) {

            sweetAlert('连接出错','','error');
        },
        success : function (response) {
          
            swal(response.msg,'','success');
        
        },

    });
  }

  /*
   *此处的作用是：
   *向后台请求5个未批改的学生作业
   *
   */
  var task_data ;
  function next_task5(task_id) {

    if (task_data == undefined || task_data == '') {


      $.ajax({
        cache   : false,
        dataType: 'json',
        type    : "POST",
        url     : del_suffix($('#next_student_task').val()),
        data    : {
        task_id :task_id,
        },
        async   : false,
        error   : function (data) {

            sweetAlert('连接出错','','error');
        },
        success : function (data) {
       
         em_data = eval('(' + data + ')'); 
        if (em_data.status == 0) {
          sweetAlert('已经没有学生作业','','error');
          return;
        }
        else{
         task_data      = eval('(' + data + ')'); 
      
        var temp_data   = task_data.shift();

        $('#task_sname').text(temp_data.sname);

        $('#task_title').text(temp_data.title);
        $('#task_submit_time').text(temp_data.submit_time);
        $('#task_content').html(temp_data.content);
        $('#mark').text('已批改');
        $('#score').val('');
        $('#s_task_id').val(temp_data.id);
        $('#task_class').text(temp_data.class);
      }
        }

    });
  }
  else{
        var temp_data   = task_data.shift();
        $('#task_sname').text(temp_data.sname);
        $('#task_title').text(temp_data.title);
        $('#task_submit_time').text(temp_data.submit_time);
        $('#task_content').html(temp_data.content);
        $('#mark').text('已批改');
        $('#score').val('');
        $('#s_task_id').val(temp_data.id);
        $('#task_class').text(temp_data.class);
  }
  }

  /*
   *此处的作用是：
   *学生查看公告
   *
   */
  function view_announce(course,tname) {

       $.ajax({
        cache   : false,
        type    : "POST",
        url     : del_suffix($('#view_announcement').val()),
        data    : {
        course  : course,
        tname   : tname,
        },
        async   : false,
        error   : function (data) {

            sweetAlert('连接出错','','error');
        },
        success : function (response) {
          
            swal(response.msg);
        
        },

    });
  }

  /*
   *此处的作用是：
   *对应请选择您的专业课
   *
   */
  function get_checkbox(argument) {
    var course  =[];
    $(".check_one").each(function(){

     if ($(this).context.checked == true) {
     course.push($(this).val()) ;
     }
 
    });

     $.ajax({
        cache   : false,
        type    : "POST",
        url     : del_suffix($('#add_course').val()),
        data    : {
        course  : course,
        },
        async   : false,
        error   : function (data) {

            sweetAlert('连接出错','','error');
        },
        success : function (response) {

          if (response.flag == 0) {
            sweetAlert(response.msg,'','error');
          }
          else{
           swal(response.msg,'','success'); 
           setTimeout(function(){
            location.reload(true);
           },1000
            )
        
          }
            
        
        },

    });


  }

  /*
   *此处的作用是：
   *对应 如果以上课程有缺失，请在下方手动添加
   *
   */
  function get_one_course(argument) {
    course   = $('#one_course').val();

    tname    = $('#one_tname').val();
    if (course == undefined || course == '' || course==null) {
      sweetAlert('请输入课程名','','error');
      return;
    }

        $.ajax({
        cache   : false,
        type    : "POST",
        url     : del_suffix($('#add_one_course').val()),
        data    : {
        course  : course,

        },
        async   : false,
        error   : function (data) {

            sweetAlert('连接出错','','error');
        },
        success : function (response) {
          if (response.flag == 0) {
            sweetAlert(response.msg,'','error');
          }
          else{
           swal(response.msg,'','success'); 
           setTimeout(function(){
 location.reload(true);
           },1000)
          
          }
            
        
        },

    });
  }
   function delete_checkbox(argument) {
    var course  =[];
    $(".check_two").each(function(){

     if ($(this).context.checked == true) {
     course.push($(this).val()) ;
     }
       
   

    });
     $.ajax({
        cache   : false,
        type    : "POST",
        url     : del_suffix($('#delete_course').val()),
        data    : {
        course  : course,
        },
        async   : false,
        error   : function (data) {

            sweetAlert('连接出错','','error');
        },
        success : function (response) {
          if (response.flag == 0) {
            sweetAlert(response.msg,'','error');
          }
          else{
           swal(response.msg,'','success'); 
          setTimeout(function(){
            location.reload(true);
           },1000
            )
          }
            
        
        },

    });


  }

  /*
   *此处的作用是：
   *umeditor清除默认数据
   *
   */
    function clear_content(type) {
    if (type == 'teacher') {
    if (um.isFocus() && $('#old_content').text()=='将您要布置的作业写在这里') {
        $('#old_content').text('');
    }
    }
    else{
     if (um.isFocus() && $('#default_c').text()=='将您要完成的作业写在这里') {
        $('#default_c').text('');
    }  
    }
    }