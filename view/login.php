<!DOCTYPE html>
<html lang="zh">
<head>

    <?php include 'header.php'?>
    <link href="res/css/pages/login.css" rel="stylesheet" />
    
    <script type="text/javascript">
    	  var command = '';
    <?php 
       if(!empty($GLOBALS['command'])){
       	echo  'command="' . $GLOBALS['command'] . '" ;' ;
      }
    ?>    

    </script>
</head>

<body>

<div class="navbar navbar-fixed-top">

    <div class="navbar-inner">

        <div class="container">

            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <a class="brand" href="#"> <img src="img/logo.png" alt=""  style='width:50px;height:24px;'/> &nbsp; <?php printx('SIN DR-100','SIN DR-100') ?></a>

            <!--div class="nav-collapse">

                <ul class="nav pull-right">

                    <li class="">

                        <a href="javascript:;"><i class="icon-chevron-left"></i> </a>
                    </li>
                </ul>

            </div--> <!-- /nav-collapse -->

        </div> <!-- /container -->

    </div> <!-- /navbar-inner -->

</div> <!-- /navbar -->



<?php

if((strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 7.0"))  ||(strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 6.0")) ){


echo   "<BR><BR>";


}






?>




<div id="login-container">


    <div id="login-header">

        <h3> <?php printx('登陆','Login') ?> </h3>

    </div> <!-- /login-header -->

    <div id="login-content" class="clearfix">

        <form action="login.php" method="post"  id="frm"/>
        <fieldset>
            <div id='d_msg'>
            <?php   global $ERROR_MESSAGE;     if(isset($ERROR_MESSAGE)) { ?>



                <div class="alert alert-error">
                    <button type="button" class="close" onclick='javascript:$("#d_msg").hide()'>&times;</button>
                <span class='error-icon'></span>   <?php   echo $ERROR_MESSAGE;   ?>
                </div>


            <?php  } ?>
            </div>
             <input  type="hidden" name="act" value="login"  >
             <div class="control-group"  id="cg_username">
                <label class="control-label" for="username"><b><?php printx('用户名','User Name') ?></b></label>
                <div class="controls">
                    <input type="text" class="" id="username" name='username'  autocomplete="off"/>
                </div>
            </div>
            <div class="control-group"  id="cg_password">
                <label class="control-label" for="password"><b><?php printx('密码','Password') ?></b></label>
                <div class="controls">
                    <input type="password" class="" id="password" name='password'  autocomplete="off"/>
                </div>
            </div>
            
            <div class="control-group"  id="cg_lang">
                
               
                    <select   id="lang"  style='width:100px;'/>
                    <?php  if($_REQUEST['lang']=='en_us'){ ?>   	
                    	<option value='zh_cn'  >中文</option>
                    	<option value='en_us' selected >English</option>
                    <?php  }else   if($_REQUEST['lang']=='zh_cn'){ ?> 	
                    	<option value='zh_cn' selected >中文</option>
                    	<option value='en_us'  >English</option>
                    <?php  }else   if($_SESSION['lang']=='zh_cn'){ ?> 	
                    	<option value='zh_cn' selected >中文</option>
                    	<option value='en_us'  >English</option>
                    <?php  }else   if($_SESSION['lang']=='en_us'){ ?> 	
                    	<option value='zh_cn'  >中文</option>
                    	<option value='en_us'  selected >English</option>
                    <?php  }else { ?> 	
                       <option value='zh_cn' selected >中文</option>
                    	<option value='en_us'   >English</option>
                    <?php } ?> 	
                    
                    </select>	
                    <input type='hidden' name='lang' id='hidden_lang'>
            </div>            
            
            
        </fieldset>

        <!--div id="remember-me" class="pull-left">
            <input type="checkbox" name="remember" id="remember" />
            <label id="remember-label" for="remember">Remember Me</label>
        </div-->

        <div class="pull-right  ">
            <input id="btn_submit"  type="button" class="btn btn-warning   btn-large" value="<?php printx('登陆','Login') ?>" style="width:100px;">
            <input id='btn_reset' class="btn   btn-large"   type="button"  value="<?php printx('重置','Reset') ?>"  style="width:100px;">
        </div>
        </form>

    </div> <!-- /login-content -->


    <!--div id="login-extra">

        <p><a href="javascript:;"></a></p>

        <p><a href="forgot_password.html"></a></p>

    </div--> <!-- /login-extra -->

</div> <!-- /login-wrapper -->



<!--  javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="res/js/jquery-1.7.2.min.js"></script>


<script src="res/js/bootstrap.js"></script>
<script type="text/javascript">

    var meta_info =new Array();
    meta_info['form1'] = [
        {id:"username",rule:"notnull,char,len[3-10]",status:""},
        {id:"password",rule:"notnull,char,len[3-10]"}
    ];

    $(document).ready(function () {

        $('#btn_submit').click(function(){
        	  $('#hidden_lang').val($('#lang').val());
            if(!check_form('form1')){
              return;
            }
            $("#frm").submit();

        });
	    $('#btn_reset').click(function(){
		    $('#username').val('');
			$('#password').val('');
		});

        $('#lang').change(function(){
        	 var lang = $('#lang').val();
           location.href = 'login.php?lang='+lang;
        });   

        $(document).keyup(function(event){
         if(event.keyCode ==13){
             $("#btn_submit").trigger("click");
       }
});
		
		
    if(command=='recover'){
          $.ajax({
           type: "GET",
           async: true,
            url: "operation.php?act=recover&ajax=true",
            dataType: "html",
            success: function (resp) {
                //window.location.href="logout.php";
            }
        });
    }else  if(command=='restart'){
          $.ajax({
           type: "GET",
           async: true,
            url: "operation.php?act=restart&ajax=true",
            dataType: "html",
            success: function (resp) {
                //window.location.href="logout.php";
            }
        });
       
    }		
		
		
        
    });

<?php
global $error_message;
if(!empty($error_message)){
            $msg = $error_message;

               $content= $msg['content'];
           $type= $msg['type'];

              echo  "show_message('$content',$type);";

}


?>


</script>



</body>
</html>
