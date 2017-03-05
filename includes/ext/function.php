
 <?php

	$obj_guish = new guish();
	$doc = new DOMDocument();
    if(!is_test()){
	    $obj_guish->set_fd();
    }
	function check_err($str_xml,$action)
	{
		global $doc;
        $msg = '';

		if(trim($str_xml) !="" && trim($str_xml) != NULL)
		{
			$doc->loadXML($str_xml);
			if($doc->documentElement->tagName == 'return_code')
			{
				$err_list = $doc->getElementsByTagName('group')->item(0)->childNodes;
                $msg = $err_list->item(1)->nodeValue;
                return  $msg;
//				echo'<script language="javascript">
//				alert("'.$err_list->item(1)->nodeValue.'");
//				document.location=window.location.pathname+"?parts='.$_REQUEST['parts'].'&type=list&pages=1&serch_value='.$_REQUEST['serch_value'].'";
//				//window.history.go(window.location.pathname);
//				</script>';
			}
		}
        return $msg;
//		else
//		{
//			switch($action)
//			{
//				case 'add':
//					echo'<script language="javascript">
//						alert("添加成功！！");
//						document.location=window.location.pathname+"?parts='.$_REQUEST['parts'].'&type=list&pages=1&serch_value='.$_REQUEST['serch_value'].'";
//						</script>';
//					break;
//				case 'mod':
//					echo '<script language="javascript">
//					    if("'.$_REQUEST['parts'].'"== "wan_guider")
//						{
//						   alert("成功完成！");
//						 open_url_dir(\'sys_manager\',\'status\',\'hostinfo\');
//						 }
//					   else{
//						alert("修改成功！");
//						document.location=window.location.pathname+"?parts='.$_REQUEST['parts'].'&type=list&pages=1&serch_value='.$_REQUEST['serch_value'].'";
//						}
//						</script>';
//					break;
//				case 'export':
//					echo '<script language="javascript">
//						alert("导出成功！");
//						document.location=window.location.pathname+"?parts='.$_REQUEST['parts'].'&type=list&pages=1&serch_value='.$_REQUEST['serch_value'].'";
//						</script>';
//					break;
//				case 'del':
//					echo '<script language="javascript">
//						document.location=window.location.pathname+"?parts='.$_REQUEST['parts'].'&type=list&pages=1&&path='.$_REQUEST['cur_path'].'&serch_value='.$_REQUEST['serch_value'].'";
//						</script>';
//					break;
//				case 'chg_pwd':
//					echo '<script language="javascript">
//						alert("密码修改成功!");
//						window.close();
//						</script>';
//					break;
//				default:
//					break;
//			}
//		}
	}
	function Node_update($name,$date,$type)
	{
		global $obj_guish;
		$obj_guish->set_rsgui($_SESSION['session_id'],$name,$date,$type);
		$str_xml = $obj_guish->get_xml();
		return $str_xml;
	}
	//function Node_uplode($name,$
	function Node_add($node_xml)
	{
		global $obj_guish;
		$obj_guish->set_rsgui($_SESSION['session_id'],NULL,$node_xml,UCT_CMD);
		$str_xml = $obj_guish->get_xml();
		check_err($str_xml,'add');
		//header('Location:'.$_SERVER['PHP_SELF'].'?parts='.$_REQUEST['parts'].'&type=list&pages=1');
	}
	function Node_add_new($node_xml)
	{
		global $obj_guish;
		$obj_guish->set_rsgui($_SESSION['session_id'],NULL,$node_xml,UCT_CMD);
		$str_xml = $obj_guish->get_xml();
		//check_err($str_xml,'add');
		//header('Location:'.$_SERVER['PHP_SELF'].'?parts='.$_REQUEST['parts'].'&type=list&pages=1');
	}
	function Node_del($node_xml)
	{
		global $obj_guish;
		$obj_guish->set_rsgui($_SESSION['session_id'],NULL,$node_xml,UCT_CMD);
		$str_xml = $obj_guish->get_xml();
		check_err($str_xml,'del');
		//header('Location:'.$_SERVER['PHP_SELF'].'?parts='.$_REQUEST['parts'].'&type=list&pages=1');
	}
	function Node_del_new($tagName,$del_name,$del_value)
	{
		global $obj_guish;
		$del_xml ='<'.$tagName.' action="del"><group>';
		$del_xml .='<'.$del_name.'>'.$del_value.'</'.$del_name.'>';
		$del_xml .='</group></'.$tagName.'>';
		$obj_guish->set_rsgui($_SESSION['session_id'],NULL,$del_xml,UCT_CMD);
		$str_xml = $obj_guish->get_xml();
		check_err($str_xml,'del');
		//header('Location:'.$_SERVER['PHP_SELF'].'?parts='.$_REQUEST['parts'].'&type=list&pages=1');
	}
	function Node_mod($node_xml)
	{
		global $obj_guish;
        //log_muta('$obj_guish:  '. $obj_guish);

        log_muta('[Node_mod input] ' . $node_xml);
          $sid = get_session_id();
        if(empty($sid)){
            return "INVALID_SESSION";
            //redirect_view();
        }


        if($node_xml !="")
		{
           // log_muta('will enter:  $obj_guish->set_rsgui(get_session_id(),NULL,$node_xml,UCT_CMD) ');
            log_muta('sessionid is: '. get_session_id());

			$obj_guish->set_rsgui(get_session_id(),NULL,$node_xml,UCT_CMD);

           // log_muta('will enter:  $str_xml = $obj_guish->get_xml(); ');

            $str_xml = $obj_guish->get_xml();
            log_muta('Output: '.$str_xml);
            return check_err($str_xml,'mod');
		}else{
            log_muta('ERROR: null param for Node_mod');
            die('null param for Node_mod');
        }
		//header('Location:'.$_SERVER['PHP_SELF'].'?parts='.$_REQUEST['parts'].'&type=list&pages=1');
	}
	
	function Node_mod_new($node_xml)
	{
		global $obj_guish;
		if($node_xml !="")
		{  
			$obj_guish->set_rsgui($_SESSION['session_id'],NULL,$node_xml,UCT_CMD);
			$str_xml = $obj_guish->get_xml();
			//check_err($str_xml,'mod');
		}
		//header('Location:'.$_SERVER['PHP_SELF'].'?parts='.$_REQUEST['parts'].'&type=list&pages=1');
	}
	
	
	function Node_export($node_xml)
	{
		global $obj_guish;
		if($node_xml !="")
		{  
			$obj_guish->set_rsgui($_SESSION['session_id'],NULL,$node_xml,UCT_CMD);
			$str_xml = $obj_guish->get_xml();
			check_err($str_xml,'export');
		}
		//header('Location:'.$_SERVER['PHP_SELF'].'?parts='.$_REQUEST['parts'].'&type=list&pages=1');
	}
	function Node_ajaxmod($node_xml)
	{
		global $obj_guish;
		if($node_xml !="")
		{
			$obj_guish->set_rsgui($_REQUEST['session_id'],NULL,$node_xml,UCT_CMD);
			$str_xml = $obj_guish->get_xml();
			return $str_xml;
		}
	}
	function Node_show($node_name,$action)
	{
		global $obj_guish;
		$node_xml = '<'.$node_name.' action="'.$action.'"></'.$node_name.'>';
		$obj_guish->set_rsgui($_SESSION['session_id'],NULL,$node_xml,UCT_CMD);
		$str_xml = $obj_guish->get_xml();
		if(empty($str_xml) == true)
		{
			echo '<script language="javascript">
			var path =window.location.hostname;
			var path_arr = path.split("/");
			var page = path_arr[path_arr.length-1];
			if((page == "main.php")||(page == "login.php"))
			{
				window.location ="/";
			}
			else
			{
				window.parent.parent.location="/";
			}
			</script>';
		}
		else
		{
			check_err($str_xml,NULL);
			return $str_xml;
		}
	}
		
	function Node_show_file($node_name,$action)
	{
		global $obj_guish;
		$node_xml = '<'.$node_name.' action="'.$action.'"></'.$node_name.'>';
		$obj_guish->set_rsgui($_SESSION['session_id'],NULL,$node_xml,UCT_CMD);
		$str_xml = $obj_guish->get_xml();
		if(empty($str_xml) == true)
		{
			echo '<script language="javascript">
			var path =window.location.hostname;
			var path_arr = path.split("/");
			var page = path_arr[path_arr.length-1];
			if((page == "main.php")||(page == "login.php"))
			{
				window.location ="/";
			}
			else
			{
				window.parent.parent.location="/";
			}
			</script>';
		}
	}
	
	function Node_show_syslog($node_xml)
	{
		global $obj_guish;
		$obj_guish->set_rsgui($_SESSION['session_id'],NULL,$node_xml,UCT_CMD);
		$str_xml = $obj_guish->get_xml();
		//check_err($str_xml,NULL);
		if(empty($str_xml) == true)
		{
			echo '<script language="javascript">
			var path =window.location.hostname;
			var path_arr = path.split("/");
			var page = path_arr[path_arr.length-1];
			if((page == "main.php")||(page == "login.php"))
			{
				window.location ="/";
			}
			else
			{
				window.parent.parent.location="/";
			}
			</script>';
		}
		else
		{
			//check_err($str_xml,NULL);
			return $str_xml;
		}
		//return $str_xml;
	}
	
	function Node_showIndex($node_xml)
	{
        $rtn = array();
        $sid = get_session_id();
        if(empty($sid)){
            $rtn['error_msg'] ="INVALID_SESSION";
            return $rtn;
        }
        log_muta('sessionid is: '. get_session_id());

		global $obj_guish;
		$obj_guish->set_rsgui($_SESSION['session_id'],NULL,$node_xml,UCT_CMD);
		$str_xml = $obj_guish->get_xml();
		//check_err($str_xml,NULL);
		//return $str_xml;
		if(empty($str_xml) == true)
		{
//			echo '<script language="javascript">
//			var path =window.location.hostname;
//			var path_arr = path.split("/");
//			var page = path_arr[path_arr.length-1];
//			if((page == "main.php")||(page == "login.php"))
//			{
//				window.location ="/";
//			}
//			else
//			{
//				window.parent.parent.location="/";
//			}
//			</script>';
            $rtn['error_msg'] ="empty result";

            return $rtn;
		}
		else
		{
			$error=check_err($str_xml,NULL);
            if(!empty($error)){
                $rtn['error'] =$error;
            }
            $rtn['result'] =$str_xml;
			return $rtn;
		}
	}
	
	
	function login_auth($node_xml,$username)
	{
        $rtn = array();

		global $obj_guish;
		$obj_guish->set_rsgui($username,NULL,$node_xml,UCT_CMD);
		$str_xml = $obj_guish->get_xml();
		if(empty($str_xml) == true)
		{
            $rtn['error_msg'] ="empty result";
            return $rtn;
		}
		else
		{
			$error=check_err($str_xml,NULL);
            if(!empty($error)){
                $rtn['error'] =$error;
            }
            $rtn['result'] =$str_xml;
			return $rtn;
		}
	}	
	
	
	
  function show_vlan_mult($page,$add_page,$mod_page)
		{	
			global $doc;
			$serch_xml = '<interface_sub action="show"><group><get_type>2</get_type></group></interface_sub>';
			$str_xml = Node_showIndex($serch_xml);
			if(trim($str_xml) !="")
			{
				$doc->loadXML($str_xml);
				$groups = $doc->getElementsByTagName('group');
				$length = $groups->length;
		  		$divs = $length/15;
		 		$page_count = is_float($divs)? intval($divs)+1:(($divs >0) ? $divs:1);
		  		$first_record = ($page-1)*15;
		  		if(($first_record+15) > $length)
		  			$last_record = $length;
		   		else
		   			$last_record =$first_record+15;
				$tagName = 'interface_sub';
		  		for($i=$first_record;$i<$last_record;$i++)
				{
					$n_list = $groups->item($i)->childNodes;
					$fw = NULL;
					$mod_value = $n_list->item(1)->nodeValue;
					$del_name=$n_list->item(1)->nodeName;
					$del_value=$mod_value;
					if($n_list->item(0)->nodeValue == 0)
					{
						$inface_nums = 0;
					}
					else
					{
						continue;
						//$inface_nums = 2;
					}	
				 echo '<option value="'.$n_list->item(1+$inface_nums)->nodeValue.'">'.
				 $n_list->item(1+$inface_nums)->nodeValue.'</option>';				
				}
				
			}
		}
	
	
	function show_wan($node_name,$action)
	{
		global $doc;
		$str_xml = Node_show($node_name,$action);
		if(trim($str_xml) !="")
		{
			$doc->loadXML($str_xml);
			$name_list = $doc->getElementsByTagName('name');
			for($i=0; $i<$name_list->length;$i++)
			{
			  $wan = $name_list->item($i)->nodeValue;
			  $name = substr($wan, 0, 4);  
			  if($name == "eth0")
			  {
				echo '<option value="'.$wan.'">'.
				$wan.'</option>';
			  }
			}
		}
		else
		{
			echo '<script language="javascript">
			var path =window.location.hostname;
			var path_arr = path.split("/");
			var page = path_arr[path_arr.length-1];
			if((page == "main.php")||(page == "login.php"))
			{
				window.location ="/";
			}
			else
			{
				window.parent.parent.location="/";
			}
			</script>';
		}
	}
	
	function objtab_show($node_name,$action)
	{
		global $doc;
		$str_xml = Node_show($node_name,$action);
		if(trim($str_xml) !="")
		{
			$doc->loadXML($str_xml);
			$name_list = $doc->getElementsByTagName('name');
			for($i=0; $i<$name_list->length;$i++)
			{
				echo '<option value="'.$name_list->item($i)->nodeValue.'">'.
				$name_list->item($i)->nodeValue.'</option>';
			}
		}
		else
		{
			echo '<script language="javascript">
			var path =window.location.hostname;
			var path_arr = path.split("/");
			var page = path_arr[path_arr.length-1];
			if((page == "main.php")||(page == "login.php"))
			{
				window.location ="/";
			}
			else
			{
				window.parent.parent.location="/";
			}
			</script>';
		}
	}
	
	
	// add 认证
	
	
	function objtab_show_cert($node_name,$action)
	{
		global $doc;
		$str_xml = Node_show($node_name,$action);
		if(trim($str_xml) !="")
		{
			$doc->loadXML($str_xml);
			$name_list = $doc->getElementsByTagName('ca_cert_name');
			for($i=0; $i<$name_list->length;$i++)
			{
				echo '<option value="'.$name_list->item($i)->nodeValue.'">'.
				$name_list->item($i)->nodeValue.'</option>';
			}
		}
		else
		{
			echo '<script language="javascript">
			var path =window.location.hostname;
			var path_arr = path.split("/");
			var page = path_arr[path_arr.length-1];
			if((page == "main.php")||(page == "login.php"))
			{
				window.location ="/";
			}
			else
			{
				window.parent.parent.location="/";
			}
			</script>';
		}
	}
	
	
	
	function objtab_showbyindex($node_name,$action,$index_name)
	{
		global $doc;
		$str_xml = Node_show($node_name,$action);
		if(trim($str_xml) !="")
		{
			$doc->loadXML($str_xml);
			$name_list = $doc->getElementsByTagName($index_name);
			for($i=0; $i<$name_list->length;$i++)
			{
				echo '<option value="'.$name_list->item($i)->nodeValue.'">'.
				$name_list->item($i)->nodeValue.'</option>';
			}
		}
		else
		{
			echo '<script language="javascript">
			var path =window.location.hostname;
			var path_arr = path.split("/");
			var page = path_arr[path_arr.length-1];
			if((page == "main.php")||(page == "login.php"))
			{
				window.location ="/";
			}
			else
			{
				window.parent.parent.location="/";
			}
			</script>';
		}
	}
	function usergrp_show($type)
	{
		global $doc;
		$str_xml = Node_show('user_group','show');
		if(trim($str_xml) !="")
		{
			$doc->loadXML($str_xml);
			$groups = $doc->getElementsByTagName('group');
			$grp_len = $groups->length;
			for($i=0; $i < $grp_len;$i++)
			{
				$elm_list = $groups->item($i)->childNodes;
				if($elm_list->item(1)->nodeValue == $type)
				echo '<option value="'.$elm_list->item(0)->nodeValue.'">'.
				$elm_list->item(0)->nodeValue.'</option>';
			}
		}
		else
		{
			echo '<script language="javascript">
			var path =window.location.hostname;
			var path_arr = path.split("/");
			var page = path_arr[path_arr.length-1];
			if((page == "main.php")||(page == "login.php"))
			{
				window.location ="/";
			}
			else
			{
				window.parent.parent.location="/";
			}
			</script>';
		}
	}
	function sevgrp_show($node_name,$action,$type)
	{
		global $doc;
		$str_xml = Node_show($node_name,$action);
		if(trim($str_xml) != "")
		{
			$doc->loadXML($str_xml);
			$n_list = $doc->getElementsByTagName('group');
			for($i=0;$i <$n_list->length; $i++)
			{
				$elm_list = $n_list->item($i)->childNodes;
				if($elm_list->item(1)->nodeValue != $type)
					continue;
				else
					echo '<option value="'.$elm_list->item(0)->nodeValue.'">'.
				$elm_list->item(0)->nodeValue.'</option>';
			}
		}
		else
		{
			echo '<script language="javascript">
			var path =window.location.hostname;
			var path_arr = path.split("/");
			var page = path_arr[path_arr.length-1];
			if((page == "main.php")||(page == "login.php"))
			{
				window.location ="/";
			}
			else
			{
				window.parent.parent.location="/";
			}
			</script>';
		}
	}
	function l2tpgrp_show($node_name,$action)
	{
		global $doc;
		$str_xml = Node_show($node_name,$action);
		if(trim($str_xml) != "")
		{
			$doc->loadXML($str_xml);
			$name_list = $doc->getElementsByTagName('group_name');
			for($i=0;$i <$name_list->length; $i++)
			{
				echo '<option value="'.$name_list->item($i)->nodeValue.'">'.
				$name_list->item($i)->nodeValue.'</option>';
			}
		}
		else
		{
			echo '<script language="javascript">
			var path =window.location.hostname;
			var path_arr = path.split("/");
			var page = path_arr[path_arr.length-1];
			if((page == "main.php")||(page == "login.php"))
			{
				window.location ="/";
			}
			else
			{
				window.parent.parent.location="/";
			}
			</script>';
		}
	}
	function objtype_show($node_name,$action,$type)
	{
		global $doc;
		$str_xml = Node_show($node_name,$action);
		if(trim($str_xml) !="")
		{
			$doc->loadXML($str_xml);
			$groups = $doc->getElementsByTagName($node_name)->item(0)->childNodes;
			for($i=0;$i<$groups->length;$i++)
			{
				$n_list = $groups->item($i)->childNodes;
				if($n_list->item(1)->nodeValue == $type)
				{
					echo '<option value="'.$n_list->item(0)->nodeValue.'">'.$n_list->item(0)->nodeValue.'</option>';
				}
				else
				{
					continue;
				}
			}
		}
		else
		{
			echo '<script language="javascript">
			var path =window.location.hostname;
			var path_arr = path.split("/");
			var page = path_arr[path_arr.length-1];
			if((page == "main.php")||(page == "login.php"))
			{
				window.location ="/";
			}
			else
			{
				window.parent.parent.location="/";
			}
			</script>';
		}
	}
	function ssid_index()
	{
	    global $doc;
		$rst_xml = Node_show('wlan_cfg','show');
		if(trim($rst_xml) != "")
		{
			$doc->loadXML($rst_xml);
			$n_list= $doc->getElementsByTagName('ssid_name');
			for($i=0;$i<$n_list->length;$i++)
			{
				echo '<option value="'.$n_list->item($i)->nodeValue.'">'.$n_list->item($i)->nodeValue.'</option>';
			}
		}
	}
	
	function ssid_index1()
	{
	    global $doc;
		$rst_xml = Node_show('wlan_cfg','show');
		if(trim($rst_xml) != "")
		{
			$doc->loadXML($rst_xml);
			$n_list= $doc->getElementsByTagName('ssid_name');
		
				echo $n_list->item(0)->nodeValue ;	
		}
	}
	
	
	function phyface_show($node_name,$action)
	{
		global $doc;
		$filter_py = array('wifi0','ath7','eth2','eth3','eth4','eth5','eth6','eth7','eth8','eth9');
		$str_xml = Node_show($node_name,$action);
		if(trim($str_xml) !="")
		{
			$doc->loadXML($str_xml);
			$name_list = $doc->getElementsByTagName('name');
			$elm_len = $name_list->length;
			if($start<$elm_len)
			{
				for($i=$start; $i<$elm_len;$i++)
				{
					if(!in_array($name_list->item($i)->nodeValue,$filter_py))
						echo '<option value="'.$name_list->item($i)->nodeValue.'">'.$name_list->item($i)->nodeValue.'</option>';
				}
			}
		}
		else
		{
			echo '<script language="javascript">
			var path =window.location.hostname;
			var path_arr = path.split("/");
			var page = path_arr[path_arr.length-1];
			if((page == "main.php")||(page == "login.php"))
			{
				window.location ="/";
			}
			else
			{
				window.parent.parent.location="/";
			}
			</script>';
		}
	}
