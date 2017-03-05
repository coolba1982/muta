<?php

define('IN_MUTA', true);
require_once(dirname(__FILE__) . '/includes/init.php');


$act = value_req('act');
$ajax = value_req('ajax');
$old_pwd = value_req('old_pwd');
$new_pwd = value_req('new_pwd');
$repeat_pwd = value_req('repeat_pwd');

if (!empty($ajax)) {


    if ($act === 'update') {
        $real_pwd = '';
        $str_xml = '<admin_db action="show_one"><group><name>admin</name></group></admin_db>';
        $rst = array();
        $rst['error_msg'] = '';
        $rst['result'] = '';
        if (!is_test())
            $rst = Node_showIndex($str_xml);
        log_muta('[chgpwd rsp error_msg]' . $rst['error']);
        log_muta('[chgpwd rsp xml]' . $rst['result']);
        $error_msg = trim($rst['error_msg']);
        $result_xml = trim($rst['result']);
        if (empty($error_msg) && !empty($result_xml)) {
            $simple = simplexml_load_string($result_xml);
            $simple = json_encode($simple);
            $simple_array = json_decode($simple, TRUE);
            $real_pwd = $simple_array['group']['password'];
            if ($real_pwd != $old_pwd) {
            	   $m = get_i18n('输入的旧的密码不正确','The old password is not correct');

                return_echo(false, $m, null);
            }
        } else if (!empty($error_msg)) {
            return_echo(false, $error_msg, null);
        } else {
            if ($real_pwd != $old_pwd) {
            	  $m = get_i18n('输入的旧的密码不正确','The old password is not correct');
                return_echo(false, $m , null);
            }
        }
        $cmd = "<admin_db action=\"mod\"><group><name>admin</name><desc/><authority_table_name>telecomadmin</authority_table_name><status>0</status><type>1</type><password>$new_pwd</password><permit_ip1/><permit_ip2/><permit_ip3/><radius_server_name></radius_server_name><ladp_server_name/></group></admin_db>";
        execute_cmd($cmd);
        $m = get_i18n('已经成功修改了密码','Success to reset the password');
        return_echo(true, $m, null);


    } else {


        ///////////////////////////////显示///////////////////////////////


    }


} else {


    forward_view('pwd.php');

}










?>