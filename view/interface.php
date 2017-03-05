<!DOCTYPE html>
<html lang="zh">
<head>
    <!---------------------------header start----------------------------->
    <?php include 'header.php'?>
    <!---------------------------header end----------------------------->
    <style type="text/css">

        div.plan-features{ padding:20px;}

    </style>

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
                      <?php printx('接口信息','Interface Info') ?>
                </h1>


                <div class='row'>
                    <div class="span10">
                        <div class="widget">

                            <div class="widget-header">
                                <h3> <?php printx('接口信息','Interface Info') ?></h3>
                            </div>
                            <!-- /widget-header -->

                            <div class="widget-content">

                                <div class="pricing-plans plans-3">



                                    <div class="plan-container">
                                        <div class="plan orange">
                                            <div class="plan-header">

                                                <div class="plan-title">
                                                    <?php printx('有线接口','Wire Interface') ?>
                                                </div>
                                            </div>
                                            <!-- /plan-header -->

                                            <div class="plan-features">
                                                <!--ul>
                                                    <li style="text-align:left;"><strong>连接状态:</strong> <span>test</span></li>
                                                    <li style="text-align:left;"><strong>网络地址:</strong> <span>test</span></li>
                                                    <li style="text-align:left;"><strong>接收速率:</strong> <span>test</span></li>
                                                    <li style="text-align:left;"><strong>发送速率:</strong> <span>test</span></li>
                                                </ul-->
                                                <p><strong><?php printx('连接状态:','Link Status:') ?></strong> <span id='link_status_1' >N/A</span> </p>
                                                <p><strong><?php printx('网络地址:','IP Address:') ?></strong> <span id='ip_1'>N/A</span> </p>
                                                <p><strong><?php printx('接受速率:','Acceptance Rate:') ?></strong> <span id='rx_1'>N/A</span> </p>
                                                <p><strong><?php printx('发送速率:','Sending Rate:') ?></strong> <span id='tx_1'>N/A</span></p>
                                                <p><strong><?php printx('接受字节:','Acceptance Bytes:') ?></strong> <span id='rx_t_1'>N/A</span> </p>
                                                <p><strong><?php printx('发送字节:','Sending Bytes:') ?></strong> <span id='tx_t_1'>N/A</span></p>


                                            </div>
                                            <!-- /plan-features -->

                                            <div class="plan-actions">
                                                <!--a href="javascript:;" class="btn"></a-->
                                            </div>
                                            <!-- /plan-actions -->

                                        </div>
                                        <!-- /plan -->
                                    </div>
                                    <!-- /plan-container -->


                                    <div class="plan-container">
                                        <div class="plan orange">
                                            <div class="plan-header">

                                                <div class="plan-title">
                                                     <?php printx('3G/4G上网卡接口','3G/4G Data Card Interface') ?>
                                                </div>
                                            </div>
                                            <!-- /plan-header -->

                                            <div class="plan-features">
                                                <p><strong><?php printx('连接状态:','Link Status:') ?></strong> <span id='link_status_2' >N/A</span> </p>
                                                <p><strong><?php printx('网络地址:','IP Address:') ?></strong> <span id='ip_2'>N/A</span> </p>
                                                <p><strong><?php printx('接受速率:','Acceptance Rate:') ?></strong> <span id='rx_2'>N/A</span> </p>
                                                <p><strong><?php printx('发送速率:','Sending Rate:') ?></strong> <span id='tx_2'>N/A</span></p>
                                                <p><strong><?php printx('接受字节:','Acceptance Bytes:') ?></strong> <span id='rx_t_2'>N/A</span> </p>
                                                <p><strong><?php printx('发送字节:','Sending Bytes:') ?></strong> <span id='tx_t_2'>N/A</span></p>
                                            </div>
                                            <!-- /plan-features -->

                                            <div class="plan-actions">
                                                <!--a href="javascript:;" class="btn"></a-->
                                            </div>
                                            <!-- /plan-actions -->

                                        </div>
                                        <!-- /plan -->
                                    </div>
                                    <!-- /plan-container -->



                                    <div class="plan-container">
                                        <div class="plan orange">
                                            <div class="plan-header">

                                                <div class="plan-title">
                                                    <?php printx('WIFI接口','WIFI Interface') ?>
                                                </div>
                                            </div>
                                            <!-- /plan-header -->

                                            <div class="plan-features">
                                                <p><strong><?php printx('连接状态:','Link Status:') ?></strong> <span id='link_status_3' >N/A</span> </p>
                                                <p><strong><?php printx('网络地址:','IP Address:') ?></strong> <span id='ip_3'>N/A</span> </p>
                                                <p><strong><?php printx('接受速率:','Acceptance Rate:') ?></strong> <span id='rx_3'>N/A</span> </p>
                                                <p><strong><?php printx('发送速率:','Sending Rate:') ?></strong> <span id='tx_3'>N/A</span></p>
                                                <p><strong><?php printx('接受字节:','Acceptance Bytes:') ?></strong> <span id='rx_t_3'>N/A</span> </p>
                                                <p><strong><?php printx('发送字节:','Sending Bytes:') ?></strong> <span id='tx_t_3'>N/A</span></p>
                                            </div>
                                            <!-- /plan-features -->

                                            <div class="plan-actions">
                                                <!--a href="javascript:;" class="btn"></a-->
                                            </div>
                                            <!-- /plan-actions -->

                                        </div>
                                        <!-- /plan -->
                                    </div>
                                    <!-- /plan-container -->





                                </div>
                                <!-- /pricing-plans -->

                            </div>


                            <!-- /widget-content -->

                            <div class="form-actions">
                                 <button id='btn_back' type="button"   class="btn"  > <i class='icon-home'> </i> <?php  printx('首页','Home') ?> </button>
                            <div>



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


