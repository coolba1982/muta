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
                     <?php printx('WIFI DHCP设置','WIFI DHCP Settings') ?>
                </h1>


                <div class='row'>
                    <div class="span10">
                        <div class="widget">

                            <div class="widget-header">
                                <h3>    <?php printx('设置参数','Parameters') ?></h3>
                            </div>
                            <!-- /widget-header -->


                            <div class="widget-content">

                                <div id='d_msg'>
                                </div>


                                <form id="edit-profile" class="form-horizontal">
                                    <fieldset>


                                        <div class="control-group" id='cg_ip'>
                                            <label class="control-label" for="ip"><?php printx('IP地址','IP Address') ?></label>

                                            <div class="controls">
                                                <input type="text" class="input-large" id="ip"
                                                       value="">
                                                <!--p class="help-block"></p-->
                                            </div>
                                        </div>

                                        <div class="control-group" id='cg_mask'>
                                            <label class="control-label" for="mask"><?php printx('子网掩码','Mask') ?></label>

                                            <div class="controls">
                                                <input type="text" class="input-large" id="mask"
                                                       value="255.255.255.0">
                                                <!--p class="help-block"></p-->
                                            </div>
                                        </div>



                                        <!--div class="control-group" id='cg_service'>
                                            <label class="control-label" for="service">DHCP服务</label>

                                            <div class="controls">
                                                <select id="service">
                                                    <option value=""></option>
                                                    <option value="0">打开</option>
                                                    <option value="1">关闭</option>
                                                </select>
                                            </div>
                                        </div-->


                                        <div class="control-group" id='cg_start_ip'>
                                            <label class="control-label" for="start_ip"><?php printx('起始IP地址','Start IP') ?></label>

                                            <div class="controls">
                                                <input type="text" class="input-large" id="start_ip"
                                                       value="">
                                                <!--p class="help-block"></p-->
                                            </div>
                                        </div>


                                        <div class="control-group" id='cg_end_ip'>
                                            <label class="control-label" for="end_ip"><?php printx('结束IP地址','End IP') ?></label>

                                            <div class="controls">
                                                <input type="text" class="input-large" id="end_ip"
                                                       value="">
                                                <!--p class="help-block"></p-->
                                            </div>
                                        </div>
                                        <!-- /control-group -->


                                        <br>


                                        <div class="form-actions">
                                            <input id='btn_submit' type='button' class="btn btn-primary" value='<?php printx('提交','Apply') ?>'>
                                            <button id='btn_back' type="button"   class="btn"  > <i class='icon-arrow-up'> </i> <?php  printx('WIFI设置','WIFI Settings') ?> </button>
                                            <button id='btn_home' type="button"   class="btn"  > <i class='icon-home'> </i> <?php  printx('主页','Home') ?> </button>
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


    function after_init(){
        $('#mask').val(num2mask($('#mask').val()));
    }
    

    function  before_func(){
    	
    	   
    	   $('#close_win_msg').html('<?php  printx('请关闭此页面，重新连接wifi成功后，再登陆本系统','Please close this window and wait a while, reconnect the WIFI and relogin') ?>');
    	
   	     //$('#close_win').modal({backdrop: 'static'});
    	location.href='#footer';
       var tp = $('#footer').offset().top/2;
       finish_loading();
      $('#close_win').modal({backdrop: 'static'}).css({'top':'400'+'px'});   	 
   	     return true;
   	     
   	
    }	
    


    function submit() {
        var para = {'act': 'update', 'ajax': 'true'};
        var opt = {debug: 'false', load_msg: '<?php printx('正在保存DHCP设置,请稍候...','Saving DHCP configs now...') ?>',before:before_func, create_param: function (param) {
            param.mask2num= mask2num(trim($('#mask').val()));
            return param;
        }};
        var obj = {form_id:'form1',url: "dhcpset.php", param: para, option: opt};
        try {
            if (!check_form('form1')) return;
            confirm('<?php  printx('保存设置会导致wifi连接断开，请重新连接wifi后，登陆本系统。 是否继续？','It will be disconnected from WIFI for a while before you relogin. Are you sure to continue?') ?>', submit_form_ext, obj);
        } catch (e) {
            alert(e);
        }
    }

    var meta_info =new Array();
    meta_info['form1'] =[
        {id: "ip", rule: "notnull,ip", status: ""},
        {id: "mask", rule: "notnull,mask"},
        {id: "start_ip", rule: "notnull,ip"},
        {id: "end_ip", rule: "notnull,ip"}
    ];





    $(document).ready(function () {
        init_form('dhcpset.php?ajax=true',after_init,'form1');
        $('#btn_submit').click(submit);
        $('#btn_back').click(function(){location.href='wiset.php'});
	    $("#btn_home").click(function(){location.href='index.php?page=1';});

        heart_beat(5000);

    });


</script>

<?php include 'close_win.php' ?>

</body>
</html>
