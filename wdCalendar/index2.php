<?php session_start(); $yh=$_SESSION['username']; $salesid=$_SESSION['userid'];?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
    <title>我的日程</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link href="css/dailog.css" rel="stylesheet" type="text/css" />
    <link href="css/calendar.css" rel="stylesheet" type="text/css" /> 
    <link href="css/dp.css" rel="stylesheet" type="text/css" />   
    <link href="css/alert.css" rel="stylesheet" type="text/css" /> 
    <link href="css/main.css" rel="stylesheet" type="text/css" /> 

    
    <script src="src/Plugins/Common.js" type="text/javascript"></script>    
    <script src="src/Plugins/datepicker_lang_zh.js" type="text/javascript"></script>     
    <script src="src/Plugins/jquery.datepicker.js" type="text/javascript"></script>

    <script src="src/Plugins/jquery.alert.js" type="text/javascript"></script>    
    <script src="src/Plugins/jquery.ifrmdailog.js" defer="defer" type="text/javascript"></script>
    <script src="src/Plugins/wdCalendar_lang_zh.js" type="text/javascript"></script>    
    <script src="src/Plugins/jquery.calendar.js" type="text/javascript"></script> 
    
    <script type="text/javascript">
        $(document).ready(function() {     
           var view="week";          
           
            var DATA_FEED_URL = "datafeed.php";
            var op = {
                view: view,
                theme:3,
                showday: new Date(),
                EditCmdhandler:Edit,
                DeleteCmdhandler:Delete,
                ViewCmdhandler:View,    
                onWeekOrMonthToDay:wtd,
                onBeforeRequestData: cal_beforerequest,
                onAfterRequestData: cal_afterrequest,
                onRequestDataError: cal_onerror, 
                autoload:true,
                url: DATA_FEED_URL + "?method=list",  
                quickAddUrl: DATA_FEED_URL + "?method=add", 
                quickUpdateUrl: DATA_FEED_URL + "?method=update",
                quickDeleteUrl: DATA_FEED_URL + "?method=remove"        
            };
            var $dv = $("#calhead");
            var _MH = document.documentElement.clientHeight;
            var dvH = $dv.height() + 2;
            op.height = _MH - dvH;
            op.eventItems =[];

            var p = $("#gridcontainer").bcalendar(op).BcalGetOp();
            if (p && p.datestrshow) {
                $("#txtdatetimeshow").text(p.datestrshow);
            }
            $("#caltoolbar").noSelect();
            
            $("#hdtxtshow").datepicker({ picker: "#txtdatetimeshow", showtarget: $("#txtdatetimeshow"),
            onReturn:function(r){                          
                            var p = $("#gridcontainer").gotoDate(r).BcalGetOp();
                            if (p && p.datestrshow) {
                                $("#txtdatetimeshow").text(p.datestrshow);
                            }
                     } 
            });
            function cal_beforerequest(type)
            {
                var t="加载数据...";
                switch(type)
                {
                    case 1:
                        t="加载数据...";
                        break;
                    case 2:                      
                    case 3:  
                    case 4:    
                        t="正在处理的请求 ...";                                   
                        break;
                }
                $("#errorpannel").hide();
                $("#loadingpannel").html(t).show();    
            }
            function cal_afterrequest(type)
            {
                switch(type)
                {
                    case 1:
                        $("#loadingpannel").hide();
                        break;
                    case 2:
                    case 3:
                    case 4:
                        $("#loadingpannel").html("成功提交!");
                        window.setTimeout(function(){ $("#loadingpannel").hide();},2000);
                    break;
                }              
               
            }
            function cal_onerror(type,data)
            {
                $("#errorpannel").show();
            }
            function Edit(data)
            {
               var eurl="edit.php?id={0}&start={2}&end={3}&isallday={4}&title={1}";   
                if(data)
                {
                    var url = StrFormat(eurl,data);
                    OpenModelWindow(url,{ width: 600, height: 400, caption:"管理日程",onclose:function(){
                       $("#gridcontainer").reload();
                    }});
                }
            }    
            function View(data)
            {
                var str = "";
                $.each(data, function(i, item){
                    str += "[" + i + "]: " + item + "\n";
                });
                alert(str);               
            }    
            function Delete(data,callback)
            {           
                
                $.alerts.okButton="确定";  
                $.alerts.cancelButton="取消";  
                hiConfirm("您确定要删除此日程", 'Confirm',function(r){ r && callback(0);});           
            }
            function wtd(p)
            {
               if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $("#showdaybtn").addClass("fcurrent");
            }
            //to show day view
            $("#showdaybtn").click(function(e) {
                //document.location.href="#day";
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $(this).addClass("fcurrent");
                var p = $("#gridcontainer").swtichView("day").BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
            });
			
            //to show week view
            $("#showweekbtn").click(function(e) {
                //document.location.href="#week";
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $(this).addClass("fcurrent");
                var p = $("#gridcontainer").swtichView("week").BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }

            });
            //to show month view
            $("#showmonthbtn").click(function(e) {
                //document.location.href="#month";
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $(this).addClass("fcurrent");
                var p = $("#gridcontainer").swtichView("month").BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
            });
            
            $("#showreflashbtn").click(function(e){
                $("#gridcontainer").reload();
            });
            
            //Add a new event
            $("#faddbtn").click(function(e) {
                var url ="edit.php";
                OpenModelWindow(url,{ width: 500, height: 400, caption: "创建新的日程"});
            });
            //go to today
            $("#showtodaybtn").click(function(e) {
                var p = $("#gridcontainer").gotoDate().BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }


            });
            //previous date range
            $("#sfprevbtn").click(function(e) {
                var p = $("#gridcontainer").previousRange().BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }

            });
            //next date range
            $("#sfnextbtn").click(function(e) {
                var p = $("#gridcontainer").nextRange().BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
            });
            
        });
    </script> 