//            function interval() {
//                setInterval(get_all_info, 10000);
//            }


            function get_all_info(){
                $.ajax({
                    type: "GET",
                    async: true,
                    url: 'inter.php?ajax=true&act=all',
                    dataType: "html",
                    success: function (resp) {
                        var data;
                        try {
                            data = eval("(" + resp + ")");
                        } catch (e) {
                            //alert(e + ' resp:' + resp);
                            data =null;
                        }
                        show_all(data);
                        //finish_loading();
                    }
                });

            }

            function  show_all(obj){
                show_wan(obj);
                show_g(obj);
                show_wifi(obj);
                //show_sys_info(obj);
            }
            function  show_wan(obj){
                if(obj==null){
                    set_null(['link_status_1','ip_1','rx_1','tx_1','rx_t_1','tx_t_1']);
                    return ;
                }
                obj.link_status_1==null?set_value('link_status_1','N/A'):set_value('link_status_1',obj.link_status_1);
                obj.ip_1==null?set_value('ip_1','N/A'):set_value('ip_1',obj.ip_1);
                obj.rx_1==null?set_value('rx_1','N/A'):set_value('rx_1',obj.rx_1+'<?php printx('千比特/秒','kb/s')  ?>');
                obj.tx_1==null?set_value('tx_1','N/A'):set_value('tx_1',obj.tx_1+'<?php printx('千比特/秒','kb/s')  ?>');
                obj.rx_t_1==null?set_value('rx_t_1','N/A'):set_value('rx_t_1',obj.rx_t_1+'<?php printx('字节','KB')  ?>');
                obj.tx_t_1==null?set_value('tx_t_1','N/A'):set_value('tx_t_1',obj.tx_t_1+'<?php printx('字节','KB')  ?>');

            }

            function  show_g(obj){
                if(obj==null){
                    set_null(['link_status_2','ip_2','rx_2','tx_2','rx_t_2','tx_t_2']);
                    return ;
                }
                obj.link_status_2==null?set_value('link_status_2','N/A'):set_value('link_status_2',obj.link_status_2);
                obj.ip_2==null?set_value('ip_2','N/A'):set_value('ip_2',obj.ip_2);
                obj.rx_2==null?set_value('rx_2','N/A'):set_value('rx_2',obj.rx_2+'<?php printx('千比特/秒','kb/s')  ?>');
                obj.tx_2==null?set_value('tx_2','N/A'):set_value('tx_2',obj.tx_2+'<?php printx('千比特/秒','kb/s')  ?>');
                obj.rx_t_2==null?set_value('rx_t_2','N/A'):set_value('rx_t_2',obj.rx_t_2+'<?php printx('字节','KB')  ?>');
                obj.tx_t_2==null?set_value('tx_t_2','N/A'):set_value('tx_t_2',obj.tx_t_2+'<?php printx('字节','KB')  ?>');
            }
            function  show_wifi(obj){
                if(obj==null){
                    set_null(['link_status_3','ip_3','rx_3','tx_3','rx_t_3','tx_t_3']);
                    return ;
                }
                obj.link_status_3==null?set_value('link_status_3','N/A'):set_value('link_status_3',obj.link_status_3);
                obj.ip_3==null?set_value('ip_3','N/A'):set_value('ip_3',obj.ip_3);
                obj.rx_3==null?set_value('rx_3','N/A'):set_value('rx_3',obj.rx_3+'<?php printx('千比特/秒','kb/s')  ?>');
                obj.tx_3==null?set_value('tx_3','N/A'):set_value('tx_3',obj.tx_3+'<?php printx('千比特/秒','kb/s')  ?>');
                obj.rx_t_3==null?set_value('rx_t_3','N/A'):set_value('rx_t_3',obj.rx_t_3+'<?php printx('字节','KB')  ?>');
                obj.tx_t_3==null?set_value('tx_t_3','N/A'):set_value('tx_t_3',obj.tx_t_3+'<?php printx('字节','KB')  ?>');
            }


            function set_null(id_arr){
                for(var i=0;i<id_arr.length;i++){
                    $('#'+id_arr[i]).html('N/A');
                }
            }
            function set_value(id,value){
                $('#'+id).html(value);
            }

            $(document).ready(function () {
                get_all_info();
                setInterval(get_all_info, 10000);
                $("#btn_back").click(function(){location.href='index.php?page=5';})
                heart_beat(5000);


            });
        </script>






</body>
</html>
