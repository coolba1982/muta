<!DOCTYPE html>
<html lang="zh">
<head>
    <!---------------------------header start----------------------------->
    <?php include 'header.php'?>
    <!---------------------------header end----------------------------->

    <style type="text/css">

        div.plan-features {
            padding: 20px;
        }

        li.hli {
            float: left;
            list-style: none; /*去掉li前的点标记*/
            margin: 30px; /*外边距*/
        }
        
        
.popover-inner {
padding: 3px;
width: 280px;
overflow: hidden;
background-color: #fff;

background-image: initial;
background-position-x: initial;
background-position-y: initial;
background-size: initial;
background-repeat-x: initial;
background-repeat-y: initial;
background-attachment: initial;
background-origin: initial;
background-clip: initial;


-webkit-border-radius: 6px;
-moz-border-radius: 6px;
border-radius: 6px;
-webkit-box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
-moz-box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
box-shadow: 0 3px 7px rgba(0, 0, 0, 0.3);
}
     
    .text-green{
         color:green;      
     }   

    .text-red{
         color:red;      
     }  	 
        

    </style>
</head>

<body>

<!------------------nav top start-------------------------------------->
<?php include 'nav_top.php'?>
<!------------------nav top end -------------------------------------->


<div id="content">

<div class="container">

<div class="row">


<!-- /span3 -->


<div class="span10">

<h1 class="page-title">
    <i class="icon-th-large"></i>
    <?php printx('主页', 'Home') ?>  <span id='cur_page'> </span>
</h1>

<div   id='d1'>
    <div class="row">


            <div class="widget">
                <div class="widget-header">

                    <h3>
                        <?php printx('通过有线接口接入互联网', 'Access Internet With Wire Interface') ?>
                    </h3>
                </div>
                <!-- /plan-header -->

                <div class="widget-content" style="padding:20px;">

                    <?php  if(!is_mobile()){  ?>
                    <div>
                        <?php  }  ?>

                        <?php  if(!is_mobile()){  ?>
                        <div style="width:150px; height:220px; float:left; _margin-right:-3px;">
                            <?php  }  ?>
                            <img style="width:auto;heigth:auto;" src="img/wire_l.gif">


                            <p></p>

                            <?php  if(!is_mobile()){  ?>
                        </div>
                    <?php  }  ?>




                        <div>

                            <p><strong><?php printx('联网方式:', 'Network Mode:') ?> </strong> <span
                                    id='wan_link_mode'> N/A</span></p>

                            <p><strong><?php printx('IP地址:', 'IP Address:') ?></strong> <span
                                    id="wan_ip">N/A </span></p>

                            <p><strong><?php printx('连接状态:', 'Link Status:')?>  </strong> <span
                                    id="wan_link_status"> N/A</span></p>

                            <p><strong> <?php printx('接收字节数:', 'Acceptance Bytes:')?></strong> <span
                                    id="wan_rx"> N/A</span></p>

                            <p><strong><?php printx('发送字节数:', 'Sending Bytes:')?> </strong> <span
                                    id="wan_tx"> N/A</span></p>

                            <p>&nbsp;</p>

                            <p>&nbsp;</p>

                            <!--p>&nbsp;</p-->


                            <hr>
                        </div>

                        <?php  if(!is_mobile()){  ?>
                    </div>
                <?php  }  ?>


                    <div class='action'>

                        <button id='btn_waset' type="button"
                                class="btn btn-primary"><?php printx('有线设置', 'Wire Access Config')?> </button>
                        <!--button class="btn"><?php printx('重新连接','Reconnect')?> </button-->

                        <button id='btn_t12' type="button" class="btn"  style='float:right;'  ><i class='icon-arrow-right'></i> <?php printx('下一页', 'Next Page')?> </button>
                    </div>

                </div>
                <!-- /plan-features -->




            </div>



    </div>
</div>


