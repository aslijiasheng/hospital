/**
 * jQuery EasyUI 1.3.4
 * 
 * Copyright (c) 2009-2013 www.jeasyui.com. All rights reserved.
 *
 * Licensed under the GPL or commercial licenses
 * To use it on other terms please contact us: info@jeasyui.com
 * http://www.gnu.org/licenses/gpl.txt
 * http://www.jeasyui.com/license_commercial.php
 *
 */
(function($){
$.parser={auto:true,onComplete:function(_1){
},plugins:["slider"],parse:function(_2){
var aa=[];
for(var i=0;i<$.parser.plugins.length;i++){
var _3=$.parser.plugins[i];
var r=$(".easyui-"+_3,_2);
if(r.length){
if(r[_3]){
r[_3]();
}else{
aa.push({name:_3,jq:r});
}
}
}
if(aa.length&&window.easyloader){
var _4=[];
for(var i=0;i<aa.length;i++){
_4.push(aa[i].name);
}
easyloader.load(_4,function(){
for(var i=0;i<aa.length;i++){
var _5=aa[i].name;
var jq=aa[i].jq;
jq[_5]();
}
$.parser.onComplete.call($.parser,_2);
});
}else{
$.parser.onComplete.call($.parser,_2);
}
},parseOptions:function(_6,_7){
var t=$(_6);
var _8={};
var s=$.trim(t.attr("data-options"));
if(s){
if(s.substring(0,1)!="{"){
s="{"+s+"}";
}
_8=(new Function("return "+s))();
}
if(_7){
var _9={};
for(var i=0;i<_7.length;i++){
var pp=_7[i];
if(typeof pp=="string"){
if(pp=="width"||pp=="height"||pp=="left"||pp=="top"){
_9[pp]=parseInt(_6.style[pp])||undefined;
}else{
_9[pp]=t.attr(pp);
}
}else{
for(var _a in pp){
var _b=pp[_a];
if(_b=="boolean"){
_9[_a]=t.attr(_a)?(t.attr(_a)=="true"):undefined;
}else{
if(_b=="number"){
_9[_a]=t.attr(_a)=="0"?0:parseFloat(t.attr(_a))||undefined;
}
}
}
}
}
$.extend(_8,_9);
}
return _8;
}};
$(function(){
var d=$("<div style=\"position:absolute;top:-1000px;width:100px;height:100px;padding:5px\"></div>").appendTo("body");
$._boxModel=parseInt(d.width())==100;
d.remove();
if(!window.easyloader&&$.parser.auto){
$.parser.parse();
}
});
$.fn._outerWidth=function(_c){
if(_c==undefined){
if(this[0]==window){
return this.width()||document.body.clientWidth;
}
return this.outerWidth()||0;
}
return this.each(function(){
if($._boxModel){
$(this).width(_c-($(this).outerWidth()-$(this).width()));
}else{
$(this).width(_c);
}
});
};
$.fn._outerHeight=function(_d){
if(_d==undefined){
if(this[0]==window){
return this.height()||document.body.clientHeight;
}
return this.outerHeight()||0;
}
return this.each(function(){
if($._boxModel){
$(this).height(_d-($(this).outerHeight()-$(this).height()));
}else{
$(this).height(_d);
}
});
};
$.fn._scrollLeft=function(_e){
if(_e==undefined){
return this.scrollLeft();
}else{
return this.each(function(){
$(this).scrollLeft(_e);
});
}
};
$.fn._propAttr=$.fn.prop||$.fn.attr;
$.fn._fit=function(_f){
_f=_f==undefined?true:_f;
var t=this[0];
var p=(t.tagName=="BODY"?t:this.parent()[0]);
var _10=p.fcount||0;
if(_f){
if(!t.fitted){
t.fitted=true;
p.fcount=_10+1;
$(p).addClass("panel-noscroll");
if(p.tagName=="BODY"){
$("html").addClass("panel-fit");
}
}
}else{
if(t.fitted){
t.fitted=false;
p.fcount=_10-1;
if(p.fcount==0){
$(p).removeClass("panel-noscroll");
if(p.tagName=="BODY"){
$("html").removeClass("panel-fit");
}
}
}
}
return {width:$(p).width(),height:$(p).height()};
};
})(jQuery);
(function($){
function _1b(e){
var _1c=$.data(e.data.target,"draggable");
var _1d=_1c.options;
var _1e=_1c.proxy;
var _1f=e.data;
var _20=_1f.startLeft+e.pageX-_1f.startX;
var top=_1f.startTop+e.pageY-_1f.startY;
if(_1e){
if(_1e.parent()[0]==document.body){
if(_1d.deltaX!=null&&_1d.deltaX!=undefined){
_20=e.pageX+_1d.deltaX;
}else{
_20=e.pageX-e.data.offsetWidth;
}
if(_1d.deltaY!=null&&_1d.deltaY!=undefined){
top=e.pageY+_1d.deltaY;
}else{
top=e.pageY-e.data.offsetHeight;
}
}else{
if(_1d.deltaX!=null&&_1d.deltaX!=undefined){
_20+=e.data.offsetWidth+_1d.deltaX;
}
if(_1d.deltaY!=null&&_1d.deltaY!=undefined){
top+=e.data.offsetHeight+_1d.deltaY;
}
}
}
if(e.data.parent!=document.body){
_20+=$(e.data.parent).scrollLeft();
top+=$(e.data.parent).scrollTop();
}
if(_1d.axis=="h"){
_1f.left=_20;
}else{
if(_1d.axis=="v"){
_1f.top=top;
}else{
_1f.left=_20;
_1f.top=top;
}
}
};
function _21(e){
var _22=$.data(e.data.target,"draggable");
var _23=_22.options;
var _24=_22.proxy;
if(!_24){
_24=$(e.data.target);
}
_24.css({left:e.data.left,top:e.data.top});
$("body").css("cursor",_23.cursor);
};
function _25(e){
$.fn.draggable.isDragging=true;
var _26=$.data(e.data.target,"draggable");
var _27=_26.options;
var _28=$(".droppable").filter(function(){
return e.data.target!=this;
}).filter(function(){
var _29=$.data(this,"droppable").options.accept;
if(_29){
return $(_29).filter(function(){
return this==e.data.target;
}).length>0;
}else{
return true;
}
});
_26.droppables=_28;
var _2a=_26.proxy;
if(!_2a){
if(_27.proxy){
if(_27.proxy=="clone"){
_2a=$(e.data.target).clone().insertAfter(e.data.target);
}else{
_2a=_27.proxy.call(e.data.target,e.data.target);
}
_26.proxy=_2a;
}else{
_2a=$(e.data.target);
}
}
_2a.css("position","absolute");
_1b(e);
_21(e);
_27.onStartDrag.call(e.data.target,e);
return false;
};
function _2b(e){
var _2c=$.data(e.data.target,"draggable");
_1b(e);
if(_2c.options.onDrag.call(e.data.target,e)!=false){
_21(e);
}
var _2d=e.data.target;
_2c.droppables.each(function(){
var _2e=$(this);
if(_2e.droppable("options").disabled){
return;
}
var p2=_2e.offset();
if(e.pageX>p2.left&&e.pageX<p2.left+_2e.outerWidth()&&e.pageY>p2.top&&e.pageY<p2.top+_2e.outerHeight()){
if(!this.entered){
$(this).trigger("_dragenter",[_2d]);
this.entered=true;
}
$(this).trigger("_dragover",[_2d]);
}else{
if(this.entered){
$(this).trigger("_dragleave",[_2d]);
this.entered=false;
}
}
});
return false;
};
function _2f(e){
$.fn.draggable.isDragging=false;
_2b(e);
var _30=$.data(e.data.target,"draggable");
var _31=_30.proxy;
var _32=_30.options;
if(_32.revert){
if(_33()==true){
$(e.data.target).css({position:e.data.startPosition,left:e.data.startLeft,top:e.data.startTop});
}else{
if(_31){
var _34,top;
if(_31.parent()[0]==document.body){
_34=e.data.startX-e.data.offsetWidth;
top=e.data.startY-e.data.offsetHeight;
}else{
_34=e.data.startLeft;
top=e.data.startTop;
}
_31.animate({left:_34,top:top},function(){
_35();
});
}else{
$(e.data.target).animate({left:e.data.startLeft,top:e.data.startTop},function(){
$(e.data.target).css("position",e.data.startPosition);
});
}
}
}else{
$(e.data.target).css({position:"absolute",left:e.data.left,top:e.data.top});
_33();
}
_32.onStopDrag.call(e.data.target,e);
$(document).unbind(".draggable");
setTimeout(function(){
$("body").css("cursor","");
},100);
function _35(){
if(_31){
_31.remove();
}
_30.proxy=null;
};
function _33(){
var _36=false;
_30.droppables.each(function(){
var _37=$(this);
if(_37.droppable("options").disabled){
return;
}
var p2=_37.offset();
if(e.pageX>p2.left&&e.pageX<p2.left+_37.outerWidth()&&e.pageY>p2.top&&e.pageY<p2.top+_37.outerHeight()){
if(_32.revert){
$(e.data.target).css({position:e.data.startPosition,left:e.data.startLeft,top:e.data.startTop});
}
$(this).trigger("_drop",[e.data.target]);
_35();
_36=true;
this.entered=false;
return false;
}
});
if(!_36&&!_32.revert){
_35();
}
return _36;
};
return false;
};
$.fn.draggable=function(_38,_39){
if(typeof _38=="string"){
return $.fn.draggable.methods[_38](this,_39);
}
return this.each(function(){
var _3a;
var _3b=$.data(this,"draggable");
if(_3b){
_3b.handle.unbind(".draggable");
_3a=$.extend(_3b.options,_38);
}else{
_3a=$.extend({},$.fn.draggable.defaults,$.fn.draggable.parseOptions(this),_38||{});
}
var _3c=_3a.handle?(typeof _3a.handle=="string"?$(_3a.handle,this):_3a.handle):$(this);
$.data(this,"draggable",{options:_3a,handle:_3c});
if(_3a.disabled){
$(this).css("cursor","");
return;
}
_3c.unbind(".draggable").bind("mousemove.draggable",{target:this},function(e){
if($.fn.draggable.isDragging){
return;
}
var _3d=$.data(e.data.target,"draggable").options;
if(_3e(e)){
$(this).css("cursor",_3d.cursor);
}else{
$(this).css("cursor","");
}
}).bind("mouseleave.draggable",{target:this},function(e){
$(this).css("cursor","");
}).bind("mousedown.draggable",{target:this},function(e){
if(_3e(e)==false){
return;
}
$(this).css("cursor","");
var _3f=$(e.data.target).position();
var _40=$(e.data.target).offset();
var _41={startPosition:$(e.data.target).css("position"),startLeft:_3f.left,startTop:_3f.top,left:_3f.left,top:_3f.top,startX:e.pageX,startY:e.pageY,offsetWidth:(e.pageX-_40.left),offsetHeight:(e.pageY-_40.top),target:e.data.target,parent:$(e.data.target).parent()[0]};
$.extend(e.data,_41);
var _42=$.data(e.data.target,"draggable").options;
if(_42.onBeforeDrag.call(e.data.target,e)==false){
return;
}
$(document).bind("mousedown.draggable",e.data,_25);
$(document).bind("mousemove.draggable",e.data,_2b);
$(document).bind("mouseup.draggable",e.data,_2f);
});
function _3e(e){
var _43=$.data(e.data.target,"draggable");
var _44=_43.handle;
var _45=$(_44).offset();
var _46=$(_44).outerWidth();
var _47=$(_44).outerHeight();
var t=e.pageY-_45.top;
var r=_45.left+_46-e.pageX;
var b=_45.top+_47-e.pageY;
var l=e.pageX-_45.left;
return Math.min(t,r,b,l)>_43.options.edge;
};
});
};
$.fn.draggable.methods={options:function(jq){
return $.data(jq[0],"draggable").options;
},proxy:function(jq){
return $.data(jq[0],"draggable").proxy;
},enable:function(jq){
return jq.each(function(){
$(this).draggable({disabled:false});
});
},disable:function(jq){
return jq.each(function(){
$(this).draggable({disabled:true});
});
}};
$.fn.draggable.parseOptions=function(_48){
var t=$(_48);
return $.extend({},$.parser.parseOptions(_48,["cursor","handle","axis",{"revert":"boolean","deltaX":"number","deltaY":"number","edge":"number"}]),{disabled:(t.attr("disabled")?true:undefined)});
};
$.fn.draggable.defaults={proxy:null,revert:false,cursor:"move",deltaX:null,deltaY:null,handle:null,disabled:false,edge:0,axis:null,onBeforeDrag:function(e){
},onStartDrag:function(e){
},onDrag:function(e){
},onStopDrag:function(e){
}};
$.fn.draggable.isDragging=false;
})(jQuery);


