<?php
if (!defined('ROOT_PATH')) { 
define('ROOT_PATH', str_replace('log_muta.php', '', str_replace('\\', '/', __FILE__)));
}

function log_muta($string, $output = false)
{


  
    $date='';
    if(is_test())
        $date = date('Y-m-d H:i:s');
    $logto =  '';
    $message = "[$date]" . $string . "\n";
    if ($logto == '') {
        $log_dir = ROOT_PATH . DIRECTORY_SEPARATOR . "muta/log" . DIRECTORY_SEPARATOR;
        $log_file = $log_dir . "log_muta.log";
    } else {
        $log_dir = dirname($logto);
        $log_file = $logto;
    }

    if (!is_dir($log_dir)) {
        @mkdir($log_dir, 0777);
    }

    $fp = @fopen($log_file, "a");
    if ($fp) {
        @fwrite($fp, $message);
        fclose($fp);
    }
    if (($output == true) && (isset($_SERVER["argv"][0]))) {
        print $message;
    }
}


?>