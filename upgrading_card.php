<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>正在升级中</title>
    <style>
        h1,p,body{margin:0;padding:0}html,body{font:13px/20px Tahoma,sans-serif;background:url(res/img/body-bg.png);text-align:center;height:100%}#m{padding:30px 0}#m>*{padding:20px}#f{font-size:11px;position:absolute;bottom:0;width:100%;padding:15px 0}a{color:#FEDD12;text-decoration:none}h1{font:bold 40px/40px Arial}#l{height:30px;width:30px;margin:30px auto;-webkit-animation:r 1s infinite linear;-moz-animation:r 1s infinite linear;-o-animation:r 1s infinite linear;animation:r 1s infinite linear;border-left:5px solid #FEDD12;border-right:5px solid #FEDD12;border-bottom:5px solid #135B72;border-top:5px solid #135B72;border-radius:100%}@-webkit-keyframes r{from{-webkit-transform:rotate(0deg)}to{-webkit-transform:rotate(359deg)}}@-moz-keyframes r{from{-moz-transform:rotate(0deg)}to{-moz-transform:rotate(359deg)}}@-o-keyframes r{from{-o-transform:rotate(0deg)}to{-o-transform:rotate(359deg)}}@keyframes r{from{transform:rotate(0deg)}to{transform:rotate(359deg)}}
    </style>
</head>
<body>
<div id="m">
    <h1>数据卡升级中</h1>
    <p>您的文件已经成功上传，正在进行数据卡升级，请耐心等待几分钟，等设备重新启动完毕后再重新登陆.此页面可以关闭</p>
    <div id="l"><!--img src='res/img/loading.jpg'--></div>
</div>
</body>
</html>


<script src="res/js/jquery-1.7.2.min.js"></script>

<script type="text/javascript">

    $.ajax({
        type: "GET",
        async: true,
        url: "operation.php?ajax=true&act=sysup&fpath="+'<?php echo $_REQUEST['fpath'] ?>',
        dataType: "html",
        success: function (resp) {
           //alert('success upgrade');
        }
    });


</script>