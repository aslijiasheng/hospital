<?php

/*
 This is an ARSC language file. If you translate it, please send me
 a copy to <manuel@kiessling.net>, I will add it to ARSC then.
 Thanks.

 This file is for versions 3.0-beta1, 3.0-beta2, 3.0-rc1, 3.0, 3.0.1, 3.0.2, 3.0.2-rc1, 3.0.2-rc2
  
 Translation by Stavros Tsoukalas <tsoukalass@hotmail.com>.
*/

// Include the english file, in order to provide english text if the current file has some sentences missing.
include("english.inc.php");

// Define some settings for this language
$arsc_lang_regions["greek"] = array("gr", "gr-gr", "gr-el", "el");
$arsc_lang_name["greek"] = "Greek";
$arsc_lang["charset"] = "utf-8";


// Language selection

$arsc_lang["chooseyourlanguage"] = "Επιλέξτε γλώσσα:";
$arsc_lang["next"] = "Επόμενο";


// Login Page

$arsc_lang["entername"]                 = "Δώστε χρήστη:";
$arsc_lang["enterpassword"]             = "Δώστε σύνθημα:";
$arsc_lang["selectchatversion"]         = "Επιλέξτε έκδοση συνομιλίας:";
$arsc_lang["version_browser_socket"]    = "Βελτιωμένη";
$arsc_lang["version_browser_push"]      = "Βελτιωμένη (συμβατή με firewall";
$arsc_lang["version_browser_text"]      = "Για πλοηγητές κειμένου";
$arsc_lang["yes"]                       = "Ναι";
$arsc_lang["no"]                        = "Οχι";
$arsc_lang["selectroom"]                = "Επιλέξτε δωμάτιο:";
$arsc_lang["createdby"]                 = "Δημιουργημένο από";
$arsc_lang["startbutton"]               = "Έναρξη συνομιλίας";
$arsc_lang["usersinchat"]               = "Συνδεδεμένοι χρήστες:";
$arsc_lang["usersinchat_room"]          = "Δωμάτιο";
$arsc_lang["usersinchat_name"]          = "Χρήστης/ες";
$arsc_lang["clicktoregister"]           = "Εγγραφείτε για προσωπικό όνομα χρήστη!";


// Why kicked? Page

$arsc_lang["why_kicked"] = "Σας απομάκρυνε από την συνομιλία ένας διαχεριστής. Αυτό συνέβη είτε γιατί δεν ακολουθήσατε τους κανόνες που διέπουν την συζήτηση, είτε γιατί η σύνδεσή σας έληξε χρονικά.";
$arsc_lang["returntologinpage"] = "Επιστροφή στην σελίδα σύνδεσης";

// Register page and eMail

$arsc_lang["register_intro"]                 = "Για να  εγγράψετε το e-mail σας συμπληρώστε την παρακάτω φόρμα.";
$arsc_lang["register_intro_force"]           = "ένα σύνθημα θα σταλεί με την συμπλήρωση και καταχώρηση της φόρμας, στην καταχωρημένη διεύθυνση ηλεκτρονικού ταχυδρομίου (e-mail).";
$arsc_lang["register_entername"]             = "Ονομα χρήστη:";
$arsc_lang["register_enteremail"]            = "Διεύθυνση ηλεκτρονικού ταχυδρομίου (e-mail):";
$arsc_lang["register_enterpassword"]         = "Σύνθημα:";
$arsc_lang["register_send"]                  = "Καταχώρηση";
$arsc_lang["register_yougetmail"]            = "Ευχαριστούμε, σε λίγο θα σας σταλεί ένα e-mail με το  σύνθημά σας.";
$arsc_lang["register_emailtemplate_subject"] = "Εγγραφή στο {title}";
$arsc_lang["register_emailtemplate_body"]    = "
Γειά σας,

Εγγραφήκατε στο {title}.

Επιλέξατε αυτό το όνομα χρήστη '{username}'.
το οποίο προστατεύεται από το παρακάτω σύνθημα:

            '{password}'

