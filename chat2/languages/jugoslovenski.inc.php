<?php

/*
 This is an ARSC language file. If you translate it, please send me
 a copy to <manuel@kiessling.net>, I will add it to ARSC then.
 Thanks.

 This file is for versions 3.0-beta1, 3.0-beta2, 3.0-rc1, 3.0, 3.0.1, 3.0.2, 3.0.2-rc1, 3.0.2-rc2
  
 Translation by Decky <info@decky.ch>.
*/

// Include the english file, in order to provide english text if the current file has some sentences missing.
include("english.inc.php");

// Define some settings for this language
$arsc_lang_regions["Jugoslovenski"] = array("de", "de-de", "de-at");
$arsc_lang_name["jugoslovenski"] = "Jugoslovenski";
$arsc_lang["charset"] = "utf-8";


// Language selection

$arsc_lang["chooseyourlanguage"] = "Odaberi Jezik / Wehlen sie Sprache / Choose Language:";
$arsc_lang["next"] = "Dalje";


// Login Page

$arsc_lang["entername"]                 = "Vas Nik:";
$arsc_lang["enterpassword"]             = "Vas passwort:";
$arsc_lang["selectchatversion"]         = "Odaberite sistem Chata:";
$arsc_lang["version_browser_socket"]    = "Optimalno";
$arsc_lang["version_browser_push"]      = "Optimalno (Firewallkompatibel)";
$arsc_lang["version_browser_text"]      = "Za Textbrowser";
$arsc_lang["yes"]                       = "Da";
$arsc_lang["no"]                        = "Ne";
$arsc_lang["selectroom"]                = "Odaberite zeljenu sobu:";
$arsc_lang["createdby"]                 = "angelegt von";
$arsc_lang["startbutton"]               = "Ulaz u chat";
$arsc_lang["usersinchat"]               = "Trenutni Posetioci u chatu:";
$arsc_lang["usersinchat_room"]          = "Soba";
$arsc_lang["usersinchat_name"]          = "Korisnik";
$arsc_lang["clicktoregister"]           = "Registruj svoj Nik!";


// Why kicked? Page


// Register page and eMail

$arsc_lang["register_intro"]                 = "Za registovanje vaseg Nika popunite sledeci Formular OBAVEZNO Upisite Pravu email Adresu password Dobijate na email koji ste upisali.";
$arsc_lang["register_intro_force"]           = "Vi dobijate  Passwort na eMail-Adressu koju ste upisali.";
$arsc_lang["register_entername"]             = "Zeljeni Nik:";
$arsc_lang["register_enteremail"]            = "Vasa eMail-Adressa:";
$arsc_lang["register_enterpassword"]         = "Zeljeni Passwort:";
$arsc_lang["register_send"]                  = "Posalji prijavu";
$arsc_lang["register_yougetmail"]            = "Hvala, Dobicete eMail sa vasim Passwortom.";
$arsc_lang["register_emailtemplate_subject"] = "{title} Registracija.";
$arsc_lang["register_emailtemplate_body"]    = "

Veliki pozdrav {username},

Vi ste se prijavili na chat {title}.
Saljemo vase Potrebne podatke za ulaz na chat.

Vase Nik ime i passwort glese:
           
Nik: {username}
Passwort: {password}               
 
Od ovog trenutka mozete pristupiti nasem chatu!


-- 
 {chatowner}

";


// Chat interface

$arsc_lang["usersinroom"]               = "Posetioci u sobi";
$arsc_lang["sendmessage"]               = "Posalji";
$arsc_lang["refreshmessages"]           = "Aktualisiraj Poruke";
$arsc_lang["leave"]                     = "Napusti Chat";
$arsc_lang["roomlist"]                  = "Lista Soba";
$arsc_lang["go_room"]                   = "Udji";
$arsc_lang["refresh"]                   = "Aktualisiraj";
$arsc_lang["otherfunctions"]            = "Sledece Funkcije";
$arsc_lang["smilielist"]                = "Lista Smilies";
$arsc_lang["scroll_active"]             = "Automacki Listanje";
$arsc_lang["select_color"]              = "Odaberite Boju slova";
$arsc_lang["moderatorqueue_title"]      = "Neodgovorena Pitanja";
$arsc_lang["moderatorqueue_delete"]     = "Obrisi";
$arsc_lang["moderatorqueue_youranswer"] = "Vas Odgovor";
$arsc_lang["moderatorqueue_cancel"]     = "Prekini";
$arsc_lang["drawboard"]                 = "Crtaj Slike";

