<?php


if (!defined('IN_MUTA'))
{
    die('Hacking');
}

class cls_session
{
    //var $db             = NULL;   暂时不需要入库
    //var $session_table  = '';

    var $max_life_time  = 1800; // SESSION 过期时间

    var $session_name   = '';
    var $session_id     = '';

    var $session_expiry = '';
    var $session_md5    = '';
    
    var $username    = '';
    var $userid    = '';

    var $session_cookie_path   = '/';
    var $session_cookie_domain = '';
    var $session_cookie_secure = false;

    var $_ip   = '';
    var $_time = 0;

    function __construct($session_name = 'MUTA_ID', $session_id = '')
    {
        $this->cls_session($session_name, $session_id);
    }

    function cls_session($session_name = 'MUTA_ID', $session_id = '')
    {
        $GLOBALS['_SESSION'] = array();

        if (!empty($GLOBALS['cookie_path']))
        {
            $this->session_cookie_path = $GLOBALS['cookie_path'];
        }
        else
        {
            $this->session_cookie_path = '/';
        }

        if (!empty($GLOBALS['cookie_domain']))
        {
            $this->session_cookie_domain = $GLOBALS['cookie_domain'];
        }
        else
        {
            $this->session_cookie_domain = '';
        }

        if (!empty($GLOBALS['cookie_secure']))
        {
            $this->session_cookie_secure = $GLOBALS['cookie_secure'];
        }
        else
        {
            $this->session_cookie_secure = false;
        }

        $this->_ip = real_ip();
        
        
        if (!empty($_SESSION['userid']))
        {
            $this->userid = $_SESSION['userid'];
        }        
        
         if (!empty($_SESSION['username']))
        {
            $this->userid = $_SESSION['username'];
        }        
        

        if ($session_id == '' && !empty($_COOKIE[$this->session_name]))
        {
            $this->session_id = $_COOKIE[$this->session_name];   //session_id可能从cookie当中去取
        }
        else
        {
            $this->session_id = $session_id;
        }

        if ($this->session_id)
        {
            $tmp_session_id = substr($this->session_id, 0, 32);
            if ($this->gen_session_key($tmp_session_id) == substr($this->session_id, 32))
            {
                $this->session_id = $tmp_session_id;
            }
            else
            {
                $this->session_id = '';
            }
        }

        $this->_time = time();

        if ($this->session_id)
        {
            $this->load_session();
        }
        else
        {
            $this->gen_session_id();

            setcookie($this->session_name, $this->session_id . $this->gen_session_key($this->session_id), 0, $this->session_cookie_path, $this->session_cookie_domain, $this->session_cookie_secure);
        }
        //挂掉的时候勿忘清理session
        register_shutdown_function(array(&$this, 'close_session'));
    }

    function gen_session_id()
    {
        $this->session_id = md5(uniqid(mt_rand(), true));

        return $this->session_id;
    }

    function gen_session_key($session_id)
    {
        static $ip = '';

        if ($ip == '')
        {
            $ip = substr($this->_ip, 0, strrpos($this->_ip, '.'));
        }

        return sprintf('%08x', crc32(!empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] . ROOT_PATH . $ip . $session_id : ROOT_PATH . $ip . $session_id));
    }



    function load_session()
    {
                //$this->session_expiry = $session['expiry'];
                //$this->session_md5    = md5($session['data']);
                //$GLOBALS['_SESSION']  = unserialize($session['data']);
                //$GLOBALS['_SESSION']['userid'] = $this->userid
                //$GLOBALS['_SESSION']['username'] = $this->username

    }

    function update_session()
    {
    	
    	
    }





    function destroy_session()
    {
        $GLOBALS['_SESSION'] = array();

        setcookie($this->session_name, $this->session_id, 1, $this->session_cookie_path, $this->session_cookie_domain, $this->session_cookie_secure);

        return true;
    }

    function get_session_id()
    {
        return $this->session_id;
    }

    function get_users_count()
    {
        return 1;
    }
}

?>