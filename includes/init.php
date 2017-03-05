<?php


if (!defined('IN_MUTA'))
{
    die('Hacking');
}

define('MUTA_ADMIN', true);

error_reporting(E_ALL);

if (__FILE__ == '')
{
    die('Fatal error : __FILE__ is empty ');
}
if (!isset($_SESSION)){ session_start();}

/* 初始化设置 */
@ini_set('memory_limit',          '56M');
@ini_set('session.cache_expire',  1);
@ini_set('session.use_trans_sid', 0);
@ini_set('session.use_cookies',   1);
@ini_set('session.auto_start',    0);
@ini_set('display_errors',        1);
//@ini_set('session.cookie_lifetime',   0);
//@ini_set('session.gc_maxlifetime',  1500);
@ini_set('session.gc_probability',1);
@ini_set('session.gc_divisor', 4);

if (DIRECTORY_SEPARATOR == '\\')
{
    @ini_set('include_path',      '.;' . ROOT_PATH);
}
else
{
    @ini_set('include_path',      '.:' . ROOT_PATH);
}
 
if (file_exists('includes/inc_config.php'))
{
    include('includes/inc_config.php');
}






/* 获取系统根目录 */
define('ROOT_PATH', str_replace('includes/init.php', '', str_replace('\\', '/', __FILE__)));

/* DEBUG模式 */
if (defined('DEBUG_MODE') == false)
{
    define('DEBUG_MODE', 0);
}

if (PHP_VERSION >= '5.1' && !empty($timezone))
{
    date_default_timezone_set($timezone);
}

/*包含当前网址值的全局变量*/
if (isset($_SERVER['PHP_SELF']))
{
    define('PHP_SELF', $_SERVER['PHP_SELF']);
}
else
{
    define('PHP_SELF', $_SERVER['SCRIPT_NAME']);
}

require(ROOT_PATH . 'includes/inc_constant.php');
require(ROOT_PATH . 'includes/inc_functions.php');
require(ROOT_PATH . 'includes/cls_muta.php');
require(ROOT_PATH . 'includes/cls_error.php');
require(ROOT_PATH . 'includes/lib_time.php');
require(ROOT_PATH . 'includes/lib_base.php');

require(ROOT_PATH . 'includes/cls_json.php');
require(ROOT_PATH . 'includes/Mobile_Detect.php');



require(ROOT_PATH . 'includes/ext/guish_class.php');
//require(ROOT_PATH . 'includes/ext/time_zone.php');
require(ROOT_PATH . 'includes/ext/content_type_arr.php');
require(ROOT_PATH . 'includes/ext/function.php');


///////////////////////
$detect  = new Mobile_Detect();
if($detect->isMobile()){
   // log_muta('is mobile.....');
    define('IS_MOBILE',1);
}
function is_mobile(){
    return defined('IS_MOBILE');
}
////////////////////////////////

/* 对用户传入的变量进行转义操作。*/
if (!get_magic_quotes_gpc())
{
    if (!empty($_GET))
    {
        $_GET  = addslashes_deep($_GET);
    }
    if (!empty($_POST))
    {
        $_POST = addslashes_deep($_POST);
    }

    $_COOKIE   = addslashes_deep($_COOKIE);
    $_REQUEST  = addslashes_deep($_REQUEST);
}

/* 对路径进行安全处理 */
if (strpos(PHP_SELF, '.php/') !== false)
{
    muta_header("Location:" . substr(PHP_SELF, 0, strpos(PHP_SELF, '.php/') + 4) . "\n");
    exit();
}

/* 创建 应用对象 */
$muta = new MUTA();
define('DATA_DIR', $muta->data_dir());
define('IMAGE_DIR', $muta->image_dir());


/* 创建错误处理对象 */
$err = new muta_error('message.htm');




/* 初始化session */
//require(ROOT_PATH . 'includes/cls_session.php');
//$sess = new cls_session($muta->table('sessions_data'), 'MUTA_ID');



