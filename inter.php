<?php

define('IN_MUTA', true);
require(dirname(__FILE__) . '/includes/init.php');


$act = value_req('act');
$ajax = value_req('ajax');


if (!empty($ajax)) {

    $rtn = array();
    $cmd = '<port_info action="show"></port_info>';
    $simple = get_info($cmd, 'interface');

    if (!empty($simple)) {

        $group = $simple['group'];
        $wa_group = $group[0];
        $g_group = $group[2];
        $wi_group = $group[3];


        $status = $wa_group['status'];
        $rtn['name_1'] = $wa_group['name'];
        if ($status == 1) {
            $rtn['ip_1'] = $wa_group['ip_address'];
            $rtn['rx_1'] = $wa_group['rx_byte'];
            $rtn['rx_t_1'] = $wa_group['rx_byte_total'];
            $rtn['tx_1'] = $wa_group['send_byte'];
            $rtn['tx_t_1'] = $wa_group['send_byte_total'];
            $rtn['link_status_1'] = get_i18n('已连接', 'Connected');

        } else {
            $rtn['link_status_1'] = get_i18n('已断开', 'Disconnected');
        }


        $status = $g_group['status'];
        $rtn['name_2'] = $g_group['name'];
        if ($status == 1) {
            $rtn['ip_2'] = $g_group['ip_address'];
            $rtn['rx_2'] = $g_group['rx_byte'];
            $rtn['rx_t_2'] = $g_group['rx_byte_total'];
            $rtn['tx_2'] = $g_group['send_byte'];
            $rtn['tx_t_2'] = $g_group['send_byte_total'];
            $rtn['link_status_2'] = get_i18n('已连接', 'Connected');

        } else {
            $rtn['link_status_2'] = get_i18n('已断开', 'Disconnected');
        }


        $status = $wi_group['status'];
        $rtn['name_3'] = $wi_group['name'];
        if ($status == 1) {
            $rtn['ip_3'] = $wi_group['ip_address'];
            $rtn['rx_3'] = $wi_group['rx_byte'];
            $rtn['rx_t_3'] = $wi_group['rx_byte_total'];
            $rtn['tx_3'] = $wi_group['send_byte'];
            $rtn['tx_t_3'] = $wi_group['send_byte_total'];
            $rtn['link_status_3'] = get_i18n('已连接', 'Connected');
        } else {
            $rtn['link_status_3'] = get_i18n('已断开', 'Disconnected');
        }
        $json = new JSON();

        echo $json->encode($rtn);
    } else {
        echo '{}';
    }


} else {

    forward_view('interface.php');

}















?>