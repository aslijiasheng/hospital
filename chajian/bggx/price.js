
// JavaScript Document 
$(function(){ 
$("tr.edit:even"); 
$("tr.edit td:not(.id)").click(function(){ 
if($(this).children('input').length > 0) 
return; 
//取出表格中原有的内容 
var data=$(this).text(); 
//将内容设置为空 
$(this).html(''); 
var td=$(this); 
//创建一个表格 
var inp=$('<input type="text">'); 
inp.val(data); 
inp.css("background-color","#fff"); 
inp.css("border-width","0px"); 
inp.css("width","80%");
inp.css("height","80%");
inp.css("cursor","hand");
inp.css("text-align","center");
//在表格中放一个input表单 
inp.appendTo($(this)); 
//表单放入表格后触发焦点事件 
inp.trigger('focus'); 
//全选内容 
inp.trigger('select'); 
//添加键盘时间 
inp.keydown(function(event){ 
switch(event.keyCode){ 
case 13: 
td.html($(this).val()); 
//利用Ajax将数据传给服务器 
//获取一行所有的列对象 
var tds=td.parent("tr").children("td"); 
var a=tds.eq(0).text(); 
var b=tds.eq(1).text(); 
var c=tds.eq(2).text(); 
var d=tds.eq(3).text(); 
//var user={id:i,name:n,age:a,sex:s,email:e} 
$.post("?action=config&do=priceedit",{id:a,item:b,price:c,intro:d},function(data){ 
alert(data); 
}); 
break; 
case 27: 
td.html(data); 
break; 
} 
}).blur(function(){ 
td.html($(this).val()); 
//利用Ajax将数据传给服务器 
//获取一行所有的列对象 
var tds=td.parent("tr").children("td"); 
var a=tds.eq(0).text(); 
var b=tds.eq(1).text(); 
var c=tds.eq(2).text(); 
var d=tds.eq(3).text(); 
//var user={id:i,name:n,age:a,sex:s,email:e} 
$.post("?action=config&do=priceedit",{id:a,item:b,price:c,intro:d},function(data){  
alert(data); 
}); 
}); 
}); 
}); 