</head>
<body>
    <div>

      <div id="calhead" style="padding-left:1px;padding-right:1px;">          
            <div class="cHead"><div class="ftitle"><?php echo $yh;?>的日程</div>
            <div id="loadingpannel" class="ptogtitle loadicon" style="display: none;">加载数据中...</div>
             <div id="errorpannel" class="ptogtitle loaderror" style="display: none;">抱歉，无法加载您的数据，请稍后再试</div>
            </div>          
            
            <div id="caltoolbar" class="ctoolbar">
              <div id="faddbtn" class="fbutton">
                <div><span title='单击创建新的日程' class="addcal">
                新建日程                
                </span></div>
            </div>
            <div class="btnseparator"></div>
             <div id="showtodaybtn" class="fbutton">
                <div><span title='点击返回今天日程 ' class="showtoday">
                今天</span></div>
            </div>
              <div class="btnseparator"></div>

            <div id="showdaybtn" class="fbutton">
                <div><span title='日' class="showdayview">日</span></div>
            </div>
              <div  id="showweekbtn" class="fbutton fcurrent">
                <div><span title='周' class="showweekview">周</span></div>
            </div>
              <div  id="showmonthbtn" class="fbutton">
                <div><span title='月' class="showmonthview">月</span></div>

            </div>
            <div class="btnseparator"></div>
              <div  id="showreflashbtn" class="fbutton">
                <div><span title='刷新' class="showdayflash">刷新</span></div>
                </div>
             <div class="btnseparator"></div>
            <div id="sfprevbtn" title="上一个"  class="fbutton">
              <span class="fprev"></span>

            </div>
            <div id="sfnextbtn" title="下一个" class="fbutton">
                <span class="fnext"></span>
            </div>
            <div class="fshowdatep fbutton">
                    <div>
                        <input type="hidden" name="txtshow" id="hdtxtshow" />
                        <span id="txtdatetimeshow"></span>

                    </div>
            </div>
            
            <div class="clear"></div>
            </div>
      </div>
      <div style="padding:0;">
        <!--<div class="t1 chromeColor">
            &nbsp;</div>
        <div class="t2 chromeColor" >
            &nbsp;</div>-->
        <div id="dvCalMain" class="calmain printborder" style="margin:0 1px;border:1px solid #b8d0d6;border-top:none;overflow:hidden;">
            <div id="gridcontainer" style="overflow-y: visible;">
            </div>
        </div>
        <!--<div class="t2 chromeColor" style="border:1px solid #f00;">

            &nbsp;</div>
        <div class="t1 chromeColor" >
            &nbsp;
        </div>-->   
        </div>
     
  </div>
    
</body>
</html>
