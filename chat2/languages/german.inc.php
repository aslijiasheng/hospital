<?php

/*
 This is an ARSC language file. If you translate it, please send me
 a copy to <manuel@kiessling.net>, I will add it to ARSC then.
 Thanks.

 This file is for versions 3.0-beta1, 3.0-beta2, 3.0-rc1, 3.0, 3.0.1, 3.0.2, 3.0.2-rc1, 3.0.2-rc2
  
 Translation by Manuel Kiessling <manuel@kiessling.net>.
*/

// Include the english file, in order to provide english text if the current file has some sentences missing.
include("english.inc.php");

// Define some settings for this language
$arsc_lang_regions["german"] = array("de", "de-de", "de-at");
$arsc_lang_name["german"] = "Deutsch";
$arsc_lang["charset"] = "utf-8";


// Language selection

$arsc_lang["chooseyourlanguage"] = "W&auml;hlen Sie Ihre Sprache:";
$arsc_lang["next"] = "Weiter";


// Login Page

$arsc_lang["entername"]                      = "Ihr Nickname:";
$arsc_lang["enterpassword"]                  = "Ihr Passwort:";
$arsc_lang["selectchatversion"]              = "W&auml;hlen Sie eine Chatversion:";
$arsc_lang["version_browser_socket"]         = "Streaming";
$arsc_lang["version_browser_push"]           = "Streaming, Firewall kompatibel";
$arsc_lang["version_browser_xmlhttprequest"] = "Kein Streaming, Firewall kompatibel";
$arsc_lang["version_browser_refresh"]        = "Kein Streaming, Firewall kompatibel, kein Javascript";
$arsc_lang["version_browser_text"]           = "F&uuml;r Textbrowser";
$arsc_lang["yes"]                            = "Ja";
$arsc_lang["no"]                             = "Nein";
$arsc_lang["selectroom"]                     = "W&auml;hlen Sie einen Raum:";
$arsc_lang["createdby"]                      = "angelegt von";
$arsc_lang["startbutton"]                    = "Den Chat betreten";
$arsc_lang["usersinchat"]                    = "Diese User sind zur Zeit online:";
$arsc_lang["usersinchat_room"]               = "Raum";
$arsc_lang["usersinchat_name"]               = "User";
$arsc_lang["clicktoregister"]                = "Registrieren Sie Ihren Nickname!";


// Why kicked? Page

$arsc_lang["why_kicked"] = "Ihre Sitzung wurde beendet, m&ouml;glicherweise durch einen Timeout, oder durch nicht regelkonformes Verhalten.";
$arsc_lang["returntologinpage"] = "Zur&uuml;ck zur Loginseite";


// Register page and eMail

$arsc_lang["register_intro"]                 = "Um Ihren Nicknamen zu registrieren, f&uuml;llen Sie bitte die Felder aus.";
$arsc_lang["register_intro_force"]           = "Ihnen wird dann ein Passwort an die angegebene Adresse gesandt.";
$arsc_lang["register_entername"]             = "Nickname:";
$arsc_lang["register_enteremail"]            = "eMail-Adresse:";
$arsc_lang["register_enterpassword"]         = "Passwort:";
$arsc_lang["register_send"]                  = "Absenden";
$arsc_lang["register_yougetmail"]            = "Danke, Sie erhalten nun eine eMail mit Ihrem Passwort.";
$arsc_lang["register_emailtemplate_subject"] = "Ihre {title} Registrierung.";
$arsc_lang["register_emailtemplate_body"]    = "
Hallo,

Sie haben sich beim {title} registriert.

Sie wählten den Nicknamen '{username}'.
Dieser ist nun mit folgendem Passwort geschützt:

            '{password}'

Sie können sich nun in den Chat einloggen:
{homepage}

Viel Spass!

-- 
 {chatowner}

";


// Chat interface