// show all vlan interface
	function show_vlan()
	{
	
	
	    global $doc;
		$serch_xml = '<interface_sub action="show"><group><get_type>2</get_type></group></interface_sub>';
		$str_xml = Node_showIndex($serch_xml);
		if(trim($str_xml) !="")
		{
			$doc->loadXML($str_xml);
			$name_list = $doc->getElementsByTagName('name');
			for($i=0; $i<$name_list->length;$i++)
			{
				echo '<option value="'.$name_list->item($i)->nodeValue.'">'.
				$name_list->item($i)->nodeValue.'</option>';
			}
		}
		else
		{
			echo '<script language="javascript">
			var path =window.location.hostname;
			var path_arr = path.split("/");
			var page = path_arr[path_arr.length-1];
			if((page == "main.php")||(page == "login.php"))
			{
				window.location ="/";
			}
			else
			{
				window.parent.parent.location="/";
			}
			</script>';
		}
	
	
	
	
	     	
	
	
	
	
	
	}  
	function phyface_type_show($type)
	{
		global $doc;
		$serch_xml = '<interface_sub action="show_i"><group><get_type>'.$type.'</get_type></group></interface_sub>';
		$str_xml = Node_showIndex($serch_xml);
		if(trim($str_xml) !="")
		{
			$doc->loadXML($str_xml);
			$name_list = $doc->getElementsByTagName('name');
			$elm_len = $name_list->length;
			if($start<$elm_len)
			{
				for($i=$start; $i<$elm_len;$i++)
				{
					echo '<option value="'.$name_list->item($i)->nodeValue.'">'.$name_list->item($i)->nodeValue.'</option>';
				}
			}
		}
		else
		{
			echo '<script language="javascript">
			var path =window.location.hostname;
			var path_arr = path.split("/");
			var page = path_arr[path_arr.length-1];
			if((page == "main.html")||(page == "login.php"))
			{
				window.location ="/";
			}
			else
			{
				window.parent.parent.location="/";
			}
			</script>';
		}
	}
	function checkbox_show($node_name,$action,$name)
	{
		global $doc;
		$str_xml = Node_show($node_name,$action);
		if(trim($str_xml) !="")
		{
			$doc->loadXML($str_xml);
			$name_list = $doc->getElementsByTagName('name');
			echo '<input type="hidden" name="if_count" id="if_count" value="'.$name_list->length.'" />';
			for($i=0; $i<$name_list->length;$i++)
			{
				echo '<input type="checkbox" style="width:20px;" name="'.$name.$i.'" id="'.$name.$i.'" />'.$name_list->item($i)->nodeValue;
			}
		}
	}