/* 初始化 action,部分页面留待扩展 */
//if (!isset($_REQUEST['act']))
//{
//    $_REQUEST['act'] = '';
//}
//elseif (($_REQUEST['act'] == 'login' || $_REQUEST['act'] == 'logout' || $_REQUEST['act'] == 'signin') &&
//    strpos(PHP_SELF, '/privilege.php') === false)
//{
//    $_REQUEST['act'] = '';   //login logout signin只能privilege.php页面拥有
//}
//elseif (($_REQUEST['act'] == 'forget_pwd' || $_REQUEST['act'] == 'reset_pwd' || $_REQUEST['act'] == 'get_pwd') &&
//    strpos(PHP_SELF, '/get_password.php') === false)
//{
//    $_REQUEST['act'] = '';   //forget_pwd 等值只能get_password.php页面拥有
//}

	   log_muta('PHP_SELF:' . PHP_SELF);

if((strpos(PHP_SELF, '/login.php') === false)&&((strpos(PHP_SELF, '/logout.php') === false))){
		   log_muta('start-----------------------------' );

	   log_muta('strpos:' . strpos(PHP_SELF, '/login.php'));
      if (isset($_CFG['session_expire'])){
      	  	
	        $expire = $_CFG['session_expire'];
	        log_muta('[session_expire]' . $expire);
	       
	       
	        	  $cur_time = intval(time());
	        	  
	        	  log_muta('[cur_time]' . $cur_time);
	        	
	        	  if(!empty($_SESSION['last_visit'])){
	        	  	 $last_visit = intval($_SESSION['last_visit']);
	        	  	 log_muta('[last_visit]' . $last_visit);
	        	  	 

	        	  	 
	        	  	 if(($cur_time-$last_visit)>=$expire){
	        	  	 	    unset($_SESSION['last_visit'] );
	        	  	 	    unset($_SESSION['session_id'] );
	        	  	 	    unset($_SESSION);
	        	  	 	    $path = $_CFG['session_save_path'];
	        	  	 	    if(is_test()){
	        	  	 	    	 $path = $_CFG['session_save_path_test'];
	        	  	 	    }	
	        	  	 	    
	        	  	 	    if(empty($path)){
	        	  	 	    	 $path=ini_get('session.save_path');
	        	  	 	    }	
	        	  	 	    if(!empty($path)){
	        	  	 	    	// del_dir($path);
	        	  	 	    }	
	        	  	 	    if(empty($_REQUEST['ajax'])){
	        	  	 	    	  if(strpos(PHP_SELF, '/index.php') === false)
	        	  	 	            redirect_view('login.php?sess_invalid=true');
	        	  	 	        else
	        	  	 	            redirect_view('login.php');    
	        	  	 	    }else{
	        	  	 	    	 return_echo(false, 'SESSION_EXPIRE', null);
	        	  	 	    }	   
	        	  	 	       
	        	  	 }	
	        	  }	
	        	  
	        	 if(empty($_REQUEST['auto'])){
	            $_SESSION['last_visit'] = $cur_time;
	        	 }
	       
		
      }		
			   log_muta('end-----------------------------' );

	
	
	
     if(!isset($_SESSION['session_id'])){
         if(empty($_REQUEST['ajax'])){
 	        	  	 	    	  if(strpos(PHP_SELF, '/index.php') === false)
	        	  	 	            redirect_view('login.php?sess_invalid=true');
	        	  	 	        else
	        	  	 	            redirect_view('login.php');             	
         	
             // redirect_view('login.php');
         }else{
             //如果是ajax发出的请求  ，返回一个标志位告之session失效
             return_echo(false,  'SESSION_EXPIRE', null);
         }


     }

}else{ 
	          $cur_time = intval(time());
		        if(empty($_REQUEST['auto'])){
	            $_SESSION['last_visit'] = $cur_time;
	        	}
	
}	




/* 载入通用语言文件 */
require(ROOT_PATH . 'languages/' .$_CFG['lang']. '/common.php');

