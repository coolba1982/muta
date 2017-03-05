<?php
//error_reporting(0);

function del_dir($dir){	//删除目录
	if(!($mydir=@dir($dir))){
		return;
	}
	while($file=$mydir->read()){
		if(is_dir("$dir$file") && $file!='.' && $file!='..'){ 
			@chmod("$dir$file", 0777);
			del_dir("$dir$file"); 
		}elseif(is_file("$dir/$file")){
			//$file_time=@stat($file);	//读取文件的最后更新时间
			//if(time()-$file_time>3600*24*14){
				@chmod("$dir/$file", 0777);
				@unlink("$dir/$file");
			//}
		}
	}
	$mydir->close();
	@chmod($dir, 0777);
	@rmdir($dir);
}


function check_expire_by_client(){
	
      if (isset($_CFG['session_expire'])){
      	  	
	        $expire = $_CFG['session_expire'];
	        log_muta('[session_expire]' . $expire);
	        $cur_time ;
	        if(!empty($_REQUEST['t'])){
	        	  $cur_time = intval($_REQUEST['t']);
	        	  
	        	  log_muta('[cur_time]' . $cur_time);
	        	
	        	  if(!empty($_SESSION['last_visit'])){
	        	  	 $last_visit = intval($_SESSION['last_visit']);
	        	  	 log_muta('[last_visit]' . $last_visit);
	        	  	 

	        	  	 
	        	  	 if(($cur_time-$last_visit)>=$expire){
	        	  	 	    unset($_SESSION['last_visit'] );
	        	  	 	    unset($_SESSION['session_id'] );
	        	  	 	    unset($_SESSION);
	        	  	 	    $path = $_CFG['session_save_path'];
	        	  	 	    if(is_test()){
	        	  	 	    	 $path = $_CFG['session_save_path_test'];
	        	  	 	    }	
	        	  	 	    
	        	  	 	    if(empty($path)){
	        	  	 	    	 $path=ini_get('session.save_path');
	        	  	 	    }	
	        	  	 	    if(!empty($path)){
	        	  	 	    	 del_dir($path);
	        	  	 	    }	
	        	  	 	    if(empty($_REQUEST['ajax'])){
	        	  	 	        redirect_view('login.php');
	        	  	 	    }   
	        	  	 	       
	        	  	 }	
	        	  }	
	        	
	            $_SESSION['last_visit'] = $cur_time;
	        	
	        }	
		
      }		
		
	
	
	
	
}	












function  get_interface(){
	 global $_CFG;
	 $rtn = 'eth0';
	 if(isset($_CFG['interface'])){
	 	   $rtn = $_CFG['interface'];
	 }	
	 return $rtn;
}	


 
function echo_active($arr){
	foreach ($arr as $item){
		if(strpos(PHP_SELF, '/'.$item) !== false){
			 echo ' class="active" ';
			 break ;
		}	
 }
}	
 
 

function  get_info($cmd, $tag)
{
    $str_xml = $cmd;
    $rst = array();
    $rst['error_msg'] = '';
    $rst['result'] = '';
    if (!is_test())
        $rst = Node_showIndex($str_xml);
    if (empty($tag)) {
        log_muta('[error_msg]' . $rst['error']);
        log_muta('[rsp xml]' . $rst['result']);
    } else {
        log_muta('[error_msg ' . $tag . ']' . $rst['error']);
        log_muta('[rsp ' . $tag . ']' . $rst['result']);
    }
    $error_msg = trim($rst['error_msg']);
    $result_xml = trim($rst['result']);
    if (empty($error_msg) && !empty($result_xml)) {
        $simple = simplexml_load_string($result_xml);

        $simple = json_encode($simple);
        $simple_array = json_decode($simple, TRUE);
        return $simple_array;
    }
    return false;
}


function  return_echo($is_success, $msg_content, $form_arr,$default_type=false)
{
    $arr = array();
    $type = 1;
    if (!$is_success) {
        $type = 3;
    }
    if($default_type!=false){
    	 $type = $default_type;
    }	
    
    if (!empty($msg_content)) {
        $arr['msg'] = array('type' => $type, 'content' => $msg_content);
    }
    if (!empty($form_arr)) {
        $arr['form'] = $form_arr;
    }
    $json = new JSON();
    $rst = $json->encode($arr);
    echo $rst;
    exit;
}

function  execute_cmd($cmd)
{
    $info = '';
    if (!is_test())
        $info = Node_mod($cmd);
    if (!empty($info)) {
        return_echo(false, $info, null);
    }
}