Μπορείτε τώρα να συνδεθείτε στην σελίδα:
{homepage}

Ελπίζουμε να περάσετε καλά!

-- 
 {chatowner}

";


// Chat interface

$arsc_lang["usersinroom"]               = "Χρήστες στο Δωμάτιο";
$arsc_lang["sendmessage"]               = "Αποστολή";
$arsc_lang["refreshmessages"]           = "Ανανέωση Μηνυμάτων";
$arsc_lang["leave"]                     = "Απομάκρυνση";
$arsc_lang["roomlist"]                  = "Λίστα Δωματίων";
$arsc_lang["go_room"]                   = "Εισαγωγή";
$arsc_lang["refresh"]                   = "Ανανέωση";
$arsc_lang["otherfunctions"]            = "Επιπρόσθετες Λειτουργίες";
$arsc_lang["smilielist"]                = "Λίστα των smilies";
$arsc_lang["scroll_active"]             = "Αυτόματο Ξετύλιγμα";
$arsc_lang["select_color"]              = "Επιλογή Χρώματος";
$arsc_lang["moderatorqueue_title"]      = "Αναπάντητες Ερωτήσεις";
$arsc_lang["moderatorqueue_delete"]     = "Διαγραφή";
$arsc_lang["moderatorqueue_youranswer"] = "Η Απάντησή σας";
$arsc_lang["moderatorqueue_cancel"]     = "Ακύρωση";
$arsc_lang["drawboard"]                 = "Πίνακας Σχεδίασης";

$arsc_lang["cmd_m"]           = "Κάντε κλίκ για να στείλετε μύνημα σε αυτόν τον χρήστη";
$arsc_lang["opcmd_w"]         = "Εμφάνιση περισσοτέρων πληροφοριών για αυτόν τον χρήστη";
$arsc_lang["opcmd_k"]         = "Διώξτε αυτόν τον χρήστη από το δωμάτιο.";
$arsc_lang["opcmd_b"]         = "Αποκλείστε την IP αυτού του χρήστη για κάποιο διάστημα";
$arsc_lang["opcmd_l"]         = "Κλειδώστε αυτόν τον χρήστη μόνιμα (αν έχει εγγραφεί σαν χρήστης)";
$arsc_lang["opcmd_r"]         = "Ακυρώστε τον χρήστη (για να μην μπορεί να μιλήσει)";
$arsc_lang["opcmd_u"]         = "Ενεργοποιήστε τον χρήστη (έτσι ώστε να μπορεί να μιλήσει)";
$arsc_lang["opcmd_o"]         = "Δώστε στον χρήστη status χειριστή (operator)";
$arsc_lang["opcmd_d"]         = "Αφαιρέστε το status χειριστή (operator) από τον χρήστη";
$arsc_lang["opcmd_m"]         = "Μετακινήστε τον χρήστηη σε άλλο δωμάτιο";
$arsc_lang["opcmd_id"]        = "Εμφανίστε την ταυτότητα του χρήστη";


// Errors

$arsc_lang["error_register_double_user"] = "Το όνομα χρήστη που επιλέξατε υπάρχει ήδη. Παρακαλώ επιλέξτε κάποιο άλλο.";
$arsc_lang["error_double_user"]          = "Εχει ήδη συνδεθεί κάποιος με αυτό το όνομα χρήστη.";
$arsc_lang["error_no_name"]              = "ΠΡΕΠΕΙ να καταχωρήσετε όνομα χρήστη!";
$arsc_lang["error_bad_name"]             = "Το όνομα χρήστη που επιλέξατε ΔΕΝ επιτρέπεταιt!";
$arsc_lang["error_wrong_credentials"]    = "Η Πρόσβαση ΔΕΝ επιτρέπεται!<br>Είναι σωστά τα διαπιστευτήριά σας;";
$arsc_lang["error_banned"]               = "Η Πρόσβαση προσωρινά ΔΕΝ επιτρέπεται.";


// IDCard

