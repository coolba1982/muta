<?php

define('IN_MUTA', true);
require(dirname(__FILE__) . '/includes/init.php');
ob_start();

$act = value_req('act');

$msg = array();
if ($act === 'upload') {
    $file_name  ;
    $absolute_file ;
    reset_visit_time();

    log_muta(time());
    if (isset($_FILES["upfile"]) && ($_FILES["upfile"]["name"] != '')) {
        $file_name = $_FILES["upfile"]["name"];
        $absolute_file = ROOT_PATH  . 'upload/'  . $file_name;

        if (!is_test()) {
            $absolute_file = '/var/' . $file_name;
        }
        //if(file_exists($absolute_file)){
        //	    $error = get_i18n('错误:已经上传过同名文件','Error: the file uploaded has exsit');
        //        $msg = array('type' => 3, 'content' => $error);
        //          clear($absolute_file);forward_view('upgrade_iframe.php');
        // }

        $file_size = $_FILES["upfile"]["size"];
        $fileext = substr(strrchr($file_name, '.'), 1);

        if (($fileext != 'bin') && ($fileext != 'con')) {
            $error = get_i18n('错误:上传文件格式不正确，只能为.bin或者.con格式文件', 'Error: the format of the file can only be .bin or .con');
            $msg = array('type' => 3, 'content' => $error);
            clear($absolute_file);
            forward_view('upgrade_iframe.php');
        }

        log_muta('upload  file   size:' . $file_size);
        if ($file_size > 25000000) {
            $error = get_i18n('错误:上传文件大小超过限制', 'Error: the size of file is beyond limit');
            $msg = array('type' => 3, 'content' => $error);
            clear($absolute_file);
            forward_view('upgrade_iframe.php');
        }

        if ($_FILES["upfile"]["error"] > 0) {
            //1; 超过了文件大小php.ini中即系统设定的大小。
            //2; 超过了文件大小 MAX_FILE_SIZE 选项指定的值。
            //3; 文件只有部分被上传。
            //4; 没有文件被上传。
            //5; 上传文件大小为0。
            if ($_FILES["upfile"]["error"] == 1) {
                $error = get_i18n('异常：超过了系统设定的文件大小', 'Error: the size of file is beyond system config size');
                $msg = array('type' => 3, 'content' => $error);
            } else if ($_FILES["upfile"]["error"] == 2) {
                $error = get_i18n('异常：超过了文件大小 MAX_FILE_SIZE 选项指定的值', 'Error: the size of file is beyond MAX_FILE_SIZE');
                $msg = array('type' => 3, 'content' => $error);
            } else {
                $error = get_i18n('异常：异常码为' . $_FILES["upfile"]["error"], 'Exception：code is ' . $_FILES["upfile"]["error"]);
                $msg = array('type' => 3, 'content' => $error);
            }
            clear($absolute_file);
            forward_view('upgrade_iframe.php');

        }

        $res = move_uploaded_file($_FILES["upfile"]["tmp_name"], $absolute_file);
        log_muta($absolute_file);

        if (!$res) {
            $error = get_i18n('错误：移动文件失败，' . $_FILES["upfile"]["error"], 'Error: failed to move file: ' . $_FILES["upfile"]["error"]);
            $msg = array('type' => 3, 'content' => $error);
            clear($absolute_file);
            forward_view('upgrade_iframe.php');
        }
		

		
		
		

        if (!is_test()) {

            $check_xml = '<check_softmd5 action="mod"><group>';
            $check_xml .= '<path>' . $absolute_file . '</path>';
            $check_xml .= '<fsize>' . $file_size . '</fsize>';
            $check_xml .= '</group></check_softmd5>';
            //Node_mod($check_xml);
            log_muta('[upload check]' . $check_xml);
            $obj_guish->set_rsgui($_SESSION['session_id'], NULL, $check_xml, UCT_CMD);
            $str_xml = $obj_guish->get_xml();
            if (trim($str_xml) != "") {
                $doc->loadXML($str_xml);
                if ($doc->documentElement->tagName == 'return_code') {
                    $err_list = $doc->getElementsByTagName('group')->item(0)->childNodes;
                    //@unlink($path);
                    $errmsg = $err_list->item(1)->nodeValue;
                    $msg = array('type' => 3, 'content' => $errmsg);
                    clear($absolute_file);
                    forward_view('upgrade_iframe.php');
                }
            } else {
			    //Node_update('SF_MAIN', $absolute_file, UCT_UPDATE);
                //$message = get_i18n('升级成功', 'Success to upgrade ');
                $msg = array('type' => 1, 'content' => 'OK');
                //clear($absolute_file);
                forward_view_not_exit('upgrade_iframe.php');

                exit;
            }

        }

        //$message = get_i18n('升级成功', 'Success to upgrade');
        $msg = array('type' => 1, 'content' => 'OK');
        clear($absolute_file);
        forward_view_not_exit('upgrade_iframe.php');
        exit;
    } else {
        $message = get_i18n('上传文件为空', 'The upload file is empty');
        $msg = array('type' => 3, 'content' => $message);
        clear($absolute_file);
        forward_view('upgrade_iframe.php');
    }

} else if ($act == 'iframe') {
    clear($absolute_file);
    forward_view('upgrade_iframe.php');

} else {

    clear($absolute_file);
    forward_view('upgrade.php');
}


function   reset_visit_time()
{
    if (empty($_REQUEST['auto'])) {

        if ((!isset($_SESSION)) || (!isset($_SESSION['session_id']))) {
            return_echo(false, 'SESSION_EXPIRE', null);
        }
        $cur_time = intval(time());
        $_SESSION['last_visit'] = $cur_time;
    }
}


function  clear($file)
{
    @unlink($_FILES["upfile"]['tmp_name']);
    @unlink($file);
    unset($_FILES["upfile"]['tmp_name']);
    clearstatcache();
    ob_end_clean();
}

?>