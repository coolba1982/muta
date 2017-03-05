var MSG_SUCCESS = 1;
var MSG_WARNNING = 2;
var MSG_ERROR = 3;


function show_msg(content, type) {
    if ((type == null) || (content == null)) return;
    var rst = '';
    if (type == MSG_SUCCESS) {
        rst = '<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert">';
        rst += '<i class="icon-remove"></i> </button> <strong>';
        rst += content + '<small></small></strong></div>';
    } else if (type == MSG_ERROR) {
        rst = '<div class="alert alert-block alert-error"><button type="button" class="close" data-dismiss="alert">';
        rst += '<i class="icon-remove"></i> </button> <strong>';
        rst += content + '<small></small></strong></div>';
    } else if (type == MSG_WARNNING) {
        rst = '<div class="alert alert-block alert-warning"><button type="button" class="close" data-dismiss="alert">';
        rst += '<i class="icon-remove"></i> </button> <strong>';
        rst += content + '<small></small></strong></div>'
    }
    $('#d_msg').html(rst);
}


function show_message(content, type) {

    if ((type == null) || (content == null)) return;
    if(content=='SESSION_EXPIRE'){
        location.href = 'login.php?sess_invalid=true';
        return;
    }

    var rst = '';
    if (type == MSG_SUCCESS) {
        rst = '<div class="alert alert-success"><button type="button" class="close"  data-dismiss="alert">&times;</button> <div> <span class="success-icon"></span> &nbsp;   ';
        rst += content + '</div></div>';
    } else if (type == MSG_ERROR) {
        rst = '<div class="alert alert-error"><button type="button" class="close"  data-dismiss="alert">&times;</button><div> <span class="error-icon"></span> &nbsp;';
        rst += content + '</div></div>';
    } else if (type == MSG_WARNNING) {
        rst = '<div class="alert alert-block"><button type="button" class="close"  data-dismiss="alert">&times;</button><div><span class="alert-icon"></span> &nbsp;';
        rst += content + '</div></div>';
    }
    $('#d_msg').html(rst);

}

function clear_message() {
    $('#d_msg').html('');
}


function show_loading(content) {
    $('#load_info').html(content);
    $('#md').modal({backdrop: 'static'});
   // .css({
    //'margin-top': function () {
     //   return -($(this).height() / 2);
   // }
   // });    
    
   
    
}

function finish_loading() {
    $('#md').modal('hide');
}

var confirm_registered =false;
function confirm(content, fn, paramObj) {
    $('#s_confirm').html(content);
    $('#rst_confirm').val('false');
    $('#btn_cf_apply').one('click',function () {
        confirm_hide();
        fn(paramObj);
    });
    $('#btn_cf_cancel').one('click',function () {
        confirm_hide();
    });
    	location.href='#footer';
     var tp = $('#footer').offset().top/2;
     
     if(paramObj=='top'){
     	
     	  tp=300;
     }else if(tp>450)	{
     	  tp =tp+150;
     	
    }else  if(tp<300){
    	 tp=300;
    	
    }
     
     //alert(tp);
     
    // $("body,html").animate({ 
     //  scrollTop: tp+'px'
    // }, 0);      
    
    $('#confirm').modal({backdrop: 'static'}).css({'top':tp+'px'});
    
    
    //.css({
    //'margin-top': function () {
     //   return -($(this).height() / 2);
   // }
  //  });
}




function confirm_mobile(content, fn, paramObj) {
    $('#s_confirm').html(content);
    $('#rst_confirm').val('false');
    $('#btn_cf_apply').one('click',function () {
        confirm_hide();
        fn(paramObj);
    });
    $('#btn_cf_cancel').one('click',function () {
        confirm_hide();
    });
    	location.href='#footer';
     var tp =250;
     
     

    $('#confirm').modal({backdrop: 'static'}).css({'top':tp+'px'});

}



function   heart_beat(interval){
    //return;
    var fun =function(){
    $.ajax({
        type: "GET",
        async: true,
        url: "heart.php?ajax=true",
        dataType: "html",
        success: function (resp) {
            var data;
            try {
                data = eval("(" + resp + ")");
            } catch (e) {
               // alert(e + ' resp:' + resp);
            }
            if(data.msg.content=='SESSION_EXPIRE'){
                window.location.href='login.php?sess_invalid=true';
            }
         }
    });
    }
    setInterval(fun,10000);


}









