CREATE TABLE `arsc_bannlist` (
  `id` int(11) NOT NULL auto_increment,
  `ip` char(15) NOT NULL default '',
  `until` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `ip` (`ip`)
) TYPE=MyISAM;

CREATE TABLE `arsc_guestbooks` (
  `id` int(11) NOT NULL auto_increment,
  `link_user` int(11) NOT NULL default '0',
  `date` date NOT NULL default '0000-00-00',
  `author` varchar(64) NOT NULL default '',
  `text` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `link_user` (`link_user`),
  KEY `datum` (`date`)
) TYPE=MyISAM;

CREATE TABLE `arsc_layouts` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL default '',
  `default_font_face` varchar(64) NOT NULL default '',
  `default_font_color` varchar(24) NOT NULL default '',
  `default_font_size` varchar(24) NOT NULL default '',
  `small_font_face` varchar(64) NOT NULL default '',
  `small_font_color` varchar(24) NOT NULL default '',
  `small_font_size` varchar(24) NOT NULL default '',
  `default_background_color` varchar(24) NOT NULL default '',
  `default_foreground_color` varchar(24) NOT NULL default '',
  `template_languageselection` text NOT NULL,
  `template_home` text NOT NULL,
  `template_register` text NOT NULL,
  `template_roomlist` text NOT NULL,
  `template_userlist` text NOT NULL,
  `template_input` text NOT NULL,
  `template_input_nojavascript` text NOT NULL,
  `template_queue` text NOT NULL,
  `template_browser_default_index` text NOT NULL,
  `template_browser_socket_index` text NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) TYPE=MyISAM;

