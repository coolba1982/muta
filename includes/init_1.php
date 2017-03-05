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

/* 初始化设置 */
ini_set('memory_limit',          '32M');
ini_set('session.cache_expire',  1);
ini_set('session.use_trans_sid', 0);
ini_set('session.use_cookies',   1);
ini_set('session.auto_start',    0);
ini_set('display_errors',        1);
//ini_set('session.cookie_lifetime',   10);  需要重新启动
//ini_set('session.gc_maxlifetime',  10);

if (DIRECTORY_SEPARATOR == '\\')
{
    @ini_set('include_path',      '.;' . ROOT_PATH);
}
else
{
    @ini_set('include_path',      '.:' . ROOT_PATH);
}
if (!isset($_SESSION)){ session_start();}
 
if (file_exists('includes/inc_config.php'))
{
    include('includes/inc_config.php');
}











/* 获取系统根目录 */
define('ROOT_PATH', str_replace('includes/init_1.php', '', str_replace('\\', '/', __FILE__)));

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



//del_dir('C:\PHP\Session');


if((strpos(PHP_SELF, '/login.php') === false)&&((strpos(PHP_SELF, '/logout.php') === false))){
	
      if (isset($_CGF['session_expire'])){
	        $expire = $_CGF['session_expire'];
	        $cur_time = $_REQUEST['t'];
	        if(!empty($cur_time)){
	        	  $cur_time = intval($cur_time);
	        	
	        	  if(!empty($_SESSION['last_visit'])){
	        	  	 $last_visit = intval($_SESSION['last_visit']);
	        	  	 if(($cur_time-$last_visit)>=$expire){
	        	  	 	    unset($_SESSION['last_visit'] );
	        	  	 	    unset($_SESSION['session_id'] );
	        	  	 	    
	        	  	 	    $path = $_CFG['session_save_path'];
	        	  	 	    if(empty($path)){
	        	  	 	    	 //$path=ini_get('session.save_path');
	        	  	 	    }	
	        	  	 	    if(!empty($path)){
	        	  	 	    	 del_dir($path);
	        	  	 	    }	
	        	  	 	    redirect_view('login.php');
	        	  	 }	
	        	  }	
	        	
	            $_SESSION['last_visit'] = $cur_time;
	        	
	        }	
	
	
	
      }	
	
	
	
	
	
     if(!isset($_SESSION['session_id'])){
         //if(empty($_REQUEST['ajax'])){
             // redirect_view('login.php');
         //}else{
             //如果是ajax发出的请求  ，返回一个标志位告之session失效
            // return_echo(false, 'INVALID_SESSION', null);
         //}
         echo  "not  set session id";

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
