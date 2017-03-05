<?php

define('IN_MUTA', true);
require(dirname(__FILE__) . '/includes/init.php');


$act = value_req('act');
$ajax = value_req('ajax');
$success=get_i18n('已经成功设置','Success to set configs');

if (!empty($ajax)) {

    if ($act === 'update') {

        $ssid = trim($_REQUEST['ssid']);
        $old_ssid = trim($_REQUEST['old_ssid']);
        if ($ssid === $old_ssid) {
            $info = wifi_secure_set();
            $msg = array('type' => MUTA_MSG_SUCCESS, 'content' => $success);
            if (!empty($info)) {
                $msg = array('type' => MUTA_MSG_ERROR, 'content' => $info);
            }
            $arr = array();
            $arr['msg'] = $msg;
            $json = new JSON();
            $rst = $json->encode($arr);
            sleep(1);
            echo $rst;
        } else {

            $param_string = <<<XML
<?xml version='1.0' encoding="UTF-8"?>
<wlan_cfg action="mod">
	<group>
   <mode>4</mode>
    <channel>0</channel>
    <country_code>156</country_code>
    <power_out>16</power_out>
    <wlan_down>0</wlan_down>
    <ssid_list>
      <group>
        <wlan_name>ath1</wlan_name>
        <ssid_name>$ssid</ssid_name>
        <wrate>0</wrate>
        <beacon_status>0</beacon_status>
        <beacon_intval>100</beacon_intval>
        <dtim>1</dtim>
        <if_down>0</if_down>
        <maxsta>32</maxsta>
      </group>
    </ssid_list>
  </group>
</wlan_cfg>
XML;
            $info = '';
            if (!is_test()) {
                $info = Node_mod($param_string);
            }
            if (!empty($info)) {
                $msg = array('type' => MUTA_MSG_ERROR, 'content' => $info);

                $arr = array();
                $arr['msg'] = $msg;
                $json = new JSON();
                $rst = $json->encode($arr);
                sleep(1);
                echo $rst;
                exit;

            }

            $info = wifi_secure_set();
            $msg = array('type' => MUTA_MSG_SUCCESS, 'content' => $success);
            if (!empty($info)) {
                $msg = array('type' => MUTA_MSG_ERROR, 'content' => $info);
            }
            $arr = array();
            $arr['msg'] = $msg;
            $json = new JSON();
            $rst = $json->encode($arr);
            sleep(1);
            echo $rst;


        }


    } else {


        //////////////////////////////


        $str_xml = '<wlan_secure action="show"></wlan_secure>';
        // $index_ath = substr($str[0],-1)-1;
        $rst = array();
        $rst['error_msg'] = '';
        $rst['result'] = '';
        if (!is_test())
            $rst = Node_showIndex($str_xml);

        log_muta('[error_msg]' . $rst['error_msg']);
        log_muta('[xml]' . $rst['result']);
        $error_msg = trim($rst['error_msg']);
        $result_xml = trim($rst['result']);
        if (empty($error_msg) && !empty($result_xml)) {
            $encrypt = '';
            $doc->loadXML($result_xml);
            $elm_list = $doc->getElementsByTagName('wlan_secure')->item(0)->childNodes->item(0); //->childNodes;
            $wlan_name = ($elm_list->getElementsByTagName('wlan_name')->item(0)->nodeValue);
            $ssid = ($elm_list->getElementsByTagName('ssid_name')->item(0)->nodeValue);
            $share_key = ($elm_list->getElementsByTagName('wpa_pwd')->item(0)->nodeValue);
            $segregate = ($elm_list->getElementsByTagName('segregate')->item(0)->nodeValue);
            $sec_mode = ($elm_list->getElementsByTagName('sec_mode')->item(0)->nodeValue);
            $secure = '';
            switch ($sec_mode) //
            {
                case 0:
                    $secure = 0;
                    break;
                case 3:
                    $secure = 3;
                    $encrypt = 'TKIP';
                    break;
                case 4:
                    $secure = 4;
                    $encrypt = 'AES';
                    break;

                default:
                    break;
            }
            
            $arr = array();
      
            $arr['form'] = array('secure' => "$secure", 'ssid' => "$ssid", 'encrypt' => "$encrypt", 'share_key' => "$share_key", 'segregate' => "$segregate");

            $json = new JSON();
            $init = $json->encode($arr);
            echo  $init;            
            


        }else if(!empty($error_msg)){
            $m="Except:$error_msg";
            return_echo(false, $m , null,2);
        
        }else{
            $m=get_i18n('WIFI连接尚未设置','WIFI connection is not setted');
            return_echo(false, $m , null,2);
        }




    }
} else {


    forward_view('wifi.php');

}


function  wifi_secure_set()
{

    $mod_xml = '<wlan_secure action="mod"><group>';
    $mod_xml .= '<wlan_name>ath1</wlan_name>';
    $mod_xml .= '<ssid_name>' . $_REQUEST['ssid'] . '</ssid_name>';
    $mod_xml .= '<segregate>' . $_REQUEST['segregate'] . '</segregate>';
    switch ($_REQUEST['secure']) //
    {
        case 0:
            $mod_xml .= '<sec_mode>0</sec_mode>';
            break;

        case 3:
            $mod_xml .= '<sec_mode>3</sec_mode>';
            $mod_xml .= '<wpa_pwd>' . $_REQUEST['share_key'] . '</wpa_pwd>';
            break;
        case 4:
         $mod_xml .= '<sec_mode>4</sec_mode>';
            $mod_xml .= '<wpa_pwd>' . $_REQUEST['share_key'] . '</wpa_pwd>';
            break;
        default:
            break;
    }
    $mod_xml .= '</group></wlan_secure>';

    log_muta('Wifi set input : ' . $mod_xml);
    $info = '';

    if (!is_test()) {
        $info = Node_mod($mod_xml);
    }

    return $info;


}


?>