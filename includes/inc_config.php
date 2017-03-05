<?php




define('DEBUG_MODE',0);
define('MUTA_CHARSET','utf-8');
$_CFG = array();



$_CFG['interface']='eth0';

$_CFG['session_expire']=1440;

$_CFG['session_save_path_test']='D:\pw_session';

$_CFG['session_save_path']='/tmp/sess';


$_CFG['lang'] = get_lang_by_server();


if(isset($_REQUEST['lang'])){
if(($_REQUEST['lang']=='zh_cn')||($_REQUEST['lang']=='en_us')){
	 $_CFG['lang'] = $_REQUEST['lang'];
}	
}



if(isset($_SESSION)){
if(isset($_SESSION['lang'])&&(($_SESSION['lang']=='zh_cn')||($_SESSION['lang']=='en_us'))){
	 $_CFG['lang'] = $_SESSION['lang'];
}	
}


/**正式部署在linux上面返回false**/
function is_test(){
    if((DIRECTORY_SEPARATOR=='\\')){
        return true;
    }
    return false;
}



function  get_lang_by_server(){
	$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4); //只取前4位，这样只判断最优先的语言。如果取前5位，可能出现en,zh的情况，影响判断。  
if (preg_match("/zh-c/i", $lang))  
return  "zh_cn";  

//else if (preg_match("/en/i", $lang))  
//echo "English";  

return 	"en_us";
	
}	 
 




?>

