<?php
define('IN_MUTA', true);
require_once(dirname(__FILE__) . '/includes/init.php');
//unset($_SESSION['session_id']);
$act = value_req('act');
$command='';
$param='';
if($_SESSION['lang']=='en_us'){
	 $param='?lang=en_us';
}	


switch($act){
        case 'restart':
            //redirect_view_notexit('login.php');
            $command='restart';
            include 'view/login.php';
            //flush();
            //$cmd='<power_off action="mod"><group><operation>0</operation></group></power_off>';
            //execute_cmd($cmd);
            //unset($_SESSION['session_id']);
            break;
        case 'recover':
            $command='recover';
            include 'view/login.php';
            //redirect_view_notexit('login.php');
            //flush();        
            //$cmd='<power_off action="mod"><group><operation>1</operation></group></power_off>';
            //execute_cmd($cmd);
            //unset($_SESSION['session_id']);
            break;	
            
        default:
            unset($_SESSION['session_id']);
            redirect_view_notexit('login.php' . $param);
	
}	
		


?>