function  set_help(id,ct){
    $("#"+id).popover({
        trigger: 'manual',
        placement: 'bottom', //placement of the popover. also can use top, bottom, left or right
        //title : '提示', //this is the top title bar of the popover. add some basic css
        html: true, //needed to show html of course
        content: ct,
        animation: 'false'

    }).on("mouseenter",function () {

            var _this = this;

            $(this).popover("show");

            $(this).siblings(".popover").on("mouseleave", function () {

                $(_this).popover('hide');

            });

        }).on("mouseleave", function () {

            var _this = this;

            setTimeout(function () {

                //if (!$(".popover:hover").length) {
                    $(_this).popover("hide")
                //}

            }, 100);

        });	
	
	
}	









function confirm_hide() {
    $('#confirm').modal('hide');
}


function  logout(){
    var do_logout =function(){
        location.href = 'logout.php';
    }
    
    confirm(i18n['sure_to_logout'], do_logout, 'top');
}

function  logout_mobile(){
    var do_logout =function(){
        location.href = 'logout.php';
    }
    confirm_mobile(i18n['sure_to_logout'], do_logout, 'top');
}




function  restart_device(){
	  var t=(new Date()).getTime()/1000;
    var restart =function(){
       // $.ajax({
      //      type: "GET",
       //     async: true,
        //    url: "operation.php?act=restart&ajax=true&t="+t,
        //    dataType: "html",
        //    success: function (resp) {
                //window.location.href="logout.php";
        //    }

       // });
        window.location.href="logout.php?act=restart";
    }
    confirm(i18n['sure_to_restart'], restart, 'top');
}


function  recover_settings(){
	  var t=(new Date()).getTime()/1000;
    var recover =function(){
     //   $.ajax({
     //       type: "GET",
     //       async: true,
      //      url: "operation.php?act=recover&ajax=true&t="+t,
      //      dataType: "html",
      //      success: function (resp) {
                //window.location.href="logout.php";
        //    }
       // });
        window.location.href="logout.php?act=recover";
    }
    confirm(i18n['sure_to_recover'], recover, 'top');
}


function  replace_blank(str) {
    
    if (str!=null) {
        str=str.replace(/[\r\n]/g,"");
        //str=str.replace(/\s/g,''); 
    }
    return str;
}







function empty(str) {
    var rst = true;
    if(typeof(str)=='object'){
        if(str.length==0){
            return true;
        }else
        return false;
    }

    if ((str != null) && (trim(str) != '')) {
        rst = false;
    }
    return rst;
}
function trim(str) { //删除左右两端的空格
    if (str == null) return '';
    return str.replace(/(^\s*)|(\s*$)/g, "");
}

function check_ip(str) {
    var arg = /^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/;
    if (str.match(arg) == null) {
        return false;
    }
    else {
        return true;
    }
}

function check_mask(mask){
var obj=mask; 
var exp=/^(254|252|248|240|224|192|128|0)\.0\.0\.0|255\.(254|252|248|240|224|192|128|0)\.0\.0|255\.255\.(254|252|248|240|224|192|128|0)\.0|255\.255\.255\.(254|252|248|240|224|192|128|0)$/; 
var reg = obj.match(exp); 
if(reg==null) 
{ 
return false; //"非法" 
} 
else 
{ 
return true; //"合法" 
} 	
	
}	

//////////////////////////////////

function validateip(ip) {
var result = false;
if (!(/^(\d{1,3})(\.\d{1,3}){3}$/.test(ip))){
return false;
}
var reSpaceCheck = /^(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9])\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[0-9])$/; 
var validip = ip.match(reSpaceCheck);
if (validip != null) {
result = true;
} 
return result;
}

//验证子网掩码有效性
function validateNetMast(netmask) {
var result = false;
if (!(/^(\d{1,3})(\.\d{1,3}){3}$/.test(netmask))){
return true;
}
var reSpaceCheck = /^(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9])\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[0-9])$/; 
var validip = netmask.match(reSpaceCheck);
if (validip != null) {
var mask_binary = conversionBinary(netmask);
if(-1 != mask_binary.indexOf("01")){
result = true;
}
} else {
result = true;
}
return result;
}