$arsc_lang["cmd_m"]           = "Klikni ovde da bi poslao (la) Privatnu poruku";
$arsc_lang["opcmd_w"]         = "Opsirnije Informacije od Posetioca";
$arsc_lang["opcmd_k"]         = "Ovde klikni da bi izbacio Posetioca iz Chata.";
$arsc_lang["opcmd_b"]         = "Ovu IP-Adresu ovog Posetioca Blokiraj na Odredjeno vreme koje upises (vreme je u Sekundama)";
$arsc_lang["opcmd_l"]         = "Ovom Posetiocu permanent sperren (Moguce samo Registovanim Posetiocima)";
$arsc_lang["opcmd_r"]         = "Ovom Posetiocu Blokiraj Pisanje";
$arsc_lang["opcmd_u"]         = "Ovom Posetiocu Dozvoli Pisanje";
$arsc_lang["opcmd_o"]         = "Ovom Posetiocu Dodeli Operatorenstatus ";
$arsc_lang["opcmd_d"]         = "Ovom Posetiocu Skini Operatorenstatus ";
$arsc_lang["opcmd_m"]         = "Ovog Posetioca Prebaci u Drugu sobu";
$arsc_lang["opcmd_id"]        = "ID-Card Pogledaj Ovom Posetiocu ";


// Errors

$arsc_lang["error_register_double_user"] = "Taj Nik je vec zauzet molimo odaberite Drugi Nik.";
$arsc_lang["error_double_user"]          = "Taj Nik je vec zauzet molimo odaberite Drugi Nik.";
$arsc_lang["error_no_name"]              = "Morate upisati Vas Nik!";
$arsc_lang["error_bad_name"]             = "Taj Nik nije Dozvoljen!";
$arsc_lang["error_wrong_credentials"]    = "Pristup Blokiran - Proverite vase podatke Nik i Password?";
$arsc_lang["error_banned"]               = "Vas Pristup je vremenski blokiran zbog Pogresnog unosenja podataka pokusajte kasnije.";


// IDCard

$arsc_lang["idcard_title"]               = "ID-Card Od";
$arsc_lang["idcard_sex"]                 = "Pol:";
$arsc_lang["idcard_male"]                = "Musko";
$arsc_lang["idcard_female"]              = "Zensko";
$arsc_lang["idcard_location"]            = "Mesto:";
$arsc_lang["idcard_color"]               = "Boja Slova:";
$arsc_lang["idcard_hobbies"]             = "Hobi:";
$arsc_lang["idcard_save"]                = "Memorisi";
$arsc_lang["idcard_save_ok"]             = "Vase Promene su uspesno Memorisane";
$arsc_lang["idcard_save_no"]             = "Vasa promena nije Memorisana Pokusajte Ponovo!";
$arsc_lang["idcard_guestbook"]           = "Privatna knjiga Posetilaca:";
$arsc_lang["idcard_guestbook_active"]    = "Privatnu knjigu  Pokazi?";
$arsc_lang["idcard_guestbook_delete"]    = "Obrisi poruku";
$arsc_lang["idcard_guestbook_delete_ok"] = "Poruka je izbrisana";
$arsc_lang["idcard_guestbook_delete_no"] = "Poruka se nemoze Izbrisati!";
$arsc_lang["idcard_guestbook_add"]       = "Posalji poruku";
$arsc_lang["idcard_guestbook_add_ok"]    = "Vasa Poruka je dodata";
$arsc_lang["idcard_guestbook_add_no"]    = "Vas upis nije unet!";
$arsc_lang["idcard_guestbook_next"]      = "Sledec poruke";
$arsc_lang["idcard_guestbook_prev"]      = "Predhodne poruke";
$arsc_lang["idcard_close"]               = "Zatvori";


