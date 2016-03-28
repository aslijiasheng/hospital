<?php

/*
 This is an ARSC language file. If you translate it, please send me
 a copy to <manuel@kiessling.net>, I will add it to ARSC then.
 Thanks.

 This file is for versions 3.0-beta1, 3.0-beta2, 3.0-rc1, 3.0, 3.0.1, 3.0.2, 3.0.2-rc1, 3.0.2-rc2
  
 Translation by Peter Van Voorn <peter@vanvoorn.com>.
*/

// Include the english file, in order to provide english text if the current file has some sentences missing.
include("english.inc.php");

// Define some settings for this language
$arsc_lang_regions["dutch"] = array("nl");
$arsc_lang_name["dutch"] = "Nederlands";
$arsc_lang["charset"] = "utf-8";


// Language selection

$arsc_lang["chooseyourlanguage"] = "";
$arsc_lang["next"] = "";


// Login Page

$arsc_lang["entername"]                 = "Voer hier je nick naam in:";
$arsc_lang["enterpassword"]             = "Voer hier je paswoord in:";
$arsc_lang["whichversion"]              = "Welke versie wil je gebruiken?";
$arsc_lang["version_applet"]            = "Java Applet.";
$arsc_lang["yes"]                       = "Ja";
$arsc_lang["no"]                        = "Nee";
$arsc_lang["selectroom"]                = "Kies een kamer:";
$arsc_lang["createdby"]                 = "Gemaakt door";
$arsc_lang["startbutton"]               = "Start de chat!";
$arsc_lang["usersinchat"]               = "De volgende gebruikers zijn ingelogt:";
$arsc_lang["usersinchat_room"]          = "Kamer";
$arsc_lang["usersinchat_name"]          = "Gebruiker";
$arsc_lang["clicktoregister"]           = "Registreer je naam!";

// Why kicked page


// Register page and eMail

$arsc_lang["register_intro"]                 = "Om je nicknaam te garanderen moet je je registreren vul dit in het veld hieronder.";
$arsc_lang["register_intro_force"]           = "Een paswoord zal naar de ingevooerde email gestuurd worden.";
$arsc_lang["register_entername"]             = "Nicknaam:";
$arsc_lang["register_enteremail"]            = "eMail adres:";
$arsc_lang["register_enterpassword"]         = "Paswoord:";
$arsc_lang["register_send"]                  = "Registreer nu.";
$arsc_lang["register_yougetmail"]            = "Dank je voor je registratie je paswoord is verzonden naar het ingevooerde email.";
$arsc_lang["register_emailtemplate_subject"] = "Je registratie voor {title}";
$arsc_lang["register_emailtemplate_body"]    = "
Hallo,

Je hebt je geregistreerd voor {title}.

Je hebt gekozen voor de nick naam '{username}'.
Het is nu beschermd met de volgende paswoord:

            '{password}'

Je kun nu inloggen:
{homepage}

Have a lot of fun!

-- 
 {chatowner}

";


// Chat interface

$arsc_lang["usersinroom"]     = "Gebruikers in de kamer";
$arsc_lang["sendmessage"]     = "Verzenden";
$arsc_lang["refreshmessages"] = "Verfris bericht";
$arsc_lang["leave"]           = "Vertrek";
$arsc_lang["roomlist"]        = "Kamer lijst";
$arsc_lang["go_room"]         = "Binnen gaan";
$arsc_lang["refresh"]         = "Verfris";
$arsc_lang["otherfunctions"]  = "Nog meer functies";
$arsc_lang["smilielist"]      = "Lijst van alle smilies";
$arsc_lang["scroll_active"]   = "Autoscroll";
$arsc_lang["select_color"]    = "Selecteer je kleur";
$arsc_lang["drawboard"]       = "Tekenbord";

$arsc_lang["cmd_m"]           = "Klik om het bericht te verzenden naar deze gebruiker";
$arsc_lang["opcmd_w"]         = "Laat aanvullende informatie zien van deze gebruiker";
$arsc_lang["opcmd_k"]         = "Kick deze gebruiker uit de kamer";
$arsc_lang["opcmd_b"]         = "Ban dit IP adres van de gebruiker voor een geruime tijd";
$arsc_lang["opcmd_l"]         = "Lock deze gebruiker permanent (als hij geregistreert is)";
$arsc_lang["opcmd_r"]         = "RIP deze gebruiker (zodat hij/zij niet kan praten)";
$arsc_lang["opcmd_u"]         = "UnRIP deze gebruiker(zodat hij/zij weer kan praten)";
$arsc_lang["opcmd_o"]         = "Geef deze gebruiker operator status";
$arsc_lang["opcmd_d"]         = "Ontneem operator status van deze gebruiker";
$arsc_lang["opcmd_m"]         = "Verplaats gebruiker naar een ander kamer";
$arsc_lang["opcmd_id"]        = "Laat id kaart zien van deze gebruiker";

// Errors

$arsc_lang["error_register_double_user"] = "Deze nicknaam is al in gebruik. Probeer een ander.";
$arsc_lang["error_double_user"]          = "Een gebruiker met deze naam is al ingelogt!";
$arsc_lang["error_no_name"]              = "Je moet een gebruikers naam invoeren!";
$arsc_lang["error_bad_name"]             = "Deze naam is niet toegestaan!";
$arsc_lang["error_wrong_credentials"]    = "Toegang geweigerd!<br>Zijn je credentials correct?";
$arsc_lang["error_banned"]               = "Toegang is tijdelijk geweigerd.";

// IDCard