<div   id='d2'>
    <div class="row">
            <div class="widget">
                <div class="widget-header">

                    <h3>
                        <?php printx('通过无线上网卡接入互联网', 'Access Internet By Wireless Card')?>
                    </h3>
                </div>
                <!-- /plan-header -->
                <div class="widget-content" style="padding:20px;">

                    <?php  if(!is_mobile()){  ?>
                    <div>
                        <?php  }  ?>

                        <?php  if(!is_mobile()){  ?>
                        <div style="width:150px; height:220px; float:left; _margin-right:-3px;">
                            <?php  }  ?>
                            <img style="width:auto;heigth:auto;" src="img/wireless_l.gif">


                            <p></p>

                            <?php  if(!is_mobile()){  ?>
                        </div>
                    <?php  }  ?>


                        <div>
                            <p><strong><?php printx('3G/4G卡状态:', '3G/4G Card Status:')?>  </strong>
                                <span id='g_card_status'>N/A </span></p>

                            <p><strong><?php printx('SIM卡状态:', 'SIM Card Status:')?> </strong> <span
                                    id='g_sim_status'>N/A </span></p>

                            <p><strong><?php printx('运营商:', 'Carrier:')?> </strong> <span
                                    id='g_op'>N/A </span></p>

                            <p><strong><?php printx('信号强度:', 'Signal:')?>  </strong> <span
                                    id='g_signal'> N/A</span></p>

                            <p><strong><?php printx('连接状态:', 'Link Status:')?>  </strong> <span
                                    id='g_link_status'> N/A</span></p>

                            <!--p><strong><?php printx('连接时长:', 'Link Time:')?> </strong> <span
                                                    id='g_link_time'> N/A</span></p-->

                            <p><strong><?php printx('接收字节数:', 'Acceptance Bytes:')?> </strong> <span
                                    id='g_rx'> N/A</span></p>

                            <p><strong><?php printx('发送字节数:', 'Sending Bytes:')?> </strong> <span
                                    id='g_tx'> N/A</span></p>

                            <hr>

                        </div>


                        <?php  if(!is_mobile()){  ?>
                    </div>
                <?php  }  ?>

                    <div class='action'>



                        <button id='btn_caset' type="button"
                                class="btn btn-primary"><?php printx('无线设置', 'Wireless Access Config')?> </button>
                        <!--button class="btn"><?php printx('重新连接','Reconnect')?> </button-->

                        <button id='btn_t23' type="button" style='float:right;'
                                class="btn"><i class='icon-arrow-right'></i><?php printx('下一页', 'Next Page')?> </button>

                        <button id='btn_t21' type="button" style='float:right;'
                                class="btn"><i class='icon-arrow-left'></i><?php printx('上一页', 'Last Page')?> </button>



                    </div>

                </div>

                <!-- /plan-features -->



            </div>

    </div>
</div>


<div   id='d3'>
<div class="row">
        <div class="widget">
            <div class="widget-header">

                <h3>
                    <?php printx('连接WIFI', 'Connect WIFI') ?>
                </h3>
            </div>
            <!-- /plan-header -->

            <div class="widget-content" style="padding:20px;">



                        <img style="width:auto;heigth:auto;" src="img/wifi_l.gif">



                        <p></p>



                    <div style='padding:20px;height:100%;'>
                        <p><a href="dev.php"><span id='wifi_dev_num'
                                                   class="badge badge-error">N/A</span></a><?php printx('个设备已接入', ' devices  connected') ?>
                        </p>

                        <p>&nbsp;</p>

                        <p><strong><?php printx('设备地址:', 'Device IP:') ?></strong> <span id='wifi_gate'>N/A </span></p>

                        <p><strong><?php printx('连接方式:', 'Link Mode:') ?></strong> <span> DHCP</span></p>


                    </div>



                <hr>
                <div class='action'>

                    <button id='btn_wiset' class="btn btn-primary"><?php printx('WIFI设置', 'WIFI Config') ?></button>
                    <!--button class="btn"><?php printx('关闭WIFI','Close WIFI') ?></button-->

                    <button id='btn_t34' type="button" style='float:right;'
                            class="btn"><i class='icon-arrow-right'></i><?php printx('下一页', 'Next Page')?> </button>

                    <button id='btn_t32' type="button"  style='float:right;'
                            class="btn"><i class='icon-arrow-left'></i><?php printx('上一页', 'Last Page')?> </button>

                </div>


            </div>
            <!-- /widget-content -->
            <!-- /plan-features -->




        </div>

