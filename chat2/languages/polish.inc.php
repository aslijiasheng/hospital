<?php

/* 
This is an ARSC language file. If you translate it, please send me 
a copy to <manuel@kiessling.net>, I will add it to ARSC then. 
Thanks. 

This file is for versions 3.0-beta1, 3.0-beta2, 3.0-rc1, 3.0, 3.0.1, 3.0.2, 3.0.2-rc1, 3.0.2-rc2 

Translation by Jarosław Domański <domanoid@gmail.com>. 
*/

// Define some settings for this language
$arsc_lang_regions["polish"] = array("pl", "pl-pl", "pl-pl");
$arsc_lang_name["polish"] = "Polish";
$arsc_lang["charset"] = "iso-8859-2";


// Language selection

$arsc_lang["chooseyourlanguage"] = "Wybierz j&#281;zyk:";
$arsc_lang["next"] = "Dalej";


// Login Page

$arsc_lang["entername"] = "Wpisz swojego nicka:";
$arsc_lang["enterpassword"] = "Wpisz has&#322;o:";
$arsc_lang["selectchatversion"] = "Wybierz wersj&#281;:";
$arsc_lang["version_browser_socket"] = "Streaming";
$arsc_lang["version_browser_push"] = "Streaming, kompatybilna z firewall`em";
$arsc_lang["version_browser_xmlhttprequest"] = "Kompatybilna z firewall`em";
$arsc_lang["version_browser_refresh"] = "Kompatybilna z firewall`em, bez javy";
$arsc_lang["version_browser_text"] = "Dla przegl&#261;darek tekstowych";
$arsc_lang["yes"] = "Tak";
$arsc_lang["no"] = "Nie";
$arsc_lang["selectroom"] = "Wybierz pokój:";
$arsc_lang["createdby"] = "Stworzone przez:";
$arsc_lang["startbutton"] = "Uruchom czat!";
$arsc_lang["usersinchat"] = "Zalogowani u&#380;ytkownicy:";
$arsc_lang["usersinchat_room"] = "Pokój";
$arsc_lang["usersinchat_name"] = "U&#380;ytkownik";
$arsc_lang["usersinchat_idlenote"] = "* - u&#380;ytkownik nieobecny.";
$arsc_lang["clicktoregister"] = "Zarezerwuj sobie nicka!";


// Why kicked page

$arsc_lang["why_kicked"] = "Twoja sesja wygas&#322;a - s&#261; 2 mo&#380;liwości: albo serwer si&#281; roz&#322;&#261;czy&#322;, albo nie post&#281;powa&#322;e&#347; zgodnie z regulaminem serwera.";
$arsc_lang["returntologinpage"] = "Powró&#263; na stron&#281; logowania";


// Register page and eMail

$arsc_lang["register_intro"] = "Aby si&#281; zarejestrowa&#263; wype&#322;nij poni&#380;sze pola.";
$arsc_lang["register_intro_force"] = "Has&#322;o zostanie wys&#322;ane na podany adres e-mail.";
$arsc_lang["register_entername"] = "Nick:";
$arsc_lang["register_enteremail"] = "Adres e-mail:";
$arsc_lang["register_enterpassword"] = "Has&#322;o:";
$arsc_lang["register_send"] = "Wy&#347;lij dane";
$arsc_lang["register_yougetmail"] = "Dzi&#281;kujemy, mail z has&#322;em zosta&#322; wys&#322;any na podany e-mail.";
$arsc_lang["register_emailtemplate_subject"] = "Dane rejestracyjne z czata.";
$arsc_lang["register_emailtemplate_body"] = "
Siemka,

Niedawno zarejestrowa&#322;e&#347; si&#281; na czacie.

Twój nick to '{username}'.
Aktualne twoje has&#322;o:

'{password}'

Mo&#380;esz si&#281; teraz zalogowa&#263; na czata pod adresem:
{homepage}

&#379;yczymy du&#380;o zabawy!

-- 
Admin

";


// Chat interface

$arsc_lang["usersinroom"] = "U&#380;ytkowników w pokoju";
$arsc_lang["sendmessage"] = "Wy&#347;lij";
$arsc_lang["refreshmessages"] = "Od&#347;wie&#380; wiadomo&#347;ci";
$arsc_lang["leave"] = "Wyjd&#378;";
$arsc_lang["roomlist"] = "Lista pokoi";
$arsc_lang["go_room"] = "Wejd&#378;";
$arsc_lang["refresh"] = "Od&#347;wie&#380;";
$arsc_lang["otherfunctions"] = "Dodatkowe funkcje";
$arsc_lang["smilielist"] = "Lista wszystkich buziek";
$arsc_lang["scroll_active"] = "Automatyczne przewijanie";
$arsc_lang["select_color"] = "Wybierz swój kolor";
$arsc_lang["moderatorqueue_title"] = "Pytania bez odpowiedzi";
$arsc_lang["moderatorqueue_delete"] = "Usu&#324;";
$arsc_lang["moderatorqueue_youranswer"] = "Twoja odpowied&#378;";
$arsc_lang["moderatorqueue_cancel"] = "Anulu";
$arsc_lang["drawboard"] = "Tablica";

