<!DOCTYPE html>
<html lang="zh">
<head>
    <!---------------------------header start----------------------------->
    <?php include 'header.php'?>
    <!---------------------------header end----------------------------->

</head>

<body>
<div id='d_msg'>
</div>

<form id="upload" class="form-horizontal" method="post" enctype="multipart/form-data" action="cardup.php?act=upload">
    


    <fieldset>

        <div class="control-group" id='cg_upfile'>
            <!--label class="control-label" for=""><?php printx('选择版本','Select Version')?></label-->

            <div class="controls">
			<BR> <BR> 
                <input type="file" name="upfile" id="upfile" class="input-large">
                <!--p class="help-block"></p-->
            </div>
        </div>

        <input type='hidden' id='finish_tag'>
        <input type='hidden' id='status'>
        <input type='hidden' id='file_path'>


        <!-- /form-actions -->
    </fieldset>

</form>


<script src="res/js/jquery-1.7.2.min.js"></script>

<script src="res/js/bootstrap.js"></script>
<script type="text/javascript">

    $(document).ready(function () {

        <?php

          global  $msg;
          global $absolute_file;
          if(!empty($msg)){
             $content= $msg['content'];
             $type= $msg['type'];
              echo  "show_message('$content',$type);";
              echo  "$('#status').val('$content');";
              echo  "$('#file_path').val('$absolute_file');";

          }

        ?>


        $('#finish_tag').val('true');


    });


</script>


</body>
</html>