clearstatcache();


/* 创建 Smarty 对象。*/
require(ROOT_PATH . 'includes/cls_template.php');
$smarty = new cls_template;
$smarty->template_dir  = ROOT_PATH  . 'view';
$smarty->compile_dir   = ROOT_PATH . 'temp/compiled';
if ((DEBUG_MODE & 2) == 2)
{
    $smarty->force_compile = true;
}

$smarty->assign('lang', $_LANG);
//$smarty->assign('help_open', $_CFG['help_open']);



/* 验证身份: 如果session设置了userid ，认为已经登陆;如果act参数为login等值，允许通过，因为login等值只可能在privilege.php等几个页面中出现，前面已经进行了筛选   */
//if ((!isset($_SESSION['userid'])) &&
//    $_REQUEST['act'] != 'login' && $_REQUEST['act'] != 'signin' &&
//    $_REQUEST['act'] != 'forget_pwd' && $_REQUEST['act'] != 'reset_pwd' )
//{
//    /* session 不存在，检查cookie */
//    if (!empty($_COOKIE['MUTA']['userid']) && !empty($_COOKIE['MUTA']['password']))
//    {
//        $check_result =true; //这里添加验证函数，返回$check_result
//
//        if (!$check_result)
//        {
//            // 验证不通过
//            setcookie($_COOKIE['MUTA']['userid'],   '', 1);
//            setcookie($_COOKIE['MUTA']['password'], '', 1);
//
//            if (!empty($_REQUEST['is_ajax']))
//            {   //验证不通过的情况下，如果是ajax请求，直接返回出错信息
//                make_json_error("Not login yet!");
//            }
//            else
//            {    //验证不通过的情况下，如果不是ajax请求，转向登陆页面
//                muta_header("Location: privilege.php?act=login\n");
//            }
//
//            exit;
//        }
//        else
//        {
//
//             set_admin_session($_COOKIE['MUTA']['userid'], 'username', 'action_list', 'last_time');
//
//        }
//    }
//    else
//    {    //session 不存在，cookie也不存在 */
//        if (!empty($_REQUEST['is_ajax']))
//        {
//            make_json_error('Not Login Yet!');
//        }
//        else
//        {
//            munt_header("Location: privilege.php?act=login\n");
//        }
//
//        exit;
//    }
//}


//if ($_REQUEST['act'] != 'login' && $_REQUEST['act'] != 'signin' &&
//    $_REQUEST['act'] != 'forget_pwd' && $_REQUEST['act'] != 'reset_pwd' )
//{
//    $app_path = preg_replace('/:\d+/', '', $muta->url()) ;
//    if (!empty($_SERVER['HTTP_REFERER']) &&
//        strpos(preg_replace('/:\d+/', '', $_SERVER['HTTP_REFERER']), $app_path) === false)
//    {
//        if (!empty($_REQUEST['is_ajax']))
//        {
//            make_json_error('Pri Error!');
//        }
//        else
//        {
//            munt_header("Location: privilege.php?act=login\n");
//        }
//
//        exit;
//    }
//}


$act =empty($_REQUEST['act'])?'':$_REQUEST['act'];
/* 登录后可在任何页面使用 act=phpinfo 显示 phpinfo() 信息 */
if ($act== 'phpinfo' && function_exists('phpinfo'))
{
    phpinfo();

    exit;
}

//header('Cache-control: private');
header('content-type: text/html; charset=' . MUTA_CHARSET);
header('Expires: Fri, 14 Mar 1980 20:53:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');

if ((DEBUG_MODE & 1) == 1)
{
    error_reporting(E_ALL);
}
else
{
    error_reporting(E_ALL ^ E_NOTICE);
}
$debug = "";
if ((DEBUG_MODE & 4) == 4)
{
    include(ROOT_PATH . 'includes/lib.debug.php');
}

/* 判断是否支持gzip模式 */
if (gzip_enabled())
{
    ob_start('ob_gzhandler');
}
else
{
    ob_start();
}

?>
