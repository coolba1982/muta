<!DOCTYPE html>
<html lang="zh">
<head>
    <!---------------------------header start----------------------------->
    <?php include 'header.php'?>
    <!---------------------------header end----------------------------->

</head>

<body>

<!------------------nav top start-------------------------------------->
<?php include 'nav_top.php'?>
<!------------------nav top end -------------------------------------->


<div id="content">

    <div class="container">

        <div class="row">

            <div class="span2">

                <!------------------account  start-------------------------------------->
                <?php include 'account.php'?>

                <!------------------account  end -------------------------------------->


                <!------------------nav_side  start-------------------------------------->
                <?php include 'nav_side.php'?>
                <!------------------nav_side  end -------------------------------------->


            </div>
            <!-- /span3 -->



            <?php include 'loading.php'?>

            <?php include 'confirm.php'?>



            <div class="span10">

                <h1 class="page-title">
                    <i class="icon-th-large"></i>
                     <?php  printx('WIFI设置','WIFI Configs') ?>
                </h1>


                <div class='row'>
                    <div class="span10">
                        <div class="widget">

                            <div class="widget-header">
                                <h3><?php  printx('设置参数','Parameters') ?></h3>
                            </div>
                            <!-- /widget-header -->


                            <div class="widget-content">

                                <div id='d_msg'>
                                </div>


                                <form id="edit-profile" class="form-horizontal">
                                    <fieldset>


                                        <div class="control-group" id='cg_ssid'>
                                            <label class="control-label" for="ssid">  <?php  printx('','','ssid') ?>   </label>

                                            <div class="controls">
                                                <input type="text" class="input-large" id="ssid"
                                                       value=""  autocomplete="off"> *

                                                <input type='hidden' value=''  id='old_ssid'>

                                                <!--p class="help-block"></p-->
                                            </div>
                                        </div>


                                        <div class="control-group" id='cg_segregate'>
                                            <label class="control-label" for="segregate"> <?php  printx('是否隔离','Segregate') ?>  </label>

                                            <div class="controls">
                                                <select id="segregate">
                                                    <option value=""></option>
                                                    <option value="0"><?php  printx('禁用','Disabled') ?> </option>
                                                    <option value="1"><?php  printx('启用','Enabled') ?> </option>
                                                </select> *
                                                <!--p class="help-block"></p-->
                                            </div>
                                        </div>


                                        <div class="control-group" id='cg_secure'>
                                            <label class="control-label" for="secure"><?php  printx('','','secure') ?></label>

                                            <div class="controls">
                                                <select id="secure">
                                                    <option value=""></option>
                                                    <option value="3">WPA-PSK</option>
                                                    <option value="4">WPA2-PSK</option>
                                                    <option value="0"><?php  printx('非加密','No Encrypt') ?> </option>
                                                </select> *
                                                <!--p class="help-block"></p-->
                                            </div>
                                        </div>

                                     <div style="display: none;">
                                        <div class="control-group" id='cg_encrypt'>
                                            <label class="control-label" for="encrypt"><?php  printx('','','encrypt') ?></label>

                                            <div class="controls">
                                                <select id="encrypt">
                                                    <option value=""></option>
                                                    <option value="AES">AES</option>
                                                    <option value="TKIP">TKIP</option>
                                                </select> *
                                                <!--p class="help-block"></p-->
                                            </div>
                                        </div>
                                   </div>

                                        <div class="control-group" id='cg_share_key'>
                                            <label class="control-label" for="share_key"><?php  printx('','','share_key') ?></label>

                                            <div class="controls">
                                            <span id='s_share_key'>
                                            <input type="password" class="input-medium" id="share_key" value=""> *
                                            </span>

                                            <span id='s_share_key_1' style="display:none;">
                                            <input type="text" class="input-medium" id="share_key_1" value=""> *
                                            </span>
                                                &nbsp; <input type="checkbox" id='chk'> <?php  printx('显示明文','Show The Key') ?>

                                                <p class="help-block"> <?php  printx(' 8~63 位字母或者数字的组合','Composition of letters or numbers, length of which should be the range of [8-63]') ?>    </p>

                                            </div>


                                            <!-- /controls -->
                                        </div>
                                        <!-- /control-group -->


                                        <br>


                                        <div class="form-actions">
                                            <input id='btn_submit' type='button' class="btn btn-primary" value='<?php  printx('提交','Apply') ?>'>
                                            <button id='btn_dhcp1' type="button"   class="btn"  > <i class='icon-arrow-down'> </i> <?php  printx('DHCP设置','DHCP Settings') ?> </button>
                                            <?php  if(is_mobile()) echo '<P><P>' ?>

											<button id='btn_dev' type="button"   class="btn"  > <i class='icon-arrow-down'> </i> <?php  printx('管理连接设备','Devices Connected') ?> </button> 
											<button id='btn_back' type="button"   class="btn"  > <i class='icon-home'> </i> <?php  printx('主页','Home') ?> </button>
											

                                            <div>
                                                <!-- /form-actions -->
                                    </fieldset>

                                </form>


                            </div>
                            <!-- /widget-content -->

                        </div>
                    </div>
                </div>


            </div>
            <!-- /span12 -->


        </div>
        <!-- /row -->

    </div>
    <!-- /container -->