$arsc_lang["cmd_m"] = "Wci&#347;nij aby wys&#322;a&#263; wiadomo&#347;&#263; do tego u&#380;ytkownika";
$arsc_lang["opcmd_w"] = "Wy&#347;wietl informacje o tym u&#380;ytkowniku";
$arsc_lang["opcmd_k"] = "Wyrzu&#263; u&#380;ytkownika";
$arsc_lang["opcmd_b"] = "Zbanuj tego u&#380;ytkonika na jaki&#347; czas";
$arsc_lang["opcmd_l"] = "Zbanuj na zawsze (je&#347;li zarejestrowany)";
$arsc_lang["opcmd_r"] = "Zaknebluj u&#380;ytkownika (nie mo&#380;e pisa&#263;)";
$arsc_lang["opcmd_u"] = "Odknebluj u&#380;ytkownika (ju&#380; mo&#380;e pisa&#263;)";
$arsc_lang["opcmd_o"] = "Nadaj temu u&#380;ytkownikowi OP`a";
$arsc_lang["opcmd_d"] = "Odbierz OP`a temu u&#380;ytkownikowi";
$arsc_lang["opcmd_m"] = "Przenie&#347; tego u&#380;ytkownika do innego pokoju";
$arsc_lang["opcmd_id"] = "Poka&#380; ID tego u&#380;ytkownika";


// Errors

$arsc_lang["error_register_double_user"] = "Ten nick jest ju&#380; u&#380;ywany, wypróbuj inny.";
$arsc_lang["error_double_user"] = "U&#380;ytkownik z tym nickiem jest ju&#380; zalogowany!";
$arsc_lang["error_no_name"] = "Musisz wpisa&#263; Nicka!";
$arsc_lang["error_bad_name"] = "Takia nazwa jest zabroniona!";
$arsc_lang["error_wrong_credentials"] = "Odmowa dost&#281;pu!<br>Czy wprowadzone dane s&#261; poprawne?";
$arsc_lang["error_banned"] = "Do&#380;ywotnia odmowa dost&#281;pu.";


// IDCard

$arsc_lang["idcard_title"] = "Carta ID:";
$arsc_lang["idcard_sex"] = "P&#322;e&#263;:";
$arsc_lang["idcard_male"] = "m&#281;&#380;czyzna";
$arsc_lang["idcard_female"] = "kobieta";
$arsc_lang["idcard_location"] = "Lokalizajca:";
$arsc_lang["idcard_color"] = "Standardowy kolor:";
$arsc_lang["idcard_hobbies"] = "Hobbi:";
$arsc_lang["idcard_save"] = "Zapisz";
$arsc_lang["idcard_save_ok"] = "Zmiany zapisane";
$arsc_lang["idcard_save_no"] = "Zmiany nie mog&#261; by&#263; zapisane";
$arsc_lang["idcard_guestbook"] = "Ksi&#281;ga go&#347;ci:";
$arsc_lang["idcard_guestbook_active"] = "Pokaza&#263; ksi&#281;g&#281; go&#347;ci?";
$arsc_lang["idcard_guestbook_delete"] = "Usu&#324;";
$arsc_lang["idcard_guestbook_delete_ok"] = "Wpis usuni&#281;ty";
$arsc_lang["idcard_guestbook_delete_no"] = "Wpis nie mo&#380;e zosta&#263; usuni&#281;ty!";
$arsc_lang["idcard_guestbook_add"] = "Wpisz si&#281;";
$arsc_lang["idcard_guestbook_add_ok"] = "Twój wpis zosta&#322; dodany";
$arsc_lang["idcard_guestbook_add_no"] = "Twój wpis nie mo&#380;e by&#263; dodany!";
$arsc_lang["idcard_guestbook_next"] = "Nast&#281;pne";
$arsc_lang["idcard_guestbook_prev"] = "Poprzednie";
$arsc_lang["idcard_close"] = "Zamknij";


// Chat System Messages

