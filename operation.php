<?php
define('IN_MUTA', true);
require_once(dirname(__FILE__) . '/includes/init.php');

$ajax = value_req("ajax");
$act = value_req("act");

if(!empty($ajax)){
    switch($act){
        case 'restart':
            $cmd='<power_off action="mod"><group><operation>0</operation></group></power_off>';
            execute_cmd($cmd);
            //echo '';
            break;
        case 'recover':
            $cmd='<power_off action="mod"><group><operation>1</operation></group></power_off>';
            execute_cmd($cmd);
            //echo '';
            break;
        case 'kick':
            $mac= value_req("mac");
            $cmd= "<max_station action=\"mod\"><group><wlan_name>ath1</wlan_name><sta_mac>$mac</sta_mac></group></max_station>";
            execute_cmd($cmd);
            echo '';
            break;

        case 'open_share_media':
            $cmd= "<dlna_cfg action=\"mod\"><group><enable>1</enable></group></dlna_cfg>";
            execute_cmd($cmd);
            echo "success";
            break;
        case 'close_share_media':
            $cmd= "<dlna_cfg action=\"mod\"><group><enable>0</enable></group></dlna_cfg>";
            execute_cmd($cmd);
            echo "success";
            break;
			
        case 'open_share_storage':
            $cmd= "<smb_cfg action=\"mod\"><group><enable>1</enable></group></smb_cfg>";
            execute_cmd($cmd);
            echo "success";
            break;
        case 'close_share_storage':
            $cmd= "<smb_cfg action=\"mod\"><group><enable>0</enable></group></smb_cfg>";
            execute_cmd($cmd);
            echo "success";
            break;			
			
        case 'sysup':
            $f = $_REQUEST['fpath'];
            log_muta('[sysup fpath]'.$f);
            if(is_test()){
                echo '';
                flush();
                sleep(10);
            }

            if((!empty($f))&&(!is_test())){
                log_muta('Begin to  start  Node_update');
                Node_update('SF_MAIN', $f, UCT_UPDATE);
                log_muta('End to  start  Node_update');
            }
        default:
    }




}



?>