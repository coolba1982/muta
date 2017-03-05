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


<div class="span10">

<h1 class="page-title">
    <i class="icon-th-large"></i>
    <?php printx('接入WIFI的终端','Devices Connected WIFI')  ?>
</h1>

    <?php include 'confirm.php'?>
	
	    <?php include 'modal.php'?>



    <div>
  

        <div>



            
                
                  

                      

                        

                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th> <?php printx('MAC地址','MAC Address')  ?>  </th>
                                    <th> <?php printx('IP地址','IP Address')  ?></th>
                                    <th> <?php printx('设备名称','Device Name')  ?></th>
                                    <th> <?php printx('操作','Operation')  ?></th>
                                </tr>
                                </thead>

                                <tbody  id = 'tb'>



                                </tbody>
                            </table>

                     


                           
                        

               

          







            </div>

           <div class="form-actions">
            <button id='btn_refresh' type="button"   class="btn"  > <i class='icon-refresh'> </i> <?php  printx('刷新','Refresh') ?> </button>
            <button id='btn_back' type="button"   class="btn"  > <i class='icon-arrow-up'> </i> <?php  printx('WIFI设置','WIFI Configs') ?> </button>
            <button id='btn_home' type="button"   class="btn"  > <i class='icon-home'> </i> <?php  printx('主页','Home') ?> </button>

            <div>


        </div>


    </div>



























</div>
<!-- /span12 -->



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

    function load_dev() {
	    //show_loading();
        $.ajax({
            type: "GET",
            async: true,
            url: "dev.php",
            data: {'act': 'list', 'ajax': 'true'},
            dataType: "html",
            success: function (data) {
                $('#tb').html(data);
				//finish_loading();
            }
        });
    }

    function  disconnect(mac){
        var dc =function(){
            $.ajax({
                type: "POST",
                async: true,
                url: "operation.php?act=kick&ajax=true",
                dataType: "html",
                data:{"mac":mac},
                success: function (resp) {
                    if(empty(resp)){
                        load_dev();
                        return;
                    }
                    var data;
                    try {
                        data = eval("(" + resp + ")");
                    } catch (e) {
                        alert(e + ' resp:' + resp);
                    }
                    if(!empty(data.msg)){
                        alert(data.msg.content);
                        return;
                    }else{
                        location.href="dev.php";
                    }
                }
            });
        }
        confirm(i18n['sure_to_kick'], dc, mac);
    }








    $(document).ready(function () {
        load_dev();

        $("#btn_home").click(function(){location.href='index.php?page=3';})
        $("#btn_back").click(function(){location.href='wiset.php';})
		
		$("#btn_refresh").click(function(){
		
		    load_dev();
		
		})

        heart_beat(5000);

    });


</script>



</body>
</html>