$arsc_lang["idcard_title"]               = "Ταυτότητα του";
$arsc_lang["idcard_sex"]                 = "Φύλο:";
$arsc_lang["idcard_male"]                = "Ανδρας";
$arsc_lang["idcard_female"]              = "Γυναίκα";
$arsc_lang["idcard_location"]            = "Περιοχή:";
$arsc_lang["idcard_color"]               = "Προεπιλεμένο Χρώμα:";
$arsc_lang["idcard_hobbies"]             = "Ενδιαφέροντα:";
$arsc_lang["idcard_save"]                = "Αποθήκευση";
$arsc_lang["idcard_save_ok"]             = "Οι αλλαγές αποθηκεύτηκαν";
$arsc_lang["idcard_save_no"]             = "Οι αλλαγές δεν μπόρεσαν να αποθηκευτούν!";
$arsc_lang["idcard_guestbook"]           = "Βιβλίο Επισκεπτών:";
$arsc_lang["idcard_guestbook_active"]    = "Να γίνει εμφάνιση του βιβλίου επισκεπτών;";
$arsc_lang["idcard_guestbook_delete"]    = "Διαγραφή";
$arsc_lang["idcard_guestbook_delete_ok"] = "Η εγγραφή διαγράφηκε";
$arsc_lang["idcard_guestbook_delete_no"] = "Η εγγραφή δεν μπόρεσε να διαγραφεί!";
$arsc_lang["idcard_guestbook_add"]       = "Εισαγωγή εγγραφής";
$arsc_lang["idcard_guestbook_add_ok"]    = "Η καταχώρηση έγινε επιτυχώς";
$arsc_lang["idcard_guestbook_add_no"]    = "Η καταχώρηση ΔΕΝ μπόρεσε να πραγματοποιηθεί!";
$arsc_lang["idcard_guestbook_next"]      = "Επόμενες εγγραφές";
$arsc_lang["idcard_guestbook_prev"]      = "Προηγούμενες εγγραφές";
$arsc_lang["idcard_close"]               = "Κλείσιμο";


// Chat System Messages

$arsc_lang["enter"]               = "Ο Χρήστης {user} ήλθε στο δωμάτιο {room}.";
$arsc_lang["welcome"]             = "Καλώς ήλθατε στο {title}!";
$arsc_lang["quit"]                = "Ο Χρήστης {user} αποχώρησε από το δωμάτιο {room}.";
$arsc_lang["roomchange"]          = "Ο Χρήστης {user} μετακινήθηκε απο το δωμάτιο {room1} στο {room2}.";
$arsc_lang["kicked"]              = "Ο Χρήστης {userpassive} απομακρύνθηκε από τον/ην {useractive}.";
$arsc_lang["youwerekicked"]       = "Απομακρυνθήκατε από την συζήτηση!";
$arsc_lang["floodwarn"]           = "ΜΗΝ  ΕΠΑΝΑΛΑΜΒΑΝΕΤΕ ΦΡΑΣΕΙΣ, σε αντίθετη περίπτωση θα αναγκαστείτε να απομακρυνθείτε!";
$arsc_lang["op"]                  = "User {userpassive} wurde von User {useractive} Operatorstatus erteilt.";
$arsc_lang["deop"]                = "User {useractive} hat User {userpassive} den Operatorenstatus entzogen.";
$arsc_lang["whispers"]            = "ψιθυρίζει";
$arsc_lang["whispersops"]         = "ψιθυρίζει σε ΟΛΟΥΣ τους χειριστές (operators)";
$arsc_lang["gotmsg"]              = "ψιθυρίσατε στον χρήστη {user}: {message}";
$arsc_lang["croom"]               = "Ο Χρήστης {user} αποφάσισε να αποσυρθεί στο ιδιωτικό δωμάτιο {room} .";
$arsc_lang["room_exists"]         = "Το δωμάτιο {room} υπάρχει ήδη!";
$arsc_lang["room_badname"]        = "Το όνομα δωματίου έχει αποκλειστεί.";
$arsc_lang["room_created"]        = "Το ιδιωτικό σας δωμάτιο: {room} δημιουργήθηκε επιτυχώς! Μπορείτε πλέον να καλείτε χρήστες χρησιμοποιώντας την εντολή  /invite .";
$arsc_lang["invite"]              = "Ο Χρήστης {user} σας κάλεσε στο ιδιωτικό δωμάτιο {room}. Πληκτρολογείστε \"/room {room} {password}\"  για να μπείτε στο δωμάτιο.";
$arsc_lang["invite_notexist"]     = "Ο χρήστης {user} ΔΕΝ υπάρχει!";
$arsc_lang["invite_notownroom"]   = "Πρέπει να βρίσκεστε στο ΔΙΚΟ σας ιδιωτικό δωμάτιο για να μπορείτε να καλέσετε και άλλους χρήστες!";
$arsc_lang["room_not_exist"]      = "Το δωμάτιο {room} ΔΕΝ υπάρχει!";
$arsc_lang["room_wrong_password"] = " Πρέπει να δώσετε το σωστό σύνθημα για να μπείτε στο δωμάτιο:{room} .";
$arsc_lang["moderate_message"]    = "Το μήνυμά σας `{message}` παραδώθηκε στους συντονιστές και θα ελεγθεί.";
$arsc_lang["opcall"]              = "[OPCALL] Χρειάζομαι Βοήθεια!";