// Chat System Messages

$arsc_lang["enter"]               = "Posetioc {user} je usao u sobu {room}.";
$arsc_lang["welcome"]             = "Dobro dosli {title}!";
$arsc_lang["quit"]                = "Posetioc {user} je napustio Sobu {room}.";
$arsc_lang["roomchange"]          = "Posetioc {user} je napustio Sobu {room1} i usao u sobu {room2}.";
$arsc_lang["kicked"]              = "Posetioc {userpassive} je od {useractive} Izbacen sa Chata.";
$arsc_lang["youwerekicked"]       = "Vi ste izbaceni sa Chata!";
$arsc_lang["floodwarn"]           = "Ukoliko nastaviti upisivati iste reci dalje, Bicete izbaceni sa chata od strane Systema!";
$arsc_lang["op"]                  = "Posetiocu {userpassive} Je od Operatora {useractive} Dodeljen Operator status.";
$arsc_lang["deop"]                = "Operator {useractive} Je Korisniku {userpassive} Skinuo Operator status.";
$arsc_lang["whispers"]            = "PRIVATNA PORUKA";
$arsc_lang["whispersops"]         = "Privatna Poruka za sve Operatore";
$arsc_lang["gotmsg"]              = "Privatna poruka za: {user}: {message}";
$arsc_lang["croom"]               = "Posetioc {user} Se vratio u svoju Privatnu sobu {room}.";
$arsc_lang["room_exists"]         = "Soba {room} Vec Postoji!";
$arsc_lang["room_badname"]        = "Taj naziv Sobe je nazalost nemoguc.";
$arsc_lang["room_created"]        = "Vasa Privatna soba {room} je Uspesno Postavljena! sada mozete uz pomoc /invite Komandi Pozvati Druge posetioce u vasu Sobu.";
$arsc_lang["invite"]              = "Posetioc {user} Vas je pozvao u Privatnu sobu {room} . Upisite Sledece \"/room {room} {password}\" Za ulaz i njegovu sobu.";
$arsc_lang["invite_notexist"]     = "Posetioc {user} Ne postoji vise!";
$arsc_lang["invite_notownroom"]   = "Vi morate ostati u sobi ukoliko zelite pozvati ostale posetioce u vasu sobu!";
$arsc_lang["room_not_exist"]      = "Soba {room} Vise nepostoji!";
$arsc_lang["room_wrong_password"] = "Da bi ste usli u Sobu {room} Morate upisati Korektan Password.";
$arsc_lang["moderate_message"]    = "Vasa Poruka `{message}` Je poslata Moderatoru i bice Proverena.";
$arsc_lang["opcall"]              = "[OPCALL] Meni je potrebna Pomoc!";

$arsc_lang["helplink"]      = "Pomoc";
$arsc_lang["help"]          = "
<b><i>Opsta Pomoc:</i></b>
Prozor chata deli se na: Funkcije Chata (Levo), Chat Pokazivanja upisa (Sredina), Chat Upisivanje vasih poruka (Dole) I Lista Prisutnih Posetioca (Desno).
Da bi poslao poruku svima prisutnim na chatu potrebno je, Upisi zeljenu poruku u donjem delu prozora, I stisnite ENTER taste na tastaturi.

(Ako se nalazite u sobi Moderatora Pojavljuje se poruka koju nevide svi, Osim moderatora u toj sobi, Posle Odobravanja moderatora  poruka je vidljiva za sve prisutne.)

