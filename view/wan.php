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
                     <span id='i18n_wire_access_conf'><?php printx('有线接入设置','Wire Access Config') ?> </span>
                </h1>


                <div class='row'>
                    <div class="span10">
                        <div class="widget">

                            <div class="widget-header">
                                <h3><?php printx('设置参数','Parameters') ?></h3>
                            </div>
                            <!-- /widget-header -->


                            <div class="widget-content">

                                <div id='d_msg'>
                                </div>


                                <form id="frm" class="form-horizontal">
                                    <fieldset>


                                        <div class="control-group" id='cg_link_mode' >
                                            <label class="control-label" for="link_mode"><?php printx('连接方式','Link Mode') ?></label>

                                            <div class="controls">
                                                    <select id="link_mode" name="link_mode"  rule="notnull" >
                                                    	<option value="" selected></option>
                                                        <option value="1"><?php printx('手动指定IP地址','Static IP') ?></option>
                                                        <option value="2" ><?php printx('自动获取IP地址','Auto Get IP') ?></option>
                                                        <option value="3"><?php printx('虚拟拨号(PPPOE)','PPPOE') ?></option>
                                                    </select> *
                                                <!--p class="help-block"></p-->

                                            </div>
                                        </div>
                                        <div style="border: 1px dashed #d3d3d3;"></div>
                                        <br>
                                        <div class="control-group"   id='cg_smode_ip'>
                                            <label class="control-label" for="smode_ip">IP</label>

                                            <div class="controls">
                                                <input type="text" class="input-large" id="smode_ip" name="smode_ip"   rule="notnull,ip" > *

                                                <!--p class="help-block"></p-->
                                            </div>
                                        </div>

                                        <div class="control-group"   id='cg_gate_ip'>
                                            <label class="control-label" for="gate_ip"><?php printx('网关地址','Gate Way') ?></label>

                                            <div class="controls">
                                                <input type="text" class="input-large" id="gate_ip" name="gate_ip"  rule="notnull,ip"
                                                       value="" > *
                                                <!--p class="help-block"></p-->
                                            </div>
                                        </div>

                                        <div class="control-group"   id='cg_mask'>
                                            <label class="control-label" for="mask"><?php printx('子网掩码','Mask') ?></label>

                                            <div class="controls">
                                                <input type="text" class="input-large" id="mask" name="mask"    rule="notnull,mask"
                                                       value="255.255.255.0" > *
                                                <!--p class="help-block"></p-->
                                            </div>
                                        </div>





                                        <div class="control-group"   id='cg_dns_server1'>
                                            <label class="control-label" for="dns_server1"><?php printx('主选DNS','First DNS') ?></label>

                                            <div class="controls">
                                                <input type="text" class="input-large" id="dns_server1" name="dns_server1"
                                                       value="" >
                                                <!--p class="help-block"></p-->
                                            </div>
                                        </div>


                                        <div class="control-group"   id='cg_dns_server2'>
                                            <label class="control-label" for="dns_server2"><?php printx('备选DNS','Second DNS') ?></label>

                                            <div class="controls">
                                                <input type="text" class="input-large" id="dns_server2"   name="dns_server2"   
                                                       value="" >
                                                <!--p class="help-block"></p-->
                                            </div>
                                        </div>


                                        <div class="control-group"   id='cg_pmode_name'>
                                            <label class="control-label" for="pmode_name"><?php printx('用户名','User Name') ?></label>

                                            <div class="controls">
                                                <input type="text" class="input-large" id="pmode_name" name="pmode_name"      rule="notnull,len[3-10]"
                                                       value="" > *
                                                <!--p class="help-block"></p-->
                                            </div>
                                        </div>


                                        <div class="control-group"   id='cg_pmode_pwd'>
                                            <label class="control-label" for="pmode_pwd"><?php printx('密码','Password') ?></label>

                                            <div class="controls">
                                                <input type="text" class="input-large" id="pmode_pwd" name="pmode_pwd"      rule="notnull,len[6-10]"
                                                       value="" > *
                                                <!--p class="help-block"></p-->
                                            </div>
                                        </div>







                                        <br>


                                        <div class="form-actions">
                                            <input  id='btn_submit' type='button' class="btn btn-primary" value='<?php printx('提交','Apply') ?>'>
                                            <!--input  id='btn_reset' type='button' class="btn" value='重设'-->
                                            <!--a href="#top" id="goTop"> 返 回 顶 部 </a-->
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

    function hide_show_all(hide,id_arr){
        for(var i=0;i<id_arr.length;i++){
            var id = id_arr[i];
           // alert(id_arr[i]);
            if(hide){
            	  set_meta_attr(id,'status','uncheck','form1');
                $('#cg_'+id).hide();
            }else{
            	  set_meta_attr(id,'status','check','form1');
            	  $('#'+id).attr('status','check','form1');
                $('#cg_'+id).show();
            }
        }
    }

    function after_init(){
        $('#mask').val(num2mask($('#mask').val()));
        change_link_mode();
    }




    function  change_link_mode(){
        var mode = $('#link_mode').val();
        if(mode=='1'){ //static IP
            hide_show_all(false,['smode_ip','mask','gate_ip','dns_server1','dns_server2']);
            hide_show_all(true,['pmode_name','pmode_ip','pmode_pwd']);
        }else if (mode == '2'){
            hide_show_all(true,['smode_ip','mask','gate_ip','dns_server1','dns_server2','pmode_name','pmode_ip','pmode_pwd']);
        }else if (mode == '3'){
            hide_show_all(true,['smode_ip','mask','gate_ip','dns_server1','dns_server2']);
            hide_show_all(false,['pmode_name','pmode_ip','pmode_pwd']);
        }else if (mode == ''){
            hide_show_all(true,['smode_ip','mask','gate_ip','dns_server1','dns_server2','pmode_name','pmode_ip','pmode_pwd']);
        }

    }
    
    function  submit(){
    	  var para = {'act': 'update', 'ajax': 'true'};
    	  var opt = {debug:'false',load_msg:'<?php printx('正在设置，请稍候...','Setting now, please wait...') ?>',create_param: function (param) {
            param.mask2num= mask2num(trim($('#mask').val()));
            return param;
        }};
    	  
    	  var obj = {form_id:'form1',url:"waset.php",param:para,option:opt};
    	  try{
    	  	 if(!check_form('form1')) return;
             confirm('<?php printx('是否确定更改设置?','Are you sure to change the config?') ?>' ,submit_form, obj) ;
        }catch(e){alert(e);} 	  
    }
    var meta_info =new Array();
    meta_info['form1'] = [
        {id:"link_mode",rule:"notnull",status:""}, 	
        {id:"smode_ip",rule:"notnull,ip"}, 	
        {id:"mask",rule:"notnull,mask"}, 	
        {id:"gate_ip",rule:"notnull,ip"}, 	
        {id:"dns_server1",rule:""}, 	
        {id:"dns_server2",rule:""}, 	
        {id:"pmode_name",rule:"notnull,len[1-10]"}, 	
        {id:"pmode_pwd",rule:"notnull,len[1-10]"}
    ];


    $(document).ready(function () {
        init_form('waset.php?ajax=true',after_init,'form1');
        $('#link_mode').change(change_link_mode);
        $("#btn_back").click(function(){location.href='index.php?page=1';})
        $('#btn_submit').click(submit);
        heart_beat(5000);

    });




</script>



</body>
</html>
