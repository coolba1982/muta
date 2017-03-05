<div class="navbar navbar-fixed-top">

    <div class="navbar-inner">

        <div class="container">

            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <!--a class="brand" href="#">   <img src="img/logo.png" alt=""  style='width:50px;height:24px;'/> &nbsp;<?php printx('SIN DR-100','SIN DR-100') ?></a-->

            <div class="nav-collapse">

            <ul class="nav pull-right">

    <li>
        <a href="index.php<?php echo_lang() ?>"  >
            <i class="icon-home"></i>
            <?php printx('主页','Home')?>
        </a>
    </li>
    
                    <li class="divider-vertical"></li>

                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle " href="#">
                        	  <i class='icon-cog'> </i>

                            <?php printx('网络设置','Network Settings')?><b class="caret"></b>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="waset.php<?php echo_lang() ?>"> <?php printx('有线接入设置','Wire Access')?> </a>
                            </li>
                            
                              <li class="divider"></li>


                            <li>
                                <a href="caset.php<?php echo_lang() ?>"> <?php printx('无线接入设置','Wireless Access')?></a>
                            </li>
                           
                            <?php if(!is_mobile()){  ?>
                            <li>
                                <a href="cardup.php<?php echo_lang() ?>"> <?php printx('无线模块升级','Wireless Module Upgrade')?></a>
                            </li>                            
                            <?php }  ?>
                            

                            <li class="divider"></li>

                            <li>
                                <a href="wiset.php<?php echo_lang() ?>"> <?php printx('WIFI设置','WIFI Config')?></a>
                            </li>

                            <li>
                                <a href="dhcpset.php<?php echo_lang() ?>"> <?php printx('WIFI DHCP设置','WIFI DHCP Config')?></a>
                            </li>                            
                            
                            <li>
                                <a href="dev.php<?php echo_lang() ?>"> <?php printx('WIFI设备管理','Device Connected to WIFI')?></a>
                            </li>    
                            
                            
                        </ul>
                    </li>    
                    
                   <li class="divider-vertical"></li>

                    
                    <li class="dropdown">

                        <a data-toggle="dropdown" class="dropdown-toggle " href="#"  id='pos_home'>
                        	  <i class='icon-cog'> </i>
                            <?php printx('系统管理','System Management')?><b class="caret"></b>
                        </a>

                        <ul class="dropdown-menu">

                             <?php if(!is_mobile()){  ?>
                            <li>
                                <a href="sysup.php<?php echo_lang() ?>"> <?php printx('系统升级','System Upgrade')?></a>
                            </li>   
                             <?php  }  ?>                         
                            
                             <li>
                                <a href="#" onclick='javascript:restart_device()'> <?php printx('重启设备','Device Reboot')?></a>
                            </li>                            
                                                       
                             
                        </ul>
                    </li>           
                    
                   <li class="divider-vertical"></li>

                    
                    <li class="dropdown">

                        <a data-toggle="dropdown" class="dropdown-toggle " href="#">
                        	 <!--i class='icon-user'> </i-->

                            <?php  $u=get_session_id();    printx("$u","$u"); ?><!--b class="caret"></b-->
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="changepwd.php<?php echo_lang() ?>"> <?php printx('更改密码','Change Password')?></a>
                            </li>
                            
                            <?php if (!is_mobile())  { ?>

                            <li>
                                 <a href="#"   onclick='javascript:logout()' > <?php printx('注销用户','User Logout')?>   </a>
                            </li>
                             <?php }else{ ?>
                          
                          
                          <li>
                          	  <a href="#"   onclick='javascript:logout_mobile()' > <?php printx('注销用户','User Logout')?>   </a>
                          </li>	
                          
                            <?php }  ?>
                             
                        </ul>
                    </li>                        
                    
                    
                    
                    
                </ul>

            </div> 

        </div>

    </div>

</div> 