</div>
</div>



<div   id='d4'>
    <div class="row">
            <div class="widget">
                <div class="widget-header">

                    <h3>
                        <?php printx('WIFI共享', 'WIFI Share')?>
                    </h3>
                </div>
                <!-- /plan-header -->
                <div class="widget-content" style="padding:20px;">

                    <?php  if(!is_mobile()){  ?>
                    <div>
                        <?php  }  ?>

                        <?php  if(!is_mobile()){  ?>
                        <div style="width:150px; height:150px; float:left; _margin-right:-3px;">
                            <?php  }  ?>

                            <img style="width:100px;heigth:100px;" src="img/share.jpg">
                            <div style="width:128px;heigth:28px;"></div>


                            <p></p>

                            <?php  if(!is_mobile()){  ?>
                        </div>
                    <?php  }  ?>

                        <div style='height:100%;padding-top:20px;padding-bottom: 20px;'>
                            <p style='text-align: left;'>
                                <span id="u_stat"><B><red><?php printx('未插入U盘', 'Flash disk not inserted') ?></red></B></span>
                            </p>
                            <p style='text-align: left;'>
                                <button id="btn_share_storage" class="btn btn-large btn-block btn-primary"
                                        type="button"><span id='span_share_storage'><?php printx('打开存储', 'Open Storage') ?></span></button>
                                <strong><?php //printx('共享存储', 'Share Storage') ?></strong> &nbsp; <span id="store_stat"> </span>
                            </p>
                            <p style='text-align: left;'>
                                <button id="btn_share_media" class="btn btn-large btn-block btn-primary"
                                        type="button"><span id='span_share_media'><?php printx('打开媒体', 'Open Media') ?></span></button>

                                <strong><?php //printx('共享多媒体', 'Share Media') ?></strong> &nbsp; <span id="media_stat"> </span>
                            </p>


                        </div>

                        <?php  if(!is_mobile()){  ?>
                    </div>
                <?php  }  ?>


                    <hr>
                    <div class='action'>
                        <p>&nbsp;</p>


                            <button id='btn_t45' type="button"  class="btn"  style='float:right;'><i class='icon-arrow-right'></i><?php printx('下一页', 'Next Page')?> </button>
                            <button id='btn_t43' type="button"  class="btn" style='float:right;'   ><i class='icon-arrow-left'></i><?php printx('上一页', 'Last Page')?> </button>


                    </div>


                </div>
                <!-- /plan-features -->



            </div>

    </div>
</div>


<div   id='d5'>
    <div class="row">
        <div class="widget">

            <div class="widget-header">
                <h3><?php printx('系统信息', 'System Info') ?></h3>
            </div>
            <!-- /widget-header -->

            <div class="widget-content">




                    <img src="res/img/ly.jpg" style="width:124px;height:148px;">

                    <div style='padding:20px;'>

                        <p>&nbsp;</p>

                        <p><strong><?php printx('设备型号:', 'Device Type:') ?>&nbsp;&nbsp;</strong> <span id='sys_type'></span></p>
                        <p><strong><?php printx('固件版本:', 'Firmware Version:') ?>&nbsp;&nbsp;</strong><span id='sys_version'></span></p>
                        <p><strong><?php printx('运行时长:', 'Run Time:') ?>&nbsp;&nbsp;</strong><span id='sys_time'></span></p>
                        <p><a href="inter.php"><span class="badge badge-info"><?php printx('接口信息总览', 'Interface Info') ?></span></a></p>

                        

                    </div>



                <hr>
                <div class='action'>

                   <button type="button" id="btn_restart"
                            class="btn btn-warning"> <?php printx('重启设备', 'Restart') ?></button>
                    <button type="button" id="btn_recover"
                            class="btn btn-warning"> <?php printx('恢复出厂设置', 'Default Settings Recover') ?></button>

                    <button id='btn_t54' type="button" style='float:right;'
                            class="btn"><i class='icon-arrow-left'></i><?php printx('上一页', 'Last Page')?> </button>

                </div>



      


         


                </div>







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
	
