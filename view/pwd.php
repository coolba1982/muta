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
                     <?php printx('更改密码','Reset Password')?>
                </h1>


                <div class='row'>
                    <div class="span10">
                        <div class="widget">

                            <div class="widget-header">
                                <h3><?php printx('重置密码','Reset Password')?></h3>
                            </div>
                            <!-- /widget-header -->


                            <div class="widget-content">

                                <div id='d_msg'>
                                </div>


                                <form id="edit-profile" class="form-horizontal">
                                    <fieldset>


                                        <div class="control-group" id='cg_old_pwd'>
                                            <label class="control-label" for="old_pwd"><?php printx('旧的密码','Old Password')?></label>

                                            <div class="controls">
                                                <input type='hidden' id='pwd' >
                                                <input type="password" class="input-large" id="old_pwd"
                                                       value=""> *
                                                <!--p class="help-block"></p-->
                                            </div>
                                        </div>

                                        <div class="control-group" id='cg_new_pwd'>
                                            <label class="control-label" for="new_pwd"><?php printx('新的密码','New Password')?></label>

                                            <div class="controls">
                                                <input type="password" class="input-large" id="new_pwd"
                                                       value=""> *
                                                <p class="help-block"> <?php printx('长度限制 5~63个字符，包含字母和数字','Size range 5-63, comprise of letters and numbers') ?>   </p>
                                            </div>
                                        </div>


                                        <div class="control-group" id='cg_repeat_pwd'>
                                            <label class="control-label" for="repeat_pwd"><?php printx('确认密码','Confirm Password')?></label>

                                            <div class="controls">
                                                <input type="password" class="input-large" id="repeat_pwd"
                                                       value=""> *
                                                <!--p class="help-block"></p-->
                                            </div>
                                        </div>




                                        <br>


                                        <div class="form-actions">
                                            <input id='btn_submit' type='button' class="btn btn-primary" value='<?php printx('提交','Apply')?>'>
                                            <!--input id='btn_back' type='button' class="btn" value='返回WIFI设置'-->

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





    function submit() {
        var para = {'act': 'update', 'ajax': 'true'};
        var opt = {debug: 'false', load_msg: '<?php printx('正在更改密码','Changing password now...')?>', create_param: function (param) {

            return param;
        }};
        var obj = {form_id:'form1',url: "changepwd.php", param: para, option: opt};
        try {

            if (!check_form('form1')) return;

//            if($('#old_pwd').val()!=$('#pwd').val()){
//                clear_all();
//                show_error('输入密码不正确','old_pwd');
//                return ;
//            }
            var pwd = $('#new_pwd').val();
            var r_pwd = $('#repeat_pwd').val();
            if(pwd!=r_pwd){
                clear_all();
                show_message('<?php printx('两次输入的密码不一致','Twice password input is inconsistent')?>',MSG_ERROR);
                return ;
            }
            confirm('<?php printx('是否确定更改密码?','Are you sure to change the password?')?>', submit_form, obj);
        } catch (e) {
            //alert(e);
        }
    }

    var meta_info =new Array();
    meta_info['form1'] =[
        {id: "old_pwd", rule: "notnull,char", status: ""},
        {id: "new_pwd", rule: "notnull,char,pwd1"},
        {id: "repeat_pwd", rule: "notnull,char,pwd1"},
        {id: "pwd", status:'uncheck'}

    ];





    $(document).ready(function () {
        //init_form('dhcpset.php?ajax=true',null,'form1');
        $('#btn_submit').click(submit);
        //$('#btn_back').click(function(){location.href='wiset.php'});
        heart_beat(5000);

    });


</script>


</body>
</html>
