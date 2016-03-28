<?php

/*
 This is an ARSC language file. If you translate it, please send me
 a copy to <manuel@kiessling.net>, I will add it to ARSC then.
 Thanks.

 This file is for versions 3.0-beta1, 3.0-beta2, 3.0-rc1, 3.0, 3.0.1, 3.0.2, 3.0.2-rc1, 3.0.2-rc2
  
 Translation by Amel Hankic <melko@gmx.at>.
*/

// Include the english file, in order to provide english text if the current file has some sentences missing.
include("english.inc.php");

// Define some settings for this language
$arsc_lang_regions["bosnian"] = array("ba", "ba-ba", "ba-cro");
$arsc_lang_name["bosnian"] = "Bosanski";
$arsc_lang["charset"] = "utf-8";


// Language selection

$arsc_lang["chooseyourlanguage"] = "Izaberite jezik:";
$arsc_lang["next"] = "Dalje";


// Login Page

$arsc_lang["entername"]                 = "korisnik:";
$arsc_lang["enterpassword"]             = "lozinka:";
$arsc_lang["selectchatversion"]         = "izaberite verziju chat-a:";
$arsc_lang["version_browser_socket"]    = "optimisan";
$arsc_lang["version_browser_push"]      = "optimisan (Firewall-kompatible)";
$arsc_lang["version_browser_text"]      = "za Textbrowser";
$arsc_lang["yes"]                       = "Da";
$arsc_lang["no"]                        = "Ne";
$arsc_lang["selectroom"]                = "izaberite sobu:";
$arsc_lang["createdby"]                 = "napravljena od";
$arsc_lang["startbutton"]               = "uđi u chat";
$arsc_lang["usersinchat"]               = "ovi korisnici su momentalno online:";
$arsc_lang["usersinchat_room"]          = "soba";
$arsc_lang["usersinchat_name"]          = "korisnik";
$arsc_lang["clicktoregister"]           = "registrujte novog korisnika!";


// Why kicked? Page



// Register page and eMail

$arsc_lang["register_intro"]                 = "Da bi registrovali novog korisnika, molimo vas ispunite sledeđa polja.";
$arsc_lang["register_intro_force"]           = "Onda će vam lozinka bit poslana na email.";
$arsc_lang["register_entername"]             = "korisnik:";
$arsc_lang["register_enteremail"]            = "eMail-adresa:";
$arsc_lang["register_enterpassword"]         = "lozinka:";
$arsc_lang["register_send"]                  = "pošalji";
$arsc_lang["register_yougetmail"]            = "Hvala, sada će te dobit mail sa vasom lozinkom.";
$arsc_lang["register_emailtemplate_subject"] = "Vaša {title} registracija.";
$arsc_lang["register_emailtemplate_body"]    = "
Hallo,

Dobrodošli kod {title}.

Vi ste registrovali korisnika '{username}'.
sa sledećom lozinkom:

            '{password}'

Ovdje se možete logirat u chat:
{homepage}


-- 
 {chatowner}

";


// Chat interface

$arsc_lang["usersinroom"]               = "korisnika u sobi";
$arsc_lang["sendmessage"]               = "pošalji";
$arsc_lang["refreshmessages"]           = "aktualiziraj poruke";
$arsc_lang["leave"]                     = "napusti chat";
$arsc_lang["roomlist"]                  = "lista soba";
$arsc_lang["go_room"]                   = "uđi";
$arsc_lang["refresh"]                   = "aktualiziraj";
$arsc_lang["otherfunctions"]            = "ostale funkcije";
$arsc_lang["smilielist"]                = "lista Smile-ova";
$arsc_lang["scroll_active"]             = "automatski scroll";
$arsc_lang["select_color"]              = "izaberite vašu boju teksta";
$arsc_lang["moderatorqueue_title"]      = "neodgovorena pitanja";
$arsc_lang["moderatorqueue_delete"]     = "briši";
$arsc_lang["moderatorqueue_youranswer"] = "vaš odgovor";
$arsc_lang["moderatorqueue_cancel"]     = "prekini";
$arsc_lang["drawboard"]                 = "Drawboard";

$arsc_lang["cmd_m"]           = "ovdje klikni i pošalji korisniku poruku";
$arsc_lang["opcmd_w"]         = "pokaži više informacija o ovom korisniku";
$arsc_lang["opcmd_k"]         = "izbaci ovog korisnika iz sobe.";
$arsc_lang["opcmd_b"]         = "IP-adresu ovog korisnika za jedno izvjesno vrijeme izključit";
$arsc_lang["opcmd_l"]         = "ovog korisnika za uvijek izključit (samo sa registrovanim korisnicima moguće)";
$arsc_lang["opcmd_r"]         = "zanijemi korisnika";
$arsc_lang["opcmd_u"]         = "odključaj korisnika";
$arsc_lang["opcmd_o"]         = "dadni korisniku Operatorstatus";
$arsc_lang["opcmd_d"]         = "uzmi korisniku Operatorstatus";
$arsc_lang["opcmd_m"]         = "premjesti korisnika u drugu sobu";
$arsc_lang["opcmd_id"]        = "pokaži ID-Card ovog korisnika";


