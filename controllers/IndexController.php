<?php

@session_start();

include_once ModelPrefix . $controllerName . ModelPostfix;

function showAction(){
	
	
	$field = $_SESSION['field'];
	$sorting = $_SESSION['sorting'];
	$page = $_SESSION['page'];
	$offset = ($page-1)*3;

	$arg['taskList'] = getTaskList($field, $sorting, $offset);
	$arg['taskCount'] = getTaskCount();
	$arg['countPage'] = (int)($arg['taskCount'] / 3) + 1;

	$_SESSION['countPage'] = $arg['countPage'];
	
	loadTemplate('default','head');
	loadTemplate('default','body',$arg);	
}

function getContentAction(){
	if (isset($_POST['page']) && $_POST['page']==$_SESSION['page']) {returnRes('consoleLog', ''); return;}
	if (isset($_POST['page']) && ($_POST['page']<1 || $_POST['page']>$_SESSION['countPage'])) {returnRes('consoleLog', ''); return;}
	
	if (isset($_POST['page']) && $_POST['page']!=$_SESSION['page']){
		
		$_SESSION['page'] = $_POST['page'];
		
		$field = $_SESSION['field'];
		$sorting = $_SESSION['sorting'];
		$page = $_SESSION['page'];
		$offset = ($page-1)*3;
	
		$arg['taskList'] = getTaskList($field, $sorting, $offset);
		$content = cteateContent($arg['taskList']);
		
		returnRes('setContent', $content);
		return;		
	}
	
	if (!isset($_POST['sortedType'])) {returnRes('consoleLog', ''); return;}
	
	switch ($_POST['sortedType']){
		case 1:
			$field = 'user';
			$sorting = 'ASC';
			break;
		case 2:
			$field = 'user';
			$sorting = 'DESC';
			break;
		case 3:
			$field = 'email';
			$sorting = 'ASC';
			break;
		case 4:
			$field = 'email';
			$sorting = 'DESC';
			break;
		case 5:
			$field = 'status';
			$sorting = 'ASC';
			break;
		case 6:
			$field = 'status';
			$sorting = 'DESC';
			break;
		default:
		return;		
	}
	
	if ($field==$_SESSION['field'] && $sorting==$_SESSION['sorting']) {returnRes('consoleLog', ''); return;}
	
	$_SESSION['sortedOption']=$_POST['sortedType'];	
	$_SESSION['field'] = $field;
	$_SESSION['sorting'] = $sorting;
	$page = $_SESSION['page'];
	$offset = ($page-1)*3;

	$arg['taskList'] = getTaskList($field, $sorting, $offset);
	$content = cteateContent($arg['taskList']);

	returnRes('setContent', $content);
}

function loginAction(){
	if (!isset($_POST['login'])){
		returnRes('setLoginError', 'Ошибка доступа. 1');
		return;	
	}
	if ($_POST['login']!='admin'){
		returnRes('setLoginError', 'Ошибка доступа. 2');
		return;	
	}
	if (!isset($_POST['pswd'])){
		returnRes('setLoginError', 'Ошибка доступа. 3');
		return;	
	}
	if ($_POST['pswd']!='123'){
		returnRes('setLoginError', 'Ошибка доступа. 4');
		return;	
	}
	
	$_SESSION['user']=$_POST['login'];
	returnRes('userConfirm', $_POST['login']);
}

function logoutAction(){
	unset($_SESSION['user']);
	returnRes('userUnset');
}

function cteateContent($arg){
	$content = '';

	foreach($arg as $row){
	$content .= '<div class="col">';
		$content .= '<div class="row h3em" id="task_' . $row['id'] . '">';
		$content .= '<div class="col">' . $row['user'] . '</div>';
		$content .= '<div class="col">' . $row['email'] . '</div>';
		$content .= '<div class="col">' . htmlspecialchars($row['text']) . '</div>';
		$content .= '<div class="col">' . $row['status'] . '</div>';
		$content .= '<div class="col"><button id="editTaskButton_' . $row['id'] .'" type="button" class="btn btn-sm btn-primary ' . (!isset($_SESSION['user'])? 'd-none': '') . '" onclick="editTask(this)">Редактировать</button></div>';
	$content .= '</div></div>';	
	}
	
	return $content;
}

function addTaskAction()
{
	if (!isset($_POST['user']) || is_null($_POST['user'])) {
		returnRes('setTaskError', 'Ошибка сервера: Имя пользователя не корректно');
		return;
	}
	if (!isset($_POST['email']) || is_null($_POST['email']) || !validationEmail($_POST['email'])) {
		returnRes('setTaskError', 'Ошибка сервера: Email введен не корректно');
		return;
	}
	if (!isset($_POST['task']) || is_null($_POST['task'])) {
		returnRes('setTaskError', 'Ошибка сервера: Текст задачи отсутствует');
		return;
	}
	
	createTask(array('user'=>$_POST['user'], 'email'=>$_POST['email'], 'text'=>$_POST['task'], 'status'=>0));
	returnRes('pageReload');
}

function updateTaskAction()
{
	if (!isset($_POST['id']) || is_null($_POST['id']) || !issetIdTask($_POST['id'])) {
		returnRes('setEditTaskError', 'Ошибка сервера: Неверный идентификатор задачи');
		return;
	}
	if (!isset($_POST['user']) || is_null($_POST['user'])) {
		returnRes('setEditTaskError', 'Ошибка сервера: Имя пользователя не корректно');
		return;
	}
	if (!isset($_POST['email']) || is_null($_POST['email']) || !validationEmail($_POST['email'])) {
		d($_POST['email']);
		returnRes('setEditTaskError', 'Ошибка сервера: Email введен не корректно: '.$_POST['email']);
		return;
	}
	if (!isset($_POST['task']) || is_null($_POST['task'])) {
		returnRes('setEditTaskError', 'Ошибка сервера: Текст задачи отсутствует');
		return;
	}
	if (!isset($_POST['status']) || is_null($_POST['status'])) {
		returnRes('setEditTaskError', 'Ошибка сервера: Статус выполнения неизвестен');
		return;
	}

	$_POST['status'] = ($_POST['status']=='true'? 1: 0);

	if (isset($_SESSION['user']) && $_SESSION['user']=='admin') {
		updateTask($_POST['id'], array('user'=>$_POST['user'], 'email'=>$_POST['email'], 'text'=>$_POST['task'], 'status'=>$_POST['status']));
	}
	
	returnRes('pageReload');
}