$arsc_lang["usersinroom"]               = "User in Raum";
$arsc_lang["sendmessage"]               = "Senden";
$arsc_lang["refreshmessages"]           = "Nachrichten aktualisieren";
$arsc_lang["leave"]                     = "Chat verlassen";
$arsc_lang["roomlist"]                  = "Raumliste";
$arsc_lang["go_room"]                   = "Betreten";
$arsc_lang["refresh"]                   = "Aktualisieren";
$arsc_lang["otherfunctions"]            = "Weitere Funktionen";
$arsc_lang["smilielist"]                = "Liste verf&uuml;gbarer Smilies";
$arsc_lang["scroll_active"]             = "Automatisch scrollen";
$arsc_lang["select_color"]              = "W&auml;hlen Sie Ihre Textfarbe";
$arsc_lang["moderatorqueue_title"]      = "Unbeantwortete Fragen";
$arsc_lang["moderatorqueue_delete"]     = "L&ouml;schen";
$arsc_lang["moderatorqueue_youranswer"] = "Ihre Antwort";
$arsc_lang["moderatorqueue_cancel"]     = "Abbrechen";
$arsc_lang["drawboard"]                 = "Drawboard";

$arsc_lang["cmd_m"]           = "Hier klicken um dem User eine Nachricht zu senden";
$arsc_lang["opcmd_w"]         = "Erweiterte Informationen &uuml;ber diesen User anzeigen";
$arsc_lang["opcmd_k"]         = "Diesen User des Raumes verweisen.";
$arsc_lang["opcmd_b"]         = "Die IP-Adresse dieses Users f&uuml;r einen bestimmten Zeitraum sperren";
$arsc_lang["opcmd_l"]         = "Diesen User permanent sperren (nur mit registrierten Usern m&ouml;glich)";
$arsc_lang["opcmd_r"]         = "Diesen User stumm schalten";
$arsc_lang["opcmd_u"]         = "Diesen User wieder freischalten";
$arsc_lang["opcmd_o"]         = "Diesem User Operatorenstatus geben";
$arsc_lang["opcmd_d"]         = "Diesem User Operatorenstatus entziehen";
$arsc_lang["opcmd_m"]         = "Diesen User in einen anderen Raum verschieben";
$arsc_lang["opcmd_id"]        = "ID-Card dieses Users anzeigen";


// Errors

$arsc_lang["error_register_double_user"] = "Dieser Nickname wird bereits verwendet, bitte w&auml;hlen Sie einen anderen.";
$arsc_lang["error_double_user"]          = "Dieser Nickname wird bereits verwendet, bitte w&auml;hlen Sie einen anderen.";
$arsc_lang["error_no_name"]              = "Sie m&uuml;ssen einen Nicknamen angeben!";
$arsc_lang["error_bad_name"]             = "Dieser Nickname ist nicht erlaubt!";
$arsc_lang["error_wrong_credentials"]    = "Zugriff verweigert - stimmen Ihre Zugangsdaten?";
$arsc_lang["error_banned"]               = "Ihr Zugriff wurde zeitweise gesperrt.";


// IDCard

$arsc_lang["idcard_title"]               = "ID-Card von";
$arsc_lang["idcard_sex"]                 = "Geschlecht:";
$arsc_lang["idcard_male"]                = "m&auml;nnlich";
$arsc_lang["idcard_female"]              = "weiblich";
$arsc_lang["idcard_location"]            = "Ort:";
$arsc_lang["idcard_color"]               = "Standardfarbe:";
$arsc_lang["idcard_hobbies"]             = "Hobbies:";
$arsc_lang["idcard_save"]                = "Speichern";
$arsc_lang["idcard_save_ok"]             = "&Auml;nderungen wurden gespeichert";
$arsc_lang["idcard_save_no"]             = "&Auml;nderungen konnten nicht gespeichert werden!";
$arsc_lang["idcard_guestbook"]           = "G&auml;stebuch:";
$arsc_lang["idcard_guestbook_active"]    = "G&auml;stebuch anzeigen?";
$arsc_lang["idcard_guestbook_delete"]    = "L&ouml;schen";
$arsc_lang["idcard_guestbook_delete_ok"] = "Eintrag wurde gel&ouml;scht";
$arsc_lang["idcard_guestbook_delete_no"] = "Eintrag konnte nicht gel&ouml;scht werden!";
$arsc_lang["idcard_guestbook_add"]       = "Eintrag hinzuf&uuml;gen";
$arsc_lang["idcard_guestbook_add_ok"]    = "Ihr Eintrag wurde hinzugef&uuml;gt";
$arsc_lang["idcard_guestbook_add_no"]    = "Ihr Eintrag konnte nicht hinzugef&uuml;gt werden!";
$arsc_lang["idcard_guestbook_next"]      = "Weitere Eintr&auml;ge";
$arsc_lang["idcard_guestbook_prev"]      = "Vorherige Eintr&auml;ge";
$arsc_lang["idcard_close"]               = "Schliessen";


