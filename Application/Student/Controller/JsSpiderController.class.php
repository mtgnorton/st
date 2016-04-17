<?php
namespace Student\Controller;
use Think\Controller;
 
class JsSpiderController extends Controller {

     
     public  $sid       =   '080135';
     public $password   =   '0801357377';
     public $identity   =   '教师';

    /*
     *此处的作用是：
     *获得url中的随即参数和__VIEWSTATE
     *
     */
    function getView(){
     $res;
     $url               = 'http://211.87.155.19/default2.aspx';
     $result            = $this->curl_request($url);
     if (empty($result)) {
     return array(
            'status'    => "0",
            'message'   => "模拟登陆失败，网址可能以改变",
         );    
     }
     preg_match('/Location: \/\((.*)\)/', $result,$temp);
     $pattern           = '/<input type="hidden" name="__VIEWSTATE" value="(.*?)" \/>/is';
     preg_match_all($pattern, $result, $matches);
     $res[0]            = $matches[1][0];
     $res[1]            = $temp[1];
     if (empty($res)) {
     return array(
            'status'    => "0",
            'message'   => "获取随即参数或_VIEWSTATE失败",
         );
     }
     return array(
            'status'    => "1",
            'message'   => $res,
         );
}
    //参数1：访问的URL，参数2：post数据(不填则为GET)，3是否需要加referer url
   function curl_request($url,$post='',$referer=''){//$cookie='', $returnCookie=0,
        $curl   = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)');
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_REFERER, "http://211.87.155.19/default2.aspx");
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        if($post) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
        }
      
        if ($referer) {
             curl_setopt($curl, CURLOPT_REFERER, $referer);
        }
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;       
}

    /*
     *此处的作用是：
     *模拟登陆校网，如果返回学生姓名，则登陆成功
     *
     */
    function login($temp){
     

     $url = 'http://211.87.155.19/('.$temp[1].')/default2.aspx';

     $post['__VIEWSTATE']       = $temp[0];
     $post['txtUserName']       = $this->sid;
     $post['TextBox2']          = $this->password;
     $post['txtSecretCode']     = '';
     $post['lbLanguage']        = '';
     $post['RadioButtonList1']  = iconv('utf-8', 'gb2312', $this->identity);
     $post['Button1']           = '';//iconv('utf-8', 'gb2312', '登录');
     $result                    = $this->curl_request($url,$post);
     if (empty($result)) {
        return array(
            'status'            => "0",
            'message'           => "模拟登陆失败",
         );
     }
     $referer='http://211.87.155.19/('.$temp[1].')/js_main.aspx?xh='.$post['txtUserName'];
     $result                    = $this->curl_request($referer,'',$url);
     $result                    = iconv('gb2312', 'utf-8//IGNORE', $result);
     preg_match('/<span id=\"xhxm\">(.*)<\/span>/',$result, $name);
     $name                      = substr($name[1], 0,-6);

     if (empty($name)) {
       return array(
            'status'    => "0",
            'message'   => "得不到您的姓名",
         );
     }

     return array(
            'status'    => "1",
            'message'   => $name,
         );
     }

    /*
     *此处的作用是：
     *得到校网上老师和对应课程的数组
     *
     */
     function getkebiao($temp)
     {

     $post_m['zgh']     = $this->sid;
     $post_m['xm']      = iconv('utf-8','gb2312','' );
     $post_m['gnmkdm']  = 'N122303';

     $temp_info         = http_build_query($post_m);
     $referer           = 'http://211.87.155.19/('.$temp[1].')/js_main.aspx?xh='.$this->sid;
     $url               = 'http://211.87.155.19/('.$temp[1].')/jstjkbcx.aspx?'.$temp_info;
     $result            = $this->curl_request($url,'',$referer);
     $result            = iconv('gb2312', 'utf-8', $result);
     if (empty($result)) {
         return array(
            'status'    => "0",
            'message'   => "得到课表信息失败",
         );
     } 

     $pattern           = '/<td align=\"Center\" rowspan=\"2\">([^<]*)<br>([^<]*)<br>([^<]*)<br>([^<]*)<br>([^<]*)<br>([^<]*)<br>([^<]*)<br>([^<]*)<br>([^<]*)<br>([^<]*)<br>([^<]*)<br>([^<]*)<br>([^<]*)<\/td>/';
     preg_match_all($pattern, $result, $mm);
     $info_tea_cou      = array_merge($mm[1], $mm[8]);
     $pattern           = '/<td align=\"Center\" rowspan=\"2\">([^<]*)<br>([^<]*)<br>([^<]*)<br>([^<]*)<br>([^<]*)<br>([^<]*)<\/td>/';
     preg_match_all($pattern, $result, $tt);
     $info_tea_cou      = array_merge($info_tea_cou,$tt[1]);
     $info_temp      = array_unique($info_tea_cou);
    
     if (empty($info_temp)) {
        return array(
            'status'    => "0",
            'message'   => "您的课表信息为空",
            );
     }

     return  array(
            'status'    => "1",
            'message'   => $info_temp,
        );

     }

    
   
    function transfer($sid,$password)
     {
     $this->sid         = $sid;
     $this->password    = $password;

     $temp              = $this->getView();
     $login             = $this->login($temp['message']); 
     $course_info       = $this->getkebiao($temp['message']);
     if ($login['status']   == 0  ) {
         return array(
            'status'    =>0,
            'message'   =>"校网无法登陆，请确认您的用户名或者密码是否正确",
            );

     }
  
     return array(
        'status'        => 1,
        'name'          => $login['message'],
        'courseinfo'    => $course_info['message'],
        );
     }
}


