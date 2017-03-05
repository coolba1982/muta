<?php

define('IN_MUTA', true);


/* 初始化设置 */
ini_set('memory_limit',          '32M');
ini_set('session.cache_expire',  1);
ini_set('session.use_trans_sid', 0);
ini_set('session.use_cookies',   1);
ini_set('session.auto_start',    0);
ini_set('display_errors',        1);
//ini_set('session.cookie_lifetime',   1000);
//ini_set('session.gc_maxlifetime',  1000);
if (!isset($_SESSION)){ session_start();}

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
define('ROOT_PATH', str_replace('heart.php', '', str_replace('\\', '/', __FILE__)));

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
require(ROOT_PATH . 'includes/cls_json.php');






/* 对路径进行安全处理 */
if (strpos(PHP_SELF, '.php/') !== false)
{
    //muta_header("Location:" . substr(PHP_SELF, 0, strpos(PHP_SELF, '.php/') + 4) . "\n");
    exit();
}






/* 初始化session */
//require(ROOT_PATH . 'includes/cls_session.php');
//$sess = new cls_session($muta->table('sessions_data'), 'MUTA_ID');





//log_muta('PHP_SELF:' . PHP_SELF);


    if (isset($_CFG['session_expire'])){

        $expire = $_CFG['session_expire'];
        //log_muta('[session_expire]' . $expire);


        $cur_time = intval(time());

        //log_muta('[cur_time]' . $cur_time);

        if(!empty($_SESSION['last_visit'])){
            $last_visit = intval($_SESSION['last_visit']);
            //log_muta('[last_visit]' . $last_visit);



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
                    redirect_view('login.php?sess_invalid=true');
                }else{
                    return_echo(false, 'SESSION_EXPIRE', null);
                }

            }
        }

       // if(empty($_REQUEST['auto'])){
           // $_SESSION['last_visit'] = $cur_time;
        //}


    }

    if(!isset($_SESSION['session_id'])){
        if(empty($_REQUEST['ajax'])){
            redirect_view('login.php?sess_invalid=true');
        }else{
            //如果是ajax发出的请求  ，返回一个标志位告之session失效
            return_echo(false,  'SESSION_EXPIRE', null);
        }


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



return_echo(true,  'OK', null);



?>