function  validateMask(MaskStr) 
{ 
/*有效性校验*/ 
var IPPattern=/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/ 
if(!IPPattern.test(MaskStr))returnfalse; 

/*检查域值*/ 
var IPArray=MaskStr.split("."); 
var ip1=parseInt(IPArray[0]); 
var ip2=parseInt(IPArray[1]); 
var ip3=parseInt(IPArray[2]); 
var ip4=parseInt(IPArray[3]); 
if(ip1<0||ip1>255/*每个域值范围0-255*/ 
||ip2<0||ip2>255 
||ip3<0||ip3>255 
||ip4<0||ip4>255) 
{ 
return false; 
} 

/*检查二进制值是否合法*/ 
//拼接二进制字符串 
var ip_binary=_checkIput_fomartIP(ip1)+_checkIput_fomartIP(ip2)+_checkIput_fomartIP(ip3)+_checkIput_fomartIP(ip4);

if(-1!=ip_binary.indexOf("01")) return false; 
return true; 
} 


/** 
*函数名：_checkIput_fomartIP 
*函数功能：返回传入参数对应的8位二进制值 
*函数作者：236F(fuwei236#gmail.com) 
*传入参数：ip:点分十进制的值(0~255),int类型的值， 
*主调函数：validateMask 
*调用函数：无 
*返回值:ip对应的二进制值(如：传入255，返回11111111;传入1,返回00000001) 
**/ 
function _checkIput_fomartIP(ip) 
{ 
return (ip+256).toString(2).substring(1);//格式化输出(补零) 
} 



function mask2num(mask){
	var result =0;
	var masks = mask.split('.');
	for(var i=0;i<4;i++){
		var mask = parseInt(masks[i]);
		var m = _checkIput_fomartIP(mask) ;
		for(var j=0;j<m.length;j++){
			 if(m[j] == '1'){
			 	  result++;
			 }
		}	
	}	
	return result;
}	
	











////////////////////////////////////
function num2mask(num) {
    if ((num > 32) || (num < 0)) {
        return 'N/A';
    }
    var a = [0, 0, 0, 0];
    for (var i = 0; i < num; i++) {
        var k = parseInt(i / 8);
        var m = i % 8;
        a[k] = a[k] + cal2(8 - m - 1);
    }
    var rtn = '';
    for (var i = 0; i < 4; i++) {
        rtn = rtn + a[i];
        if (i != 3) {
            rtn = rtn + '.';
        }
    }
    return rtn;
}

function is_valid_ip(value) {
    var regip = /^(([0-1]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}([0-1]?\d{1,2}|2[0-4]\d|25[0-5])$/;
    flag_ip = regip.test(trim(value));
    if (flag_ip) {
        return true;
    }
    return false;
}


/*
 用途：检查输入字符串是否只由英文字母和数字组成
 输入：
 s：字符串
 返回：
 如果通过验证返回true,否则返回false
 */
function isNumberOrChar(s) {    //判断是否是数字或字母
    var regu = "^[0-9a-zA-Z]+$";
    var re = new RegExp(regu);
    if (re.test(s)) {
        return true;
    } else {
        return false;
    }
};



function cal2(num) {
    if (num == 0) return 1;
    var j = 2;
    for (var i = 1; i < num; i++) {
        j *= 2;
    }
    return j;
}


//判断正整数
function check_int(value) {
    var re = /^[1-9]+[0-9]*]*$/;

    if (!re.test(value)) {

        return false;
    }
    return true;
}


//判断正整数
function check_pwd1(value) {
    var re = /^(?!\D+$)(?![^a-zA-Z]+$)\S{5,63}$/;

    if (!re.test(value)) {

        return false;
    }
    return true;
}






//判断字符串是否为数字
function check_num(value) {
    var re = /^[0-9]+.?[0-9]*$/;
    if (!re.test(value)) {

        return false;
    }
    return true;
}


function set_meta_attr(id, attr, val,form_id) {
    // for(var i=0;i<meta_info.length;i++){
    var group = meta_info[form_id];
    $.each(group, function (i, obj) {
        if (obj.id == id) {
            eval('group[i].' + attr + '="' + val + '"');
            return false;
        }
    });
    meta_info[form_id] =group;
}

