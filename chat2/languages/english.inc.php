<?php

/*
 This is an ARSC language file. If you translate it, please send me
 a copy to <manuel@kiessling.net>, I will add it to ARSC then.
 Thanks.

 This file is for versions 3.0-beta1, 3.0-beta2, 3.0-rc1, 3.0, 3.0.1, 3.0.2, 3.0.2-rc1, 3.0.2-rc2
  
 Translation by Manuel Kiessling <manuel@kiessling.net>.
*/




// Define some settings for this language
$arsc_lang_regions["english"] = array("en", "en-en", "en-us");
$arsc_lang_name["english"] = "English";
$arsc_lang["charset"] = "utf-8";


// Language selection

$arsc_lang["chooseyourlanguage"] = "Choose your language:";
$arsc_lang["next"] = "Next";


// Login Page

$arsc_lang["entername"]                      = "Please enter your nickname:";
$arsc_lang["enterpassword"]                  = "Please enter your password:";
$arsc_lang["selectchatversion"]              = "Choose a version:";
$arsc_lang["version_browser_socket"]         = "Streaming";
$arsc_lang["version_browser_push"]           = "Streaming, firewall compatible";
$arsc_lang["version_browser_xmlhttprequest"] = "Non-streaming, firewall compatible";
$arsc_lang["version_browser_refresh"]        = "Non-streaming, firewall compatible, no javascript";
$arsc_lang["version_browser_text"]           = "For text browsers";
$arsc_lang["yes"]                            = "Yes";
$arsc_lang["no"]                             = "No";
$arsc_lang["selectroom"]                     = "Choose a room:";
$arsc_lang["createdby"]                      = "Created by";
$arsc_lang["startbutton"]                    = "Start the chat!";
$arsc_lang["usersinchat"]                    = "These users are currently logged in:";
$arsc_lang["usersinchat_room"]               = "Room";
$arsc_lang["usersinchat_name"]               = "User";
$arsc_lang["usersinchat_idlenote"]           = "A * denotes idle users.";
$arsc_lang["clicktoregister"]                = "Register your nickname!";


// Why kicked page

$arsc_lang["why_kicked"] = "Your session has ended, probably because of a timeout, or due to behaviour that was not according with the rules of this chat.";
$arsc_lang["returntologinpage"] = "Return to the login page";


// Register page and eMail

$arsc_lang["register_intro"]                 = "To register your nickname fill in the fields below.";
$arsc_lang["register_intro_force"]           = "A password will then be sent to the given eMail adress.";
$arsc_lang["register_entername"]             = "Nickname:";
$arsc_lang["register_enteremail"]            = "eMail address:";
$arsc_lang["register_enterpassword"]         = "Password:";
$arsc_lang["register_send"]                  = "Submit registration";
$arsc_lang["register_yougetmail"]            = "Thanks, you will now get an eMail with your password.";
$arsc_lang["register_emailtemplate_subject"] = "Your registration for {title}";
$arsc_lang["register_emailtemplate_body"]    = "
Hello,

You registered for {title}.

You chose the nickname '{username}'.
It is now protected with this password:

            '{password}'

You can now log into the chat on this page:
{homepage}

Have a lot of fun!

-- 
 {chatowner}

";


// Chat interface

$arsc_lang["usersinroom"]               = "Users in room";
$arsc_lang["sendmessage"]               = "Send";
$arsc_lang["refreshmessages"]           = "Refresh Messages";
$arsc_lang["leave"]                     = "Leave";
$arsc_lang["roomlist"]                  = "Roomlist";
$arsc_lang["go_room"]                   = "Enter";
$arsc_lang["refresh"]                   = "Refresh";
$arsc_lang["otherfunctions"]            = "Additional functions";
$arsc_lang["smilielist"]                = "List of all smilies";
$arsc_lang["scroll_active"]             = "Autoscroll";
$arsc_lang["select_color"]              = "Select your color";
$arsc_lang["moderatorqueue_title"]      = "Unanswered questions";
$arsc_lang["moderatorqueue_delete"]     = "Delete";
$arsc_lang["moderatorqueue_youranswer"] = "Your answer";
$arsc_lang["moderatorqueue_cancel"]     = "Cancel";
$arsc_lang["drawboard"]                 = "Drawboard";

$arsc_lang["cmd_m"]           = "Click to send a message to this user";
$arsc_lang["opcmd_w"]         = "Show extended information about this user";
$arsc_lang["opcmd_k"]         = "Kick this user out of the room";
$arsc_lang["opcmd_b"]         = "Ban this users IP adress for some time";
$arsc_lang["opcmd_l"]         = "Lock this user permanently (if he is registered)";
$arsc_lang["opcmd_r"]         = "RIP this user (so he cannot talk)";
$arsc_lang["opcmd_u"]         = "UnRIP this user (so he can talk again)";
$arsc_lang["opcmd_o"]         = "Give this user operator status";
$arsc_lang["opcmd_d"]         = "Take operator status from this user";
$arsc_lang["opcmd_m"]         = "Move user from this room into another";
$arsc_lang["opcmd_id"]        = "Show the ID card of this user";


// Errors

