<?php

define('IN_MUTA', true);
require_once(dirname(__FILE__) . '/includes/init.php');

$interface = get_interface();

function  get_all_info()
{
    $rtn = array();
    $a1 = get_wan_info();
    $a2 = get_wifi_info();
    $a3 = get_3g_info();
    $a4 = get_sys_info();
    $a5 = get_wifi_dev_num();
    $a6 = get_share_media();
	  $a7 = get_share_storage();
	  $a8 = get_u_stat();


	

    if (!empty($a1)) $rtn = array_merge($rtn, $a1);
    if (!empty($a2)) $rtn = array_merge($rtn, $a2);
    if (!empty($a3)) $rtn = array_merge($rtn, $a3);
    if (!empty($a4)) $rtn = array_merge($rtn, $a4);
    if (!empty($a5)) $rtn = array_merge($rtn, $a5);
    if (!empty($a6)) $rtn = array_merge($rtn, $a6);
	if (!empty($a7)) $rtn = array_merge($rtn, $a7);
	if (!empty($a8)) $rtn = array_merge($rtn, $a8);


    return $rtn;
}


function get_wan_info()
{
	global $interface;
    $rtn = array();
    $cmd = "<interface_sub action=\"show_one\"><group><name>$interface</name></group></interface_sub>";
    $a = get_info($cmd, 'show_wan');
    
    if(is_test()){
    	$tag = rand(0,1);
    	$ip = 'test192.168.1.1';
    	$status ='1';
    	if($tag==1) {
    		$ip = '0';
    		$status = '0';
    	}	
    	
    	$g =array('ipaddr'=>$ip,'address_type'=> rand(2, 3),'rx_pkt_total'=>8888,'send_pkt_total'=>7777,'status'=>$status);
    	$a = array('group'=>$g);
    }
    
    if ($a) {

        //$aa= $a['group']['ipaddr'];
        if (!empty($a['group']['ipaddr'])) {
            $tmp = explode('/', $a['group']['ipaddr']);
            $rtn['wan_ip'] = $tmp[0];
        }
        $link_mode = $a['group']['address_type'];
        if ($link_mode == 1) {
            $rtn['wan_link_mode'] = i18n('link_mode_static');
        } else if ($link_mode == 2) {
            $rtn['wan_link_mode'] = i18n('link_mode_auto');
        } else if ($link_mode == 3) {
            $rtn['wan_link_mode'] = i18n('link_mode_pppoe');
        } else {
            $rtn['wan_link_mode'] = 'UNKNOWN';
        }
        $rtn['wan_link_mode_id'] = $link_mode;
        
        $wan_rx = $a['group']['rx_bytes'];
        $wan_tx = $a['group']['tx_bytes'];
        $rtn['wan_rx'] = $wan_rx;
        $rtn['wan_tx'] = $wan_tx;
        $status = $a['group']['status'];
        $status_id = 0;
        if ($status == 1) {
            $status = get_i18n('已连接', 'Connected');
            $status_id =1;
        } else {
            $status = get_i18n('已断开', 'Disconnected');
             $status_id =0;
        }
        $rtn['wan_link_status'] = $status;
        $rtn['wan_link_status_id'] = $status_id;
        return $rtn;
    }
    return false;
}


function get_3g_info()
{
    $rtn = array();
    $cmd = '<modem_3g_info action="show"></modem_3g_info>';
    $a = get_info($cmd, 'show_wan');
    
    if(is_test()){
    	$rtn['g_signal'] = rand(0,4);
    	return $rtn;
    }	
    
    
    
    if (!$a) {
        return false;
    }

    if(!empty($a['group']['csq'])){
        $rtn['g_signal'] =  intval($a['group']['csq'])-1;
        if(($rtn['g_signal']<0)||($rtn['g_signal']>4)){
              log_muta('error csq:' . $a['group']['csq']);
              unset($rtn['g_signal']);
        }
    }
    $status = $a['group']['status'];
    if ($status == 1) {
        $status = get_i18n('已插入', 'Inserted');
    } else {
        $status = get_i18n('未插入', 'Not Inserted');
    }
    $rtn['g_card_status'] = $status;
    $status = $a['group']['uimstatus'];
    if ($status == 1) {
        $status = get_i18n('已插入', 'Inserted');
    } else {
        $status = get_i18n('未插好或被锁定', 'Not Inserted Or Locked');
    }
    
    if($a['group']['status']!=1){
    	 $status='N/A';
    }	
    
    
    $rtn['g_sim_status'] = $status;

    $status = $a['group']['connection'];
    $rtn['g_link_status_id'] = $status;

    if ($status == 0) {
        $status = get_i18n('已断开', 'Disconnected');
    } else {
        $status = get_i18n('已连接', 'Connected');
    }
    $rtn['g_link_status'] = $status;
    $rtn['g_link_time'] = $a['group']['time'] . get_i18n('秒', 's');
    $op = $a['group']['net'];
    if($op=='China Mobile'){
        $op = get_i18n('中国移动','China Mobile');
    }else if ($op=='China Unicom'){
        $op = get_i18n('中国联通','China Unicom');
    }else if ($op=='china telecom'){
        $op = get_i18n('中国电信','China Telecom');
    }else{
    	  $op='N/A';
    }	
    $rtn['g_op'] = $op;
    $rtn['g_rx'] = $a['group']['rcv_bytes'];
    $rtn['g_tx'] = $a['group']['snt_bytes'];
    if(!empty( $a['group']['ip_address'])){
        $rtn['g_ip'] =  $a['group']['ip_address'];
    }

    return $rtn;
}