<?php      
$cur_page = isset($_REQUEST['page'])? $_REQUEST['page']:1;
if((!is_numeric($cur_page))||($cur_page<1)||($cur_page>5)){
	  $cur_page = 1;
}	

echo 'var cur_page='.$cur_page.';' 


?>		
	
	
var WIFI=false;
var WIRE=false;
var WIRELESS = false;


function show_and_hide(num){
	  var info = '('+num+'/5)';
    for(var i=1;i<=5;i++){
    	 if(i==num){
    	 	  $('#cur_page').html(info);
    	    $('#d'+i).show(); 	
    	 }else{
    	 	 $('#d'+i).hide(); 
    	 }	
    }		 
}	




function interval() {
    //setInterval(get_all_info, 10000);
}


function get_all_info() {
    $.ajax({
        type: "GET",
        async: true,
        url: 'index.php?ajax=true&act=all&auto=true',
        dataType: "html",
        success: function (resp) {
        	  resp=replace_blank(resp);
            var data;
            try {
                data = eval("(" + resp + ")");
            } catch (e) {
                //alert(e + ' resp:' + resp);
                data = null;
            }
            show_all(data);
            
            if(WIRELESS||WIRE)
                $('#access_nset').hide();
            else
    	          $('#access_nset').show();
    
            if(WIFI)
                $('#wifi_nset').hide();
            else
    	          $('#wifi_nset').show();                
            
            
            
            //finish_loading();
        }
    });

}

function show_all(obj) {
    show_wan(obj);
    show_g(obj);
    show_wifi(obj);
    show_sys_info(obj);
    show_share_media(obj);
	show_share_storage(obj);
	show_u_stat(obj);
	
}
var kk = 0;
function show_wan(obj) {
    if (obj == null) {
        set_null(['wan_link_mode', 'wan_ip', 'wan_link_status', 'wan_rx', 'wan_tx']);
        return;
    }
    obj.wan_link_mode == null ? set_value('wan_link_mode', 'N/A') : set_value('wan_link_mode', obj.wan_link_mode);
    obj.wan_ip == null ? set_value('wan_ip', 'N/A') : set_value('wan_ip', obj.wan_ip );
    //obj.wan_link_status == null ? set_value('wan_link_status', 'N/A') : set_value('wan_link_status', obj.wan_link_status);
    obj.wan_rx == null ? set_value('wan_rx', 'N/A') : set_value('wan_rx', obj.wan_rx);
    obj.wan_tx == null ? set_value('wan_tx', 'N/A') : set_value('wan_tx', obj.wan_tx);
    var mode_id = obj.wan_link_mode_id;
    if((mode_id==null)||(mode_id==1)){ //static或者为空
    	  obj.wan_link_status == null ? set_value('wan_link_status', 'N/A') : set_value('wan_link_status', obj.wan_link_status);
    }else if((mode_id==2)||(mode_id==3)){
    	  //var status_getip= '<span class="load-icon"></span>'+i18n['getting_ip'];
    	  var status_getip= i18n['getting_ip']+'<img src="icon/loading_1.gif" style="height:22px;width:22px;" />';
         var status = obj.wan_link_status_id;
         if(status==1){
         	  WIRE = true;
         }else{
         	  WIRE = false;
         }		
         

        if(!empty(obj.wan_ip)){
    	  	  if((obj.wan_ip=='0')||(obj.wan_ip=='0.0.0.0')){
    	  	  	  set_value('wan_link_status', status_getip);
    	  	  	 // set_value('wan_ip', status_getip);
    	  	  }else{	
    	  	      set_value('wan_link_status', obj.wan_link_status);
    	  	  }
    	  }else{
             if(status==1){
                 set_value('wan_link_status', status_getip);
             }else{
                 set_value('wan_link_status',  obj.wan_link_status);
             }

    	  }		
    }
    
    
    
    
}