// Errors

$arsc_lang["error_register_double_user"] = "korisnik se već koristi, molimo vas izaberite nekog drugog.";
$arsc_lang["error_double_user"]          = "korisnik se već koristi, molimo vas izaberite nekog drugog.";
$arsc_lang["error_no_name"]              = "morate jednog korisnika navest!";
$arsc_lang["error_bad_name"]             = "Taj korisnik nije dozvoljen!";
$arsc_lang["error_wrong_credentials"]    = "ulaz zabranjen - jesu vaši podatci tačni?";
$arsc_lang["error_banned"]               = "vaš ulaz je za neko vrijeme zabranjen.";


// IDCard

$arsc_lang["idcard_title"]               = "ID-Card od";
$arsc_lang["idcard_sex"]                 = "pol:";
$arsc_lang["idcard_male"]                = "muški";
$arsc_lang["idcard_female"]              = "ženski";
$arsc_lang["idcard_location"]            = "mjesto:";
$arsc_lang["idcard_color"]               = "standard-boja:";
$arsc_lang["idcard_hobbies"]             = "zanimanje:";
$arsc_lang["idcard_save"]                = "zapamti";
$arsc_lang["idcard_save_ok"]             = "promjene su zapamćene";
$arsc_lang["idcard_save_no"]             = "promjene se nisu mogle zapamtit!";
$arsc_lang["idcard_guestbook"]           = "knjiga gostiju:";
$arsc_lang["idcard_guestbook_active"]    = "pokaži knjigu gostiju?";
$arsc_lang["idcard_guestbook_delete"]    = "briši";
$arsc_lang["idcard_guestbook_delete_ok"] = "upis je izbrisan";
$arsc_lang["idcard_guestbook_delete_no"] = "upis se nije mogo izbrisat!";
$arsc_lang["idcard_guestbook_add"]       = "dodaj upis";
$arsc_lang["idcard_guestbook_add_ok"]    = "vaš upis je dodan";
$arsc_lang["idcard_guestbook_add_no"]    = "vaš upis se nije mogo dodat!";
$arsc_lang["idcard_guestbook_next"]      = "ostali upisi";
$arsc_lang["idcard_guestbook_prev"]      = "prošli upisi";
$arsc_lang["idcard_close"]               = "zatvori";


// Chat System Messages

$arsc_lang["enter"]               = "korisnik {user} ulazi u sobu {room}.";
$arsc_lang["welcome"]             = "Dobrodošo u {title}!";
$arsc_lang["quit"]                = "korisnik {user} napušta sobu {room}.";
$arsc_lang["roomchange"]          = "korisnik {user} napušta sobu {room1} i ulazi u sobu {room2}.";
$arsc_lang["kicked"]              = "korisnik {userpassive} je od {useractive} izbačen iz chat-a.";
$arsc_lang["youwerekicked"]       = "Vi ste izbačeni iz chat-a!";
$arsc_lang["floodwarn"]           = "Ako nastavite uvijek isto pisat, bit će te izbačeni iz chat-a!";
$arsc_lang["op"]                  = "korisnik {userpassive} dobio je od {useractive} Operatorstatus.";
$arsc_lang["deop"]                = "korisnik {useractive} je korisniku {userpassive} Operatorstatus oduzo.";
$arsc_lang["whispers"]            = "šapće";
$arsc_lang["whispersops"]         = "šapće operatorima";
$arsc_lang["gotmsg"]              = "vi šapćete sa {user}: {message}";
$arsc_lang["croom"]               = "korisnik {user} povlači se u svoju privatnu sobu {room}.";
$arsc_lang["room_exists"]         = "soba {room} već postoji!";
$arsc_lang["room_badname"]        = "to ime sobe nije dozvoljeno.";
$arsc_lang["room_created"]        = "vaša privatna soba {room} je uspješno napravljena! Vi možete samo pomoću /invite naredbe druge korisnike u vašu sobu pozvat.";
$arsc_lang["invite"]              = "korisnik {user} vas je pozvo u njegovu privatnu sobu {room}. Upiši te \"/room {room} {password}\" dabi u njegovu sobu ušli.";
$arsc_lang["invite_notexist"]     = "korisnik {user} nepostoji!";
$arsc_lang["invite_notownroom"]   = "Vi morate bit u svojoj privatnoj sobi da bi mogli pozvat druge korisnike!";
$arsc_lang["room_not_exist"]      = "soba {room} nepostoji!";
$arsc_lang["room_wrong_password"] = "Vi morate tačnu lozinku navest da bi u sobu {room} ušli.";
$arsc_lang["moderate_message"]    = "vaša poruka `{message}` je poslana do moderatora i bit će prekontrolisana.";
$arsc_lang["opcall"]              = "[OPCALL] Meni treba pomoć!";