// Chat System Messages

$arsc_lang["enter"]               = "User {user} betritt den Raum {room}.";
$arsc_lang["welcome"]             = "Willkommen im {title}!";
$arsc_lang["quit"]                = "User {user} verl&auml;sst den Raum {room}.";
$arsc_lang["roomchange"]          = "User {user} verl&auml;sst den Raum {room1} und betritt Raum {room2}.";
$arsc_lang["kicked"]              = "User {userpassive} wurde von {useractive} des Chats verwiesen.";
$arsc_lang["youwerekicked"]       = "Sie wurden des Chats verwiesen!";
$arsc_lang["floodwarn"]           = "Wenn Sie weiterhin immer dasselbe schreiben, werden Sie des Chats verwiesen!";
$arsc_lang["op"]                  = "User {userpassive} wurde von User {useractive} Operatorstatus erteilt.";
$arsc_lang["deop"]                = "User {useractive} hat User {userpassive} den Operatorenstatus entzogen.";
$arsc_lang["whispers"]            = "fl&uuml;stert";
$arsc_lang["whispersops"]         = "fl&uuml;stert zu den Operatoren";
$arsc_lang["gotmsg"]              = "Sie fl&uuml;sterten zu {user}: {message}";
$arsc_lang["croom"]               = "User {user} zieht sich in seinen privaten Raum {room} zur&uuml;ck.";
$arsc_lang["room_exists"]         = "Der Raum {room} existiert bereits!";
$arsc_lang["room_badname"]        = "Dieser Raumname ist leider nicht akzeptabel.";
$arsc_lang["room_created"]        = "Ihr privater Raum {room} wurde erfolgreich angelegt! Sie k&ouml;nnen nun mittels des /invite Befehls andere User in Ihren Raum einladen.";
$arsc_lang["invite"]              = "User {user} hat Sie in seinen privaten Raum {room} eingeladen. Schreiben Sie \"/room {room} {password}\" um seinen Raum zu betreten.";
$arsc_lang["invite_notexist"]     = "Der User {user} existiert nicht!";
$arsc_lang["invite_notownroom"]   = "Sie m&uuml;ssen in Ihrem privaten Raum sein um andere User einzuladen!";
$arsc_lang["room_not_exist"]      = "Der Raum {room} existiert nicht!";
$arsc_lang["room_wrong_password"] = "Sie m&uuml;ssen das korrekte Passwort angeben um den Raum {room} betreten zu k&ouml;nnen.";
$arsc_lang["moderate_message"]    = "Ihre Nachricht `{message}` wurde dem Moderator &uuml;bermittelt und wird &uuml;berpr&uuml;ft.";
$arsc_lang["opcall"]              = "[OPCALL] Ich brauche Hilfe!";

$arsc_lang["helplink"]      = "Hilfe";
$arsc_lang["help"]          = "
<b><i>Allgemeine Hilfe:</i></b>
Das Chatfenster teilt sich auf in die Bereiche Funktionen (links), Chatausgabe (Mitte), Chateingabe (unten) und Anwesenheitsliste (rechts).
Um eine Nachricht an alle im Raum befindlichen User zu schreiben, tippen Sie Ihre Nachricht einfach in das Textfeld im unteren Bereich, und drücken Sie die Eingabetaste.

(Wenn Sie sich in einem moderierten Raum befinden, erscheint Ihre Nachricht zun&auml;chst nicht f&uuml;r alle Anwesenden sichtbar, sondern wird an den Moderator des Raumes &uuml;bermittelt, und nach Freigabe ggf. f&uuml;r alle sichtbar in den Raum geschrieben.)

