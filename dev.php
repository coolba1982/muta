<?php


define('IN_MUTA', true);
require(dirname(__FILE__) . '/includes/init.php');


$act = value_req('act');
$ajax = value_req('ajax');




if (!empty($ajax)) {
    $rtn = array();
    $cmd = '<max_station action="show"><group><wlan_name>ath1</wlan_name></group></max_station> ';
    $simple = get_info($cmd, 'wifi_dev_list');
    $btn_value = get_i18n('断开连接', 'Disconnect');

    if(is_test()){
        $str = $str . "<tr><td>Test MAC</td><td>$ip</td><td>Test Host</td><td><input type='button' value='$btn_value'   onclick='javascript:disconnect(\"Test Mac\")'> </td> </tr>";
       echo  $str;
        exit;


    }



    if (!empty($simple)) {

        $group = $simple['group']['rst_list']['group'];

        if (!empty($group['mac'])) {
            $mac = $group['mac'];
            $ip = $group['ip'];
			if(is_array($ip)){
			    $ip = 'N/A';
			}
			
            $hostname = $group['hostname'];
			if(is_array($hostname)){
			         $hostname = 'N/A';
			}				

			
			
            $str = $str . "<tr><td>$mac</td><td>$ip</td><td>$hostname</td><td><input type='button' value='$btn_value'   onclick='javascript:disconnect(\"$mac\")'> </td> </tr>";
            //print_r($simple);

            echo $str;
            exit;
        }
        $str = '';
        for ($i = 0; $i < 30; $i++) {
            if (!empty($group[$i])) {
                $mac = $group[$i]['mac'];
                $ip = $group[$i]['ip'];
			    if(is_array($ip)){
			         $ip = 'N/A';
			    }
				
                $hostname = $group[$i]['hostname'];
			    if(is_array($hostname)){
			         $hostname = 'N/A';
			    }				
				

                $str = $str . "<tr><td>$mac</td><td>$ip</td><td>$hostname</td><td><input type='button' value='$btn_value'   onclick='javascript:disconnect(\"$mac\")'> </td> </tr>";
            } else {
                break;
            }
        }
        if (!empty($_REQUEST['test'])) {
            print_r($simple);
        } else {
            echo $str;
        }
        //$m = get_i18n('当前没有设备连接', 'No device connected');
       // echo '<tr> <td colspan="4" style="text-align:center;">' . $m . '</td> </tr>';
    } else {
        $m = get_i18n('当前没有设备连接', 'No device connected');
        echo '<tr> <td colspan="4" style="text-align:center;">' . $m . '</td> </tr>';
    }

} else {
	
	  if(is_mobile())
    forward_view('device_list.php');
    else
    forward_view('device_list_mobile.php');
    //include 'view/login.php';


}

?>