(function($){
function init(_8ce){
var _8cf=$("<div class=\"slider\">"+"<div class=\"slider-inner\">"+"<a href=\"javascript:void(0)\" class=\"slider-handle\"></a>"+"<span class=\"slider-tip\"></span><span>%</span>"+"</div>"+"<div class=\"slider-rule\"></div>"+"<div class=\"slider-rulelabel\"></div>"+"<div style=\"clear:both\"></div>"+"<input type=\"hidden\" class=\"slider-value\">"+"</div>").insertAfter(_8ce);
var name=$(_8ce).hide().attr("name");
if(name){
_8cf.find("input.slider-value").attr("name",name);
$(_8ce).removeAttr("name").attr("sliderName",name);
}
return _8cf;
};
function _8d0(_8d1,_8d2){
var _8d3=$.data(_8d1,"slider");
var opts=_8d3.options;
var _8d4=_8d3.slider;
if(_8d2){
if(_8d2.width){
opts.width=_8d2.width;
}
if(_8d2.height){
opts.height=_8d2.height;
}
}
if(opts.mode=="h"){
_8d4.css("height","");
_8d4.children("div").css("height","");
if(!isNaN(opts.width)){
_8d4.width(opts.width);
}
}else{
_8d4.css("width","");
_8d4.children("div").css("width","");
if(!isNaN(opts.height)){
_8d4.height(opts.height);
_8d4.find("div.slider-rule").height(opts.height);
_8d4.find("div.slider-rulelabel").height(opts.height);
_8d4.find("div.slider-inner")._outerHeight(opts.height);
}
}
_8d5(_8d1);
};
function _8d6(_8d7){
var _8d8=$.data(_8d7,"slider");
var opts=_8d8.options;
var _8d9=_8d8.slider;
var aa=opts.mode=="h"?opts.rule:opts.rule.slice(0).reverse();
if(opts.reversed){
aa=aa.slice(0).reverse();
}
_8da(aa);
function _8da(aa){
var rule=_8d9.find("div.slider-rule");
var _8db=_8d9.find("div.slider-rulelabel");
rule.empty();
_8db.empty();
for(var i=0;i<aa.length;i++){
var _8dc=i*100/(aa.length-1)+"%";
var span=$("<span></span>").appendTo(rule);
span.css((opts.mode=="h"?"left":"top"),_8dc);
if(aa[i]!="|"){
span=$("<span></span>").appendTo(_8db);
span.html(aa[i]);
if(opts.mode=="h"){
span.css({left:_8dc,marginLeft:-Math.round(span.outerWidth()/2)});
}else{
span.css({top:_8dc,marginTop:-Math.round(span.outerHeight()/2)});
}
}
}
};
};
function _8dd(_8de){
var _8df=$.data(_8de,"slider");
var opts=_8df.options;
var _8e0=_8df.slider;
_8e0.removeClass("slider-h slider-v slider-disabled");
_8e0.addClass(opts.mode=="h"?"slider-h":"slider-v");
_8e0.addClass(opts.disabled?"slider-disabled":"");
_8e0.find("a.slider-handle").draggable({axis:opts.mode,cursor:"pointer",disabled:opts.disabled,onDrag:function(e){
var left=e.data.left;
var _8e1=_8e0.width();
if(opts.mode!="h"){
left=e.data.top;
_8e1=_8e0.height();
}
if(left<0||left>_8e1){
return false;
}else{
var _8e2=_8f4(_8de,left);
_8e3(_8e2);
return false;
}
},onBeforeDrag:function(){
_8df.isDragging=true;
},onStartDrag:function(){
opts.onSlideStart.call(_8de,opts.value);
},onStopDrag:function(e){
var _8e4=_8f4(_8de,(opts.mode=="h"?e.data.left:e.data.top));
_8e3(_8e4);
opts.onSlideEnd.call(_8de,opts.value);
opts.onComplete.call(_8de,opts.value);
_8df.isDragging=false;
}});
_8e0.find("div.slider-inner").unbind(".slider").bind("mousedown.slider",function(e){
if(_8df.isDragging){
return;
}
var pos=$(this).offset();
var _8e5=_8f4(_8de,(opts.mode=="h"?(e.pageX-pos.left):(e.pageY-pos.top)));
_8e3(_8e5);
opts.onComplete.call(_8de,opts.value);
});
function _8e3(_8e6){
var s=Math.abs(_8e6%opts.step);
if(s<opts.step/2){
_8e6-=s;
}else{
_8e6=_8e6-s+opts.step;
}
_8e7(_8de,_8e6);
};
};
function _8e7(_8e8,_8e9){
var _8ea=$.data(_8e8,"slider");
var opts=_8ea.options;
var _8eb=_8ea.slider;
var _8ec=opts.value;
if(_8e9<opts.min){
_8e9=opts.min;
}
if(_8e9>opts.max){
_8e9=opts.max;
}
opts.value=_8e9;
$(_8e8).val(_8e9);
_8eb.find("input.slider-value").val(_8e9);
var pos=_8ed(_8e8,_8e9);
var tip=_8eb.find(".slider-tip");
if(opts.showTip){
tip.show();
tip.html(opts.tipFormatter.call(_8e8,opts.value));
}else{
tip.hide();
}
if(opts.mode=="h"){
var _8ee="left:"+pos+"px;";
_8eb.find(".slider-handle").attr("style",_8ee);
tip.attr("style",_8ee+"margin-left:"+(-Math.round(tip.outerWidth()/2))+"px");
}else{
var _8ee="top:"+pos+"px;";
_8eb.find(".slider-handle").attr("style",_8ee);
tip.attr("style",_8ee+"margin-left:"+(-Math.round(tip.outerWidth()))+"px");
}
if(_8ec!=_8e9){
opts.onChange.call(_8e8,_8e9,_8ec);
}
};
function _8d5(_8ef){
var opts=$.data(_8ef,"slider").options;
var fn=opts.onChange;
opts.onChange=function(){
};
_8e7(_8ef,opts.value);
opts.onChange=fn;
};
function _8ed(_8f0,_8f1){
var _8f2=$.data(_8f0,"slider");
var opts=_8f2.options;
var _8f3=_8f2.slider;
if(opts.mode=="h"){
var pos=(_8f1-opts.min)/(opts.max-opts.min)*_8f3.width();
if(opts.reversed){
pos=_8f3.width()-pos;
}
}else{
var pos=_8f3.height()-(_8f1-opts.min)/(opts.max-opts.min)*_8f3.height();
if(opts.reversed){
pos=_8f3.height()-pos;
}
}
return pos.toFixed(0);
};
function _8f4(_8f5,pos){
var _8f6=$.data(_8f5,"slider");
var opts=_8f6.options;
var _8f7=_8f6.slider;
if(opts.mode=="h"){
var _8f8=opts.min+(opts.max-opts.min)*(pos/_8f7.width());
}else{
var _8f8=opts.min+(opts.max-opts.min)*((_8f7.height()-pos)/_8f7.height());
}
return opts.reversed?opts.max-_8f8.toFixed(0):_8f8.toFixed(0);
};
$.fn.slider=function(_8f9,_8fa){
if(typeof _8f9=="string"){
return $.fn.slider.methods[_8f9](this,_8fa);
}
_8f9=_8f9||{};
return this.each(function(){
var _8fb=$.data(this,"slider");
if(_8fb){
$.extend(_8fb.options,_8f9);
}else{
_8fb=$.data(this,"slider",{options:$.extend({},$.fn.slider.defaults,$.fn.slider.parseOptions(this),_8f9),slider:init(this)});
$(this).removeAttr("disabled");
}
var opts=_8fb.options;
opts.min=parseFloat(opts.min);
opts.max=parseFloat(opts.max);
opts.value=parseFloat(opts.value);
opts.step=parseFloat(opts.step);
_8dd(this);
_8d6(this);
_8d0(this);
});
};
$.fn.slider.methods={options:function(jq){
return $.data(jq[0],"slider").options;
},destroy:function(jq){
return jq.each(function(){
$.data(this,"slider").slider.remove();
$(this).remove();
});
},resize:function(jq,_8fc){
return jq.each(function(){
_8d0(this,_8fc);
});
},getValue:function(jq){
return jq.slider("options").value;
},setValue:function(jq,_8fd){
return jq.each(function(){
_8e7(this,_8fd);
});
},enable:function(jq){
return jq.each(function(){
$.data(this,"slider").options.disabled=false;
_8dd(this);
});
},disable:function(jq){
return jq.each(function(){
$.data(this,"slider").options.disabled=true;
_8dd(this);
});
}};
$.fn.slider.parseOptions=function(_8fe){
var t=$(_8fe);
return $.extend({},$.parser.parseOptions(_8fe,["width","height","mode",{reversed:"boolean",showTip:"boolean",min:"number",max:"number",step:"number"}]),{value:(t.val()||undefined),disabled:(t.attr("disabled")?true:undefined),rule:(t.attr("rule")?eval(t.attr("rule")):undefined)});
};
$.fn.slider.defaults={width:"auto",height:"auto",mode:"h",reversed:false,showTip:false,disabled:false,value:0,min:0,max:100,step:1,rule:[],tipFormatter:function(_8ff){
return _8ff;
},onChange:function(_900,_901){
},onSlideStart:function(_902){
},onSlideEnd:function(_903){
},onComplete:function(_904){
}};
})(jQuery);

