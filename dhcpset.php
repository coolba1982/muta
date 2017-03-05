<?php

define('IN_MUTA', true);
require_once(dirname(__FILE__) . '/includes/init.php');






$act = value_req('act');
$ajax = value_req('ajax');
$ip = value_req('ip');
$mask = value_req('mask');
$mask2num = value_req('mask2num');
$start_ip = value_req('start_ip');
$end_ip = value_req('end_ip');
$interface = 'ath1';

if (!empty($ajax)) {
    if ($act === 'update') {
        $cmd = "<dhcp_server action=\"mod\"><group><server_name>$interface</server_name><subnet>$ip/$mask2num</subnet><ip_gw>$ip</ip_gw><ip_start>$start_ip</ip_start><ip_end>$end_ip</ip_end><infinite>1</infinite><time_d_lease/><time_h_lease/><time_m_lease/><ip_dns1>$ip</ip_dns1><ip_dns2/><ip_wins1/><ip_wins2/><domain_name/><exclusion_addr></exclusion_addr><pre></pre></group></dhcp_server>";
        execute_cmd($cmd);
        $cmd = "<dhcp_service action=\"mod\"><group><ifname>$interface</ifname><type>2</type><relay_ip></relay_ip></group></dhcp_service>";
        execute_cmd($cmd);
        $m=get_i18n('已经成功设置','Success to set configs');
        return_echo(true, $m , null);
    } else {


        ///////////////////////////////显示///////////////////////////////
        $str_xml = "<dhcp_server action=\"show_one\"><group><server_name>$interface</server_name></group></dhcp_server> ";
        $rst = array();
        $rst['error_msg'] = '';
        $rst['result'] = '';
        if (!is_test())
            $rst = Node_showIndex($str_xml);
        log_muta('[dhcp rsp error_msg]' . $rst['error']);
        log_muta('[dhcp rsp xml]' . $rst['result']);
        $error_msg = trim($rst['error_msg']);
        $result_xml = trim($rst['result']);
        if (empty($error_msg) && !empty($result_xml)) {
            $simple = simplexml_load_string($result_xml);
            $simple = json_encode($simple);
            $simple_array = json_decode($simple, TRUE);
            $sub= $simple_array['group']['subnet'];
            $ip_start= $simple_array['group']['ip_start'];
            $ip_end= $simple_array['group']['ip_end'];
            $arr=explode('/',$sub);
            $ip =$arr[0];
            $mask = $arr[1];
            $frm = array('ip'=>$ip,'start_ip'=>$ip_start,'end_ip'=>$ip_end,'mask'=>$mask,);
            return_echo(true,null,$frm);
        }else if(!empty($error_msg)){
            return_echo(false, $error_msg, null);
        }else{
        	  $m=get_i18n('WIFI DHCP尚未设置','WIFI DHCP is not setted');
            return_echo(false, $m , null,2);
        }





    }


} else {


    forward_view('dhcp.php');

}










?>