function show_g(obj) {
    if (obj == null) {
        set_null(['g_card_status', 'g_sim_status', 'g_op', 'g_signal', 'g_link_status', 'g_link_time', 'g_rx', 'g_tx']);
        return;
    }
    var status_getip= i18n['getting_ip']+'<img src="icon/loading_1.gif" style="height:22px;width:22px;" />';

    obj.g_card_status == null ? set_value('g_card_status', 'N/A') : set_value('g_card_status', obj.g_card_status);
    obj.g_sim_status == null ? set_value('g_sim_status', 'N/A') : set_value('g_sim_status', obj.g_sim_status);
    empty(obj.g_op) ? set_value('g_op', 'N/A') : set_value('g_op', obj.g_op);
    obj.g_signal == null ? set_value('g_signal', 'N/A') : set_signal( obj.g_signal);
    //obj.g_link_status == null ? set_value('g_link_status', 'N/A') : set_value('g_link_status', obj.g_link_status);
    var status = obj.g_link_status_id;
    var ip = obj.g_ip;
    if(status==null){
        set_value('g_link_status', 'N/A')
        WIRELESS=false;
        
    }else if ((status>0)&&(ip==null)){
       set_value('g_link_status', status_getip);
       WIRELESS=false;

   }else if ((status>0)||(ip!=null)){
        set_value('g_link_status', obj.g_link_status);
        WIRELESS=true;

    }else {
        set_value('g_link_status', obj.g_link_status);
        WIRELESS=false;

    }

    //obj.g_link_time == null ? set_value('g_link_time', 'N/A') : set_value('g_link_time', obj.g_link_time);
    obj.g_rx == null ? set_value('g_rx', 'N/A') : set_value('g_rx', obj.g_rx);
    obj.g_tx == null ? set_value('g_tx', 'N/A') : set_value('g_tx', obj.g_tx);
}

function set_signal(val){
	 var icon = '<img style="height:20px;width:25px;margin-bottom:5px;"  src="icon/s'+val+'.png" >'
	 set_value('g_signal', icon);
}	




function show_wifi(obj) {
    if (obj == null) {
        set_null(['wifi_dev_num', 'wifi_gate']);
        return;
    }
    obj.wifi_dev_num == null ? set_value('wifi_dev_num', 'N/A') : set_value('wifi_dev_num', obj.wifi_dev_num);
    obj.wifi_gate == null ? set_value('wifi_gate', 'N/A') : set_value('wifi_gate', obj.wifi_gate);
}

function show_sys_info(obj) {
    if (obj == null) {
        set_null(['sys_type', 'sys_version', 'sys_time']);
        return;
    }
    obj.sys_type == null ? set_value('sys_type', 'N/A') : set_value('sys_type', obj.sys_type);
    obj.sys_version == null ? set_value('sys_version', 'N/A') : set_value('sys_version', obj.sys_version);
    obj.sys_time == null ? set_value('sys_time', 'N/A') : set_value('sys_time', obj.sys_time);
}

var share_media = false;

function show_share_media(obj) {
	  var btn = $('#btn_share_media');
    if (obj == null) {
        share_media = false;
        $("#span_share_media").html('<?php printx('打开媒体','Open Media')?>');
		    $("#media_stat").removeClass().html('<?php printx('未打开','Not Open')?>');
        disable_btn(btn,false);
        return;
    }
    if (obj.share_media=='ok') {
        share_media = 'ok';
        $("#span_share_media").html('<?php printx('关闭媒体','Close Media')?>');
        $("#media_stat").removeClass().addClass('text-green').html('<green><?php printx('已打开','Opened')?></green>');
        disable_btn(btn,false);
        
    } else if (obj.share_media=='loading') {
        share_media = 'loading';
        $("#span_share_media").html('<?php printx('关闭媒体','Close Media')?>');
        $("#media_stat").removeClass().html('<?php printx('打开中..','Loading..')?>');
        disable_btn(btn,true);
      }else if (obj.share_media=='close') {
        share_media = 'close';
      	$("#span_share_media").html('<?php printx('打开媒体','Open Media') ?>');
        $("#media_stat").removeClass().addClass('text-red').html('<?php printx('已关闭','Closed') ?>');
        disable_btn(btn,false);
      
      }
       else  {
      	  share_media = 'fail';
      	  $("#span_share_media").html('<?php printx('打开媒体','Open Media')?>');
          $("#media_stat").removeClass().addClass('text-red').html('<?php printx('','')?>');
          disable_btn(btn,true);
      }	
}