function operation($tagName,$del_name,$del_value,$mod_page,$mod_value)
{
	echo'<td bgcolor="#FFFFFF"><div align="center" class="content_operation"><span class="content_td">';
	
	
	if(($_SESSION['qx'] == 'admin') || ($_SESSION['qx'] == 'telecomadmin'))
	{
	   if($mod_page == 'wan_sub'&& $_SESSION['qx'] == 'telecomadmin')
	   {
			if(!empty($tagName) && $tagName!='who')
			{
				echo'<a href="javascript:index_del(\''.$tagName.'\',\''.$del_name.'\',\''.$del_value.'\');">
					<img src="../images/tab_del.gif" />删除&nbsp;
				</a>';
			}
			switch($mod_page)
			{
				case '':
				/*
				echo'<a href="javascript:index_mod(\''.$mod_page.'\',\''.$mod_value.'\')" target="">
					<img src="../images/tab_edit.gif" />编辑
				</a>';
				*/
				break;
				case 'capture':
					echo'|<a href="javascript:index_mod(\''.$mod_page.'\',\''.$mod_value.'\')" target="">
						<img src="../images/tab_edit.gif" />下载
				</a>';
				break;
				case 'fw_policy_table':
					echo'<a href="javascript:index_mod(\''.$mod_page.'\',\''.$mod_value.'\')" target="">
					<img src="../images/tab_edit.gif" />编辑
				</a>';
					$path = 'show_oneplcy.php?index_id='.$mod_value;
					echo' <a href="javascript:show_info(\''.$path.'\');" target=""><img src="../images/tab_edit.gif" />>>详细</a>';
				break;
				default:
				echo'<a href="javascript:index_mod(\''.$mod_page.'\',\''.$mod_value.'\')" target="">
					<img src="../images/tab_edit.gif" />编辑
				</a>';
				break;
			}
		}
		if($mod_page == 'wan'&& $_SESSION['qx'] == 'telecomadmin')
	   {
			if(!empty($tagName)&& $tagName!='who')
			{
				echo'<a href="javascript:index_del(\''.$tagName.'\',\''.$del_name.'\',\''.$del_value.'\');">
					<img src="../images/tab_del.gif" />删除&nbsp;
				</a>';
			}
			switch($mod_page)
			{
				case '':
				/*
				echo'<a href="javascript:index_mod(\''.$mod_page.'\',\''.$mod_value.'\')" target="">
					<img src="../images/tab_edit.gif" />编辑
				</a>';
				*/
				break;
				case 'capture':
					echo'|<a href="javascript:index_mod(\''.$mod_page.'\',\''.$mod_value.'\')" target="">
						<img src="../images/tab_edit.gif" />下载
				</a>';
				break;
				case 'fw_policy_table':
					echo'<a href="javascript:index_mod(\''.$mod_page.'\',\''.$mod_value.'\')" target="">
					<img src="../images/tab_edit.gif" />编辑
				</a>';
					$path = 'show_oneplcy.php?index_id='.$mod_value;
					echo' <a href="javascript:show_info(\''.$path.'\');" target=""><img src="../images/tab_edit.gif" />>>详细</a>';
				break;
				default:
				echo'<a href="javascript:index_mod(\''.$mod_page.'\',\''.$mod_value.'\')" target="">
					<img src="../images/tab_edit.gif" />编辑
				</a>';
				break;
			}
		}
		 if($mod_page != 'wan_sub'&&$mod_page != 'wan')
	   {
			if(!empty($tagName)&& $tagName!='who')
			{
				echo'<a href="javascript:index_del(\''.$tagName.'\',\''.$del_name.'\',\''.$del_value.'\');">
					<img src="../images/tab_del.gif" />删除&nbsp;
				</a>';
			}
			switch($mod_page)
			{
				case '':
				/*
				echo'<a href="javascript:index_mod(\''.$mod_page.'\',\''.$mod_value.'\')" target="">
					<img src="../images/tab_edit.gif" />编辑
				</a>';
				*/
				break;
				case 'capture':
					echo'|<a href="javascript:index_mod(\''.$mod_page.'\',\''.$mod_value.'\')" target="">
						<img src="../images/tab_edit.gif" />下载
				</a>';
				break;
				case 'fw_policy_table':
					echo'<a href="javascript:index_mod(\''.$mod_page.'\',\''.$mod_value.'\')" target="">
					<img src="../images/tab_edit.gif" />编辑
				</a>';
					$path = 'show_oneplcy.php?index_id='.$mod_value;
					echo' <a href="javascript:show_info(\''.$path.'\');" target=""><img src="../images/tab_edit.gif" />>>详细</a>';
				break;
				default:
				echo'<a href="javascript:index_mod(\''.$mod_page.'\',\''.$mod_value.'\')" target="">
					<img src="../images/tab_edit.gif" />编辑
				</a>';
				break;
			}
		}
		
		
		
		
	}
	echo'</span></div></td></tr>';
}
function show_ftype()
{
	global $type_content_arr;
	foreach($type_content_arr as $key => $value)
	{
		echo '<option value="'.$key.'">'.$key.':'.$value.'</option>';
	}
}
function show_timezone()
{
	global $time_zone;
	for($i=0;$i<count($time_zone);$i++)
	{
		if($i == 56)
		{
			echo'<option value="'.($i+1).'" selected="selected">';
			echo $time_zone[$i+1];
			echo '</option>';
		}
		else
		{
			echo'<option value="'.($i+1).'">';
			echo $time_zone[$i+1];
			echo '</option>';
		}
	}
}
function index_zonetime($index)
{
	global $time_zone;
	if($index <= count($time_zone) && $index >=1)
	{
		echo $time_zone[$index-1];
	}
}