$arsc_lang["enter"] = "{user} wszed&#322; do pokoju {room}.";
$arsc_lang["welcome"] = "Witaj w {title}!";
$arsc_lang["quit"] = "{user} odszed&#322; z pokoju {room}.";
$arsc_lang["roomchange"] = "{user} opó&#347;ci&#322; pokój {room1} i przeszed&#322; do pokoju {room2}.";
$arsc_lang["kicked"] = "U&#380;ytkownik {userpassive} zosta&#322; wy&#380;ucony przez {useractive}.";
$arsc_lang["youwerekicked"] = "Zosta&#322;e&#347; wy&#380;ucony z czatu!";
$arsc_lang["floodwarn"] = "PRZESTA&#323; FLOODOWA&#262; albo zostaniesz wy&#380;ucony z czata!";
$arsc_lang["op"] = "U&#380;ytkownik {userpassive} dosta&#322; prawa od {useractive}.";
$arsc_lang["deop"] = "U&#380;ytkownik {useractive} usun&#261;&#322; prawa u&#380;ytkownikowi {userpassive}.";
$arsc_lang["whispers"] = "szept";
$arsc_lang["whispersops"] = "szept do wszystkich opów";
$arsc_lang["gotmsg"] = "Szepczesz do {user}: {message}";
$arsc_lang["croom"] = "Użytkownik {user} wyszed&#322; ze swojego prywatnego czata {room}.";
$arsc_lang["room_exists"] = "Przepraszamy, taki pokój {room} ju&#380; istnieje.";
$arsc_lang["room_badname"] = "Przepraszamy, taka nazwa pokoju nie jest akceptowana.";
$arsc_lang["room_created"] = "Twój prywatny pokój '{room}' zosta&#322; poprawnie utworzony! Teraz mo&#380;esz kogo&#347; do niego zaprosi&#263; u&#380;ywaj&#261;c komendy '/invite' .";
$arsc_lang["invite"] = "U&#380;ytkownik {user} zaprasza Ci&#281; do pokoju {room}. Wpisz \"/room {room} {password}\" aby wej&#347;&#263; do tego pokoju.";
$arsc_lang["invite_notexist"] = "Przepraszamy, u&#380;ytkownik {user} nie istnieje.";
$arsc_lang["invite_notownroom"] = "Przepraszamy, aby zapraszać u&#380;ytkowników musisz by&#263; w swoim prywatnym pokoju.";
$arsc_lang["room_not_exist"] = "Przepraszamy, ale pokój {room} nie istnieje";
$arsc_lang["room_wrong_password"] = "Przepraszamy, wpisz poprawne has&#322;o aby wej&#347;&#263; do pokoju {room}";
$arsc_lang["moderate_message"] = "Twoja wiadomo&#347;&#263; `{message}` zosta&#322;a dostarczona do moderatora i zostanie rozpatrzona.";
$arsc_lang["opcall"] = "[OPCALL] Potrzebuj&#281; pomocy!";

$arsc_lang["helplink"] = "Pomoc";
$arsc_lang["help"] = "
Pomoc:
Po prawej stronie s&#261; wypisani wszyscy u&#380;ytkownicy
ko&#380;ystaj&#261;cy z danego pokoju.

Uzytkownicy maj&#261;cy przed swoim nickiem @ s&#261; opami,
mog&#261; wy&#380;uci&#263; uczestnika czatu, nada&#263; mu prawa lub
mu je zabra&#263;.

Po klikni&#281;ciu na u&#380;ytkownika po prawej stronie
zostanie wpisana komenda potrzeba do wys&#322;ania
danemu u&#380;ytkownikowi prywatnej wiadomo&#347;ci.

Komendy:
/me message -- Oznacza akcj&#281; u&#380;ytkownika, np. /me czuj&#281; si&#281; dobrze * U&#380;ytkownik czuje si&#281; dobrze
/msg user message -- Wysy&#322;a prywatn&#261; wiadomo&#347;&#263; do u&#380;ytkownika
/j inny pokój -- Opuszcza ten pokój i przechodzi do innego pokoju
/room room -- alias do /j";

$arsc_lang["helpop"] = "
Komendy dla OP`a:
/msgops message -- Szepcze do wszystkich op`ów
/whois user -- Pokazuje dane o u&#380;ytkowniku
/op user -- Nadaje u&#380;ytkownikowi prawa op`a
/deop user -- Odbiera u&#380;ytkownikowi prawa op`a
/kick user -- Wyrzuca u&#380;ytkownika
/bann user X -- Blokuje IP u&#380;ytkownika na X sekund
/lock user -- Blokuje permanentnie konto (zarejestrowanego!) u&#380;ytkownika
/rip user -- Blokuje mo&#380;liwo&#347;&#263; pisania u&#380;ytkownikowi
/unrip user -- Odblokowywuje mo&#380;liwo&#347;&#263; pisania u&#380;ytkownikowi
/move user room -- Przenosi u&#380;ytkownika do pokoju room";

?>
