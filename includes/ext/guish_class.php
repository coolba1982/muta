<?php
	class guish
	{
		const SOCK_PATH = '/tmp/.gui_xml';
		private $sock_fd;
		private $rs_guish;
		public function __construct()
		{
			$this->sock_fd = 0;
			$this->rs_guish = NULL;
		}
		function set_fd()
		{
			if (!file_exists(self::SOCK_PATH))
			{
				die("unable find".self::SOCK_PATH."\n");
			}
			$this->sock_fd = socket_create(AF_UNIX, SOCK_STREAM, 0);
			if (!$this->sock_fd)
			{
				die('Unable to create AF_UNIX socket [toserv]');
			}
			if (!socket_connect($this->sock_fd,self::SOCK_PATH))
			{
				@system('killall guish');
				@system('guish -d');
				
				sleep(1); // 1 Minutes
 			  if (!socket_connect($this->sock_fd,self::SOCK_PATH))
 			  {
					die('Unable to connect to ');
			  }
			}
		}
		function get_fd()
		{
			return $this->sock_fd;
		}
		function set_rsgui($session_id,$name,$node_xml,$type)
		{
			if($session_id == NULL)
			{
				//echo '<script language="javascript">alert("�Ựʱ����ڣ�")</script>';
				//header('Location:/');
                forward_view('login.php');
			}
			else
			{
//				echo '<script language="javascript">
//						setTimeout("interval()",1000*60*10);
//					</script>';
			}
			$this->rs_guish = init_icgcmd($session_id,$name,$node_xml,$type);
		}
		function set_rsgui_tst($session_id,$name,$node_xml,$type)
		{
			if($session_id == NULL || $node_xml == NULL)
			{
				header('Location:http://'.$_SERVER['SERVER_ADDR']);
			}
			else
			{
				/*
				echo '<script language="javascript">
						//alert("set timeout agine 5 minutes......");
						setTimeout("interval()",1000*60*5);
					</script>';
				*/
			}
			$this->rs_guish = init_icgcmd($session_id,$name,$node_xml,$type);
		}
		function get_rsgui()
		{
			return $this->rs_guish;
		}
		function get_xml()
		{
			$str_xml = NULL;
			if($this->sock_fd <=0 ||$this->rs_guish == NULL)
			{
				die('sock_fd <=0 or rs_guish is null.....\n');
			}
			socket_write_guish($this->sock_fd,$this->rs_guish);
			$str_xml = socket_read_guish($this->sock_fd,1048576,PHP_BINARY_READ);
			return $str_xml;
		}
		function send_xml()
		{
			$str_xml = NULL;
			if($this->sock_fd <=0 ||$this->rs_guish == NULL)
			{
				die('sock_fd <=0 or rs_guish is null.....\n');
			}
			socket_write_guish($this->sock_fd,$this->rs_guish);
		}
		function get_xml_tst()
		{
			$str_xml = NULL;
			if($this->sock_fd <=0 ||$this->rs_guish == NULL)
			{
				die('sock_fd <=0 or rs_guish is null.....\n');
			}
			socket_write_guish($this->sock_fd,$this->rs_guish);
			//sleep(3);
			$str_xml = socket_read_guish($this->sock_fd,1048576,PHP_BINARY_READ);
			$xml_handle = xml_parser_create();
			while(!xml_parse($xml_handle,$str_xml))
			{
				$str_xml .=socket_read_guish($this->sock_fd,1048576,PHP_BINARY_READ);
			}
			return $str_xml;
		}
		function __destruct()
		{
			if ($this->sock_fd >0)
			{
				socket_close($this->sock_fd);
			}
		}
	}
?>
