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
$arsc_lang_regions["spanish"] = array("es", "es", "es");
$arsc_lang_name["spanish"] = "Español";
$arsc_lang["charset"] = "utf-8";


// Language selection

$arsc_lang["chooseyourlanguage"] = "Elija su idioma:";
$arsc_lang["next"] = "Siguiente";


// Login Page

$arsc_lang["entername"]                 = "Ingrese su nick:";
$arsc_lang["enterpassword"]             = "Ingrese su password:";
$arsc_lang["selectchatversion"]         = "Elija una version:";
$arsc_lang["version_browser_socket"]    = "Optimizado";
$arsc_lang["version_browser_push"]      = "Optimizado (compatible con firewalls)";
$arsc_lang["version_browser_text"]      = "Para navegadores de texto";
$arsc_lang["yes"]                       = "Si";
$arsc_lang["no"]                        = "No";
$arsc_lang["selectroom"]                = "Elija una sala:";
$arsc_lang["createdby"]                 = "Creado por";
$arsc_lang["startbutton"]               = "Comience a chatear!";
$arsc_lang["usersinchat"]               = "Estos usuarios estan logueados:";
$arsc_lang["usersinchat_room"]          = "Sala";
$arsc_lang["usersinchat_name"]          = "Usuario";
$arsc_lang["clicktoregister"]           = "Registre su nick!";


// Why kicked page

$arsc_lang["returntologinpage"] = "Volver a la pagina de login";


// Register page and eMail

$arsc_lang["register_intro"]                 = "Para registrar su nick, complete los campos de abajo";
$arsc_lang["register_intro_force"]           = "Un password le será enviado al email que ingresó";
$arsc_lang["register_entername"]             = "Nickname:";
$arsc_lang["register_enteremail"]            = "EMail:";
$arsc_lang["register_enterpassword"]         = "Password:";
$arsc_lang["register_send"]                  = "Terminar Registro";
$arsc_lang["register_yougetmail"]            = "Gracias, ud recibira en instantes un email con su password";
$arsc_lang["register_emailtemplate_subject"] = "Su registro para {title}";
$arsc_lang["register_emailtemplate_body"]    = "
Hola,

Ud se registro para {title}.

Y el nickname '{username}'.
esta ahora protegido por la contraseña

            '{password}'

Ahora puede ingresar al chat desde esta página:
{homepage}

Diviertase!

-- 
 {chatowner}

";


// Chat interface

$arsc_lang["usersinroom"]               = "Usearios en la sala";
$arsc_lang["sendmessage"]               = "Enviar";
$arsc_lang["refreshmessages"]           = "Actualizar mensajes";
$arsc_lang["leave"]                     = "Abandonar";
$arsc_lang["roomlist"]                  = "Salas";
$arsc_lang["go_room"]                   = "Entrar";
$arsc_lang["refresh"]                   = "Actualizar";
$arsc_lang["otherfunctions"]            = "funciones adicionales";
$arsc_lang["smilielist"]                = "Lista de todos los emoticones";
$arsc_lang["scroll_active"]             = "Autoscroll";
$arsc_lang["select_color"]              = "Seleccione su color";
$arsc_lang["moderatorqueue_title"]      = "Preguntas sin contestar";
$arsc_lang["moderatorqueue_delete"]     = "Borrar";
$arsc_lang["moderatorqueue_youranswer"] = "Su respuesta";
$arsc_lang["moderatorqueue_cancel"]     = "Cancelar";
$arsc_lang["drawboard"]                 = "Pizarron";

$arsc_lang["cmd_m"]           = "Golpear para enviar un mensaje a este usuario";
$arsc_lang["opcmd_w"]         = "Mostrar mas informacion de este usuario";
$arsc_lang["opcmd_k"]         = "Expulsar a este usuario";
$arsc_lang["opcmd_b"]         = "Bloquear la IP de este usuario por un tiempo";
$arsc_lang["opcmd_l"]         = "Bloquear a este usuario permamentemente (si esta registrado)";
$arsc_lang["opcmd_r"]         = "Quitar voz a este usuario";
$arsc_lang["opcmd_u"]         = "Dar voz a este usuario";
$arsc_lang["opcmd_o"]         = "Dar nivel de operador a este usuario";
$arsc_lang["opcmd_d"]         = "Tomar nivel de operar de este usuario";
$arsc_lang["opcmd_m"]         = "Mover usuario a otra sala";
$arsc_lang["opcmd_id"]        = "Mostrar el ID de este usuario";


// Errors

$arsc_lang["error_register_double_user"] = "Este nick está en uso. Por favor elija otro.";
$arsc_lang["error_double_user"]          = "Un usuario con este nick está actualmente logueado!";
$arsc_lang["error_no_name"]              = "Debe ingresar un nick!";
$arsc_lang["error_bad_name"]             = "Este nombre no está permitido!";
$arsc_lang["error_wrong_credentials"]    = "Acceso denegado!<br>Tus credenciales estan correctas?";
$arsc_lang["error_banned"]               = "Acceso temporalmente denegado";


// IDCard

