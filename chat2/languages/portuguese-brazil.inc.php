<?php

/*
 This is an ARSC language file. If you translate it, please send me
 a copy to <manuel@kiessling.net>, I will add it to ARSC then.
 Thanks.

 This file is for versions 3.0-beta1, 3.0-beta2, 3.0-rc1, 3.0, 3.0.1, 3.0.2, 3.0.2-rc1, 3.0.2-rc2
  
 Translation by Rodrigo Lopes <rvl@ufrj.br>.
*/

// Include the english file, in order to provide english text if the current file has some sentences missing.
include("english.inc.php");

// Define some settings for this language
$arsc_lang_regions["portuguese-brazil"] = array("pt-br", "pt");
$arsc_lang_name["portuguese-brazil"] = "Portuguese (Brazil)";
$arsc_lang["charset"] = "utf-8";


// Language selection

$arsc_lang["chooseyourlanguage"] = "W&auml;hlen Sie Ihre Sprache:";
$arsc_lang["next"] = "Weiter";


// Login Page

$arsc_lang["entername"]                 = "Por favor digite seu nick:";
$arsc_lang["enterpassword"]             = "Por favor digite sua senha:";
$arsc_lang["whichversion"]              = "Qual vcersão você quer usar?";
$arsc_lang["version_browser_text"]      = "Versão simples para navegadores baseados em texto.";
$arsc_lang["version_applet"]            = "Java Applet.";
$arsc_lang["yes"]                       = "Sim";
$arsc_lang["no"]                        = "Não";
$arsc_lang["selectroom"]                = "Escolha uma sala:";
$arsc_lang["createdby"]                 = "Criado por";
$arsc_lang["startbutton"]               = "iniciar o chat!";
$arsc_lang["usersinchat"]               = "Estes usuários estão logados:";
$arsc_lang["usersinchat_room"]          = "Sala";
$arsc_lang["usersinchat_name"]          = "Usuário";
$arsc_lang["clicktoregister"]           = "Registre seu nick!";

// Why kicked page



// Register page and eMail

$arsc_lang["register_intro"]                 = "Para registrar seu nick, preencha os campos abaixo.";
$arsc_lang["register_intro_force"]           = "Uma senha será enviada para o email fornecido.";
$arsc_lang["register_entername"]             = "Nick:";
$arsc_lang["register_enteremail"]            = "Email:";
$arsc_lang["register_enterpassword"]         = "Senha:";
$arsc_lang["register_send"]                  = "Enviar registro";
$arsc_lang["register_yougetmail"]            = "Obrigado, Você receberá agora um email com a sua senha.";
$arsc_lang["register_emailtemplate_subject"] = "Seu registro para {title}";
$arsc_lang["register_emailtemplate_body"]    = "
Olá,

Você está registrado para {title}.

Você escolheu o nick '{username}'.
Ele está agora protegido com esta senha:

            '{password}'

Você pode agora entrar no chat por esta página:
{homepage}

Divirta-se!

-- 
 {chatowner}

";


// Chat interface

$arsc_lang["usersinroom"]     = "Usuários na sala";
$arsc_lang["sendmessage"]     = "Enviar";
$arsc_lang["refreshmessages"] = "Atualizar Menssagens";
$arsc_lang["leave"]           = "Sair";
$arsc_lang["roomlist"]        = "Lista de Salas";
$arsc_lang["go_room"]         = "Entrar";
$arsc_lang["refresh"]         = "Atualizar";
$arsc_lang["otherfunctions"]  = "Funções adicionais";
$arsc_lang["smilielist"]      = "Lista de todos os Smiles";
$arsc_lang["scroll_active"]   = "Auto Rolagem";
$arsc_lang["select_color"]    = "Selecione sua cor";
$arsc_lang["drawboard"]       = "Quadro de cor";

$arsc_lang["cmd_m"]           = "Clique para enviar uma mensagem para este usuário";
$arsc_lang["opcmd_w"]         = "Mostrar informações adicionais para este usuário";
$arsc_lang["opcmd_k"]         = "Chutar esse usuário da sala";
$arsc_lang["opcmd_b"]         = "Banir o IP deste usuário por algum tempo";
$arsc_lang["opcmd_l"]         = "Trancar este usuário permanentemente (se ele estiver registrado)";
$arsc_lang["opcmd_r"]         = "Calar este usuário (então ele não pode conversar)";
$arsc_lang["opcmd_u"]         = "DesCalar este usuário (então ele pode conversar denovo)";
$arsc_lang["opcmd_o"]         = "Dar a este usuário status de operador";
$arsc_lang["opcmd_d"]         = "Tirar status de operador deste usuário";
$arsc_lang["opcmd_m"]         = "Mover usuário deste sala para uma outra";
$arsc_lang["opcmd_id"]        = "Mostrar o ID Card deste usuário";

// Errors

$arsc_lang["error_register_double_user"] = "Este nick já está em uso. Por favor escolha outro.";
$arsc_lang["error_double_user"]          = "Um usuário com este nome já está logado!";
$arsc_lang["error_no_name"]              = "Você deve digitar um nick!";
$arsc_lang["error_bad_name"]             = "Este nome não é permitido!";
$arsc_lang["error_wrong_credentials"]    = "Acesso negado!<br>Seuas credenciais estão corretas?";
$arsc_lang["error_banned"]               = "Acesso temporariamente não permitido.";

// IDCard

