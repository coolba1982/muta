<meta charset="utf-8" />
<title></title>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />

<link href="res/css/bootstrap.min.css" rel="stylesheet" />
<link href="res/css/bootstrap-responsive.min.css" rel="stylesheet" />

<!--link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet" /-->
<link href="res/css/google-font.css" rel="stylesheet" />


<link href="res/css/font-awesome.css" rel="stylesheet" />

<link href="res/css/adminia.css" rel="stylesheet" />
<link href="res/css/adminia-responsive.css" rel="stylesheet" />

<link href="res/css/pages/plans.css" rel="stylesheet" />


    <link href="css/return_top.css" rel="stylesheet" />
<link href="css/muta.css" rel="stylesheet" />

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="res/js/html5.js"></script>
<![endif]-->


<script src="js/json2.js"></script>

<script src="js/common.js"></script>



<script type="text/javascript">

<?php 
global $_LANG;

while($key= key($_LANG)) {	
  $key= key($_LANG);//获取key
  $val= current($_LANG);//获取值
  echo "i18n['$key']='$val'; \n";
  next($_LANG);
}

global  $init;
echo "var INIT_DATA = {}; \n";
if(!empty($init)){
    echo ' INIT_DATA = '.$init."; \n";
}	

if(!is_mobile()){

   echo  'var ONPC= true;';

}else{
   echo  'var ONPC= false;';


}





?>
</script>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