$arsc_lang["helplink"]      = "pomoć";
$arsc_lang["help"]          = "
<b><i>opća pomoć:</i></b>
Chat-prozor se dijeli u funkcije (lijevo), Chat (sredina), Chat-upis (dole) i lista online korisnika (desno).
Da bi jednu poruku na sve osobe koje se nalaze u sobi poslali, utipkajte jednostavno željnu poruku u Chat-upis (dole) i pritisnite 'Enter'.

(Ako se u sobi sa moderatorom nalazite, vaša će poruka bit prvo moderatoru poslana, pa ako on dadne OK, onda će tek bit za sve korisnike vidljiva.)

U lijevom dijelu imate dosta funkcija. Ispod logo ima lista svih soba u koje se možete premjestit.
Ispod tog formulara nalazi se jedan šalter, sa kojim možete naštimat da se Chat uvijek automatski scroll-uje. Ako želite da čitate poruke, koje se više u chat-u nevide, onda morate samo ovu kvaku izkjlučit i možete onda ko normalno na gore scroll-ovat.
Pazite da, u browserima <i>Mozilla</i>, <i>Firefox</i> i <i>Netscape 7</i> šalter se nemora extra deaktivirat, dovoljno je, jednom u Chat kliknut i pomoću scroll-balkena se na gore micat. Ako opet želite automatski scroll, odna je dovoljno jedan klik u Chat-upis učinit.

U desnom prostoru, u listi online korisnika, vidite imena svih korisnika, koji se sa vama u istoj sobi nalaze. Korisnici, ispred kojih se simbol @ nalazi, su takozvani operatori - oni imaju više prava u chat-u, naprimer izbacivanje korisnika, i zadužni su za red u sobi. Njima trebate pisat ako imate problema ili pitanja. Naredba '/opcall' (jednostavno dole upisat) informise online operatore, da vi pomoć trebate.

Svako ime u listi korisnika (osim vašeg) je istovremeno i jedan link - ako na njega kliknete, automatski se dole upiše '/msg imeKorisnika'. Onda morate samo vašu poruku dodat, i kad je pošaljete, dobiva izabrani korisnik jednu privatnu poruku od vas. To znači, da samo on tu poruku može vidit. Ta funkcija se isto <i>šaptat</i> zove.


<b><i>pregled naredbi:</i></b>
<b>/me poruka</b> -- symboliše jednu radnju, naprimer <i>/me otvara jednu vrećicu čipsa</i> piše u chat-u: <i>* otvara jednu vrećicu čipsa</i>
<b>/msg imeKorisnika poruka</b> -- šalje jednu privatnu poruku na <i>imeKorisnika</i>
<b>/opcall</b> -- zove operatore u pomoć
<b>/croom imeSobe</b> -- pravi jednu novu privatnu sobu sa imenom <i>imeSobe</i> 
<b>/invite imeKorisnika</b> -- poziva <i>imeKorisnika</i> u privatnu sobu
<b>/j imeSobe</b> -- premješta te u <i>imeSobe</i>";

$arsc_lang["helpop"]        = "
<b><i>operator naredbe:</i></b>
<b>/msgops poruka</b> -- šapćat sa svim drugim operatorima
<b>/whois imeKorisnika</b> -- pokazuje informacije o korisniku <i>imeKorisnika</i>
<b>/op imeKorisnika</b> -- korisniku <i>imeKorisnika</i> operatorstatus dat
<b>/deop imeKorisnika</b> -- korisniku <i>imeKorisnika</i> operatorstatus uzet
<b>/kick imeKorisnika</b> -- korisnika <i>imeKorisnika</i> iz chat-a izbacit
<b>/bann imeKorisnika XYZ</b> -- IP korisnika <i>imeKorisnika</i> za <i>XYZ</i> sekundi zaključat
<b>/lock imeKorisnika</b> -- registriranog korisnika <i>imeKorisnika</i> non stop zaključat
<b>/rip imeKorisnika</b> -- zanijemi korisnika <i>imeKorisnika</i>
<b>/unrip imeKorisnika</b> -- korisniku <i>imeKorisnika</i> opet glas dat
<b>/move imeKorisnika imeSobe</b> -- korisnika <i>imeKorisnika</i> u <i>imeSobe</i> premjestit";

?>