function get_meta_attr(id, attr,form_id) {
    var rst = null;
    var group = meta_info[form_id];
    $.each(group, function (i, obj) {
        if (obj.id == id) {
            eval('rst = group[i].' + attr);
            return false;
        }
    });
    return rst;
}


var i18n = new Array();
i18n['rule_common'] = '{input}输入不合法';


// rule = "ip,notnull,range[5-13],len[0-14],mask,int,char,nchar,date,datetime" hint_ip="XXX" hint_notnull='XXX'
// status = 'uncheck'  uncheck状态的不检测       char 只有字母和数字  nchar可以包含中文
function check_form(form_id) {
    clear_all();
    var items = meta_info[form_id];
    var item;
    var result = true;
    //for (var index = 0; index < items.length; index++)  
    $.each(items, function (i, obj) {
        item = obj;
        if (empty(item.rule)) {
            return true;
        }

        var rules = item.rule.split(',');

        $.each(rules, function (j, r) {

            if (!check_item(item, r)) {
                result = false;
                return false;
            }
        });
        return  result;

    });
    return result;
}


function check_item(item, rule) {
    var tmp_rule = rule;
    if (tmp_rule.indexOf('len') == 0)
        tmp_rule = 'len';
    if (tmp_rule.indexOf('range') == 0)
        tmp_rule = 'range';
    var status = item.status;
    if ((!empty(status)) && (status == 'uncheck')) {
        return true;
    }
    var id = item.id;
    var val = trim($('#' + id).val());
    var el = "var hint_msg = item.hint_" + tmp_rule;
    eval(el);
    var input_name = i18n[id] == null ? '' : i18n[id];
    if (empty(input_name)) {
        input_name = '';
    }

    var msg = empty(hint_msg) ? i18n['rule_' + tmp_rule] : hint_msg;
    if (empty(msg)) {
        msg = i18n['rule_common'];
    }
    msg = msg.replace('{input}', input_name);

    switch (rule) {
        case "notnull":
            if (empty(val)) {
                show_error(msg, id);
                return false;
            }
            break;

        case "char":
            if (empty(val)) { //如果为空，认为是空字符窜 ,单纯的char规则不排斥空值
                return true;
            }

            if (!ischar(trim(val))) {
                show_error(msg, id);
                return false;
            }
            break;

        case "int":
            if (!check_int(trim(val))) {
                show_error(msg, id);
                return false;
            }
            break;

        case "date":
            break;


        case "datetime":
            break;


        case "ip":
            if (!check_ip(trim(val))) {
                show_error(msg, id);
                return false;
            }
            break;

        case "mask":
            if (!check_mask(trim(val))) {
                show_error(msg, id);
                return false;
            }
            break;
            
            
        case "pwd1":    
            if(!check_pwd1(trim(val))){
            	  show_error(msg, id);
                return false;
            }	
            break;

        default:  //range[5-13]
            if ((rule.length >= 10) && (rule.substring(0, 5) == 'range')) {

                if (!check_item(item, 'notnull')) {
                    return false;
                }
                if (!check_item(item, 'int')) {
                    return false;
                }

                var tmp = rule.substring(6, rule.length - 1);
                var r = tmp.split('-');
                if ((parseInt(val) < parseInt(r[0])) || (parseInt(val) > parseInt(r[1]))) {

                    msg = empty(hint_msg) ? i18n['rule_range'] : hint_msg;
                    if (empty(msg)) {
                        msg = i18n['rule_common'];
                    }
                    msg = msg.replace('{input}', input_name);
                    msg = msg.replace('{range}', tmp);
                    show_error(msg, id);
                    return false;
                }

            } //len[0-14]
            else if ((rule.length >= 8) && (rule.substring(0, 3) == 'len')) {
                //if(!check_item(item,'notnull')){
                //    return false;
                //}
                if (!check_item(item, 'char')) {
                    return false;
                }
                var tmp = rule.substring(4, rule.length - 1);
                var r = tmp.split('-');
                if ((strlen(val) < parseInt(r[0])) || (strlen(val) > parseInt(r[1]))) {
                    msg = empty(hint_msg) ? i18n['rule_len'] : hint_msg;
                    if (empty(msg)) {
                        msg = i18n['rule_common'];
                    }
                    msg = msg.replace('{input}', input_name);
                    msg = msg.replace('{range}', tmp);
                    show_error(msg, id);
                    return false;
                }
            }

            break;

    }

    return true;

}