$arsc_lang["idcard_title"]               = "ID Card de";
$arsc_lang["idcard_sex"]                 = "Sexo:";
$arsc_lang["idcard_male"]                = "masculino";
$arsc_lang["idcard_female"]              = "feminino";
$arsc_lang["idcard_location"]            = "Localização:";
$arsc_lang["idcard_color"]               = "Cor padrão:";
$arsc_lang["idcard_hobbies"]             = "Hobbes:";
$arsc_lang["idcard_save"]                = "Salvar";
$arsc_lang["idcard_save_ok"]             = "Mudanças salvas";
$arsc_lang["idcard_save_no"]             = "Mudanças não puderam ser salvas";
$arsc_lang["idcard_guestbook"]           = "Livro de visitas:";
$arsc_lang["idcard_guestbook_active"]    = "Mostrar livro de visitas?";
$arsc_lang["idcard_guestbook_delete"]    = "Delete";
$arsc_lang["idcard_guestbook_delete_ok"] = "Entrada foi deletada";
$arsc_lang["idcard_guestbook_delete_no"] = "Entrada não pode ser deletada!";
$arsc_lang["idcard_guestbook_add"]       = "Acrescentar entrada";
$arsc_lang["idcard_guestbook_add_ok"]    = "Sua entrada foi acrescentada";
$arsc_lang["idcard_guestbook_add_no"]    = "Sua entrada não pode ser acrescentada!";
$arsc_lang["idcard_guestbook_next"]      = "Próximas entradas";
$arsc_lang["idcard_guestbook_prev"]      = "Anteriores entradas";
$arsc_lang["idcard_close"]               = "Fechar";


// Chat System Messages

$arsc_lang["enter"]               = "Usuário {user} entrou na sala {room}.";
$arsc_lang["welcome"]             = "Bem vindo ao {title}!";
$arsc_lang["quit"]                = "Usuário {user} saiu da sala {room}.";
$arsc_lang["roomchange"]          = "Usuário {user} saiu da sala {room1} e entrou na {room2}.";
$arsc_lang["kicked"]              = "Usuário {userpassive} foi chutado do chat por {useractive}.";
$arsc_lang["youwerekicked"]       = "Você foi chutado pra fora do chat!";
$arsc_lang["floodwarn"]           = "Para de FLOODAR ou terá que deixar a sala!";
$arsc_lang["op"]                  = "Usuário {userpassive} pegou status de operador de {useractive}.";
$arsc_lang["deop"]                = "Usuário {useractive} removeu o status de operador de {userpassive}.";
$arsc_lang["whispers"]            = "sussurros";
$arsc_lang["whispersops"]         = "sussurros para todos os operadores";
$arsc_lang["gotmsg"]              = "Você sussurrou para {user}: {message}";
$arsc_lang["croom"]               = "Usuário {user} decidiu-se retirar-se em sua sala reservada {room}.";
$arsc_lang["room_exists"]         = "Desculpe, mas a sala {room} já existe.";
$arsc_lang["room_badname"]        = "Desculpe, este nome de sala não é aceitável.";
$arsc_lang["room_created"]        = "Sua sala privada {room} foi criada com sucesso! Agora você pode convidar alguém usando o comando /invite .";
$arsc_lang["invite"]              = "Usuário {user} convidou você para a sala {room}. Digite \"/room {room} {password}\" para entrar nesta sala.";
$arsc_lang["invite_notexist"]     = "Desculpe, o usuário {user} não existe.";
$arsc_lang["invite_notownroom"]   = "Desculpe, você deve estar em sua própria sala para convidar outros usuários.";
$arsc_lang["room_not_exist"]      = "Desculpe, mas a sala {room} não existe";
$arsc_lang["room_wrong_password"] = "Desculpe, você deve dizer a senha correta para entrar na sala {room}";
$arsc_lang["moderate_message"]    = "Sua menssagem `{message}` foi entregue ao moderador e será checada.";
$arsc_lang["opcall"]              = "[OPCALL] Preciso de ajuda !!!";

$arsc_lang["helplink"]      = "Ajuda";
$arsc_lang["help"]          = "
Ajuda Geral:
No frame direito você vê todos os usuários
que estão agora mesmo na sala.

Usuários com um @ a frente de seus nomes
e podem chutar usuários para fora
da sala, dar status de operador a outros
usuários, e se disfazer de seu status de operador.

Se você clicar num nome da direita, o campo de
entrada será preenchido com o comando
necessário para enviar menssagem privada para este usário.
Você só deve acrescentar sua menssagem ao final
desta linha.

Comandos Gerais:
/me message -- Simboliza uma ação, ex. /me feels fine writes * User feels fine
/msg user message -- Enviar uma menssagem privada para um usuário
/j OutraSala -- Deixa essa sala e entra na sala 'OutraSala'
/room room -- O mesmo que /j";

$arsc_lang["helpop"]        = "
Comandos de Operador:
/msgops message -- Sussurra uma menssagem para todos os operadores
/whois user -- Mostra informações sobre usuários
/op user -- Dá status de operador à usuários
/deop user -- Retira status de operador de usuários
/kick user -- Chuta usuários para fora do chat
/bann user X -- Bloqueia o IP do usuário por X segundos
/lock user -- Bloqueia conta do (registered!) usuário permanentemente
/rip user -- O que o suário dizer não será mostrado
/unrip user -- O que o usuário disser será mostrado denovo
/move user room -- Move o usuário na sala";

?>
