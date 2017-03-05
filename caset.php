<?php

define('IN_MUTA', true);
require(dirname(__FILE__) . '/includes/init.php');

aaaaaaa----------
$act = value_req('act');
$ajax = value_req('ajax');
$leisure_time = value_req('leisure_time');
$dial_intval = value_req('dial_intval');
$link_status = 1;
$dial_way = value_req('dial_way');


if (!empty($ajax)) {


    if ($act === 'update') {

        if($dial_way==1){
            $cmd="<evdo_cfg action=\"mod\"><group><evdo_en>1</evdo_en><in_type>1</in_type><dial_way>1</dial_way><leisure_time>$leisure_time</leisure_time><link_status>$link_status</link_status></group></evdo_cfg>";
            execute_cmd($cmd);
        }else if($dial_way==2){
            $cmd="<evdo_cfg action=\"mod\"><group><evdo_en>1</evdo_en><in_type>1</in_type><dial_way>2</dial_way><dial_intval>$dial_intval</dial_intval><link_status>$link_status</link_status></group></evdo_cfg>";
            execute_cmd($cmd);
        }else if($dial_way==3){
            $cmd="<evdo_cfg action=\"mod\"><group><evdo_en>1</evdo_en><in_type>1</in_type><dial_way>3</dial_way><link_status>$link_status</link_status></group></evdo_cfg>";
            execute_cmd($cmd);
        }else{
            return_echo(false,'Unknown dial way',null);
        }
        $m = get_i18n('已经成功设置','Success to set configs');
        return_echo(true,$m,null);

    } else {

        $str_xml = '<evdo_cfg action="show"></evdo_cfg>';
        $rst = array();
        $rst['error_msg'] = '';
        $rst['result'] = '';
        if (!is_test())
            $rst = Node_showIndex($str_xml);
        log_muta('[3g rsp error_msg]' . $rst['error']);
        log_muta('[3g rsp xml]' . $rst['result']);
        $error_msg = trim($rst['error_msg']);
        $result_xml = trim($rst['result']);
        if (empty($error_msg) && !empty($result_xml)) {
            $simple = simplexml_load_string($result_xml);
            $simple = json_encode($simple);
            $simple_array = json_decode($simple, TRUE);
            $dial_way = $simple_array['group']['dial_way'];
            $leisure_time='';
            $dial_intval='';
            $link_status='';
            if($dial_way==2){
                $dial_intval =  $simple_array['group']['dial_intval'];
            }else if($dial_way==1){
                $leisure_time =  $simple_array['group']['leisure_time'];
            }else if($dial_way==3){

            }else{
                return_echo(false,"Unknown dial way:$dial_way",null);
            }
            $link_status =  $simple_array['group']['link_status'];
            return_echo(true,null, array('dial_way'=>$dial_way,'dial_intval'=>$dial_intval,'link_status'=>$link_status,'leisure_time'=>$leisure_time));
        } else if (!empty($error_msg)) {
            return_echo(false, $error_msg, null);
        } else {
        	  $m = get_i18n('无线接入还没有设置','Wireless access is not setted');
            return_echo(false, $m, null,2);
        }

    }


} else {


    forward_view('card.php');

}










?>