$arsc_lang["idcard_title"]               = "ID Card van";
$arsc_lang["idcard_sex"]                 = "Geslacht:";
$arsc_lang["idcard_male"]                = "Man";
$arsc_lang["idcard_female"]              = "Vrouw";
$arsc_lang["idcard_location"]            = "Lokatie:";
$arsc_lang["idcard_color"]               = "Standaard kleur:";
$arsc_lang["idcard_hobbies"]             = "Hobbies:";
$arsc_lang["idcard_save"]                = "Bewaar";
$arsc_lang["idcard_save_ok"]             = "Veranderingen zijn bewaard";
$arsc_lang["idcard_save_no"]             = "Veranderingen konden niet bewaard worden";
$arsc_lang["idcard_guestbook"]           = "Gastenboek:";
$arsc_lang["idcard_guestbook_active"]    = "Laat gastenboek zien?";
$arsc_lang["idcard_guestbook_delete"]    = "Verwijder";
$arsc_lang["idcard_guestbook_delete_ok"] = "Invoer is verwijdert";
$arsc_lang["idcard_guestbook_delete_no"] = "Invoer kon niet worden verwijdert!";
$arsc_lang["idcard_guestbook_add"]       = "Voeg invoer toe";
$arsc_lang["idcard_guestbook_add_ok"]    = "Je invoer is toegevoegt";
$arsc_lang["idcard_guestbook_add_no"]    = "Je invoer kon niet worden toegevoegt!";
$arsc_lang["idcard_guestbook_next"]      = "Volgende invoer";
$arsc_lang["idcard_guestbook_prev"]      = "Vorige invoer";
$arsc_lang["idcard_close"]               = "Sluiten";


// Chat System Messages

$arsc_lang["enter"]               = "{user} komt de {room} kamer binnen.";
$arsc_lang["welcome"]             = "Welkom bij {title}!";
$arsc_lang["quit"]                = "{user} vertrekt de {room} kamer.";
$arsc_lang["roomchange"]          = "{user} vertrekt de {room1} kamer en komt binnen in {room2} kamer.";
$arsc_lang["kicked"]              = "{userpassive} is eruit gekicked door {useractive}.";
$arsc_lang["youwerekicked"]       = "Je bent uit de chat gekicked!";
$arsc_lang["floodwarn"]           = "STOP OVERVLOEDEN NU anders zul je moeten vertrekken!";
$arsc_lang["op"]                  = "{userpassive} heeft operator status van {useractive}.";
$arsc_lang["deop"]                = "{useractive} heeft de operator status verwijdert van {userpassive}.";
$arsc_lang["whispers"]            = "fluisteren";
$arsc_lang["whispersops"]         = "fluister naar alle operators";
$arsc_lang["gotmsg"]              = "Je fluistert naar {user}: {message}";
$arsc_lang["croom"]               = "{user} beslist om zich terug te trekken in een prive chat {room}.";
$arsc_lang["room_exists"]         = "Sorry, maar deze {room} kamer bestaat al.";
$arsc_lang["room_badname"]        = "Sorry, deze kamer naam is niet toegestaan.";
$arsc_lang["room_created"]        = "Je prive {room} kamer is succesvol aangemaakt! Je kunt nu gebruikers uitnodigen. Gebruik /invite commando.";
$arsc_lang["invite"]              = "{user} heeft je uitgenodigt in deze {room}. Typ \"/room {room} {password}\" om in deze kamer binnen te komen.";
$arsc_lang["invite_notexist"]     = "Sorry, {user} bestaat niet.";
$arsc_lang["invite_notownroom"]   = "Sorry, je moet in je eigen prive kamer zijn om andere mensen uit te nodigen.";
$arsc_lang["room_not_exist"]      = "Sorry, maar de kamer {room} bestaat niet";
$arsc_lang["room_wrong_password"] = "Sorry, maar je moet wel de juiste paswoord invoeren om de kamer {room} binnen te kunnen.";
$arsc_lang["moderate_message"]    = "Je bericht`{message}` is bezorgt aan de moderator en zal worden gecontroleerd.";
$arsc_lang["opcall"]              = "[OPCALL] IK HEB HULP NODIG!";

$arsc_lang["helplink"]      = "Help";
$arsc_lang["help"]          = "
Algemene Help:
In de rechter frame zie je alle gebruikers
Wie zit er in de kamer.

Gebruikers met een @ aan het begin van hun naam
zijn operators en kunnen gebruikers uit de kamer
kicken, geeft operator status aan andere gebruikers
,en ontneemt operator statusen

Als je op een naam klikt aan de rechterkant, de invoer
veld zal worden gevuld met commandos die nodig zijn om
een prive bericht te sturen naar deze gebruiker.
Je moet alleen het bericht aan het eind toevoegen
van de commando regel.

General Commands:
/me bericht -- Symboliseert een actie, e.g. /me ik voel me goed * gebruiker voelt zich goed
/msg gebruikers bericht -- verzend een prive bericht naar een gebruiker
/j algemeen -- Vetrekt de huidige kamer en gaat een ander kamer binnen 'algemeen'
/room kamer -- Een alias voor /j";

$arsc_lang["helpop"]        = "
Operator Commandos:
/msgops bericht -- Fluistert een bericht naar alle operators
/whois gebruiker -- Laat gebruikers info zien
/op gebruiker -- Geeft operator status aan gebruiker
/deop gebruiker -- Ontneemt operator status van gebruiker
/kick gebruiker -- Kicks gebruiker uit de kamer
/bann gebruiker X -- Blocked IP van de gebruiker voor X seconden.
/lock gebruiker -- Lock account van (registered!) gebruiker permanent
/rip gebruiker -- Gebruiker word de mond gesnoerd
/unrip gebruiker -- Gberuiker heeft weer het recht tot praten
/move gebruiker kamer -- Verplaats gebruiker naar andere kamer";

?>
