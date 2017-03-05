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
                    <?php printx('无线接入设置','Wireless Access Config') ?>
                </h1>


                <div class='row'>
                    <div class="span10">
                        <div class="widget">

                            <div class="widget-header">
                                <h3><?php printx('参数','Parameters') ?></h3>
                            </div>
                            <!-- /widget-header -->


                            <div class="widget-content">

                                <div id='d_msg'>
                                </div>


                                <form id="edit-profile" class="form-horizontal">
                                    <fieldset>




                                        <div class="control-group" id='cg_dial_way'>
                                            <label class="control-label" for="dial_way"><?php printx('拨号方式','Dial Way')?></label>

                                            <div class="controls">
                                                <select id="dial_way">
                                                    <option value=""></option>
                                                    <option value="1"><?php printx('上网时自动连接','Auto connect')?></option>
                                                    <option value="2"><?php printx('始终在线','Always online')?></option>
                                                    <option value="3"><?php printx('人工拨号','Dial manually')?></option>
                                                </select> *
                                                <!--p class="help-block"></p-->
                                            </div>
                                        </div>


                                        <div class="control-group" id='cg_leisure_time'>
                                            <label class="control-label" for="leisure_time"><?php printx('最长空闲时间','Max Leisure Time')?></label>

                                            <div class="controls">
                                                <input type="text" class="input-large" id="leisure_time"
                                                       value="">*
                                                <p class="help-block"><?php printx('超过最长空闲时间会自动断开连接,取值范围1-300秒','Auto disconnect after the max leisure time, which is on the range of 1-300s')?></p>
                                            </div>
                                        </div>

                                        <div class="control-group" id='cg_dial_intval'>
                                            <label class="control-label" for="dial_intval"><?php printx('最长断开时间','Max Disconnected Time')?></label>

                                            <div class="controls">
                                                <input type="text" class="input-large" id="dial_intval"
                                                       value=""> *
                                                <p class="help-block"><?php printx('超过最长断开时间会自动连接,取值范围1-300秒','Auto connect after the max disconnected time, which is on the range of 1-300s')?></p>
                                            </div>
                                        </div>





                                        <!--div class="control-group" id='cg_link_status'>
                                            <label class="control-label" for="link_status"><?php printx('连接状态','Link Status')?></label>

                                            <div class="controls">
                                                <select id="link_status">
                                                    <option value=""></option>
                                                    <option value="1"><?php printx('连接','Connected')?></option>
                                                    <option value="0"><?php printx('断开','Disconnected')?></option>
                                                </select> *

                                            </div>
                                        </div-->




                                        <br>


                                        <div class="form-actions">
                                            <input id='btn_submit' type='button' class="btn btn-primary" value='<?php printx('提交','Apply')?>'>
                                            
                                            <?php if(!is_mobile()){  ?>
                                            <button id='btn_up' type="button"   class="btn"  > <i class='icon-arrow-down'> </i> <?php printx('无线上网卡升级','Wireless Card Upgrade')?> </button>
                                             <?php  }  ?>
                                            <button id='btn_home' type="button"   class="btn"  > <i class='icon-home'> </i> <?php printx('主页','Home')?> </button>

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

    function hide_or_show() {
        var dial_way = $('#dial_way').val();
        if(dial_way=='1'){
            $('#cg_dial_intval').hide();
            $('#cg_leisure_time').show();
            set_meta_attr('dial_intval', 'status', 'uncheck','form1');  //设置为check的会自动进行验证
            set_meta_attr('leisure_time', 'status', 'check','form1');
        }else if(dial_way=='2'){
            $('#cg_dial_intval').show();
            $('#cg_leisure_time').hide();
            set_meta_attr('dial_intval', 'status', 'check','form1');  //设置为check的会自动进行验证
            set_meta_attr('leisure_time', 'status', 'uncheck','form1');
        }else{
            $('#cg_dial_intval').hide();
            $('#cg_leisure_time').hide();
            set_meta_attr('dial_intval', 'status', 'uncheck','form1');  //设置为check的会自动进行验证
            set_meta_attr('leisure_time', 'status', 'uncheck','form1');
        }

    }




    function submit() {
        var para = {'act': 'update', 'ajax': 'true'};
        var opt = {debug: 'false', load_msg: '<?php printx('正在进行数据卡设置','Setting data card now...')?>', create_param: function (param) {

            return param;
        }};
        var obj = {form_id:'form1',url: "caset.php", param: para, option: opt};
        try {
            if (!check_form('form1')) return;
            confirm('<?php printx('是否确定更改设置?','Are you sure to change configs?') ?>', submit_form, obj);
        } catch (e) {
            alert(e);
        }
    }

    var meta_info =new Array();
    meta_info['form1'] =[
        {id: "dial_way", rule: "notnull", status: ""},
        {id: "dial_intval", rule: "notnull,range[1-300]"},
        {id: "leisure_time", rule: "notnull,range[1-300]"}
        //{id: "link_status", rule: "notnull"}
    ];





    $(document).ready(function () {

        init_form('caset.php?ajax=true',hide_or_show,'form1');
        $('#dial_way').change(hide_or_show);
        $('#btn_submit').click(submit);
       $('#btn_up').click(function(){location.href='cardup.php'});
        $("#btn_home").click(function(){location.href='index.php?page=2';})

       
        heart_beat(5000);


    });


</script>






</body>
</html>
