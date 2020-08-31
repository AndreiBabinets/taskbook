<?php

//вывод ошибок кода PHP на экран
error_reporting(-1);
$conf['error_level'] = 2;
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


// подключение констант и общих переменных
include_once('../config/default.cfg');
include_once('../sys/GlobalFunctions.php');

// запуск сессии;
@session_start();

// определение параметров ссылки (парсинг ссылки)
$urlData = parseUrl($_SERVER['REQUEST_URI'], '/');

// определение контроллера
$controllerName =  isset( $urlData[1] ) && !empty( $urlData[1] )? urlToControllername(ucfirst( $urlData[1] )) : 'Index';

// определение функции контроллера: show - по умолчанию
$actionName =  isset( $urlData[2] ) ? $urlData[2] : 'show';

// определение параметров контроллера: null - по умолчанию
$arg =  isset( $urlData[3] ) ? $urlData[3] : null;

// Определение начальных параметров сессии
if (!isset($_SESSION['sortedOption'])) {$_SESSION['sortedOption']=1;}
if (!isset($_SESSION['field'])) {$_SESSION['field']='user';}
if (!isset($_SESSION['sorting'])) {$_SESSION['sorting']='ASC';}
if (!isset($_SESSION['page'])) {$_SESSION['page']=1;}

loadPage( $controllerName, $actionName, $arg );

?>