function show_error(msg, id) {

    show_message(msg, MSG_ERROR);
    //$('.control-group').removeClass('control-group error').addClass('control-group');
    //var  jj=$('#cg_' + id);
    if($('#cg_' + id).length==1)
        $('#cg_' + id).removeClass('control-group').addClass('control-group error');
    else
        $('#cg_' + id.substring(0,id.length-2)).removeClass('control-group').addClass('control-group error');

}


/**设置form数据  **/
function set_form(param,form_id) {
    clear_all();
    var items = meta_info[form_id];
    var form_data = param.form;
    var item;
    if (form_data != null) {

        $.each(items, function (i, obj) {

            item = obj;
            if (item.status == 'uncheck') {
                return true;
            }
            if (empty(item.id)) {
                return true;
            }
            var id = item.id;
            var control = $('#' + id);
            if (control != null) {
                for (var key in form_data) {
                    if (key == id) {
                        control.val(form_data[key]);
                        break;
                    }
                }
            }
        });
    }
    var msg = param.msg;
    if (msg != null) {
        show_message(msg.content, msg.type);
    }
}


function get_form(rst,form_id) {
    var items = meta_info[form_id];
    if (rst == null) rst = {};
    var item;
    $.each(items, function (i, obj) {
        item = obj;
        if (item.status == 'uncheck') {
            return true;

        }
        if (empty(item.id)) {
            return true;
        }
        var id = item.id;
        var control = $('#' + id);
        if (control != null) {
            eval('rst.' + id + '=control.val()');
        }
    });
    return rst;
}


function init_form(url_param, after,form_id,before_setform) {
	
	  if(ONPC){
	  	show_loading(i18n['init']);
	     
	  }
	 var t=(new Date()).getTime()/1000;
	 
    $.ajax({
        type:  "GET",
        async: true,
        url: url_param,
        dataType: "html",
        success: function (resp) {
        		  	

	      if(ONPC){
        	finish_loading();
        }	
            var data;
            try {
                data = eval("(" + resp + ")");
            } catch (e) {
                alert(e + ' resp:' + resp);
            }
            
            if(before_setform!=null){
            	 before_setform();
            }	

            
            set_form(data,form_id);
            

            if (after != null) {
                after();
            }
            //finish_loading();
        }
    });
}


function submit_form_ext(objPara) {
    var url = objPara.url;
    var para = objPara.param;
    var option = objPara.option;
    var form_id =objPara.form_id;
    var direct_to_login = objPara.direct_to_login;
    if ((option != null) && (option.before != null)) {
        if (!option.before())    return;
    }
    clear_all();
    //if(!check_form()) return;
    para = get_form(para,form_id);
    if ((option != null) && (option.create_param != null)) {
        para = option.create_param(para);
    }
    if ((option != null) && (option.debug != null)&& (option.debug == 'true')) alert("INPUT:" + JSON.stringify(para));
    if ((option != null) && (option.load_msg != null)) {
       // show_loading(option.load_msg);
    } else {
       // show_loading("loading...");
    }
    var t=(new Date()).getTime()/1000;
    $.ajax({
        type: "POST",
        async: true,
        url: url,
        data: para,
        dataType: "html",
        success: function (resp) {
            finish_loading();
            var data;
            try {
                data = eval("(" + resp + ")");
            } catch (e) {
                alert(e + ' resp:' + resp);
            }
            if ((option != null) && (option.debug != null)&& (option.debug == 'true'))  alert("RESPONSE:" + JSON.stringify(data));
            set_form(data,form_id);
            if ((option != null) && (option.after != null)) {
                option.after();
            }
        }
    });
    if(direct_to_login!=null){
    	   window.location.href="logout.php";
    }
    
    
}







