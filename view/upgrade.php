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
                   <?php printx('无线上网卡升级','Wireless card upgrade')?>
                </h1>


                <div class='row'>
                    <div class="span10">
                        <div class="widget">

                            <div class="widget-header">
                                <h3><?php printx('上传文件','Upload File')?></h3>
                            </div>
                            <!-- /widget-header -->


                            <div class="widget-content"  style='padding:0px;'>


                                <iframe src='cardup.php?act=iframe' id="frame"  name="frame" style="width:100%;height:100%;border:none;"   frameborder="no" border="0" >
                       
                                </iframe>
                                

                                        


                                        <div class="form-actions">
                                            <input id='btn_submit' type='button' class="btn btn-primary" value='<?php printx('上传','Upload')?>'>
                                            <button id='btn_back' type="button"   class="btn"  > <i class='icon-arrow-up'> </i> <?php  printx('3G/4G无线接入设置','3G/4G Wireless Access Config') ?> </button>
                                          <div>
                                                <!-- /form-actions -->
                                    </fieldset>

                               
                                

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








function submit(){  
    	  try{
    	  	 //if(!check_form('form1')) return;
              clear_message();

             confirm('<?php printx('是否确定上传并升级?','Are you sure to upload and upgrade?') ?>' ,upload_form) ;
        }catch(e){alert(e);} 	 	   

}

function   upload_form(){
	        
           show_loading("<?php printx('正在上传，请稍候...','Uploading now, please wait...') ?>");
            $(window.frames["frame"].document).find("#finish_tag").val('false');
           var  up = $(window.frames["frame"].document).find("#upload");
           up.submit();
           
           var interval_id;
           var is_finished = function(){
           	
           	 if( $(window.frames["frame"].document).find("#finish_tag").val()=='true'){
           	 	   finish_loading();
           	 	   window.clearInterval(interval_id);
                 var file = $(window.frames["frame"].document).find("#file_path").val();
                 window.location.href = 'upgrading_card.php?fpath='+file;
           	 }
          }
            
         interval_id=  setInterval(is_finished, 2000);

}


    $(document).ready(function () {
    	
    	
    	
        $('#btn_back').click(function(){location.href='caset.php<?php echo_lang() ?>'});

        $("#btn_submit").click(submit);
        heart_beat(5000);



    });


</script>


</body>
</html>