function  execute_cmd_ext($cmd)
{
    $info = '';
    if (!is_test())
        $info = Node_mod($cmd);
    if (!empty($info)) {
        return_echo(false, $info, null);
    }else{
        return_echo(true, null, null);
    }
}




function  value_req($key)
{
    $rst = '';
    if (isset($_REQUEST[$key])) {
        $rst = $_REQUEST[$key];
    }
    return $rst;
}


function  value_get($key)
{
    $rst = '';
    if (isset($_GET[$key])) {
        $rst = $_GET[$key];
    }
    return $rst;
}

function  value_post($key)
{
    $rst = '';
    if (isset($_POST[$key])) {
        $rst = $_POST[$key];
    }
    return $rst;
}

function  value_ses($key)
{
    $rst = '';
    if (isset($_SESSION[$key])) {
        $rst = $_SESSION[$key];
    }
    return $rst;
}

function build_msg($content, $type = MUTA_MSG_INVALID)
{
    $msg = array();
    $msg['content'] = $content;
    $msg['type'] = $type;
    return $msg;
}

function hint($id)
{
    global $hint;
    $rst = '';
    if (isset($hint) && (isset($hint[$id]))) {
        $rst = $hint[$id];
    }
    return $rst;
}


function i18n($id)
{
    global $_LANG;
    $rst = $id;
    if (isset($_LANG) && (isset($_LANG[$id]))) {
        $rst = $_LANG[$id];
    }
    return $rst;
}


function echo_i18n($id)
{
    echo i18n($id);
}

function printx($zh,$en,$id=null)
{
	  if(!empty($id)){
        echo_i18n($id);
        return;
    }
    global $_CFG;
    if($_CFG['lang']=='en_us'){
        echo $en;
    }else{
    	 echo $zh;
    }		
}


function get_i18n($zh,$en)
{

    global $_CFG;
    if($_CFG['lang']=='en_us'){
        return $en;
    }else{
    	 return $zh;
    }		
}



function echo_lang()
{
    if(!empty($_REQUEST['lang'])){
    	  echo '?lang='.$_REQUEST['lang'];
    }	
}

function redirect_view($string, $replace = true, $http_response_code = 0)
{

    $string = str_replace(array("\r", "\n"), array('', ''), $string);


    @header('Location:'.$string . "\n", $replace);

    exit();
    

}

function redirect_view_notexit($string, $replace = true, $http_response_code = 0)
{

    $string = str_replace(array("\r", "\n"), array('', ''), $string);


    @header('Location:'.$string . "\n", $replace);

    //exit();
    

}


function  forward_view($view,$cache=true)
{  
	  if(!$cache){
	  	header("Cache-Control: no-cache, must-revalidate");
      header("Pragma: no-cache");
	  }	
	
    include 'view/' . $view;
    exit;
}



function  forward_view_not_exit($view,$cache=true)
{
    if(!$cache){
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
    }

    include 'view/' . $view;
}




function  get_session_id()
{
//   if(empty($_SESSION['session_id'])) {
//       forward_view('login.php');
//   }
//   return $_SESSION['session_id'];

    if(is_test()){
        return 'test_session_id';
    }
    if (!empty($_SESSION['session_id'])) {
        $sid = $_SESSION['session_id'];
    }else {
        $sid = '';
    }


    return $sid;
}


function  encode_json_return($msg)
{
    $rst = array();
    $rst['msg'] = $msg;
    $json = new JSON();
    sleep(1);
    echo $json->encode($rst);
    exit;
}


/* array_rekey - 改变array形态:
     '$arr[0] = array("id" => 23, "name" => "blah")'
     to the form
     '$arr = array(23 => "blah")'
   @arg $array - (array) the original array to manipulate
   @arg $key - the name of the key
   @arg $key_value - the name of the key value
   @returns - the modified array */
function array_rekey($array, $key, $key_value)
{
    $ret_array = array();

    if (sizeof($array) > 0) {
        foreach ($array as $item) {
            $item_key = $item[$key];

            if (is_array($key_value)) {
                for ($i = 0; $i < count($key_value); $i++) {
                    $ret_array[$item_key]{$key_value[$i]} = $item{$key_value[$i]};
                }
            } else {
                $ret_array[$item_key] = $item[$key_value];
            }
        }
    }

    return $ret_array;
}


function mkdirs($dir)
{
    if (!is_dir($dir)) {
        if (!mkdirs(dirname($dir))) {
            return false;
        }
        if (!@mkdir($dir, 0777)) {
            echo "cant not create dir: $dir";
            return false;
        }
    }
    return true;
}


function log_muta($string, $output = false){
}	