function submit_form(objPara) {
    var url = objPara.url;
    var para = objPara.param;
    var option = objPara.option;
    var form_id =objPara.form_id;
    var direct_to_login = objPara.direct_to_login;
    if ((option != null) && (option.before != null)) {
        if (!option.before())    return;
    }
    clear_all();
    //if(!check_form()) return;
    para = get_form(para,form_id);
    if ((option != null) && (option.create_param != null)) {
        para = option.create_param(para);
    }
    if ((option != null) && (option.debug != null)&& (option.debug == 'true')) alert("INPUT:" + JSON.stringify(para));
    if ((option != null) && (option.load_msg != null)) {
        show_loading(option.load_msg);
    } else {
        show_loading("loading...");
    }
    var t=(new Date()).getTime()/1000;
    $.ajax({
        type: "POST",
        async: true,
        url: url,
        data: para,
        dataType: "html",
        success: function (resp) {
            finish_loading();
            var data;
            try {
                data = eval("(" + resp + ")");
            } catch (e) {
                alert(e + ' resp:' + resp);
            }
            if ((option != null) && (option.debug != null)&& (option.debug == 'true'))  alert("RESPONSE:" + JSON.stringify(data));
            set_form(data,form_id);
            if ((option != null) && (option.after != null)) {
                option.after();
            }
        }
    });
    if(direct_to_login!=null){
    	   window.location.href="logout.php";
    }
    
    
}


function clear_all() {
    clear_message();
    $('.control-group').removeClass('control-group error').addClass('control-group');
}


/* 检测字符串长度 汉字算２个字节*/
function strlen(str) {
    var i;
    var len;
    len = 0;
    if (str != undefined && str != null && str != "") {
        for (i = 0; i < str.length; i++) {
            if (str.charCodeAt(i) > 255) len += 2; else len++;
        }
        return len;
    }
};
/*检测是否是字符或数字*/
function ischar(str) {
    var s2 = /[^A-Za-z0-9]/;
    if (s2.exec(str))
        return false;
    else
        return true;
};
/* 检测字符串是否为空 */
function isnull(str) {
    if (str == null) return true;
    var i;
    for (i = 0; i < str.length; i++) {
        if (str.charAt(i) != ' ') return false;
    }
    return true;
};
//判断输入是否为字母
function isLetter(str) {
    var regex = /^([a-zA-Z])*$/;
    if (regex.test(str)) {
        return true;
    }
    return false;
}
/*判断是否输入了中文的字符*/
function isExsitChineseChar(str) {
    if (typeof str == "undefined" || isnull(str) || str == "")
        return false;
    if (str.length != strlen(str))
        return true;
    else
        return false;
};

//检测货币
function ismoney(str) {
    var pos1 = str.indexOf(".");
    var pos2 = str.lastIndexOf(".");
    if ((pos1 != pos2) || !isnumber(str)) {
        return false;
    }
    return true;
};
//检测年(YYYY年)
function isyear(str) {
    if (!isnumber(str))
        return false;
    //if(str.length != 4 ) {
    //  return false;
    //}

    if ((str < '1950') || (str > '2050')) {
        return false;
    }

    return true;

};

//检测非空
function checklength(val, maxlen) {
    var str = trim(document.forms[0].elements[val].value);
    if (str == "" && maxlen == null) {
        alert($res_entry("muta.exception.notnull", "此项不可为空"));
        document.forms[0].elements[val].focus();
        document.forms[0].elements[val].select();
        return false;
    } else if (str != "" && maxlen != null) {
        if (str.length > maxlen) {
            return false;
        }
    }
    document.forms[0].elements[val].value = str;
    return true;
};
//验证数字
function checknum(val) {
    if (isNaN(document.forms[0].elements[val].value)) {
        alert($res_entry("muta.exception.neednumber", "请输入数字"));
        document.forms[0].elements[val].focus();
        document.forms[0].elements[val].select();
        return false;
    }
    return true;
};


//检测电话号码
function isphone(str) {
    var number_chars = "()-1234567890";
    var i;
    for (i = 0; i < str.length; i++) {
        if (number_chars.indexOf(str.charAt(i)) == -1) return false;
    }
    return true;
};

function replaceAll(str) {
    var i;
    for (i = 0; i < str.length; i++) {/*
     if(str.charAt(i)=='&')
     str=str.replace('&','&amp;');
     if(str.charAt(i)=='<')
     str=str.replace('<','&lt;');
     if(str.charAt(i)=='>')
     str=str.replace('>','&gt;');*/
        if (str.charAt(i) == '\'')
            str = str.replace('\'', '\\uff07');
        if (str.charAt(i) == '\"')
            str = str.replace('\"', '\\uff02');
    }
    return str;
};

