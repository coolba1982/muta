<?php
define('IN_MUTA', true);
require_once(dirname(__FILE__) . '/includes/init.php');
$error_message =array();
    $lang = $_REQUEST['lang'];
    if($lang=='en_us'){
    	 $_CFG['lang'] = 'en_us';
    }	else{
    	$_CFG['lang'] = 'zh_cn';
    }	
    $_SESSION['lang'] = $_CFG['lang'];

//if(!empty($_SESSION['session_id'])){
//    forward_view('main.php');
//}



if(!empty($_REQUEST['sess_invalid'])){
    $ERROR_MESSAGE=get_i18n('长时间未操作，请重新登录','No operation for long time, please login again');
    forward_view('login.php',false);
}
//if(!empty($_REQUEST['sess_invalid_1'])){
    //$ERROR_MESSAGE=get_i18n('长时间未操作，请重新登录','No operation for long time, please login again_1');
    //forward_view('login.php',false);
//}


if ($_REQUEST['act'] === 'login') {
    $name = $_REQUEST['username'];
    $pwd = $_REQUEST['password'];
    $ip_addr = $_SERVER['SERVER_ADDR'];
    $cmd = '<admin_authen_login action="show"><group><username>' . $name . '</username><password>' . $pwd . '</password><ip_addr>' . $ip_addr . '</ip_addr></group></admin_authen_login>';
    if(is_test()){
        if(($name=='admin')&&($pwd=='admin')){
            $_SESSION['session_id'] = $name;
            $_SESSION['last_visit'] = time();
            redirect_view('index.php');
        }else{
            $ERROR_MESSAGE=get_i18n('登陆失败,请检查用户名或者密码','Login failed, please check your username or password');
            forward_view('login.php',false);
        }
        exit;
    }
    log_muta('[input]' . $cmd);
    $str_xml = $cmd;
    $rst = array();
    $rst['error_msg'] = '';
    $rst['result'] = '';
    $rst = login_auth($str_xml,$name);
    log_muta('[error_msg login]' . $rst['error_msg']);
    log_muta('[xml login]' . $rst['result']);
    $error_msg = trim($rst['error_msg']);
    $result_xml = trim($rst['result']);
    if(!empty($error_msg)){
        $ERROR_MESSAGE=get_i18n('登陆失败,请检查用户名或者密码','Login failed, please check your username or password');
        forward_view('login.php',false);
    }else {
	//正确的返回: <admin_authen_login action="response"><group><level>262143</level></group></admin_authen_login>
    //错误的返回: <return_code action="response"><group><code>266</code><str>&#x5BC6;&#x7801;&#x9519;&#x8BEF;</str></group></return_code>
        $simple = simplexml_load_string($result_xml);
        $simple = json_encode($simple);
        $simple_array = json_decode($simple, TRUE);
		if(!empty($simple_array['group']['code'])){
		     $code = $simple_array['group']['code'];
			  $ERROR_MESSAGE ='';
			 if($code=='266'){
			     $ERROR_MESSAGE=get_i18n('登陆失败,密码错误','Login failed, invalid password');
			 }else if($code=='267'){
			     $ERROR_MESSAGE=get_i18n('登陆失败,用户名错误','Login failed, invalid username');
			 }else{
			 	$ERROR_MESSAGE=get_i18n('登陆失败','Login failed');
				log_muta('[login failed] code is ' . $code );
			 }
		      forward_view('login.php',false);

		
		}
		
		
	
	
	}




    $_SESSION['last_visit'] = time();
    $_SESSION['session_id'] = $name;
    redirect_view('index.php');

//    if (!empty($result_xml)) {
//        $simple = simplexml_load_string($result_xml);
//        $simple = json_encode($simple);
//        $simple_array = json_decode($simple, TRUE);
//        echo $simple_array['group']['str'];
//
//    }
          // include('index.php');

} else {

    if(!empty($_SESSION['session_id'])){
        $_SESSION['last_visit'] = time();
        redirect_view('index.php');
    }


    forward_view("login.php",false);
}









?>