$arsc_lang["helplink"]      = "Βοήθεια";
$arsc_lang["help"]          = "
<b><i>Γενική Βοήθεια:</i></b>
Στο δεξί μέρος της σελίδας μπορείτε να δείτε 
όλους τους χρήστες, που βρίσκονται στο δωμάτιο.

Οι χρήστες με το @ μπροστά από το όνομά τους
είναι χειριστές (operators) και μπορούν 
να απομακρύνουν άλλους χρήστες από το δωμάτιο,
να δώσουν βαθμό χειριστή (operator) σε άλλους χρήστες 
και να αφαιρέσουν βαθμό χειριστή (operator).

Αν κάνετε κλίκ σε ένα όνομα χρήστη δεξιά,
στο πεδίο μηνύματος θα εισαχθεί η εντολή 
για αποστολή προσωπικού μηνύματος στον χρήστη αυτό.
Το μόνο που μένει ακόμα είναι στο τέλος της εντολής,
να εισάγετε το μήνυμα, που επιθυμείτε, αφήνοντας ένα κενό.

<b><i>Γενικές Εντολές:</i></b>
<b>/me message</b> -- Συμβολίζει μία ενέργεια, π.χ. <i>/me αισθάνομαι όμορφα</i> Στην συνομιλία: <i>* Ο Χρήστης αισθάνομαι όμορφα</i>
<b>/msg Ονομα Χρήστη Μύνημα</b> -- Στέλνει προσωπικό μύνημα στον <i>Ονομα Χρηστη</i>, χωρίς να είναι ορατό σε άλλο χρήστη.
<b>/opcall</b> -- Καλέστε τους χειριστές σε βοήθεια";

$arsc_lang["helpop"]        = "
<b><i>Εντολές Χειριστών (operators):</i></b>
/msgops μυνημα -- Ψιθυρίζει το μήνυμα σε όλους τους χειριστές (operators)
/whois χρήστη -- Δείχνει πληροφορίες για τον χρήστη
/op χρήστη -- Δείνει status χειριστή (operator) στον χρήστη
/deop χρήστη -- Αφαιρεί το status χειριστή (operator) από τον χρήστη
/kick χρήστη -- Διώχνει τον χρήστη από την συζήτηση
/bann χρήστη X -- Μπλοκάρει την IP του χρήστης για X δευτερόλεπτα
/lock χρήστη -- Κλειδώνει τον λογαριασμό του (εγγεγραμένου) χρήστη μόνιμα
/rip χρήστη --  Ο,τι λέει ο χρήστη δεν είναι ορατά
/unrip χρήστη -- Ο,τι λέει ο χρήστη είναι ξανά ορατά
/move χρήστη δωμάτιο -- Μετακινεί τον χρήστη στο δωμάτιο";

?>