//验证percent
function checkPercent(regEx) {
    var regu = /^-?([1-9]\d*|0)(\.\d+)?%$/;
    var re = new RegExp(regu);
    if (re.test(regEx)) {
        return false;
    }
    else {
        return true;
    }
}
//屏蔽键盘快捷键
function checkKey() {
    var srce = window.event.srcElement.type;
    var shield = false;
    //文本框内不屏蔽快捷键
    if (window.event.keyCode == 8 && srce == "password") return;
    if (window.event.keyCode == 8 && srce == "file") return;
    if (window.event.keyCode == 8 && srce == "text") return;
    if (window.event.keyCode == 8 && srce == "textarea") return;

    //屏蔽文本框内的回车
    if (window.event.keyCode == 13 && srce == "password") {
        event.keyCode = 0;
        return false;
    }

    if (window.event.keyCode == 13 && srce == "file") {
        event.keyCode = 0;
        return false;
    }
    if (window.event.keyCode == 13 && srce == "text") {
        event.keyCode = 0;
        return false;
    }
    if (window.event.keyCode == 13 && srce == "textarea") {
        event.keyCode = 0;
        return false;
    }

    if ((event.keyCode == 8) || //屏蔽退格删除键
        (event.keyCode == 116) || //屏蔽 F5 刷新键
        (event.ctrlKey && event.keyCode == 82)) { //Ctrl + R
        event.keyCode = 0;
        return false;
    }
    if ((window.event.altKey) &&
        ((window.event.keyCode == 37) || //屏蔽 Alt+ 方向键 ←
            (window.event.keyCode == 39))) { //屏蔽 Alt+ 方向键 →
        alert("不准你使用ALT+方向键前进或后退网页！");
        return false;
    }
    if ((event.ctrlKey) && (event.keyCode == 78)) //屏蔽 Ctrl+n
        return false;
    if (window.event.srcElement.tagName == "A" && window.event.shiftKey)
        return false; //屏蔽 shift 加鼠标左键新开一网页
};
function compareDate(date1, date2) {
    var value;
    if ((date1 == null || date1 == "undefined") && (date2 == null || date2 == "undefined"))
        value = "d1=d2";
    else if ((date1 == null || date1 == "undefined") && (date2 != null && date2 != "undefined"))
        value = "d1<d2";
    else if ((date1 != null && date1 != "undefined") && (date2 == null || date2 == "undefined"))
        value = "d1>d2";
    else
        value = date1.localeCompare(date2);
    if (value == 0)
        return "d1=d2";
    else if (value > 0)
        return "d1>d2";
    else
        return "d1<d2";
};

/*
 用途：检查输入的日期是否符合 yyyy-MM-dd
 输入：
 value：字符串
 返回：
 如果通过验证返回true,否则返回false
 */
function isDate(elem) {
    var date = elem.value;
    var length = date.length;
    var year = date.substr(0, 4);
    var month = date.substr(5, 2);
    var day = date.substr(8, 2);
    var var1 = date.substr(4, 1);
    var var2 = date.substr(7, 1);

    if (length == '10' && var1 == var2 && (var1 == '-' || var1 == '/' || var1 == '.')) {
        if (isNumber(year) && isNumber(month) && isNumber(day)) {
            if (month > "12" || month < "01") {
                alert("\"" + elem.chname + "\"" + $res_entry("muta.exception.monthbetween", "月份应该在01和12之间"));
                return false;
            }
            if (day > getMaxDay(year, month) || day < "01") {
                alert("\"" + elem.chname + "\"" + $res_entry("muta.exception.maxdateerror", "月份和日期最大值不符合"));
                return false;
            }

            return true;
        }
        else {
            alert("\"" + elem.chname + "\"" + $res_entry("muta.exception.dateformateerror", "时间格式不合法，年月日必须为数字"));
            return false;
        }
    }
    else {


        alert("\"" + elem.chname + "\"" + $res_entry("muta.exception.dateformatelike", "时间格式不合法，请检查日期是否符合YYYY/MM/DD,YYYY-MM-DD或YYYY.MM.DD格式"));
        return false;

    }
};


function getMaxDay(year, month) {
    if (month == 4 || month == 6 || month == 9 || month == 11)
        return "30";
    if (month == 2)
        if (year % 4 == 0 && year % 100 != 0 || year % 400 == 0)
            return "29";
        else
            return "28";
    return "31";
};