function log_muta_1($string, $output = false)
{
    global $config;
    $date = '';
    if (is_test())
        $date = date('Y-m-d H:i:s');
    $logto = isset($_CFG["log_file"]) ? $_CFG["log_file"] : '';
    $message = "[$date]" . $string . "\n";
    $log_dir ='';
    if ($logto == '') {
        $log_dir = ROOT_PATH . DIRECTORY_SEPARATOR . "log" . DIRECTORY_SEPARATOR;
        if(!is_test()){
           // $log_dir =  "/var/muta_log/" ;
		   $log_dir =  "/www/log/" ;
        }
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

function log_test($string, $output = false)
{
    global $config;
    $date = date('Y-m-d H:i:s');
    // $logto = isset($_CFG["log_file"]) ? $_CFG["log_file"] : '';
    //$message = "[$date]" . $string . "\n";
    $log_file = '';
    $logto = '';
    if ($logto == '') {
        //$log_dir = ROOT_PATH . DIRECTORY_SEPARATOR . "log" . DIRECTORY_SEPARATOR;
        $log_file = $log_dir . "log_muta.log";
    } else {
        // $log_dir = dirname($logto);
        //$log_file = $logto;
    }

    echo '$log_file:' . $log_file;
    //if (!is_dir($log_dir)) {
    //  @mkdir($log_dir, 0777);
    //}
    echo '$log_file:' . $log_file;

    //  $fp = @fopen($log_file, "a");
    //  if ($fp) {
    //    @fwrite($fp, $message);
    //   fclose($fp);
    //  }
    //if (($output == true) && (isset($_SERVER["argv"][0]))) {
    // print $message;
    // }
}


function  clean_value($val)
{
    if ($val == "") {
        return "";
    }
    $val = trim($val);
    $val = str_replace("", "*", $val);
    $val = str_replace("&#032;", "  ", $val);
    $val = str_replace("&", "&amp;", $val);
    $val = str_replace("<!--", "&#60;&#33;--", $val);
    $val = str_replace("-->", "--&#62;", $val);
    $val = preg_replace("/<script/i", "&#60;script", $val);
    $val = str_replace(">", "&gt;", $val);
    $val = str_replace("<", "&lt;", $val);
    $val = str_replace("\"", "&quot;", $val);
    $val = preg_replace("/\  |/", "&#124;", $val);
    $val = preg_replace("/\n/", "<br>", $val); //  Convert  literal  newlines
    $val = preg_replace("/\\\$/", "&#036;", $val);
    $val = preg_replace("/\r/", "", $val); //  Remove  literal  carriage  returns
    $val = str_replace("!", "&#33;", $val);
    $val = str_replace("'", "&#39;", $val); //  IMPORTANT:  It  helps  to  increase  sql  query              afety.
    $val = stripslashes($val); //  Swop  PHP  added  backslashes
    $val = preg_replace("/\\\/", "&#092;", $val); //  Swop  user  inputted  backslashes
    return $val;
}


/***字符串转换***/
function  changeStr($str)
{
    $str = str_replace("&", "&amp;", $str);
    $str = str_replace("<", "&lt;", $str);
    $str = str_replace(">", "&gt;", $str);
    $str = str_replace("\"", "&quot;", $str);
    $str = str_replace("  ", "&nbsp;", $str);
    //$str=str_replace("≥","&Yacute;",$str);
    //$str=str_replace("℃","&aelig;",$str);
    //$str=str_replace("±","&Agrave;",$str);
    //$str=str_replace("≤","&Uuml;",$str);
    $str = nl2br($str);
    return $str;
}


function replace_str($post)
{
    if (!get_magic_quotes_gpc()) // 判断magic_quotes_gpc是否为打开
    {
        $post = addslashes($post); // 进行magic_quotes_gpc没有打开的情况对提交数据的过滤
    }
    $post = str_replace("_", "\_", $post); // 把 '_'过滤掉
    $post = str_replace("%", "\%", $post); // 把' % '过滤掉
    $post = nl2br($post); // 回车转换
    $post = htmlspecialchars($post); // html标记转换
    return $post;
}


function generate_name($length = 8)
{
// 密码字符集，可任意添加你需要的字符
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $n = '';
    for ($i = 0; $i < $length; $i++) {
// 这里提供两种字符获取方式
// 第一种是使用 substr 截取$chars中的任意一位字符；
// 第二种是取字符数组 $chars 的任意元素
// $password .= substr($chars, mt_rand(0, strlen($chars) – 1), 1);
        $n .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    return $n;
}


//获取文件扩展名
function get_extension($file)
{
    return pathinfo($file, PATHINFO_EXTENSION);
}


?>