INSERT INTO `arsc_layouts` VALUES (1, 'Default', 'Arial, Verdana, sans-serif', '#000000', '2', 'Arial, Verdana, sans-serif', '#000000', '1', '#EEEEEE', '#DDDDDD', '<html>\r\n <head>\r\n  <title>\r\n   <%parameter_title%>\r\n  </title>\r\n  <meta http-equiv="Content-Type" content="text/html; charset=<%lang_charset%>">\r\n </head>\r\n <body bgcolor="<%layout_default_background_color%>" text="<%layout_default_font_color%>" link="<%layout_default_font_color%>" vlink="<%layout_default_font_color%>">\r\n  <br>\r\n  <br>\r\n  <form action="home.php" method="GET">\r\n   <table align="center" cellpadding="6" bgcolor="<%layout_default_foreground_color%>">\r\n    <tr>\r\n     <td>\r\n      <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="<%layout_default_font_color%>">\r\n       <b>\r\n        <%current_chooseyourlanguage%>\r\n       </b>\r\n      </font>\r\n      <%current_languageselection%>\r\n      <input type="submit" value="<%current_next%> &gt;">\r\n     </td>\r\n    </tr>\r\n   </table>\r\n  </form>\r\n  <br>\r\n  <center>\r\n   <table align="center" cellpadding="1" cellspacing="0" border="0" bgcolor="<%layout_default_foreground_color%>">\r\n    <tr>\r\n     <td><a href="http://manuel.kiessling.net/projects/software/arsc/" target="_blank" title="The Homepage of ARSC"><img src="pic/arsc_poweredby102x47.jpg" width="102" height="47" border="0" title="Powered by ARSC"></a></td>\r\n    </tr>\r\n   </table>\r\n   <font face="<%layout_small_font_face%>" size="<%layout_small_font_size%>" color="<%layout_small_font_color%>">\r\n    [v<%current_version%>]\r\n   </font>\r\n  </center>\r\n </body>\r\n</html>\r\n', '<html>\r\n <head>\r\n  <title>\r\n   <%parameter_title%>\r\n  </title>\r\n  <meta http-equiv="Content-Type" content="text/html; charset=<%lang_charset%>">\r\n </head>\r\n <body bgcolor="<%layout_default_background_color%>" text="<%layout_default_font_color%>" link="<%layout_default_font_color%>" vlink="<%layout_default_font_color%>">\r\n  <table align="center" cellspacing="4">\r\n   <tr>\r\n    <td valign="top">\r\n     <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="#FF0000">\r\n      <b>\r\n       <%current_error%>\r\n      </b>\r\n     </font>\r\n     <form action="login.php" method="POST">\r\n      <table>\r\n       <tr>\r\n        <td valign="top">\r\n         <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="<%layout_default_font_color%>">\r\n          <b>\r\n           <%lang_entername%>\r\n          </b>\r\n         </font>\r\n        </td>\r\n        <td valign="top">\r\n         <input type="text" name="arsc_user" size="20" maxlength="64" value="<%current_user%>">\r\n        </td>\r\n       </tr>\r\n       <tr>\r\n        <td valign="top">\r\n         <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="<%layout_default_font_color%>">\r\n          <b>\r\n           <%lang_enterpassword%>\r\n          </b>\r\n         </font>\r\n        </td>\r\n        <td valign="top">\r\n         <input type="password" name="arsc_password" size="20">\r\n        </td>\r\n       </tr>\r\n       <tr>\r\n        <td>\r\n         <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="<%layout_default_font_color%>">\r\n          <b>\r\n           <%lang_selectroom%>\r\n          </b>\r\n         </font>\r\n        </td>\r\n        <td>\r\n         <%layout_room_selection%>\r\n        </td>\r\n       </tr>\r\n       <tr>\r\n        <td>\r\n         <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="<%layout_default_font_color%>">\r\n          <b>\r\n           <%lang_selectchatversion%>\r\n          </b>\r\n         </font>\r\n        </td>\r\n        <td>\r\n         <%layout_chatversion_selection%>\r\n        </td>\r\n       </tr>\r\n       <tr>\r\n        <td>\r\n         <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="<%layout_default_font_color%>">\r\n          &nbsp;\r\n         </font>\r\n        </td>\r\n        <td>\r\n         <input type="submit" value="<%lang_startbutton%>">\r\n        </td>\r\n       </tr>\r\n      </table>\r\n      <input type="hidden" name="arsc_language" value="<%current_language%>">\r\n      <input type="hidden" name="arsc_template" value="html">\r\n     </form>\r\n    </td>\r\n    <td valign="top" bgcolor="<%layout_default_foreground_color%>">\r\n      <br>\r\n      <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="<%layout_default_font_color%>">\r\n       <center>\r\n        <a href="register.php?arsc_language=<%current_language%>"><%lang_clicktoregister%></a>\r\n       </center>\r\n      </font>\r\n      <br>\r\n      <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="<%layout_default_font_color%>">\r\n       <b>\r\n        <%lang_usersinchat%>\r\n       </b>\r\n      </font>\r\n      <table width="100%" align="center">\r\n      <tr bgcolor="<%layout_default_background_color%>">\r\n       <td width="50%">\r\n        <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="<%layout_default_font_color%>">\r\n         <%lang_usersinchat_name%>\r\n        </font>\r\n       </td>\r\n       <td width="50%">\r\n        <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="<%layout_default_font_color%>">\r\n         <%lang_usersinchat_room%>\r\n        </font>\r\n       </td>\r\n      </tr>\r\n     </table>\r\n     <center>\r\n      <%layout_usersinchat_table%>\r\n      <font face="<%layout_default_font_face%>" size="<%layout_small_font_size%>">\r\n       <%lang_usersinchat_idlenote%>\r\n      </font>\r\n     </center>\r\n    </td>\r\n   </tr>\r\n  </table>\r\n </body>\r\n</html>', '<html>\r\n <head>\r\n  <title>\r\n   <%parameter_title%>\r\n  </title>\r\n  <meta http-equiv="Content-Type" content="text/html; charset=<%lang_charset%>">\r\n </head>\r\n <body bgcolor="<%layout_default_background_color%>" text="<%layout_default_font_color%>" link="<%layout_default_font_color%>" vlink="<%layout_default_font_color%>">\r\n  <table align="center" cellpadding="6" bgcolor="<%layout_default_foreground_color%>">\r\n   <tr>\r\n    <td>\r\n     <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="#FF0000">\r\n      <b>\r\n       <%current_error%>\r\n      </b>\r\n     </font>\r\n     <form method="POST">\r\n      <input type="hidden" name="arsc_send" value="yes">\r\n      <input type="hidden" name="arsc_language" value="<%current_language%>">\r\n      <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="<%layout_default_font_color%>">\r\n       <%lang_register_intro%>\r\n      </font>\r\n      <br>\r\n      <br>\r\n      <table>\r\n       <tr>\r\n        <td>\r\n         <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="<%layout_default_font_color%>">\r\n          <b>\r\n           <%lang_register_entername%>\r\n          </b>\r\n         </font>\r\n        </td>\r\n        <td>\r\n         <input type="text" name="arsc_user" size="30" maxlength="64">\r\n        </td>\r\n       </tr>\r\n       <tr>\r\n        <td>\r\n         <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="<%layout_default_font_color%>">\r\n          <b>\r\n           <%lang_register_enterpassword%>\r\n          </b>\r\n         </font>\r\n        </td>\r\n        <td>\r\n         <input type="password" name="arsc_password" size="30" maxlength="64">\r\n        </td>\r\n       </tr>\r\n       <tr>\r\n        <td>\r\n         <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="<%layout_default_font_color%>">\r\n          <b>\r\n           <%lang_register_enteremail%>\r\n          </b>\r\n         </font>\r\n        </td>\r\n        <td>\r\n         <input type="text" name="arsc_email" size="30" maxlength="64">\r\n        </td>\r\n       </tr>\r\n       <tr>\r\n        <td>\r\n         &nbsp;\r\n        </td>\r\n        <td>\r\n         <input type="submit" value="<%lang_register_send%>">\r\n        </td>\r\n       </tr>\r\n      </table>\r\n     </form>\r\n    </td>\r\n   </tr>\r\n  </table>\r\n </body>\r\n</html>', '<html>\r\n <head>\r\n  <title>roomlist</title>\r\n  <meta http-equiv="Content-Type" content="text/html; charset=<%lang_charset%>">\r\n  <%layout_scrolling_script%>\r\n  <%layout_help_script%>\r\n  <%layout_drawboard_script%>\r\n </head>\r\n   <body bgcolor="<%layout_default_background_color%>" text="<%layout_default_font_color%>" link="<%layout_default_font_color%>" vlink="<%layout_default_font_color%>">\r\n  <table width="95%" bgcolor="<%layout_default_foreground_color%>" align="center">\r\n   <tr>\r\n    <td>\r\n     <%layout_roomlist_form%>\r\n     <div align="right">\r\n      <font face="<%layout_small_font_face%>" size="<%layout_small_font_size%>" color="<%layout_small_font_color%>">\r\n       [<a href="roomlist.php?arsc_sid=<%my_sid%>"><%lang_refresh%></a>]\r\n      </font>\r\n     </div>\r\n    </td>\r\n   </tr>\r\n  </table>\r\n  <br>\r\n  <table width="95%" bgcolor="<%layout_default_foreground_color%>" align="center">\r\n   <tr>\r\n    <td>\r\n     <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="<%layout_default_font_color%>">\r\n      <b>\r\n       <%lang_otherfunctions%>:\r\n      </b>\r\n      <%layout_scrolling_form%>\r\n      <%layout_drawboard_link%>\r\n      <li> <b><%layout_help_link%></b></li>\r\n      <li> <a href="<%parameter_baseurl%>base/logout.php?arsc_sid=<%my_sid%>&arsc_post_logout=true" target="_parent"><%lang_leave%></a></li>\r\n     </font>\r\n    </td>\r\n   </tr>\r\n  </table>\r\n  <br>\r\n  <table width="95%" bgcolor="<%layout_default_foreground_color%>" align="center">\r\n   <tr>\r\n    <td>\r\n     <%layout_colorselection_table%>\r\n    </td>\r\n   </tr>\r\n  </table>\r\n </body>\r\n</html>', '<html>\r\n <head>\r\n  <title>userlist</title>\r\n  <meta http-equiv="Content-Type" content="text/html; charset=<%lang_charset%>">\r\n  <%layout_kickuser_script%>\r\n  <%layout_idcard_script%>\r\n  <script language="JavaScript">\r\n  <!--\r\n   var reloadableFrames=new Array();\r\n   reloadableFrames[0] = "roomlist";\r\n   reloadableFrames[1] = "input";\r\n   reloadableFrames[2] = "empty";\r\n  //-->\r\n  </script>\r\n  <%layout_reloadallframes_script%>\r\n </head>\r\n <body bgcolor="<%layout_default_background_color%>" text="<%layout_default_font_color%>" link="<%layout_default_font_color%>" vlink="<%layout_default_font_color%>">\r\n  <table width="95%" bgcolor="<%layout_default_foreground_color%>" align="center">\r\n   <tr>\r\n    <td align="center">\r\n     <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="<%layout_default_font_color%>">\r\n      <%lang_usersinroom%><br>\r\n      <b>\r\n       <%layout_currentroom%>\r\n      </b>\r\n      <br>\r\n      <font face="<%layout_small_font_face%>" size="<%layout_small_font_size%>" color="<%layout_small_font_color%>">\r\n       [<a href="userlist.php?arsc_sid=<%my_sid%>"><%lang_refresh%></a>]\r\n      </font>\r\n     </font>\r\n    </td>\r\n   </tr>\r\n  </table>\r\n  <br>\r\n  <%layout_userlist%>\r\n </body>\r\n</html>', '<html>\r\n <head>\r\n  <title>input</title>\r\n  <meta http-equiv="Content-Type" content="text/html; charset=<%lang_charset%>">\r\n  <%layout_msginput_script%>\r\n </head>\r\n <body bgcolor="<%layout_default_background_color%>" text="<%layout_default_font_color%>" link="<%layout_default_font_color%>" vlink="<%layout_default_font_color%>" OnLoad="<%layout_msginput_onload%>">\r\n  <form action="chatins.php" method="GET" target="empty" name="f" OnSubmit="return empty_field_and_submit()">\r\n   <input type="text" name="arsc_message" size="50" maxlength="<%parameter_input_maxsize%>" value="<%layout_pretext%>">\r\n  </form>\r\n  <form action="chatins.php" method="GET" target="empty" name="fdummy" OnSubmit="return empty_field_and_submit()">\r\n   <input type="hidden" name="arsc_sid" value="<%my_sid%>">\r\n   <input type="hidden" name="arsc_chatversion" value="<%my_version%>">\r\n   <input type="hidden" name="arsc_random" value="">\r\n   <input type="hidden" name="arsc_message">\r\n  </form>\r\n </body>\r\n</html>', '<html>\r\n <head>\r\n  <title>input</title>\r\n  <meta http-equiv="Content-Type" content="text/html; charset=<%lang_charset%>">\r\n  <%layout_msginput_script%>\r\n </head>\r\n <body bgcolor="<%layout_default_background_color%>" text="<%layout_default_font_color%>" link="<%layout_default_font_color%>" vlink="<%layout_default_font_color%>">\r\n  <form action="chatins.php" method="GET" name="f">\r\n   <input type="text" name="arsc_message" size="50" maxlength="<%parameter_input_maxsize%>" value="<%layout_pretext%>">\r\n   <input type="hidden" name="arsc_sid" value="<%my_sid%>">\r\n   <input type="hidden" name="arsc_chatversion" value="<%my_version%>">\r\n  </form>\r\n </body>\r\n</html>', '<html>\r\n <head>\r\n  <title>\r\n   <%parameter_title%>\r\n  </title>\r\n  <meta http-equiv="Content-Type" content="text/html; charset=<%lang_charset%>">\r\n </head>\r\n <body bgcolor="<%layout_default_background_color%>" text="<%layout_default_font_color%>" link="<%layout_default_font_color%>" vlink="<%layout_default_font_color%>">\r\n  <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="<%layout_default_font_color%>">\r\n   <b>\r\n    <u><%lang_moderatorqueue_title%></u>\r\n   </b>\r\n   [<a href="queue.php?arsc_sid=<%my_sid%>"><%lang_refresh%></a>]\r\n   <br>\r\n   <br>\r\n   <%current_queueentries%>\r\n  </font>\r\n  <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="<%layout_default_font_color%>">\r\n   <b>\r\n    <%current_answerqueuemessage%>\r\n   </b>\r\n  </font>\r\n  <br>\r\n  <form method="GET">\r\n   <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="<%layout_default_font_color%>"><%lang_moderatorqueue_youranswer%>:</font> <input type="text" name="arsc_answer" size="50" maxlength="<%parameter_input_maxsize%>">\r\n   <input type="submit" value="<%lang_sendmessage%>">\r\n   <input type="hidden" name="arsc_sid" value="<%my_sid%>">\r\n   <input type="hidden" name="arsc_answerqueueid" value="<%current_answerqueueid%>">\r\n   <input type="hidden" name="arsc_sendanswer" value="1">\r\n   <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="<%layout_default_font_color%>">\r\n    <a href="queue.php?arsc_sid=<%my_sid%>"><%lang_moderatorqueue_cancel%></a>\r\n   </font>\r\n  </form>\r\n </body>\r\n</html>', '<html>\r\n <head>\r\n  <title>\r\n   <%parameter_title%>\r\n  </title>\r\n  <meta http-equiv="Content-Type" content="text/html; charset=<%lang_charset%>">\r\n </head>\r\n <frameset cols="220,*" border="0" framespacing="no" frameborder="1" marginwidth="2" marginheight="1">\r\n  <frame src="http://<%parameter_virtualservers_current%><%parameter_hostname%><%parameter_currentdir%>/../shared/browser/roomlist.php?arsc_sid=<%my_sid%>" name="roomlist" scrolling="no" marginwidth="0" marginheight="0">\r\n  <frameset cols="*,120" border="0" framespacing="no" frameborder="0" marginwidth="2" marginheight="1">\r\n   <frameset rows="0,0,<%current_queueframeheight%>,*,40" border="1" framespacing="no" frameborder="0" marginwidth="2" marginheight="1">\r\n    <frame src="http://<%parameter_virtualservers_current%><%parameter_hostname%><%parameter_currentdir%>/../shared/browser/ping.php?arsc_sid=<%my_sid%>" name="ping" scrolling="no" marginwidth="0" marginheight="0">\r\n    <frame src="http://<%parameter_virtualservers_current%><%parameter_hostname%><%parameter_currentdir%>/../shared/browser/empty.php" name="empty" scrolling="no" marginwidth="0" marginheight="0">\r\n    <frame src="http://<%parameter_virtualservers_current%><%parameter_hostname%><%parameter_currentdir%>/../shared/browser/queue.php?arsc_sid=<%my_sid%>" name="queue" scrolling="auto" marginwidth="2" marginheight="1">\r\n    <frame src="http://<%parameter_virtualservers_current%><%parameter_hostname%><%parameter_currentdir%>/chatmsg.php?arsc_sid=<%my_sid%>" name="msg" scrolling="auto" marginwidth="2" marginheight="0">\r\n    <frame src="http://<%parameter_virtualservers_current%><%parameter_hostname%><%parameter_currentdir%>/../shared/browser/input.php?arsc_sid=<%my_sid%>" name="input" scrolling="no" marginwidth="2" marginheight="1">\r\n   </frameset>\r\n   <frame src="http://<%parameter_virtualservers_current%><%parameter_hostname%><%parameter_currentdir%>/../shared/browser/userlist.php?arsc_sid=<%my_sid%>&arsc_current_room=<%my_room%>&arsc_enter=1" name="userlist" scrolling="auto" marginwidth="2" marginheight="2">\r\n  </frameset>\r\n </frameset>\r\n <noframes>\r\n  Sorry, this chat needs a browser that understands framesets. But we have a lynx-friendly version too, check the login page!\r\n </noframes>\r\n</html>', '<html>\r\n <head>\r\n  <title>\r\n   <%parameter_title%>\r\n  </title>\r\n  <meta http-equiv="Content-Type" content="text/html; charset=<%lang_charset%>">\r\n </head>\r\n <frameset cols="220,*" border="0" framespacing="no" frameborder="1" marginwidth="2" marginheight="1">\r\n  <frame src="http://<%parameter_virtualservers_current%><%parameter_hostname%><%parameter_currentdir%>/../shared/browser/roomlist.php?arsc_sid=<%my_sid%>" name="roomlist" scrolling="no" marginwidth="0" marginheight="0">\r\n  <frameset cols="*,120" border="0" framespacing="no" frameborder="0" marginwidth="2" marginheight="1">\r\n   <frameset rows="0,<%current_queueframeheight%>,*,40" border="1" framespacing="no" frameborder="0" marginwidth="2" marginheight="1">\r\n    <frame src="http://<%parameter_virtualservers_current%><%parameter_hostname%><%parameter_currentdir%>/../shared/browser/empty.php" name="empty" scrolling="no" marginwidth="0" marginheight="0">\r\n    <frame src="http://<%parameter_virtualservers_current%><%parameter_hostname%><%parameter_currentdir%>/../shared/browser/queue.php?arsc_sid=<%my_sid%>" name="queue" scrolling="auto" marginwidth="2" marginheight="1">\r\n    <frame src="http://<%parameter_socketserver_adress%>:<%parameter_socketserver_port%>/?arsc_sid=<%my_sid%>" name="msg" scrolling="auto" marginwidth="2" marginheight="0">\r\n    <frame src="http://<%parameter_virtualservers_current%><%parameter_hostname%><%parameter_currentdir%>/../shared/browser/input.php?arsc_sid=<%my_sid%>" name="input" scrolling="no" marginwidth="2" marginheight="1">\r\n   </frameset>\r\n   <frame src="http://<%parameter_virtualservers_current%><%parameter_hostname%><%parameter_currentdir%>/../shared/browser/userlist.php?arsc_sid=<%my_sid%>&arsc_current_room=<%my_room%>&arsc_enter=1" name="userlist" scrolling="auto" marginwidth="2" marginheight="2">\r\n  </frameset>\r\n </frameset>\r\n <noframes>\r\n  Sorry, this chat needs a browser that understands framesets. But we have a lynx-friendly version too, check the login page!\r\n </noframes>\r\n</html>');
INSERT INTO `arsc_layouts` VALUES (2, 'display', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<html>\r\n <head>\r\n  <title>\r\n   <%parameter_title%>\r\n  </title>\r\n </head>\r\n  <frameset cols="*,120" border="0" framespacing="no" frameborder="0" marginwidth="2" marginheight="1">\r\n   <frameset rows="0,0,*" border="1" framespacing="no" frameborder="0" marginwidth="2" marginheight="1">\r\n    <frame src="http://<%parameter_virtualservers_current%><%parameter_hostname%><%parameter_currentdir%>/../shared/browser/ping.php?arsc_sid=<%my_sid%>" name="ping" scrolling="no" marginwidth="0" marginheight="0">\r\n    <frame src="http://<%parameter_virtualservers_current%><%parameter_hostname%><%parameter_currentdir%>/../shared/browser/empty.php" name="empty" scrolling="no" marginwidth="0" marginheight="0">\r\n    <frame src="http://<%parameter_virtualservers_current%><%parameter_hostname%><%parameter_currentdir%>/chatmsg.php?arsc_sid=<%my_sid%>" name="msg" scrolling="auto" marginwidth="2" marginheight="0">\r\n   </frameset>\r\n   <frame src="http://<%parameter_virtualservers_current%><%parameter_hostname%><%parameter_currentdir%>/../shared/browser/userlist.php?arsc_sid=<%my_sid%>&arsc_current_room=<%my_room%>&arsc_enter=1" name="userlist" scrolling="auto" marginwidth="2" marginheight="2">\r\n  </frameset>\r\n </frameset>\r\n <noframes>\r\n  Sorry, this chat needs a browser that understands framesets. But we have a lynx-friendly version too, check the login page!\r\n </noframes>\r\n</html>', '<html>\r\n <head>\r\n  <title>\r\n   <%parameter_title%>\r\n  </title>\r\n </head>\r\n  <frameset cols="*,120" border="0" framespacing="no" frameborder="0" marginwidth="2" marginheight="1">\r\n   <frameset rows="0,*" border="1" framespacing="no" frameborder="0" marginwidth="2" marginheight="1">\r\n    <frame src="http://<%parameter_virtualservers_current%><%parameter_hostname%><%parameter_currentdir%>/../shared/browser/empty.php" name="empty" scrolling="no" marginwidth="0" marginheight="0">\r\n    <frame src="http://<%parameter_socketserver_adress%>:<%parameter_socketserver_port%>/?arsc_sid=<%my_sid%>" name="msg" scrolling="auto" marginwidth="2" marginheight="0">\r\n   </frameset>\r\n   <frame src="http://<%parameter_virtualservers_current%><%parameter_hostname%><%parameter_currentdir%>/../shared/browser/userlist.php?arsc_sid=<%my_sid%>&arsc_current_room=<%my_room%>&arsc_enter=1" name="userlist" scrolling="auto" marginwidth="2" marginheight="2">\r\n  </frameset>\r\n </frameset>\r\n <noframes>\r\n  Sorry, this chat needs a browser that understands framesets. But we have a lynx-friendly version too, check the login page!\r\n </noframes>\r\n</html>');
INSERT INTO `arsc_layouts` VALUES (3, 'InRoomChat', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<html>\r\n <head>\r\n  <title>roomlist</title>\r\n  <meta http-equiv="Content-Type" content="text/html; charset=<%lang_charset%>">\r\n  <%layout_scrolling_script%>\r\n  <%layout_help_script%>\r\n  <%layout_drawboard_script%>\r\n </head>\r\n   <body bgcolor="<%layout_default_background_color%>" text="<%layout_default_font_color%>" link="<%layout_default_font_color%>" vlink="<%layout_default_font_color%>">\r\n  <table width="95%" bgcolor="<%layout_default_foreground_color%>" align="center">\r\n   <tr>\r\n    <td>\r\n     <%layout_roomlist_form%>\r\n     <div align="right">\r\n      <font face="<%layout_small_font_face%>" size="<%layout_small_font_size%>" color="<%layout_small_font_color%>">\r\n       [<a href="roomlist.php?arsc_sid=<%my_sid%>"><%lang_refresh%></a>]\r\n      </font>\r\n     </div>\r\n    </td>\r\n   </tr>\r\n  </table>\r\n  <br>\r\n  <table width="95%" bgcolor="<%layout_default_foreground_color%>" align="center">\r\n   <tr>\r\n    <td>\r\n     <font face="<%layout_default_font_face%>" size="<%layout_default_font_size%>" color="<%layout_default_font_color%>">\r\n      <b>\r\n       <%lang_otherfunctions%>:\r\n      </b>\r\n      <%layout_scrolling_form%>\r\n      <%layout_drawboard_link%>\r\n      <li> <b><%layout_help_link%></b></li>\r\n      <li> <a href="<%parameter_baseurl%>base/logout.php?arsc_sid=<%my_sid%>&arsc_post_logout=true" target="_parent"><%lang_leave%></a></li>\r\n     </font>\r\n    </td>\r\n   </tr>\r\n  </table>\r\n  <br>\r\n  <table width="95%" bgcolor="<%layout_default_foreground_color%>" align="center">\r\n   <tr>\r\n    <td>\r\n     <%layout_colorselection_table%>\r\n    </td>\r\n   </tr>\r\n  </table>\r\n  <br>\r\n  <table width="95%" bgcolor="<%layout_default_foreground_color%>" align="center">\r\n   <tr>\r\n    <td align="center">\r\n     <a href="chatins.php?arsc_sid=<%my_sid%>&arsc_message=/greencard/&arsc_chatversion=<%my_version%>" target="empty" title="Agree"><img src="<%parameter_smilies_path%>18.gif" border="0"></a>\r\n     <a href="chatins.php?arsc_sid=<%my_sid%>&arsc_message=/redcard/&arsc_chatversion=<%my_version%>" target="empty" title="Disagree"><img src="<%parameter_smilies_path%>19.gif" border="0"></a>\r\n     <a href="chatins.php?arsc_sid=<%my_sid%>&arsc_message=/yellowcard/&arsc_chatversion=<%my_version%>" target="empty" title="Caution"><img src="<%parameter_smilies_path%>20.gif" border="0"></a>\r\n     <a href="chatins.php?arsc_sid=<%my_sid%>&arsc_message=/greycard/&arsc_chatversion=<%my_version%>" target="empty" title="Clarification, please"><img src="<%parameter_smilies_path%>21.gif" border="0"></a>\r\n    </td>\r\n   </tr>\r\n  </table>\r\n </body>\r\n</html>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>', '<%use_default_layout%>');

CREATE TABLE `arsc_levels` (
  `command` char(8) NOT NULL default '0',
  `level0` tinyint(4) NOT NULL default '0',
  `level10` tinyint(4) NOT NULL default '0',
  `level20` tinyint(4) NOT NULL default '0',
  `level30` tinyint(4) NOT NULL default '0',
  `level99` tinyint(4) NOT NULL default '0',
  KEY `command` (`command`)
) TYPE=MyISAM;

INSERT INTO `arsc_levels` VALUES ('whois', 0, 1, 0, 1, 1);
INSERT INTO `arsc_levels` VALUES ('kick', 0, 1, 0, 1, 1);
INSERT INTO `arsc_levels` VALUES ('bann', 0, 0, 0, 0, 1);
INSERT INTO `arsc_levels` VALUES ('rip', 0, 1, 0, 1, 1);
INSERT INTO `arsc_levels` VALUES ('unrip', 0, 1, 0, 1, 1);
INSERT INTO `arsc_levels` VALUES ('op', 0, 0, 0, 1, 1);
INSERT INTO `arsc_levels` VALUES ('deop', 0, 0, 0, 1, 1);
INSERT INTO `arsc_levels` VALUES ('move', 0, 1, 0, 1, 1);
INSERT INTO `arsc_levels` VALUES ('color', 1, 1, 1, 1, 1);
INSERT INTO `arsc_levels` VALUES ('msg', 1, 1, 0, 1, 1);
INSERT INTO `arsc_levels` VALUES ('msgops', 0, 1, 1, 1, 1);
INSERT INTO `arsc_levels` VALUES ('opcall', 1, 1, 1, 1, 1);
INSERT INTO `arsc_levels` VALUES ('room', 1, 1, 1, 1, 1);
INSERT INTO `arsc_levels` VALUES ('invite', 1, 1, 0, 0, 1);
INSERT INTO `arsc_levels` VALUES ('smilies', 1, 1, 1, 1, 1);
INSERT INTO `arsc_levels` VALUES ('roomlist', 1, 1, 1, 1, 1);
INSERT INTO `arsc_levels` VALUES ('userlist', 1, 1, 1, 1, 1);
INSERT INTO `arsc_levels` VALUES ('croom', 1, 1, 0, 0, 1);
INSERT INTO `arsc_levels` VALUES ('whois', 0, 1, 0, 1, 1);
INSERT INTO `arsc_levels` VALUES ('kick', 0, 1, 0, 1, 1);
INSERT INTO `arsc_levels` VALUES ('bann', 0, 0, 0, 0, 1);
INSERT INTO `arsc_levels` VALUES ('rip', 0, 1, 0, 1, 1);
INSERT INTO `arsc_levels` VALUES ('unrip', 0, 1, 0, 1, 1);
INSERT INTO `arsc_levels` VALUES ('op', 0, 0, 0, 1, 1);
INSERT INTO `arsc_levels` VALUES ('deop', 0, 0, 0, 1, 1);
INSERT INTO `arsc_levels` VALUES ('move', 0, 1, 0, 1, 1);
INSERT INTO `arsc_levels` VALUES ('color', 1, 1, 1, 1, 1);
INSERT INTO `arsc_levels` VALUES ('msg', 1, 1, 0, 1, 1);
INSERT INTO `arsc_levels` VALUES ('msgops', 0, 1, 1, 1, 1);
INSERT INTO `arsc_levels` VALUES ('opcall', 1, 1, 1, 1, 1);
INSERT INTO `arsc_levels` VALUES ('room', 1, 1, 1, 1, 1);
INSERT INTO `arsc_levels` VALUES ('invite', 1, 1, 0, 0, 1);
INSERT INTO `arsc_levels` VALUES ('smilies', 1, 1, 1, 1, 1);
INSERT INTO `arsc_levels` VALUES ('roomlist', 1, 1, 1, 1, 1);
INSERT INTO `arsc_levels` VALUES ('userlist', 1, 1, 1, 1, 1);
INSERT INTO `arsc_levels` VALUES ('croom', 1, 1, 0, 0, 1);

CREATE TABLE `arsc_moderation_queue` (
  `id` int(11) NOT NULL auto_increment,
  `rooms_id` int(11) NOT NULL default '0',
  `user` varchar(64) NOT NULL default '',
  `message` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE `arsc_parameters` (
  `name` varchar(255) NOT NULL default '',
  `value` text NOT NULL,
  `description` text NOT NULL,
  UNIQUE KEY `name` (`name`)
) TYPE=MyISAM;

INSERT INTO `arsc_parameters` VALUES ('socketserver_use', 'no', 'THE ARSC SOCKET SERVER IS NOT STABLE AND NOT RECOMMENDED FOR PRODUCTION USE! YOU HAVE BEEN WARNED! Do you want to use the socket server? Say <b>yes</b> or <b>no</b>. Please note that the socket server must be running, or your visitors will not be able to log in.');
INSERT INTO `arsc_parameters` VALUES ('socketserver_adress', 'manuel.kiessling.net', 'What is the public IP adress or DNS name of the socket server?');
INSERT INTO `arsc_parameters` VALUES ('socketserver_port', '8080', 'At which port do you want the socket server to listen?');
INSERT INTO `arsc_parameters` VALUES ('socketserver_maximumusers', '200', 'How many user do you want to allow to connect to the socket server at the most?');
INSERT INTO `arsc_parameters` VALUES ('refresh', '600000', 'The streaming versions of ARSC (socket_server and browser_push) wait this long before they check for new messages between every pass. This value is in microseconds (1000000 = 1 second). Set higher (800000 - 1000000) in order to save system resources, and lower (300000 - 400000) to get faster respond times.');
INSERT INTO `arsc_parameters` VALUES ('title', 'ARSC Really Simple Chat', 'What is the name of your ARSC installation? This text will be visible on the HTML pages of your installation.');
INSERT INTO `arsc_parameters` VALUES ('default_language', 'english', 'Which language do you want to set as the default language?');
INSERT INTO `arsc_parameters` VALUES ('smilies', 'yes', 'Do you want to allow the use of graphical smilies? Say <b>yes</b> or <b>no</b>.');
INSERT INTO `arsc_parameters` VALUES ('smilies_path', 'http://manuel.kiessling.net/arsc3/3.1-rc1/base/pic/smilies/', 'What is the URL to your smilies directory?');
INSERT INTO `arsc_parameters` VALUES ('register_force', 'no', 'Do you want to force your visitors to register before they can use your chat? Say <b>yes</b> or <b>no</b>.');
INSERT INTO `arsc_parameters` VALUES ('flood_max', '4', 'ARSC has some kind of flood protection. This value defines how often a user may successively write the same text. He will then be asked to stop flooding, if he continues, he will get kicked.');
INSERT INTO `arsc_parameters` VALUES ('first_user_gets_op', 'no', 'Do you want that the first user who enters the chat automatically becomes operator? Say <b>yes</b> or <b>no</b>.');
INSERT INTO `arsc_parameters` VALUES ('keep_sended_message', 'no', 'Do you want that a message one types into the input field will remain in the input field after the message was sent? Say <b>yes</b> or <b>no</b>.');
INSERT INTO `arsc_parameters` VALUES ('input_maxsize', '400', 'This value defines how many characters a user is allowed to send in one message.');
INSERT INTO `arsc_parameters` VALUES ('register_owner', 'ARSC Chat Administrator', 'This name will be used in eMails sent by ARSC (e.g. upon registration).');
INSERT INTO `arsc_parameters` VALUES ('register_owner_email', 'webmaster@manuel.kiessling.net', 'This is the eMail address from which eMails sent by ARSC will originate.');
INSERT INTO `arsc_parameters` VALUES ('register_homepage', 'http://manuel.kiessling.net/arsc3/3.1-rc1/', 'This is the URL which will be mentioned in eMails sent by ARSC.');
INSERT INTO `arsc_parameters` VALUES ('ping', '60', 'This value defines after how many seconds of inactivity a user will become idle.');
INSERT INTO `arsc_parameters` VALUES ('ping_text', '600', 'This value defines after how many seconds of inactivity a text-browser user will become idle. Set reasonably high!');
INSERT INTO `arsc_parameters` VALUES ('ping_idle', '3600', 'This value defines after how many seconds of inactivity an idle user will be logged out.');
INSERT INTO `arsc_parameters` VALUES ('ping_refresh', '8', 'This value defines after how many seconds the ping frame will be refreshed, sending a heartbeat of the user. Please make sure that this value is never higher than the value defined by "ping".');
INSERT INTO `arsc_parameters` VALUES ('userlist_refresh', '8', 'This value defines after how many seconds the user list frame will be refreshed.');
INSERT INTO `arsc_parameters` VALUES ('roomlist_refresh', '240', 'This value defines after how many seconds the room list frame will be refreshed.');
INSERT INTO `arsc_parameters` VALUES ('rowlimit', '100', 'This value defines how many entries will be hold in the database table of each room at the most. This is used to avoid an unlimited grow of the database tables, which would slow things down. Set this higher if you have really many users chatting at the same time.');
INSERT INTO `arsc_parameters` VALUES ('baseurl', 'http://manuel.kiessling.net/arsc3/3.1-rc1/', 'This is the URL of your installation. Do not change unless you know what you are doing!');
INSERT INTO `arsc_parameters` VALUES ('default_layout_id', '1', 'The ID of the layout which will be used as the default.');
INSERT INTO `arsc_parameters` VALUES ('virtualservers_name', 'srv%.', 'The subdomain prefix for virtual servers.');
INSERT INTO `arsc_parameters` VALUES ('virtualservers_use', 'no', 'Do you want to use virtual servers? Say <b>yes</b> or <b>no</b>. Read about virtual servers in the manual!');
INSERT INTO `arsc_parameters` VALUES ('welcome_message', '', 'This message is shown to every user upon login.');
INSERT INTO `arsc_parameters` VALUES ('queue_refresh', '10', 'This value is the time in seconds after which the Message Queue (in moderated rooms, visible only to Moderators and VIPs) will be refreshed.');
INSERT INTO `arsc_parameters` VALUES ('queue_listsize', '5', 'The number of entries which are shown in the Message Queue frame at the most.');
INSERT INTO `arsc_parameters` VALUES ('disable_browser_push', 'no', 'Do you want to disable browser_push? If you can successfully log into the chat with version browser_push, but the message frame remains white, then you can disable this chatversion completely. browser_xmlhttprequest will then be the default chat version. Say <b>yes</b> or <b>no</b>.');
INSERT INTO `arsc_parameters` VALUES ('moderated_login_visible', 'no', 'Do you want to enable status messages in moderated rooms? This is disabled by default so login messages can not be used to flood or to send messages. Say <b>yes</b> or <b>no</b>.');

CREATE TABLE `arsc_registered_users` (
  `id` int(11) NOT NULL auto_increment,
  `user` varchar(64) NOT NULL default '',
  `password` varchar(40) NOT NULL default '',
  `admin_sessionid` varchar(40) NOT NULL default '',
  `language` varchar(32) NOT NULL default '',
  `level` tinyint(4) NOT NULL default '0',
  `color` varchar(6) NOT NULL default '000000',
  `template` varchar(32) NOT NULL default '',
  `layout` int(11) NOT NULL default '0',
  `email` varchar(128) NOT NULL default '',
  `sex` tinyint(4) NOT NULL default '0',
  `location` varchar(255) NOT NULL default '',
  `hobbies` text NOT NULL,
  `flag_guestbook` tinyint(4) NOT NULL default '0',
  `flag_locked` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `user` (`user`),
  KEY `admin_sessionid` (`admin_sessionid`)
) TYPE=MyISAM;

INSERT INTO `arsc_registered_users` VALUES (1, 'Administrator', 'f2b2e72bed67c9db5e68822c71608a0437fe3f32', '3136a43fa1433a891d166eb87f3bb748393a822f', 'english', 99, '000000', 'html', 1, '', 0, '', '', 0, 0);
INSERT INTO `arsc_registered_users` VALUES (2, 'Display', '8a6b8cd6e4cdef76b97009bf1d02bdf177d40269', '', 'english', 0, '000000', 'display', 2, '', 1, '', 'Showing big text!', 0, 0);
INSERT INTO `arsc_registered_users` VALUES (3, 'Moderator', '749340542678a36e4624dbbe23c1b83200461b07', '', 'english', 30, '0000CC', 'html', 1, '', 1, '', '', 0, 0);
INSERT INTO `arsc_registered_users` VALUES (4, 'VIP', '0aa62908fef195b77637474707497aacc4172910', '', 'english', 20, 'FF9900', 'html', 1, '', 0, '', '', 0, 0);

CREATE TABLE `arsc_room_free_for_all` (
  `id` int(11) NOT NULL auto_increment,
  `message` text NOT NULL,
  `user` varchar(64) NOT NULL default '',
  `flag_ripped` tinyint(4) NOT NULL default '0',
  `flag_gotmsg` tinyint(4) NOT NULL default '0',
  `flag_moderated` tinyint(4) NOT NULL default '0',
  `sendtime` time NOT NULL default '00:00:00',
  `timeid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `timeid` (`timeid`),
  KEY `flag_ripped` (`flag_ripped`)
) TYPE=MyISAM;

CREATE TABLE `arsc_room_inroom_chat` (
  `id` int(11) NOT NULL auto_increment,
  `message` text NOT NULL,
  `user` varchar(64) NOT NULL default '',
  `flag_ripped` tinyint(4) NOT NULL default '0',
  `flag_gotmsg` tinyint(4) NOT NULL default '0',
  `flag_moderated` tinyint(4) NOT NULL default '0',
  `sendtime` time NOT NULL default '00:00:00',
  `timeid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `timeid` (`timeid`),
  KEY `flag_ripped` (`flag_ripped`)
) TYPE=MyISAM;

CREATE TABLE `arsc_room_vip_lounge` (
  `id` int(11) NOT NULL auto_increment,
  `message` text NOT NULL,
  `user` varchar(64) NOT NULL default '',
  `flag_ripped` tinyint(4) NOT NULL default '0',
  `flag_gotmsg` tinyint(4) NOT NULL default '0',
  `flag_moderated` tinyint(4) NOT NULL default '0',
  `sendtime` time NOT NULL default '00:00:00',
  `timeid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `timeid` (`timeid`),
  KEY `flag_ripped` (`flag_ripped`)
) TYPE=MyISAM;

CREATE TABLE `arsc_rooms` (
  `id` int(11) NOT NULL auto_increment,
  `roomname` varchar(32) NOT NULL default '',
  `roomname_nice` varchar(64) NOT NULL default '',
  `description` text NOT NULL,
  `owner` varchar(64) NOT NULL default '0',
  `password` varchar(6) NOT NULL default '',
  `type` smallint(6) NOT NULL default '0',
  `layout_id` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `roomname_nice` (`roomname_nice`),
  UNIQUE KEY `roomname` (`roomname`)
) TYPE=MyISAM;

INSERT INTO `arsc_rooms` VALUES (1, 'free_for_all', 'Free For All', 'The lounge is the entry room for all your needs. Get in touch here and explore the other rooms.', '-1', '', 0, 1);
INSERT INTO `arsc_rooms` VALUES (2, 'vip_lounge', 'VIP Lounge (moderated)', 'This room is moderated.', '-1', '', 2, 1);
INSERT INTO `arsc_rooms` VALUES (3, 'inroom_chat', 'InRoom Chat', 'For chat sessions at conferences, where all people are in one room.', '-1', '', 0, 3);

CREATE TABLE `arsc_smilies` (
  `id` int(11) NOT NULL default '0',
  `value` char(32) NOT NULL default '',
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) TYPE=MyISAM;

INSERT INTO `arsc_smilies` VALUES (0, ':-)');
INSERT INTO `arsc_smilies` VALUES (1, ';-)');
INSERT INTO `arsc_smilies` VALUES (2, ':-(');
INSERT INTO `arsc_smilies` VALUES (3, ':-s');
INSERT INTO `arsc_smilies` VALUES (4, ':-]');
INSERT INTO `arsc_smilies` VALUES (5, ':-[');
INSERT INTO `arsc_smilies` VALUES (6, '/love/');
INSERT INTO `arsc_smilies` VALUES (7, '/thumbsup/');
INSERT INTO `arsc_smilies` VALUES (8, '/thumbsdown/');
INSERT INTO `arsc_smilies` VALUES (9, 'B-)');
INSERT INTO `arsc_smilies` VALUES (10, ':-O');
INSERT INTO `arsc_smilies` VALUES (11, ':P');
INSERT INTO `arsc_smilies` VALUES (12, ':-P');
INSERT INTO `arsc_smilies` VALUES (13, '8-)');
INSERT INTO `arsc_smilies` VALUES (14, '/santa/');
INSERT INTO `arsc_smilies` VALUES (15, ':-/');
INSERT INTO `arsc_smilies` VALUES (16, '/gift/');
INSERT INTO `arsc_smilies` VALUES (17, ':)');
INSERT INTO `arsc_smilies` VALUES (18, '/greencard/');
INSERT INTO `arsc_smilies` VALUES (19, '/redcard/');
INSERT INTO `arsc_smilies` VALUES (20, '/yellowcard/');
INSERT INTO `arsc_smilies` VALUES (21, '/greycard/');

CREATE TABLE `arsc_templates` (
  `template` varchar(32) NOT NULL default '',
  `name` varchar(32) NOT NULL default '',
  `value` text NOT NULL,
  KEY `name` (`name`)
) TYPE=MyISAM;

INSERT INTO `arsc_templates` VALUES ('html', 'normal', '<font face="Arial" size="2" color="{color}"><font color="#999999" size="1">[{sendtime}]</font> <b>&lt;{user}&gt;</b> {message}</font><br>');
INSERT INTO `arsc_templates` VALUES ('html', 'msg', '<font face="Arial" size="2" color="#000099"><font color="#999999" size="1">[{sendtime}]</font> <b>&lt;{user}&gt;</b> {whispers}: <i>{message}</i></font><br>');
INSERT INTO `arsc_templates` VALUES ('html', 'msgops', '<font face="Arial" size="2" color="#FF6C00"><font color="#999999" size="1">[{sendtime}]</font> <b>&lt;{user}&gt;</b> {whispersops}: <i>{message}</i></font><br>');
INSERT INTO `arsc_templates` VALUES ('html', 'me', '<font face="Arial" size="2" color="#9B368A"><font color="#999999" size="1">[{sendtime}]</font> * {user} {message}</font><br>');
INSERT INTO `arsc_templates` VALUES ('html', 'system', '<font face="Arial" size="2" color="#999999"><font size="1">[{sendtime}]</font> <i><b>{message}</b></i></font><br>');
INSERT INTO `arsc_templates` VALUES ('html_moderator', 'system', '<font face="Arial" size="2" color="#999999"><font size="1">[{sendtime}]</font> <i><b>{message}</b></i></font><br>');
INSERT INTO `arsc_templates` VALUES ('html_moderator', 'msgops', '<font face="Arial" size="2" color="#FF6C00"><font color="#999999" size="1">[{sendtime}]</font> <b>&lt;{user}&gt;</b> {whispersops}: <i>{message}</i></font><br>');
INSERT INTO `arsc_templates` VALUES ('html_moderator', 'me', '<font face="Arial" size="2" color="#9B368A"><font color="#999999" size="1">[{sendtime}]</font> * {user} {message}</font><br>');
INSERT INTO `arsc_templates` VALUES ('html_moderator', 'msg', '<font face="Arial" size="2" color="#000099"><font color="#999999" size="1">[{sendtime}]</font> <b>&lt;{user}&gt;</b> {whispers}: <i>{message}</i></font><br>');
INSERT INTO `arsc_templates` VALUES ('html_moderator', 'normal', '<font face="Arial" size="2" color="{color}"><font color="#999999" size="1">[{sendtime}]</font> <b>&lt;{user}&gt;</b> <a href="{path}chatins.php?arsc_toqueue=1&arsc_sid={sid}&arsc_moderate_user={moderate_user}&arsc_message={moderate_message}" target="empty">{message}</a></font><br>');
INSERT INTO `arsc_templates` VALUES ('html_moderated', 'normal', '<font face="Arial" size="2" color="{color}"><font color="#999999" size="1">[{sendtime}]</font> <b>&lt;{user}&gt;</b> {message}</font><br>');
INSERT INTO `arsc_templates` VALUES ('html_moderated', 'msg', '<font face="Arial" size="2" color="#000099"><font color="#999999" size="1">[{sendtime}]</font> <b>&lt;{user}&gt;</b> {whispers}: <i>{message}</i></font><br>');
INSERT INTO `arsc_templates` VALUES ('html_moderated', 'msgops', '<font face="Arial" size="2" color="#FF6C00"><font color="#999999" size="1">[{sendtime}]</font> <b>&lt;{user}&gt;</b> {whispersops}: <i>{message}</i></font><br>');
INSERT INTO `arsc_templates` VALUES ('html_moderated', 'me', '<font face="Arial" size="2" color="#9B368A"><font color="#999999" size="1">[{sendtime}]</font> * {user} {message}</font><br>');
INSERT INTO `arsc_templates` VALUES ('html_moderated', 'system', '<font face="Arial" size="2" color="#999999"><font size="1">[{sendtime}]</font> <i><b>{message}</b></i></font><br>');
INSERT INTO `arsc_templates` VALUES ('display', 'normal', '<font face="Arial" size="6" color="{color}"><font color="#999999" size="6">[{sendtime}]</font> <b>&lt;{user}&gt;</b> {message}</font><br>');
INSERT INTO `arsc_templates` VALUES ('display', 'msg', '<font face="Arial" size="6" color="#000099"><font color="#999999" size="6">[{sendtime}]</font> <b>&lt;{user}&gt;</b> {whispers}: <i>{message}</i></font><br>');
INSERT INTO `arsc_templates` VALUES ('display', 'msgops', '<font face="Arial" size="6" color="#FF6C00"><font color="#999999" size="6">[{sendtime}]</font> <b>&lt;{user}&gt;</b> {whispersops}: <i>{message}</i></font><br>');
INSERT INTO `arsc_templates` VALUES ('display', 'me', '<font face="Arial" size="6" color="#9B368A"><font color="#999999" size="6">[{sendtime}]</font> * {user} {message}</font><br>');
INSERT INTO `arsc_templates` VALUES ('display', 'system', '<font face="Arial" size="6" color="#999999"><font size="6">[{sendtime}]</font> <i><b>{message}</b></i></font><br>');
INSERT INTO `arsc_templates` VALUES ('xml', 'normal', '<arscmessage><type>normal</type><sendtime>{sendtime}</sendtime><sender>{user}</sender><content>{message}</content></arscmessage>');
INSERT INTO `arsc_templates` VALUES ('xml', 'msg', '<arscmessage><type>whisper</type><sendtime>{sendtime}</sendtime><sender>{user}</sender><content>{message}</content></arscmessage>');
INSERT INTO `arsc_templates` VALUES ('xml', 'msgops', '<arscmessage><type>whisperops</type><sendtime>{sendtime}</sendtime><sender>{user}</sender><content>{message}</content></arscmessage>');
INSERT INTO `arsc_templates` VALUES ('xml', 'me', '<arscmessage><type>me</type><sendtime>{sendtime}</sendtime><sender>{user}</sender><content>{message}</content></arscmessage>');
INSERT INTO `arsc_templates` VALUES ('xml', 'system', '<arscmessage><type>system</type><sendtime>{sendtime}</sendtime><sender>{user}</sender><content>{message}</content></arscmessage>');


CREATE TABLE `arsc_traffic` (
  `incoming` int(11) NOT NULL default '0',
  `outgoing` int(11) NOT NULL default '0'
) TYPE=MyISAM;

CREATE TABLE `arsc_users` (
  `id` int(11) NOT NULL auto_increment,
  `user` varchar(64) NOT NULL default '',
  `lastping` int(11) NOT NULL default '0',
  `flag_idle` enum('0', '1') NOT NULL default '0',
  `ip` varchar(15) NOT NULL default '',
  `room` varchar(32) NOT NULL default '',
  `language` varchar(32) NOT NULL default '',
  `version` varchar(32) NOT NULL default '',
  `template` varchar(32) NOT NULL default '0',
  `layout` int(11) NOT NULL default '0',
  `color` varchar(6) NOT NULL default '000000',
  `level` tinyint(11) NOT NULL default '0',
  `flag_ripped` enum('0', '1') NOT NULL default '0',
  `sid` varchar(40) NOT NULL default '',
  `lastmessageping` int(11) NOT NULL default '0',
  `showsince` int(11) NOT NULL default '0',
  `flood_count` tinyint(4) NOT NULL default '0',
  `flood_lastmessage` text NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `sid` (`sid`),
  UNIQUE KEY `user` (`user`),
  KEY `lastping` (`lastping`),
  KEY `flag_idle` (`flag_idle`)
) TYPE=MyISAM;