</div>
<!-- /content -->



<?php include 'footer.php'?>
<!-- /footer -->


<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="res/js/jquery-1.7.2.min.js"></script>

<script src="res/js/bootstrap.js"></script>

<script type="text/javascript">

    function   after_init_form(){
        $('#old_ssid').val($('#ssid').val());
        hide_or_show();		
    }

    function hide_or_show() {

        if (($('#secure').val() == '4') || ($('#secure').val() == '3')) {
            //$('#cg_encrypt').show();
            //set_meta_attr('encrypt', 'status', 'check','form1');

            $('#cg_share_key').show();
            if (!keyshow) {
                set_meta_attr('share_key', 'status', 'check','form1');  //设置为check的会自动进行验证
                set_meta_attr('share_key_1', 'status', 'uncheck','form1');
            } else {
                set_meta_attr('share_key', 'status', 'uncheck','form1');
                set_meta_attr('share_key_1', 'status', 'check','form1');
            }

        } else {
           // $('#cg_encrypt').hide();
           // set_meta_attr('encrypt', 'status', 'uncheck','form1');

            $('#cg_share_key').hide();
            set_meta_attr('share_key', 'status', 'uncheck','form1');
            set_meta_attr('share_key_1', 'status', 'uncheck','form1');

        }


    }

    var keyshow = false;

    function showkey() {
        if (keyshow) {
            $("#share_key").val($("#share_key_1").val());
            $("#s_share_key_1").hide();
            $("#l_share_key").attr('for', 'share_key');
            $("#s_share_key").show();
            set_meta_attr('share_key', 'status', 'check','form1');
            set_meta_attr('share_key_1', 'status', 'uncheck','form1');
        } else {
            $("#s_share_key").hide();
            $("#s_share_key_1").show();
            $("#l_share_key").attr('for', 'share_key_1');
            set_meta_attr('share_key', 'status', 'uncheck','form1');
            set_meta_attr('share_key_1', 'status', 'check','form1');
            $("#share_key_1").val($("#share_key").val());
        }
        keyshow = keyshow ? false : true;
    }


    function  before_func(){
    	
    	   
    	   $('#close_win_msg').html('<?php  printx('请关闭此页面，重新连接wifi成功后，再登陆本系统','Please close this window and wait a while, reconnect the WIFI and relogin') ?>');
    	
   	    // $('#close_win').modal({backdrop: 'static'});
   	     
   	     
    	location.href='#footer';
     var tp = $('#footer').offset().top/2;
     
    finish_loading();
    $('#close_win').modal({backdrop: 'static'}).css({'top':'400'+'px'});   	     
   	     
   	     
   	     
   	     
   	     
   	     
   	     return true;
   	     
   	     //.css({'top':tp+'px'});   	
   	
    }	





    function submit() {
        var para = {'act': 'update', 'ajax': 'true'};
        var opt = {debug: 'false', load_msg: '<?php  printx('正在配置WIFI...','Setting WIFI now...')  ?>',  before:before_func, create_param: function (param) {
            if (keyshow) {
                param.share_key = param.share_key_1;
            }
            param.old_ssid= $('#old_ssid').val();
            return param;
        }};
        //var obj = {form_id:'form1',url: "wiset.php", param: para, option: opt,direct_to_login:'true'};
        var obj = {form_id:'form1',url: "wiset.php", param: para, option: opt};

        try {
            if (!check_form('form1')) return;
            //confirm('<?php  printx('是否确定更改设置?','Are you sure to change the config?') ?>', submit_form, obj);
            confirm('<?php  printx('保存设置会导致wifi连接断开，请重新连接wifi后，登陆本系统。 是否继续？','It will be disconnected from WIFI for a while before you relogin. Are you sure to continue?') ?>', submit_form_ext, obj);

        } catch (e) {
            alert(e);
        }
    }

    var meta_info =new Array();
    meta_info['form1'] =[
        {id: "ssid", rule: "notnull,len[1-32]", status: ""},
        {id: "segregate", rule: "notnull"},
        {id: "secure", rule: "notnull"},
       // {id: "encrypt", rule: "notnull"},

        {id: "share_key", rule: "notnull,len[8-63]"},
        {id: "share_key_1", rule: "notnull,len[8-63]"}
    ];





    $(document).ready(function () {
	    var before_setform = function(){
		   $("#share_key_1").val('');
           $("#share_key").val('');
		    $("#ssid").val('');

		};
	
        init_form('wiset.php?ajax=true', after_init_form,'form1',before_setform);
		

        $('#secure').change(hide_or_show);

        $('#chk').click(showkey);
        $('#btn_submit').click(submit);

        $('#btn_dhcp1').click(function(){location.href = "dhcpset.php<?php echo_lang() ?>"; });
        $('#btn_dev').click(function(){location.href = "dev.php<?php echo_lang() ?>"; });

        $("#btn_back").click(function(){location.href='index.php?page=3';})
        heart_beat(5000);


    });
    
    function closeWin(){
      
    
    }


</script>

<?php include 'close_win.php' ?>
</body>
</html>