function get_wifi_info()
{
    $rtn = array();
    $cmd = '<interface_sub action="show_one"><group><name>ath1</name></group></interface_sub>';
    $a = get_info($cmd, 'show_wifi_gateway');
    if (!$a) {
        return false;
    }
    $gateway = $a['group']['ipaddr'];
	if(empty($gateway)){
	    $rtn['wifi_gate'] = 'N/A';
	}else{
	    $arr= explode('/',$gateway);
		$gateway =$arr[0];
	    $rtn['wifi_gate'] = $gateway;
	}
	
	
    return $rtn;
}

function get_wifi_dev_num()
{
    $rtn = array();
    $cmd = '<station_num action="show"><group><wlan_name>ath1</wlan_name></group></station_num> ';
    $a = get_info($cmd, 'wifi_dev_num');
    if ($a) {
        $rtn['wifi_dev_num'] = $a['group']['station_num'];
        return $rtn;
    }
    return false;
}


function get_wifi_dev_list()
{
    $rtn = array();
    $cmd = '<max_station action="show"><group><wlan_name>ath1</wlan_name></group></max_station> ';
    $a = get_info($cmd, 'wifi_dev_list');
    if ($a) {
        $rtn['wifi_dev_num'] = $a['group']['station_num'];
        return $rtn;
    }
    return false;

}


function get_sys_info()
{
    $rtn = array();
    $cmd = '<hostinfo action="show"></hostinfo> ';
    $a = get_info($cmd, 'wifi_dev_num');
    if ($a) {
        $rtn['sys_type'] = $a['group']['product_name'];
        $rtn['sys_version'] = $a['group']['fw_version'];
        //$rtn['sys_time'] = $a['group']['uptime'];
        $t='';
        
        $day = $a['group']['uptime']['day'];
        $hour = $a['group']['uptime']['hour'];
        $minute = $a['group']['uptime']['minute'];
        if($day!=='0'){
        	  $t = $t . $day . get_i18n('天','Days');
        }	
         if($hour!=='0'){
        	  $t = $t . $hour . get_i18n('小时','Hours');
        }
         if($minute!=='0'){
        	  $t = $t . $minute . get_i18n('分钟','Minutes');
        }
        $rtn['sys_time']=$t;
        
        return $rtn;
    }
    return false;

}

// <dlna_cfg action="showall"><group></group></dlna_cfg>    
// 

function get_share_media()
{
    $rtn = array();
    $cmd = '<dlna_cfg action="show"><group></group></dlna_cfg> ';
    $a = get_info($cmd, 'share_media');
    if(is_test()){
    	$arr=array('ok','fail','loading');
    	$index=rand(0,2);
		$rtn['share_media'] = $arr[$index];
    	return $rtn;
    }	    
     
    if ($a) {
	    $status =$a['group']['status'];
		$usb_status =$a['group']['usb_status'];
		
		if($status==1){
		    $rtn['share_media'] = 'loading';
		}else if ($status==2){
			$rtn['share_media']='ok';
		}else if ($status==3){
			$rtn['share_media']='close';
		}else {
			$rtn['share_media']='fail';
		}	
		if($usb_status==1){
		    $rtn['u_stat']='inserted';
		}
        return $rtn;
    }
    return false;

}

//<dlna_cfg action="response"><group><enable>0</enable><status>1</status></group></dlna_cfg>
function get_share_storage()
{
    $rtn = array();
    $cmd = '<smb_cfg action="show"><group></group></smb_cfg>';
    $a = get_info($cmd, 'share_storage');
    if(is_test()){
    	$arr=array('ok','fail','loading');
    	$index=rand(0,2);
		$rtn['share_storage'] = $arr[$index];
    	return $rtn;
    }	    
    if ($a) {
	    $status =$a['group']['status'];
		$usb_status =$a['group']['usb_status'];
		
		if($status==1){
		    $rtn['share_storage'] = 'loading';
		}else if ($status==2){
			$rtn['share_storage']='ok';
		}else if ($status==3){
			$rtn['share_storage']='close';
		}else {
			$rtn['share_storage']='fail';
		}	
		if($usb_status==1){
		    $rtn['u_stat']='inserted';
		}
        return $rtn;
    }
    return false;

}


function get_u_stat()
{
    $rtn = array();

    if(is_test()){
    	$index = rand(0,1);
		if($index>0){
		    $rtn['u_stat'] = 'inserted';
			return $rtn;
		}
		return false;
    	
    }	    

    return false;

}










$act = value_req('act');
$ajax = value_req('ajax');

if (!empty($ajax)) {

    if ($act == all) {
        $rtn = get_all_info();
        $json = new JSON();
        echo $json->encode($rtn);
        exit;
    }

}

if(is_mobile())
    forward_view('main_mobile.php');
else
    forward_view('main.php');


?>