function show_year()
{
	//$Ystart = date('Y')-10;
	//$Yend = date('Y')+10;
	$Ystart = 0;
	$Yend = 100;
	for($i= $Ystart;$i<$Yend;$i++)
	{
		$year_txt = 2000 + $i;
		if($i<10)
		{
		  echo '<option value="0'.$i.'">'.$year_txt.'</option>';
		 }
		 else{
		  echo '<option value="'.$i.'">'.$year_txt.'</option>';
	    }
	}
}
function show_month()
{
	for($i=1;$i<=9;$i++)
		echo'<option value="'.$i.'">0'.$i.'</option>';
	for($i=10;$i<=12;$i++)
		echo '<option value="'.$i.'">'.$i.'</option>';
}
function show_date()
{
	for($i=1;$i<=9;$i++)
		echo'<option value="'.$i.'">0'.$i.'</option>';
	for($i=10;$i<=31;$i++)
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
	function show_hour()
	{
		for($i=0;$i<=9;$i++)
			echo'<option value="'.$i.'">0'.$i.'</option>';
		for($i=10;$i<=23;$i++)
			echo '<option value="'.$i.'">'.$i.'</option>';
	}
	function show_minute()
	{
		for($i=0;$i<=9;$i++)
			echo'<option value="'.$i.'">0'.$i.'</option>';
		for($i=10;$i<=59;$i++)
			echo'<option value="'.$i.'">'.$i.'</option>';
	}
	function list_header($title,$add_page,$content_title,$nodes)
	{
		echo '
		<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" 	onmouseover="changeto()"  onmouseout="changeback()" style="clear:both" class="table_list">
		<tbody class="content_body_area">
				<tr class="tab_header">
    				<td height="30" colspan="'.count($content_title).'" class="tab_header">
    					<div class="tab_head_div1"><span id="list_title">'.$title.'</span></div>
       				 	<div class="tab_head_div2">
        					<span>';
		switch($nodes)
		{
			case 'rule':
				echo '<input type="radio"  id="rule_type1" name="rule_type" value="1" checked="checked" onclick="read_url(\'nat_rule_table\',this.value)"/>静态地址转换';
				echo '<input type="radio" id="rule_type2" name="rule_type" value="2" onclick="read_url(\'nat_rule_table\',this.value);" />源地址转换';
				echo '<input type="radio" id="rule_type4" name="rule_type" value="4"  onclick="read_url(\'nat_rule_table\',this.value);"/>目的地址转换';
			default:
				//echo'<input type="checkbox" name="checkbox11" id="checkbox11" />全选';
				break;
		}
		if(($_SESSION['qx'] =='admin') || ($_SESSION['qx'] == 'telecomadmin'))
		{
		
			if(!empty($add_page) && $add_page == 'l2tp_grp')
			{
				echo'</span><span class="tab_head_opration" id="op_add">
              	<a href="javascript:new_dir(\''.$add_page.'\');">
					<img src="../images/add.gif" width="10" height="10" /> 编辑
				</a>
            </span>';
			}
			else if(!empty($add_page)&&$add_page !='syslog_filter')
			{
				if($_SESSION['qx'] == 'telecomadmin'&&$add_page =='wan_sub')
				{
				echo'</span><span class="tab_head_opration" id="op_add">
					<a href="javascript:index_add(\''.$add_page.'\');">
						<img src="../images/add.gif" width="10" height="10" /> 添加
					</a>
				</span>';
				}else if($add_page !='wan_sub'){
				echo'</span><span class="tab_head_opration" id="op_add">
					<a href="javascript:index_add(\''.$add_page.'\');">
						<img src="../images/add.gif" width="10" height="10" /> 添加
					</a>
				</span>';
				}
				
			}
			else if($add_page == 'syslog_filter')
			{
			echo'</span><span class="tab_head_opration" id="op_add">
              	<a href="javascript:index_mod(\''.$add_page.'\',\' \');">
					<img src="../images/add.gif" width="10" height="10" /> 编辑
				</a>
            </span>';
			}
		}
		/*
         echo'<span class="tab_head_opration" id="op_del">
            	<a href="#"><img src="../images/del.gif" width="10" height="10" />待定 </a>
            </span>
            <span class="tab_head_opration" id="op_mod">
                <a href="#"><img src="../images/edit.gif" width="10" height="10" /> 帮助</a>
            </span>
		*/
        echo'</div>
   		  </td>
  		</tr>';
		echo '<tr class="tab_header">';
		for($i=0;$i<count($content_title);$i++)
		{
   			echo'<td  class="list_row" bgcolor="white">
					<div align="center">
						<span>'.$content_title[$i].'</span>
        			</div>
				</td>';
		}
		echo '</tr>';
	}
	function list_Sheader($content_title,$nodes)
	{
		echo '
		<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#ffffff" 	onmouseover="changeto()"  onmouseout="changeback()" style="clear:both" class="table_list">
		<tbody class="content_body_area">
				<tr>
    				<td height="30" colspan="'.count($content_title).'" class="tab_header">
    					<div class="tab_head_div1"><form action="" method="post">';
		switch($nodes)
		{
			case 'session_stat':
				echo '<span>统计类型
                <select name="hhtj_type" id="hhtj_type" onchange="serch_hhtj(this.value,\'disp_title\',\'disp_xy\');">
                	<option value="0">源IP统计</option>
                    <option value="1">目的IP统计</option>
                    <option value="2">目的端口统计</option>
                </select>
            	</span>
            	<span id="disp_title">源IP/掩码</span>
            	<span id="disp_value">
       				<input type="text" name="serch_ip" id="serch_ip"  valid="isMask" errmsg="掩码格式错误!" />
            	</span>
            	<span  id="disp_xy" style="display:none;">协议
					<select name="hhtj_proto" id="hhtj_proto">
                		<option value="0">ALL</option>
                    	<option value="1">TCP</option>
                    	<option value="2">UDP</option>
						<!--
                    	<option>ICMP</option>
						!-->
                	</select>
            	</span>
            	<span>
            		<input type="submit" value="检索" style="width:88px;" class="buttonL"/>
            	</span>
            	<span id="errMsg_serch_ip" style="color:#FF0000"></span>
            	<span id="errMsg_serch_port" style="color:#FF0000"></span>
				</div><div class="tab_head_div2">';
				break;
			case 'flow_stat_table':
				echo '<span>统计类型
                <select name="lltj_type" id="lltj_type" onchange="serch_lltj(this.value,\'disp_title\');">
                	<option value="0">主机统计</option>
                    <option value="1">目的端口统计</option>
                </select>
            	</span>
            	<span id="disp_title">主机IP</span>
            	<span id="disp_value">
            		<input type="text" name="serch_ip" id="serch_ip" valid="isIp" errmsg="IP地址格式错误!" />
            	</span>
				<span>
					<input type="submit"  value="检索" style="width:88px;" class="buttonL"/>
				</span>
            	<span id="errMsg_serch_ip" style="color:#FF0000"></span>
            	<span id="errMsg_serch_port" style="color:#FF0000"></span>
				</div><div class="tab_head_div2">';
				break;
			case 'session_scout':
				echo'<span>协议
            		<select style="width:50px;" name="hhjk_proto" id="hhjk_proto" onchange="serch_hhjk(this.value,\'disp_value\');">
                		<option value="0">ANY</option>
                    	<option value="1">TCP</option>
                    	<option value="2">UDP</option>
                    	<option value="3">ICMP</option>
                    	<option value="4">OTHER</option>
            		</select>
            	</span>
            	<span>类型
                <select style="width:50px;" name="hhjk_linktype" id="hhjk_linktype">
                	<option value="0">所有</option>
                    <option value="1">全连接</option>
                    <option value="2">半连接</option>
                </select>
            	</span>
            	<span>源IP/掩码
                	<input type="text" style="width:80px;" name="serch_sip" id="serch_sip" valid="isMask" errmsg="掩码格式错误!" />
            	</span>
            	<span>目的IP/掩码
                	<input type="text" style="width:80px;" name="serch_dip" id="serch_dip" valid="isMask" errmsg="掩码格式错误!"/>
            	</span>
            	<span id="disp_title">目的端口/范围(a-b)
					<input type="text" style="width:80px;" name="serch_dport" id="serch_dport" valid="range" min="1" max="65535" errmsg="端口号范围溢出!" />
            	</span>&nbsp;
            	<span>
            		<input type="submit" value="检索" style="width:88px;" class="buttonL"/>
            	</span>
            	<span id="errMsg_serch_sip" style="color:#FF0000"></span>
            	<span id="errMsg_serch_dip" style="color:#FF0000"></span>
            	<span id="errMsg_serch_dport" style="color:#FF0000"></span>';
				break;
			case 'fw_policy_table':
				echo'';
				break;
			case 'event_log':
			    if($_SESSION['qx'] != 'access')
				 {
				echo '<span>类型
						<select name="log_type" id="log_type" onchange="SetCookie(\'log_type\',this.value);">
						<option value="0">全部日志</option>
                		<option value="1">设备告警日志</option>
                    	<option value="2">登录日志</option>
                    	<option value="3">操作日志</option>
                    	<option value="4">ARP攻击日志</option>
                    	<option value="5">DDos日志</option>
						<option value="6">URL过滤命中</option>
                    	<option value="7">病毒日志</option>
                    	<option value="8">网页日志</option>
                    	<option value="9">邮件日志</option>
                    	<option value="10">IM日志</option>
						<option value="11">FTP日志</option>
            		</select>
            	</span>
				<span>级别
						<select name="log_level" id="log_level" onchange="SetCookie(\'log_level\',this.value);" style="width:50px">
						<option value="0">全部</option>
                		<option value="1">紧急</option>
                        <option value="2">告警</option>
                        <option value="3">严重</option>
                        <option value="4">错误</option>
                        <option value="5">警示</option>
                        <option value="6">通知</option>
                        <option value="7">信息</option>
            		</select>
            	</span>
				<span>
					时间范围：<input type="text" style="width:15%;" name="serchlog_stime" id="serchlog_stime" valid="isTime" errmsg="时间格式设置错误(例如:2010-04-19 19:22:11)"/>~
					<input type="text" style="width:15%;" name="serchlog_etime" id="serchlog_etime" valid="isTime" errmsg="时间格式设置错误(例如:2010-04-19 19:22:11)" 
				</span>
				<span>
					记录条数:<input type="text" style="width:50px" name="record_num" id="record_num" valid="range" min="1" max="10000" errmsg="检索记录条数超出预定范围（1~10000)!"/>
				</span>
				<span>
					<input type="submit" name="serch_submit" id="serch_submit" value="检索" style="width:88px;" class="buttonL"/>&nbsp;
				</span>
				<span>
					<input type="submit" name="clear_submit" id="clear_submit" value="清除日志" style="width:88px;" class="buttonL"/>
				</span>
				</div><div class="tab_head_div2">';
				}
				if($_SESSION['qx'] == 'access')
				 {
				echo '<span>类型
						<select name="log_type" id="log_type" onchange="SetCookie(\'log_type\',this.value);">
						<option value="0">全部日志</option>
                		<option value="1">设备告警日志</option>
                    	<option value="2">登录日志</option>
                    	<option value="3">操作日志</option>
                    	<option value="4">ARP攻击日志</option>
                    	<option value="5">DDos日志</option>
						<option value="6">URL过滤命中</option>
                    	<option value="7">病毒日志</option>
                    	<option value="8">网页日志</option>
                    	<option value="9">邮件日志</option>
                    	<option value="10">IM日志</option>
						<option value="11">FTP日志</option>
            		</select>
            	</span>
				<span>级别
						<select name="log_level" id="log_level" onchange="SetCookie(\'log_level\',this.value);" style="width:50px">
						<option value="0">全部</option>
                		<option value="1">紧急</option>
                        <option value="2">告警</option>
                        <option value="3">严重</option>
                        <option value="4">错误</option>
                        <option value="5">警示</option>
                        <option value="6">通知</option>
                        <option value="7">信息</option>
            		</select>
            	</span>
				<span>
					时间范围：<input type="text" style="width:15%;" name="serchlog_stime" id="serchlog_stime" valid="isTime" errmsg="时间格式设置错误(例如:2010-04-19 19:22:11)"/>~
					<input type="text" style="width:15%;" name="serchlog_etime" id="serchlog_etime" valid="isTime" errmsg="时间格式设置错误(例如:2010-04-19 19:22:11)" 
				</span>
				<span>
					记录条数:<input type="text" style="width:50px" name="record_num" id="record_num" valid="range" min="1" max="10000" errmsg="检索记录条数超出预定范围（1~10000)!"/>
				</span>
				<span>
					<input type="submit" name="serch_submit" id="serch_submit" value="检索" style="width:88px;" class="buttonL"/>&nbsp;
				</span>
				
				</div><div class="tab_head_div2">';
				}
				break;
			case 'max_station':
				echo '<span>无线接口
						<select name="wlan_name" id="wlan_name" onchange="check_dev(this);">
                		<option value="0">WLAN1</option>
                    	<option value="1">WLAN2</option>
                    	<option value="2">WLAN3</option>
						<!--
						<option value="3">WLAN4</option>
						!-->
            		</select>
            	</span>
				<span>
					<input type="submit"  value="查看" style="width:88px;" class="buttonL"/>
				</span>
				</div><div class="tab_head_div2">';
				break;
			default:
				break;
		}
		/*
		<span class="tab_head_opration" id="op_del">
            	<a href="#"><img src="../images/del.gif" width="10" height="10" />&nbsp; </a>
            </span>
            <span class="tab_head_opration" id="op_mod">
                <a href="#"><img src="../images/edit.gif" width="10" height="10" /> &nbsp;</a>
            </span>
		*/
        	echo'</div>
   		  </td>
  		</tr>';
		echo '<tr>';
		for($i=0;$i<count($content_title);$i++)
		{
   			echo'<td  class="list_row" bgcolor="#ffffff">
					<div align="center">
						<span>'.$content_title[$i].'</span>
        			</div>
				</td>';
		}
		echo '</tr>';
	}
	function list_bottom($length,$page,$page_count,$col_span)
	{
	  echo'<tr>
            <td colspan="'.$col_span.'" class="content_td">
            <div class="tab_head_div2">
                	共有
                    <span id="list_count">'.$length.'</span>条记录，当前第
                    <span id="page_index">'.$page.'</span>页，共
                    <span id="page_count">'.$page_count.'</span>页
            </div>
            <div class="tab_head_div2">
               	<span id="page_one">
                	<a href="javascript:show_page(1);" target="">
                    	首页
                    </a>
                </span>
            	<span id="page_prev">
                	<a href="javascript:show_page(2);" target="">
                       上一页
                    </a>
                </span>
                <span id="page_next">
                	<a href="javascript:show_page(3);" target="">
                    	下一页
                    </a>
                </span>
                <span id="page_last">
                	<a href="javascript:show_page(4);" target="">
                    	尾页
                    </a>
                </span>
                <span id="page_jump_span"  >转到
                    <input id="page_jump" type="text" name="textfield"/>
                    页
                </span>
                <span>
                	<a href="javascript:show_page(5);" target="">
                    	转
                    </a>
                </span>
            </div>
        </td>
      </tr>
    </table>';
	}
function node_info($title,$opration,$inf_arr)
{
	echo '<table class="info_tab" cellpadding="0px;" cellspacing="0px;">';
	echo '<caption><div class="title">'.$title.'</div>';
	if($_SESSION['qx'] == 'admin' || $_SESSION['qx'] == 'telecomadmin')
	 echo '<div class="opration">'.$opration.'</div></caption>';
	else
	 echo '</caption>'; 
	foreach($inf_arr as $key => $value)
	{
	    if($value =='')
	     echo '<tr ><td width="30%">'.$key.'</td><td>&nbsp;</td></tr>';
		 else
		echo '<tr ><td width="30%">'.$key.'</td><td>'.$value.'</td></tr>';
	}
	echo '</table>';
}
function usb_header($path,$content_title,$mkdir_page,$upload_page)
{
	echo '
		<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" 	onmouseover="changeto()"  onmouseout="changeback()" style="clear:both" class="table_list">
		<tbody class="content_body_area"/>
				<tr>
    				<td height="30" colspan="'.count($content_title).'" >
    					<div class="tab_head_div1">当前位置:<span id="list_title">'.$path.'</span>
						　　　　　　　　　　　　　　　　　　　　　　　传输状态:<span id="idStatus"></span> 
						</div>
						
       				 	<div class="tab_head_div2">';						
	$top_arr = preg_split('/\//',$path,-1,PREG_SPLIT_NO_EMPTY);
	$flag_top = count($top_arr);
	array_pop($top_arr);
	if(count($top_arr) ==0)
	{
		$top_path ='/';
	}
	else
	{
		$top_path = join('/',$top_arr);
	}
	if( $top_path !='/')
	{
		echo'<span class="tab_head_opration" id="op_add">
            <a href="javascript:list_dir(\'/'.$top_path.'\');">
				<img src="../images/add.gif" width="10" height="10" />上级目录
			</a>
         </span>';
	}
	else if($flag_top == 1)
	{
		echo'<span class="tab_head_opration" id="op_add">
            <a href="javascript:list_dir(\'/'.$top_path.'\');">
				<img src="../images/add.gif" width="10" height="10" />上级目录
			</a>
         </span>';
	} 
	if(($_SESSION['qx'] == 'admin') || ($_SESSION['qx'] == 'telecomadmin'))
	{
		if(empty($mkdir_page) != true)
		{
			echo'<span class="tab_head_opration" id="op_add">				
            	<a href="javascript:Mkdir(\''.$path.'\');">
					<img src="../images/add.gif" width="10" height="10" />新建目录
				</a>
         		</span>';
		}
		if(empty($upload_page) != true)
		{
			echo'<span class="tab_head_opration" id="op_add">
           		<a href="javascript:upload(\''.$path.' \');">
					<img src="../images/add.gif" width="10" height="10" />上传文件
				</a>
        	</span>';
		}
	}
	echo'</td></tr>';
	echo '<tr>';
	for($i=0;$i<count($content_title);$i++)
	{
   		echo'<td  class="list_row" bgcolor="#FFFFFF">
				<div align="center">
					<span>'.$content_title[$i].'</span>
        		</div>
			</td>';
	}
	echo '</tr>';
}
function ftp_header($path,$content_title,$mkdir_page,$upload_page)
{
	echo '
		<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#a8c7ce" 	onmouseover="changeto()"  onmouseout="changeback()" style="clear:both">
				<tr>
    				<td height="30" colspan="'.count($content_title).'" class="tab_header">
    					<div class="tab_head_div1">当前位置:<span id="list_title">'.$path.'</span></div>
       				 	<div class="tab_head_div2">';
	$top_arr = explode('/',$path);
	array_pop($top_arr);
	if(count($top_arr) ==1)
	{
		$top_path ='/';
	}
	else
	{
		$top_path = join('/',$top_arr);
	}
	if( $top_path !='/')
	{
		echo'<span class="tab_head_opration" id="op_add">
            <a href="javascript:list_dir(\''.$top_path.'\');">
				<img src="../images/add.gif" width="10" height="10" />上级目录
			</a>
         </span>';
	}
	echo'<span class="tab_head_opration" id="op_add">
            <a href="javascript:new_dir(\''.$mkdir_page.'\',\''.$path.'\');">
				<img src="../images/add.gif" width="10" height="10" />服务器配
			</a>
         </span>';
	echo'<span class="tab_head_opration" id="op_add">
           	<a href="javascript:new_upload(\''.$upload_page.'\',\''.$path.' \');">
				<img src="../images/add.gif" width="10" height="10" />上传文件
			</a>
        </span>';
	echo'</td></tr>';
	echo '<tr>';
	for($i=0;$i<count($content_title);$i++)
	{
   		echo'<td  class="list_row" bgcolor="#d3eaef">
				<div align="center">
					<span>'.$content_title[$i].'</span>
        		</div>
			</td>';
	}
	echo '</tr>';
}
function usb_operation($tagName,$del_name,$del_value,$down_file)
{
	echo'<td bgcolor="#FFFFFF"><div align="center" class="content_operation"><span class="content_td">';
	if(($_SESSION['qx'] == 'useradmin') || ($_SESSION['qx'] == 'telecomadmin'))
	{
		//if(!empty($tagName))
		//{
		if($del_value == 1)    // test the is or not direct(目录）
		{
			echo'<a href="javascript:index_del_test(\''.$tagName.'\',\''.$del_name.'\',\''.$down_file.'\');">
				<img src="../images/tab_del.gif" />删除 
			</a>';
		}
		//}
	}
	if($del_value == 1)
	{
		echo' <a href="javascript:ftpdown_file(\''.$down_file.'\')">
				<img src="../images/tab_edit.gif" />下载
			</a>';
	}
	echo'</span></div></td></tr>';
}

function web_usb_operation($tagName,$del_name,$del_value,$down_file)
{
	echo'<td bgcolor="#FFFFFF"><div align="center" class="content_operation"><span class="content_td">';
	if(($_SESSION['qx_usb'] == 'useradmin') || ($_SESSION['qx_usb'] == 'telecomadmin'))
	{
		if(!empty($tagName))
		{
			echo'<a href="javascript:index_del(\''.$tagName.'\',\''.$del_name.'\',\''.$down_file.'\');">
				<img src="../images/tab_del.gif" />删除 
			</a>';
		}
	}
	if($del_value == 1)
	{
		echo' <a href="javascript:Down(\''.$down_file.'\')">
				<img src="../images/tab_edit.gif" />下载
			</a>';
	}
	echo'</span></div></td></tr>';
}

function show_allinfo($title1,$title2,$info_arr)
{
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="../css/mod_add.css" rel="stylesheet" type="text/css" />
<script src="../js_script/common.js" language="javascript"></script>
</head>
<body>
<table border="0" cellspacing="0" cellpadding="0"  align="center" class="template_tab">
<thead>
	<tr>
  		<td width="12px"></td>
    	<td class="template_head_tab">
        	<span id="pos_title">当前位置：</span>
        	<span id="pos_leve1">'.$title1.'</span>->
        	<span id="pos_leve2">'.$title2.'</span>
    	</td>
    	<td width="12px;"></td>
  	</tr>
</thead>
<tbody>
  	<tr>
  		<td height="100%"><img src="../images/tab_12.gif" height="660px" width="8px"/></td>
        <td height="660px" valign="top">
        	<table class="template_body">';
			foreach($info_arr as $key => $value)
			{
				echo '<tr><td width="40%">'.$key.'</td><td>'.$value.'</td></tr>';
			}
           echo'</table>
        </td>
      	<td height="100%"><img src="../images/tab_15.gif"  height="660px" width="8px" align="right"/></td>
    </tr>
  </tbody>
  <tr>
  	<td width="12px"><img src="../images/tab_18.gif" /></td>
    <td class="template_foot"></td>
    <td width="12px;"><img src="../images/tab_20.gif" /></td>
  </tr>
</table>
</body>
</html>';
}
?>