Im linken Bereich stehen Ihnen verschiedene Funktionen zur Verf&uuml;gung. Unterhalb des Logos sehen Sie ein Formular mit dem Sie in alle vorhandenen R&auml;ume des Chats wechseln k&ouml;nnen.
Unterhalb dieses Formulars befindet sich ein Schalter mit dem Sie einstellen k&ouml;nnen, ob sich der Inhalt des Chatausgabebereichs immer automatisch mit neuen Nachrichten mitbewegt. Wenn Sie einmal vorhergehende Nachrichten lesen wollen, die schon aus dem sichtbaren Bereich der Chatausgabe verschwunden sind, m&uuml;ssen Sie lediglich das H&auml;kchen vor <i>Automatich scrollen</i> deaktivieren und k&ouml;nnen dann den Chatausgabeframe wie gewohnt nach oben scrollen.
Beachten Sie bitte, dass in den Browsern <i>Mozilla</i>, <i>Firefox</i> und <i>Netscape 7</i> das H&auml;kchen nicht extra deaktiviert werden muss, es reicht aus, einmal in das Chatausgabefenster zu klicken und dann mittels der Scrollbalken des Frames zu scrollen. Wenn automatisches Scrollen wieder aktiviert werden soll, reicht ein einfacher Klick in das Textfeld der Chateingabe.

Im rechten Bereich, der Anwesenheitsliste, sehen Sie die Namen aller User, die sich mit Ihnen im selben Raum befinden. User, vor deren Namen sich das Zeichen @ befindet, sind sogenannte Operatoren - diese haben erweiterte Rechte im Chat, z.B. das Verweisen anderer User, und sorgen f&uuml;r Ordnung im Chat. An diese sollten Sie sich wenden, wenn Sie Fragen oder Probleme haben. Der Befehl '/opcall' (einfach in die Texteingabe eingeben) informiert alle anwesenden Operatoren, dass Sie Hilfe ben&ouml;tigen.

Jeder Name in der Anwesenheitsliste (ausser Ihrem eigenen) ist gleichzeitig ein Link - wenn Sie auf diesen klicken, wird die Texteingabe mit dem Befehl '/msg NameDesUsers' gef&uuml;llt. Sie m&uuml;ssen dann nur noch Ihre Nachricht an das Ende dieses Befehls anfügen, und wenn Sie diese dann absenden, erh&auml;hlt der entsprechende User eine private Nachricht von Ihnen. Das bedeutet, dass nur er diese Nachricht sieht. Diese Funktion wird auch <i>Fl&uuml;stern</i> genannt.


<b><i>Befehls&uuml;bersicht:</i></b>
<b>/me message</b> -- Symbolisiert eine Aktion, z.B. <i>/me macht eine T&uuml;te Chips auf</i> schreibt in den Chat: <i>* macht eine T&uuml;te Chips auf</i>
<b>/msg NameDesUsers Nachricht</b> -- Sendet eine private Nachricht an <i>NameDesUsers</i>
<b>/opcall</b> -- Ruft die Operatoren zu Hilfe
<b>/croom NameDesRaums</b> -- Legt einen privaten Raum <i>NameDesRaums</i> an
<b>/invite NameDesUsers</b> -- L&auml;dt <i>NameDesUsers</i> in privaten Raum ein
<b>/j NameDesRaums</b> -- Wechselt in den Raum <i>NameDesRaums</i>";

$arsc_lang["helpop"]        = "
<b><i>Operatorenbefehle:</i></b>
<b>/msgops Nachricht</b> -- Alle anderen Operatoren anfl&uuml;stern
<b>/whois User</b> -- Zeigt Informationen &uuml;ber User <i>NameDesUser</i>
<b>/op NameDesUsers</b> -- User <i>NameDesUser</i> Operatorenstatus geben
<b>/deop NameDesUsers</b> -- User <i>NameDesUser</i> Operatorenstatus entziehen
<b>/kick NameDesUsers</b> -- User <i>NameDesUsers</i> des Chats verweisen
<b>/bann NameDesUsers XYZ</b> -- IP des Users <i>NameDesUsers</i> f&uuml;r <i>XYZ</i> Sekunden sperren
<b>/lock NameDesUsers</b> -- Account des (registrierten!) Users <i>NameDesUsers</i> permanent sperren
<b>/rip NameDesUsers</b> -- User <i>NameDesUsers</i> stummschalten
<b>/unrip NameDesUsers</b> -- Stummschaltung von User <i>NameDesUsers</i> wieder aufheben
<b>/move NameDesUsers NameDesRaums</b> -- User <i>NameDesUsers</i> in <i>NameDesRaums</i> verschieben";

?>
