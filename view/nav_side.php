<?php if(!is_mobile()){  ?>

<ul id="main-nav" class="nav nav-tabs nav-stacked">

    <li<?php echo_active(array('index.php')) ?>>
        <a href="index.php<?php echo_lang() ?>">
            <i class="icon-home"></i>
            <?php printx('主页','Home')?>
        </a>
    </li>

    <li<?php echo_active(array('waset.php')) ?>>
        <a href="waset.php<?php echo_lang() ?>">
            <i class="icon-pushpin"></i>
            <?php printx('有线接入设置','Wire Access')?>
        </a>
    </li>

    <li<?php echo_active(array('caset.php','cardup.php')) ?>>
        <a href="caset.php<?php echo_lang() ?>">
            <i class="icon-random"></i>
            <?php printx('无线接入设置','Wireless Access')?>
        </a>
    </li>

    <li<?php echo_active(array('wiset.php','dhcpset.php','dev.php')) ?>>
        <a href="wiset.php<?php echo_lang() ?>">
            <i class="icon-signal"></i>
            <?php printx('WIFI设置','WIFI Config')?>
            <!--span class="label label-warning pull-right">5</span-->
        </a>
    </li>

    <li<?php echo_active(array('changepwd.php')) ?>>
        <a href="changepwd.php<?php echo_lang() ?>">
            <!--img src="img/wire.gif" style="width:15px;height:14px;"> <span>&nbsp;&nbsp; </span-->
            <i class="icon-check"></i>
            <?php printx('更改密码','Change PWD')?>
        </a>
    </li>

    <li>
        <a href="#"  onclick='javascript:logout()'>
            <i class="icon-user"></i>
            <?php printx('注销用户','User Logout')?>
        </a>
    </li>

     <?php if(!is_mobile()){  ?>
    <li<?php echo_active(array('sysup.php')) ?>>
        <a href="sysup.php<?php echo_lang() ?>">
            <i class="icon-upload"></i>
            <?php printx('系统升级','System Upgrade')?>
        </a>
    </li>
    <?php }  ?>


    <li>
        <a href="javascript:restart_device()">
            <i class="icon-off"></i>
            <?php printx('重启设备','Device Reboot')?>
        </a>
    </li>


</ul>

<!--hr /-->





<div class="sidebar-extra">
    <p></p>
</div> <!-- .sidebar-extra -->

<br />

<?php  }  ?>