Na levoj strani stoje  Ihnen verschiedene Funktionen zur Verf&uuml;gung. Unterhalb des Logos sehen Sie ein Formular mit dem Sie in alle vorhandenen R&auml;ume des Chats wechseln k&ouml;nnen.
Unterhalb dieses Formulars befindet sich ein Schalter mit dem Sie einstellen k&ouml;nnen, ob sich der Inhalt des Chatausgabebereichs immer automatisch mit neuen Nachrichten mitbewegt. Wenn Sie einmal vorhergehende Nachrichten lesen wollen, die schon aus dem sichtbaren Bereich der Chatausgabe verschwunden sind, m&uuml;ssen Sie lediglich das H&auml;kchen vor <i>Automatich scrollen</i> deaktivieren und k&ouml;nnen dann den Chatausgabeframe wie gewohnt nach oben scrollen.
Beachten Sie bitte, dass in den Browsern <i>Mozilla</i>, <i>Firefox</i> und <i>Netscape 7</i> das H&auml;kchen nicht extra deaktiviert werden muss, es reicht aus, einmal in das Chatausgabefenster zu klicken und dann mittels der Scrollbalken des Frames zu scrollen. Wenn automatisches Scrollen wieder aktiviert werden soll, reicht ein einfacher Klick in das Textfeld der Chateingabe.

U desnom uglu je lista sa nickovima svi clanova koji  su prisutni na chatu.
 
Clanovi sa znakom _op_ ispred imena su operatori i imaju pravo da izbace
clanove sa chata, mogu da daju status operatora  odredjenim  clanovima
takodje mogu da oduzmu status operatorima odredjenim clanovima.

 PRIVATNE PORUKE !!!
Ako kliknete na zeljeno ime (na nick) u donjem praznom polju gde pisete poruku
ce se pojaviti zeljene osobe ime tj. nick i vi trebate samo da dopise te zeljenu poruku u 
nastvaku do imena tj.nika i klikne te na enter da se poruka posalje zeljenoj osobi.


<b><i>Pregled Komandi na Chatu:</i></b>
<b>/me message</b> -- Javna poruka , Na primer. <i>/Ovde mozete poslati poruku sa nekim naglasavanjem</i> Kako da posaljem sliku na grand</i>
<b>/msg Ime Posetioca Poruka</b> -- Posalji Privatnu poruku <i>Ime posetioca</i>
<b>/opcall</b> -- Poziv Operatorima za pomoc
<b>/croom Ime sobe</b> -- Napraviti Privatnu sobu <i>Ime sobe</i> 
<b>/invite Ime Posetioca</b> -- Poziva <i>Ime posetioca</i> U Privatnu sobu.
<b>/j Ime sobe</b> -- Prebaciti se u sobu <i>Ime sobe</i>";


$arsc_lang["helpop"]        = "
<b><i>Operator Komande:</i></b>
<b>/msgops Poruka</b> -- Privatna Poruka za sve operatore na chatu
<b>/whois Posetic</b> -- Pokazi Podatke o posetiocu  <i>Ime Posetioca</i>
<b>/op Ime posetioca</b> -- Posetiocu <i>Ime Posetioca</i> Dodaj Operator Status
<b>/deop Ime posetioca</b> -- Posetiocu <i>Ime posetioca</i> Operatorenstatus Skinuti
<b>/kick Ime posetioca</b> -- Posetioca <i>Ime posetioca</i> Izbaciti sa chata
<b>/bann Ime posetioca XYZ</b> -- IP Od Posetioca <i>Ime posetioca</i> za <i>XYZ</i> Sekundi blokirati
<b>/lock Ime posetioca</b> -- Nik od (Registrovanog!) Posetioca <i>Ime posetioca</i> Blokirati permanentno
<b>/rip Ime posetioca</b> -- Posetiocu <i>Ime posetioca</i> Zabrani Upisivanje teksta u chat (samo citanje)
<b>/unrip Ime posetioca</b> -- Posetiocu <i>Ime posetioca</i> Dozvoli dalje Pisanje u chatu
<b>/move Ime posetioca Ime sobe</b> -- Posetioca <i>Ime posetioca</i> Prebaci u sobu <i>Ime sobe</i>";

?>