var share_storage = false;

function show_share_storage(obj) {
	  var btn = $('#btn_share_storage');
    if (obj == null) {
        share_storage = false;
        $("#span_share_storage").html('<?php printx('打开存储','Open Storage')?>');
		    $("#store_stat").removeClass().html('<?php printx('未打开','Not Open')?>');
        disable_btn(btn,false);
        return;
    }
    if (obj.share_storage=='ok') {
        share_storage = 'ok';
        $("#span_share_storage").html('<?php printx('关闭存储','Close Storage')?>');
        $("#store_stat").removeClass().addClass('text-green').html('<green><?php printx('已打开','Opened')?></green>');
        disable_btn(btn,false);
        
    } else if (obj.share_storage=='loading') {
        share_storage = 'loading';
        $("#span_share_storage").html('<?php printx('关闭存储','Close Storage')?>');
        $("#store_stat").removeClass().html('<?php printx('打开中..','Loading..')?>');
        disable_btn(btn,true);
      } 
     else if (obj.share_storage=='close') {
        share_storage = 'close';
      	$("#span_share_storage").html('<?php printx('打开存储','Open Storage')?>');
        $("#store_stat").removeClass().addClass('text-red').html('<?php printx('已关闭','Closed') ?>');
        disable_btn(btn,false);
      }       

      
      else  {
      	  share_storage = 'fail';
      	  $("#span_share_storage").html('<?php printx('打开存储','Open Storage')?>');
          $("#store_stat").removeClass().addClass('text-red').html('<?php printx('','')?>');
          disable_btn(btn,true);
      }	
}

var u_insert=false;
function  show_u_stat(obj){
	 var u =$('#u_stat');
	 var media = $('#btn_share_media');var store = $('#btn_share_storage');
	 if ((obj==null)||(obj.u_stat==null)) {
        u.removeClass().addClass('font-red').html('<?php printx('未插入U盘','Flash disc not insert')?>');
        disable_btn(media,true);
        disable_btn(store,true);
        $("#media_stat").html('<?php printx('','')?>');
        $("#store_stat").html('<?php printx('','')?>');
        u_insert=false;
        return;
    }else{
	      u.removeClass().addClass('text-green').html('<?php printx('已插入U盘','Flash disc inserted')?>');
    	  u_insert=true;
    	  //disable_btn(media,false);
        //disable_btn(store,false);
     }	
	
}	





function disable_btn(btn,disable){
	  if(disable){
	  	btn.attr('disabled',disable);
	  	btn.addClass('disabled');
	  }else{
	  	 btn.removeAttr("disabled");
	  	 btn.removeClass('disabled');
	  }		
	
}	








function set_null(id_arr) {
    for (var i = 0; i < id_arr.length; i++) {
        $('#' + id_arr[i]).html('N/A');
    }
}
function set_value(id, value) {
    $('#' + id).html(value);
}