$arsc_lang["idcard_title"]               = "ID de";
$arsc_lang["idcard_sex"]                 = "Genero:";
$arsc_lang["idcard_male"]                = "masculino";
$arsc_lang["idcard_female"]              = "femenino";
$arsc_lang["idcard_location"]            = "Localidad:";
$arsc_lang["idcard_color"]               = "Color por defecto:";
$arsc_lang["idcard_hobbies"]             = "Hobbis:";
$arsc_lang["idcard_save"]                = "Guardar";
$arsc_lang["idcard_save_ok"]             = "Los cambion fueron guardados";
$arsc_lang["idcard_save_no"]             = "Los cambios no fueron guardados";
$arsc_lang["idcard_guestbook"]           = "Libro de visitas:";
$arsc_lang["idcard_guestbook_active"]    = "Mostrar libro de visitas?";
$arsc_lang["idcard_guestbook_delete"]    = "Borrar";
$arsc_lang["idcard_guestbook_delete_ok"] = "El mensaje fue eliminado";
$arsc_lang["idcard_guestbook_delete_no"] = "El mensaje no fue eliminado!";
$arsc_lang["idcard_guestbook_add"]       = "Agregar comentario";
$arsc_lang["idcard_guestbook_add_ok"]    = "Su comentario fue agregado";
$arsc_lang["idcard_guestbook_add_no"]    = "Su comentario no fue agregado!";
$arsc_lang["idcard_guestbook_next"]      = "Siguientes";
$arsc_lang["idcard_guestbook_prev"]      = "Anteriores";
$arsc_lang["idcard_close"]               = "Cerrar";


// Chat System Messages

$arsc_lang["enter"]               = "{user} ha ingresado a la sala {room}.";
$arsc_lang["welcome"]             = "Bioenvenido a {title}!";
$arsc_lang["quit"]                = "{user} ha abandonado la sala {room}.";
$arsc_lang["roomchange"]          = "{user} ha abandonado la sala {room1} y ha ongresado a {room2}.";
$arsc_lang["kicked"]              = "{userpassive} fue expulsado de la sala por {useractive}.";
$arsc_lang["youwerekicked"]       = "Has sido expulsado del chat!";
$arsc_lang["floodwarn"]           = "Deja de molestar o serás expulsado de la sala!";
$arsc_lang["op"]                  = "{userpassive} ha recibido nivel de operador de {useractive}.";
$arsc_lang["deop"]                = "{useractive} ha quitado nivel de operador a {userpassive}.";
$arsc_lang["whispers"]            = "Susurrar";
$arsc_lang["whispersops"]         = "Susurrar a todos los operadores";
$arsc_lang["gotmsg"]              = "Estas susurrando a {user}: {message}";
$arsc_lang["croom"]               = "{user} ha decidido dibujar en la sala {room}.";
$arsc_lang["room_exists"]         = "Lo siento, pero la sala {room} ya existe.";
$arsc_lang["room_badname"]        = "Lo siento, el nombre de la sala no es valido.";
$arsc_lang["room_created"]        = "Tu sala privada {room} fue creada! Ahora puedes invitar a otros usuarios con el comando /invite .";
$arsc_lang["invite"]              = "{user} te ha invitado a la sala {room}. Tipee \"/room {room} {password}\" para ingresar.";
$arsc_lang["invite_notexist"]     = "Lo siento, el usuario {user} no existe.";
$arsc_lang["invite_notownroom"]   = "Lo siento, usted debe estar en su sala privada para invitar a otros usuarios.";
$arsc_lang["room_not_exist"]      = "Lo siento, pero la sala {room} no existe";
$arsc_lang["room_wrong_password"] = "Lo siento, ustede debe ingresar el password correcto para ingresar a la sala {room}";
$arsc_lang["moderate_message"]    = "Su mensaje `{message}` fue entregado al moderador y será revisado.";
$arsc_lang["opcall"]              = "[OPCALL] Necesito ayuda!";

$arsc_lang["helplink"]      = "Ayuda";
$arsc_lang["help"]          = "
Ayuda General:
En el frame de la derecha Ud puede ver a todos los usuarios
que estan actualmente en la sala

Los usuarios con @ adelante de su nick 
son los operadores y pueden expulsar usuarios,
dar nivel de operador y quitarselo a otros OPs.

Si cliqueas en un nombre de la derecha, el cuadro de 
mensajes sera completado con el comando necesario para 
enviar un mensaje privado a ese usuario. 
Ud sólo debe añadir su mensaje al final de esta linea.


Comandos generale:
/me mensaje -- Simboliza una accion, ej. /me feels fine writes * User feels fine
/msg usuario mensaje -- Envia un mensaje privado al usuario
/j OtraSala -- Abandona la sala actual e ingresa a 'OtraSala'
/room Sala -- Similar a /j";

$arsc_lang["helpop"]        = "
Comandos de Operador:
/msgops mensaje -- Susurrar un mensaje a todos los operadores
/whois usuario -- Muestra informacion acerca de del usuario
/op usuario -- Da nivel de operador al usuario
/deop usuario -- Quita nivel de operador al usuario
/kick usuario -- Expulsa al usuario del chat
/bann usuario X -- Bloquea la IP del usuario por X segundos
/lock usuario -- Bloquea el usuario (registrado!) permanentemente
/rip usuario -- Silencia al usuario. Nadie podra leerlo
/unrip usuario -- Devuelve la voz al usuario
/move usuario sala -- Mueve al usuario a la sala";

?>
