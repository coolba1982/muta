<?php
b----111111
define('IN_MUTA', true);
require(dirname(__FILE__) . '/includes/init.php');

$act = value_req('act');
$ajax = value_req('ajax');
$link_mode = value_req('link_mode');
$smode_ip = value_req('smode_ip');
$mask = value_req('mask');
$mask2num = value_req('mask2num');


$gate_ip = value_req('gate_ip');
$dns_server1 = value_req('dns_server1');
$dns_server2 = value_req('dns_server2');
$pmode_name = value_req('pmode_name');
$pmode_pwd = value_req('pmode_pwd');
$pmode_ip = value_req('pmode_ip');

$interface = get_interface();


if (!empty($ajax)) {

    $success=get_i18n('已经成功设置','Success to set configs');
    $arr = array();
    $msg = array('type' => MUTA_MSG_SUCCESS, 'content' => $success);
     $json = new JSON();
     $info ='';
            //$rst = $json->encode($arr);
            //sleep(1);
            //echo $rst;


    if ($act === 'update') {

        $link_mode =value_req('link_mode');
        $str_xml='';



        if($link_mode==1){ //static IP

            //echo '$link_mode='.$link_mode;
            $param_string = <<<XML
<?xml version='1.0' encoding="UTF-8"?>
<interface_sub action="mod">
<group>
  <type>0</type> 
  <name>$interface</name> 
  <address_type>1</address_type> 
  <ipaddr>$smode_ip/$mask2num</ipaddr> 
  <http>0</http> 
  <https>0</https> 
  <ping>0</ping> 
  <telnet>0</telnet> 
  <ssh>0</ssh> 
  <cen_monitor>0</cen_monitor> 
  <l2tp>0</l2tp> 
  <sslvpn>0</sslvpn> 
  <webauth>0</webauth> 
  <mtu>1500</mtu> 
  <negotiate>0</negotiate> 
  <half>0</half> 
  <speed>100</speed> 
  <service_type>1</service_type> 
  <ip_type>1</ip_type> 
  </group>
  </interface_sub>
XML;

if(!is_test())
$info = Node_mod($param_string);
if(!empty($info)){
     $msg = array('type' => 3, 'content' => $info);
     $arr['msg'] = $msg ;
     sleep(1);
     echo $json->encode($arr);
     exit;
}



$param_string = <<<XML
<?xml version='1.0' encoding="UTF-8"?>
<default_gate action="add">
<group>
  <gate_ip>$gate_ip</gate_ip> 
  <oif>$interface</oif> 
  <get_style>0</get_style> 
  <service_type>1</service_type> 
  <distance>1</distance> 
  <weight>1</weight> 
  </group>
  </default_gate>
XML;
if(!is_test())
$info = Node_mod($param_string);
if(!empty($info)){
     $msg = array('type' => 3, 'content' => $info);
     $arr['msg'] = $msg ;
     sleep(1);
     echo $json->encode($arr);
     exit;
}



$param_string = <<<XML
<?xml version='1.0' encoding="UTF-8"?>
 <dns action="mod">
 <group>
  <dns_proxy>1</dns_proxy> 
  <first_dns>$dns_server1</first_dns> 
  <second_dns>$dns_server2</second_dns> 
  </group>
  </dns>
XML;
if(!is_test())
$info = Node_mod($param_string);
if(!empty($info)){
     $msg = array('type' => 3, 'content' => $info);
     $arr['msg'] = $msg ;
     sleep(1);
     echo $json->encode($arr);
     exit;
}


     $arr['msg'] = $msg ;
     sleep(1);
     echo $json->encode($arr);
     exit;




        }else if($link_mode==2){//auto get IP

$param_string = <<<XML
<?xml version='1.0' encoding="UTF-8"?>
<interface_sub action="mod">
<group>
  <type>0</type> 
  <name>$interface</name> 
  <address_type>2</address_type> 
  <dhcp_distance /> 
  <dhcp_default_gate>1</dhcp_default_gate> 
  <dhcp_dns>1</dhcp_dns> 
  <http>0</http> 
  <https>0</https> 
  <ping>0</ping> 
  <telnet>0</telnet> 
  <ssh>0</ssh> 
  <cen_monitor>0</cen_monitor> 
  <l2tp>0</l2tp> 
  <sslvpn>0</sslvpn> 
  <webauth>0</webauth> 
  <mtu>1500</mtu> 
  <negotiate>0</negotiate> 
  <half>0</half> 
  <speed>100</speed> 
  <service_type>1</service_type> 
  <ip_type>1</ip_type> 
  </group>
  </interface_sub>
XML;
if(!is_test())
$info = Node_mod($param_string);
if(!empty($info)){
     $msg = array('type' => 3, 'content' => $info);
     $arr['msg'] = $msg ;
     sleep(1);
     echo $json->encode($arr);
     exit;
}



$param_string = <<<XML
<?xml version='1.0' encoding="UTF-8"?>
<default_gate action="add">
 <group>
  <gate_ip /> 
  <oif>$interface</oif> 
  <get_style>2</get_style> 
  <service_type>1</service_type> 
  <default_gate_add>1</default_gate_add> 
  <distance>1</distance> 
  <weight>1</weight> 
  </group>
  </default_gate>
XML;
if(!is_test())
$info = Node_mod($param_string);
if(!empty($info)){
     $msg = array('type' => 3, 'content' => $info);
     $arr['msg'] = $msg ;
     sleep(1);
     echo $json->encode($arr);
     exit;
}


     $arr['msg'] = $msg ;
     sleep(1);
     echo $json->encode($arr);
     exit;






        }else if($link_mode==3){// pppoe

$param_string = <<<XML
<?xml version='1.0' encoding="UTF-8"?>
<interface_sub action="mod">
<group>
  <type>0</type> 
  <name>$interface</name> 
  <address_type>3</address_type> 
  <pppoe_user>$pmode_name</pppoe_user> 
  <pppoe_passwd>$pmode_pwd</pppoe_passwd> 
  <pppoe_specify_ip /> 
  <pppoe_default_gate>1</pppoe_default_gate> 
  <pppoe_distance>1</pppoe_distance> 
  <pppoe_weight>1</pppoe_weight> 
  <pppoe_dns>1</pppoe_dns> 
  <http>0</http> 
  <https>0</https> 
  <ping>0</ping> 
  <telnet>0</telnet> 
  <ssh>0</ssh> 
  <cen_monitor>0</cen_monitor> 
  <l2tp>0</l2tp> 
  <sslvpn>0</sslvpn> 
  <webauth>0</webauth> 
  <mtu>1500</mtu> 
  <negotiate>0</negotiate> 
  <half>0</half> 
  <speed>100</speed> 
  <service_type>1</service_type> 
  <ip_type>1</ip_type> 
  </group>
  </interface_sub>
XML;
if(!is_test())
$info = Node_mod($param_string);
if(!empty($info)){
     $msg = array('type' => 3, 'content' => $info);
     $arr['msg'] = $msg ;
     sleep(1);
     echo $json->encode($arr);
     exit;
}



$param_string = <<<XML
<?xml version='1.0' encoding="UTF-8"?>
 <default_gate action="add">
 <group>
  <gate_ip /> 
  <oif>$interface</oif> 
  <get_style>1</get_style> 
  <service_type>1</service_type> 
  <default_gate_add>0</default_gate_add> 
  <distance>1</distance> 
  <weight>1</weight> 
  </group>
  </default_gate>
XML;
if(!is_test())
$info = Node_mod($param_string);
if(!empty($info)){
     $msg = array('type' => 3, 'content' => $info);
     $arr['msg'] = $msg ;
     sleep(1);
     echo $json->encode($arr);
     exit;
}


     $arr['msg'] = $msg ;
     sleep(1);
     echo $json->encode($arr);
     exit;




        }



        //Node_mod($mod_xml);

        $hint = array();
        $msg = array('type' => 1, 'content' => $success);
        $arr = array();
        $arr['msg'] = $msg;
        $json = new JSON();
        $rst = $json->encode($arr);

        sleep(1);
        echo $rst;

    } else {
    
     ///////////////////////////////显示///////////////////////////////

        $str_xml = "<interface_sub action=\"show_one\"><group><name>$interface</name></group></interface_sub>";
        $rst = array();
        $rst['error_msg'] = '';
        $rst['result'] = '';
        if (!is_test())
            $rst = Node_showIndex($str_xml);

        log_muta('[wan rsp error_msg]' . $rst['error']);
        log_muta('[wan rsp xml]' . $rst['result']);
        $error_msg = trim($rst['error_msg']);
        $result_xml = trim($rst['result']);
        if (empty($error_msg) && !empty($result_xml)) {
            $simple = simplexml_load_string($result_xml);
            $simple = json_encode($simple);
            $simple_array = json_decode($simple,TRUE);

            //$address = $simple->group->address_type;
            $address= $simple_array['group']['address_type'];

            if(empty($address)){
                $arr = array();
                $m = get_i18n('获取连接方式为空，请重新设置一种连接方式','Link mode is empty, please rechoose one');
                $arr['msg'] = array('type' => 3, 'content' => $m);
                $arr['form'] = array( 'link_mode' => '');
                $json = new JSON();
                $init = $json->encode($arr);
                echo  $init;
                exit;
            }

            if($address==1){  //static  ip
                //$smode_ip = $simple->group->ipaddr[0];
                $smode_ip = $simple_array['group']['ipaddr'];
                $arr=explode('/',$smode_ip);
                $smode_ip =$arr[0];
                $mask = $arr[1];
                $gate_ip =$simple_array['group']['gateway'];
                $dns_server1 ='';
                $dns_server2 ='';

                //查询DNS
                $str_xml='<dns action="show"></dns> ';
                $rst = array();
                $rst['error_msg'] = '';
                $rst['result'] = '';
                if (!is_test())
                    $rst = Node_showIndex($str_xml);

                log_muta('[error_msg]' . $rst['error']);
                log_muta('[xml]' . $rst['result']);
                $error_msg = trim($rst['error_msg']);
                $result_xml = trim($rst['result']);
                if (empty($error_msg) && !empty($result_xml)) {
                    $simple = simplexml_load_string($result_xml);
                    $simple = json_encode($simple);
                    $simple_array = json_decode($simple,TRUE);

                    $dns_server1 = $simple_array['group']['first_dns'];
                    $dns_server2 = $simple_array['group']['second_dns'];
                }else  if(!empty($error_msg)){
                    $arr = array();
                    $arr['msg'] = array('type' => 3, 'content' => 'EXCEPT:'.$error_msg);
                    $json = new JSON();
                    $init = $json->encode($arr);
                    echo  $init;
                    exit;
                }else{
                
                    $arr = array();
                    $arr['msg'] = array('type' => 2, 'content' => get_i18n('有线接入尚未设置','Wire access is not setted'));
                    $json = new JSON();
                    $init = $json->encode($arr);
                    echo  $init;
                    exit;
                
                }

                $arr = array();
                
                $arr['form'] =array('link_mode'=>'1','smode_ip'=>$smode_ip,'gate_ip'=>$gate_ip,'mask'=>$mask,'dns_server1'=>$dns_server1,'dns_server2'=>$dns_server2);
                $json = new JSON();
                $init = $json->encode($arr);
                echo  $init;
                exit;


            }else if($address==2){

                $arr = array();
                $arr['form'] =array('link_mode'=>'2');
                $json = new JSON();
                $init = $json->encode($arr);
                echo  $init;
                exit;

            }else if($address==3){
               $pmode_name =  $simple_array['group']['pppoe_user'];
                $pmode_pwd = $simple_array['group']['pppoe_passwd'];

                $arr = array();
                $arr['form'] =array('link_mode'=>'3','pmode_pwd'=>$pmode_pwd,'pmode_name'=>$pmode_name);
                $json = new JSON();
                $init = $json->encode($arr);
                echo  $init;
                exit;

            }else{
                $arr = array();
                $arr['msg'] = array('type' => 2, 'content' => get_i18n('有线接入尚未设置','Wire access is not setted'));
                $json = new JSON();
                $init = $json->encode($arr);
                echo  $init;
                exit;

            }


        }else if(!empty($error_msg)){
            $arr = array();
            $arr['msg'] = array('type' => 3, 'content' => 'EXCEPT:'.$error_msg);
            $json = new JSON();
            $init = $json->encode($arr);
            echo  $init;
            exit;

        }else{
                $arr = array();
                $arr['msg'] = array('type' => 2, 'content' => get_i18n('有线接入尚未设置','Wire access is not setted'));
                $json = new JSON();
                $init = $json->encode($arr);
                echo  $init;
                exit;
        }



        // for test
        $arr = array();
        $arr['msg'] = array('type' => 1, 'content' => $success);
        $arr['form'] = array('smode_ip' => '1.2.3.4', 'link_mode' => '3', 'pmode_name' => 'AAAAA', 'pmode_pwd' => 'BBBBB');

        $json = new JSON();
        $init = $json->encode($arr);
        echo  $init;


    }


} else {
    //$arr = array();
    //$arr['msg']=array('type'=>1,'content'=>'');
    //$arr['form']=array('smode_ip'=>'1.2.3.4');

    //$json =new JSON();
    //$init = $json->encode($arr);














        forward_view('wan.php');

}















?>