<?php
//@session_start();
/*
Блок функций общего назначения
*/
include_once sysPrefix . 'safemysql' . sysPostfix;
	
// Функция отлова ошибок
function d( $value = null, $die = 1){
	echo '<h6>Debug:</h6>'.'<pre>';
	print_r($value);
	echo '</pre>';
	
	if ($die) die;
}

// Парсинг адресной строки
function parseUrl($strUrl = null, $explodeChar = null): array{
	$urlData = array();
	if (!empty($strUrl)) $urlData = explode( $explodeChar, $strUrl);
	return $urlData;
}

// Возврат имени контроллера из URL
function urlToControllername($url){
	$controllerName=str_replace(".php","",$url);
	return $controllerName;
}

// загрузка страницы через контроллер
function loadPage($controllerName, $actionName, $arg = null){
	if (!file_exists(PathPrefix . $controllerName . PathPostfix)){
		$resData=array();
		$resData['action'] = 'consoleLog';
		$resData['data'] = "Контроллер: $controllerName - не определен.";
		echo json_encode($resData);	
		return; 
	}
	include_once PathPrefix . $controllerName . PathPostfix;
	
	$function = $actionName . 'Action';
	$function($arg);
}

// функция загрузки шаблона HTML
function loadTemplate ($templateDir, $templateName, $arg = null){
	require_once TemplatePrefix . $templateDir . '/' . $templateName . TemplatePostfix;
	
}

//Функция (возврата) передачи результата работы контроллера
function returnRes($actionRes, $dataRes=null){
	$resData=array();
	$resData['data']=$dataRes;
	$resData['action'] = $actionRes;
	echo json_encode($resData);
}

//Функция проверки валидности email
function validationEmail($email){
	return preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $email);
}











?>