$arsc_lang["error_register_double_user"] = "This nickname is already in use. Please choose another one.";
$arsc_lang["error_double_user"]          = "A user with this name is already logged in!";
$arsc_lang["error_no_name"]              = "You must enter an username!";
$arsc_lang["error_bad_name"]             = "This name is not allowed!";
$arsc_lang["error_wrong_credentials"]    = "Access denied!<br>Are your credentials correct?";
$arsc_lang["error_banned"]               = "Access is temporarily denied.";


// IDCard

$arsc_lang["idcard_title"]               = "ID Card of";
$arsc_lang["idcard_sex"]                 = "Gender:";
$arsc_lang["idcard_male"]                = "male";
$arsc_lang["idcard_female"]              = "female";
$arsc_lang["idcard_location"]            = "Location:";
$arsc_lang["idcard_color"]               = "Default color:";
$arsc_lang["idcard_hobbies"]             = "Hobbies:";
$arsc_lang["idcard_save"]                = "Save";
$arsc_lang["idcard_save_ok"]             = "Changes were saved";
$arsc_lang["idcard_save_no"]             = "Changes could not be saved";
$arsc_lang["idcard_guestbook"]           = "Guestbook:";
$arsc_lang["idcard_guestbook_active"]    = "Show guestbook?";
$arsc_lang["idcard_guestbook_delete"]    = "Delete";
$arsc_lang["idcard_guestbook_delete_ok"] = "Entry was deleted";
$arsc_lang["idcard_guestbook_delete_no"] = "Entry could not be deleted!";
$arsc_lang["idcard_guestbook_add"]       = "Add entry";
$arsc_lang["idcard_guestbook_add_ok"]    = "Your entry was added";
$arsc_lang["idcard_guestbook_add_no"]    = "Your entry could not be added!";
$arsc_lang["idcard_guestbook_next"]      = "Next entries";
$arsc_lang["idcard_guestbook_prev"]      = "Previous entries";
$arsc_lang["idcard_close"]               = "Close";


// Chat System Messages

$arsc_lang["enter"]               = "User {user} enters the room {room}.";
$arsc_lang["welcome"]             = "Welcome to {title}!";
$arsc_lang["quit"]                = "User {user} leaves the room {room}.";
$arsc_lang["roomchange"]          = "User {user} leaves the room {room1} and enters room {room2}.";
$arsc_lang["kicked"]              = "User {userpassive} was kicked out of the chat by {useractive}.";
$arsc_lang["youwerekicked"]       = "You were kicked out of the chat!";
$arsc_lang["floodwarn"]           = "STOP FLOODING NOW or you will have to leave!";
$arsc_lang["op"]                  = "User {userpassive} got operator status from {useractive}.";
$arsc_lang["deop"]                = "User {useractive} removed the operator status of {userpassive}.";
$arsc_lang["whispers"]            = "whispers";
$arsc_lang["whispersops"]         = "whispers to all operators";
$arsc_lang["gotmsg"]              = "You whispered to {user}: {message}";
$arsc_lang["croom"]               = "User {user} decides to withdraw in his private room {room}.";
$arsc_lang["room_exists"]         = "Sorry, but the room {room} already exists.";
$arsc_lang["room_badname"]        = "Sorry, this roomname is not acceptable.";
$arsc_lang["room_created"]        = "Your private room '{room}' was successfully created! Now you can invite someone using the /invite command.";
$arsc_lang["invite"]              = "User {user} has invited you to his room {room}. Type \"/room {room} {password}\" to enter this room.";
$arsc_lang["invite_notexist"]     = "Sorry, the user {user} does not exist.";
$arsc_lang["invite_notownroom"]   = "Sorry, you must be in your own private room to invite other users.";
$arsc_lang["room_not_exist"]      = "Sorry, but the room {room} does not exist";
$arsc_lang["room_wrong_password"] = "Sorry, but you must deliver the correct password to enter room {room}";
$arsc_lang["moderate_message"]    = "Your message `{message}` was delivered to the moderator and will be checked.";
$arsc_lang["opcall"]              = "[OPCALL] I need help!";

$arsc_lang["helplink"]      = "Help";
$arsc_lang["help"]          = "
General Help:
In the right frame you see all users
who are currently in the room.

Users with an @ in front of their name
are operators and can kick users out of
the room, give operator status to other
users, and take away their operator status.

If you click on a name on the right, the input
field will be filled with the command that is
necessary to send a private message to this user.
You only have to append your message to the end
of the command line.

General Commands:
/me message -- Symbolizes an action, e.g. /me feels fine writes * User feels fine
/msg user message -- Sends a private message to an user
/j AnotherRoom -- Leaves the current room and enters room 'AnotherRoom'
/room room -- An alias to /j";

$arsc_lang["helpop"]        = "
Operator Commands:
/msgops message -- Whispers a message to all operators
/whois user -- Shows information about user
/op user -- Gives operator status to user
/deop user -- Takes operator status from user
/kick user -- Kicks user out of the chat
/bann user X -- Blocks IP of user for X seconds
/lock user -- Lock account of (registered!) user permanently
/rip user -- What user says is not shown
/unrip user -- What user says is shown again
/move user room -- Moves user into room";

?>