$(document).ready(function () {
	
	 show_and_hide(cur_page);
	 $('#btn_t12').click(function(){show_and_hide(2)});
   $('#btn_t21').click(function(){show_and_hide(1)});
   $('#btn_t23').click(function(){show_and_hide(3)});
   $('#btn_t34').click(function(){show_and_hide(4)});
   $('#btn_t32').click(function(){show_and_hide(2)});
   $('#btn_t43').click(function(){show_and_hide(3)});
   $('#btn_t45').click(function(){show_and_hide(5)});
   $('#btn_t54').click(function(){show_and_hide(4)});	
	
	
    get_all_info();
   setInterval(get_all_info, 5000);
    $("#btn_waset").click(function () {
        location.href = 'waset.php';
    });
    $("#btn_wiset").click(function () {
        location.href = 'wiset.php';
    });
    $("#btn_caset").click(function () {
        location.href = 'caset.php';
    });

    $("#btn_restart").click(function () {
        restart_device();
    });
    $("#btn_recover").click(function () {
        recover_settings();
    });

    $("#btn_share_media").click(function () {
        var confirm_open = i18n['confirm_open_media'];
        var confirm_close = i18n['confirm_close_media'];

        var after_confirm = function () {
		        var btn = $('#btn_share_media');
		        disable_btn(btn,true);
            if (share_media=='ok') {
                $.ajax({
                    type: "GET",
                    async: true,
                    url: 'operation.php?ajax=true&act=close_share_media',
                    dataType: "html",
                    success: function (resp) {
                            show_share_media(null);
                            return;
                    }
                });

            } else if(u_insert==true){
                $.ajax({
                    type: "GET",
                    async: true,
                    url: 'operation.php?ajax=true&act=open_share_media',
                    dataType: "html",
                    success: function (resp) {
                            show_share_media({'share_media': "ok"});
                            return;
                    }
                });
            }
        };
        if (share_media=='ok') {
            confirm(confirm_close, after_confirm,'top');
        }  else if(u_insert==true){
            confirm(confirm_open, after_confirm,'top');
        }

    });
	
	
    $("#btn_share_storage").click(function () {

			var confirm_open = i18n['confirm_open_storage'];
        var confirm_close = i18n['confirm_close_storage'];

        var after_confirm = function () {
		    var btn = $('#btn_share_storage');
		    disable_btn(btn,true);		
            if (share_storage=='ok') {
                $.ajax({
                    type: "GET",
                    async: true,
                    url: 'operation.php?ajax=true&act=close_share_storage',
                    dataType: "html",
                    success: function (resp) {
                            show_share_storage(null);
                           // disable_btn(btn,true);
                            return;
                    }
                });

            } else if(u_insert==true){
                $.ajax({
                    type: "GET",
                    async: true,
                    url: 'operation.php?ajax=true&act=open_share_storage',
                    dataType: "html",
                    success: function (resp) {
                            show_share_storage({'share_storage': "ok"});
                            return;
                    }
                });
            }
        };
        if (share_storage=='ok') {
            confirm(confirm_close, after_confirm,'top');
        }  else if(u_insert==true){
            confirm(confirm_open, after_confirm,'top');
        }

    });	
	
    
    var msg = '<?php  printx('使用网线连接您的便携式路由器和家庭或者宾馆的网络接口以接入互联网','Connect  your router to  Internet interface at home or hotel, using  ethernet wire  ')  ?>';
    set_help('help_wan',msg);
    
    
    msg = '<?php  printx('您的手机或PC通过WIFI连接到路由器，访问互联网或者本地共享的资源','Connect  your telephone or PC  to the router with WIFI to visit internet or local shared resources')  ?>';
    set_help('help_wifi',msg);

    msg = '<?php  printx('通过运营商提供的无线上网卡接入互联网，设置前请先将上网卡插入USB卡槽','Access Internet by using wireless card provided by the carrier, please insert the card to the USB interface before setting it')  ?>';
    set_help('help_3g',msg);


    msg = '<?php  printx('将USB存储插入到路由器并打开资源共享， 您的终端可以通过WIFI网络访问到USB存储中的内容','Insert your USB device to the  rounter and open resouce share, your terminal can visit the content of USB device by the WIFI network')  ?>';

    set_help('help_share',msg);
    heart_beat(5000);
    

    


});





</script>

    
<?php include 'confirm.php'?>

</body>
</html>
