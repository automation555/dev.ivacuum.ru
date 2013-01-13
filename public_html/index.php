<?php
/**
* @package ivacuum.ru
* @copyright (c) 2013
*/

namespace app;

require('/srv/www/vhosts/_/fw/master/bootstrap.php');

/**
* Создание сессии
* Инициализация привилегий
*/
$user->session_begin();
$auth->init($user->data);
$user->setup();

/* Домен временно закрыт для публики */
if ($request->header('Host') == 'dev.ivacuum.ru' && $user['user_id'] != 1 && $user->ip != '192.168.1.1' && $user->ip != '79.175.20.190')
{
	// redirect(ilink('', 'http://ivacuum.ru'));
}

/* Маршрутизация запроса */
$router = new \fw\core\router($cache, $config, $db, $request, $template, $user);
$router->_init()->handle_request();
