
/**
 * Формирование xmlhttprequest
 */
function getXmlHttp(){                
    var xmlhttp;
    try{
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } 
    catch (e){
        try{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } 
        catch (E){
            xmlhttp = false;
        }
    }
	
    if (!xmlhttp && typeof XMLHttpRequest!='undefined'){
        xmlhttp = new XMLHttpRequest();
    }
	
    return xmlhttp;
}

/**
 * Отправки запроса серверу через xmlhttprequest
 *
 * @param {string} action  - Название действия в контроллере сервера, строка.
 * @param {string} vardata - Передаваемые данные в контроллер сервера, строка.
 * @return {function} processinResponseData() - Функция обработки данных полученых от сервера.
 */
function sendData(action, vardata)
{
	var xmlhttp = new XMLHttpRequest();        
    xmlhttp.open('POST', action );
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    
	xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4) {
            if(xmlhttp.status == 200) {
			   responseData(xmlhttp.responseText);
            }
        }
    };
	
	xmlhttp.send(vardata);		
	return 1;
}

/**
 * Обработка ответов от сервера
 *
 * @param {obj} resData - Данные полученные с сервера, объект или массив JSON
 * @return {function} window[action]() - Вызов определенной функции данного скрипта.
 */
function responseData(resData){
	
	if (resData[0]=='<' || resData[1]=='<')	{
			return 0;
	} else {
		var responseJson = $.parseJSON(resData);
		if (responseJson.action === undefined) {	
			console.log('Action undefined!');
			return 0;
		}
		window[responseJson.action](responseJson.data);
	}
}

/**
 * Вывод контента в блок класса контент
 *
 * @param {obj} content - Данные полученные с сервера, код HTML
 */
function setContent(content){
	var divContent = $('#contentTask');
	divContent.html('');
	divContent.html(content);
}


/**
 * Перезагрузка страницы
 */
 function pageReload(){
	location.reload(); 
}

/**
 * Функции обработки входа / выхода пользователя
 */
function clearLoginModal(){
	$('#login').val('');
	$('#loginPswd').val('');
	resetLoginError();
}

function setLoginError($errorMsg){
	$('#loginError').text($errorMsg);
}

function resetLoginError(){
	$('#loginError').text('');
}

function loginVarification(){
	if (!$('#login').val().length) {
		setLoginError('Ошибка: не все поля заполнены.');
		return false;
	}
	if (!$('#loginPswd').val().length) {
		setLoginError('Ошибка: не все поля заполнены.');
		return false;
	}
	resetLoginError();
	return true;
}

function logIn(){
	if (!loginVarification()) return;
	var action = "index/login";
	var vardata = "login="+$('#login').val()+"&pswd="+$('#loginPswd').val();
	sendData(action,vardata);
}

function userConfirm(user){
	$('#user').text(user);
	$('#loginButton').toggleClass('d-none');
	$('#logoutButton').toggleClass('d-none');
	$('#loginModal').modal('toggle');
	$('[id^="editTaskButton_"]').toggleClass('d-none');	
}

function logOut(){
	var action = "index/logout";
	sendData(action);
}

function userUnset(){
	$('#user').text('');
	$('#loginButton').toggleClass('d-none');
	$('#logoutButton').toggleClass('d-none');
	$('[id^="editTaskButton_"]').toggleClass('d-none');
}

/**
 * Функции обработки добавления новой задачи
 */
function clearTaskModal(){
	$('#userName').val('');
	$('#userEmail').val('');
	$('#textTask').val('')
	resetTaskError();
}

function setTaskError($errorMsg){
		$('#taskError').text($errorMsg);
}

function resetTaskError(){
		$('#taskError').text('');
}

function validateEmail($email) {
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	return emailReg.test( $email );
}

function taskVerification(){
	if (!$('#userName').val().length) {
		setTaskError('Ошибка: Имя пользователя не указано.');
		return false;
	}
	if (!$('#userEmail').val().length) {
		setTaskError('Ошибка: Email не указан');
		return false;
	}
	if( !validateEmail($('#userEmail').val())) {
		setTaskError('Ошибка: Email не правильный');
		return false;
	}
	if( !$('#textTask').val().length) {
		setTaskError('Ошибка: Текст задачи не может быть пустым');
		return false;
	}
	
	resetTaskError();
	return true;
}

function addTask(){
	if (!taskVerification()) return;
	var action = "index/addTask";
	var vardata = "user="+$('#userName').val()+"&email="+$('#userEmail').val()+"&task="+$('#textTask').val();
	sendData(action,vardata);	
}

/**
 * Функции обработки редактирования и обновления задачи
 */
function setEditTaskError($errorMsg){
	$('#editTaskError').text($errorMsg);
}

function resetEditTaskError(){
	$('#editTaskError').text('');
}

function editTaskVerification(){
	if (!$('#editUserName').val().length) {
		setEditTaskError('Ошибка: Имя пользователя не указано.');
		return false;
	}
	if (!$('#editUserEmail').val().length) {
		setEditTaskError('Ошибка: Email не указан');
		return false;
	}
	if( !validateEmail($('#editUserEmail').val())) {
		setEditTaskError('Ошибка: Email не правильный');
		return false;
	}
	if( !$('#editTextTask').val().length) {
		setEditTaskError('Ошибка: Текст задачи не может быть пустым');
		return false;
	}
	
	resetEditTaskError();
	return true;
}

function editTask(el){
	var row=$(el).parent().parent();
	$('#editTaskId').val($(row).attr('id').replace('task_',''));
	$('#editUserName').val($(row).children(':nth-child(1)').text());
	$('#editUserEmail').val($(row).children(':nth-child(2)').text());
	$('#editTextTask').val($(row).children(':nth-child(3)').children('.textTask').text().trim());
	$('#editStatus').prop('checked', parseInt($(row).children(':nth-child(4)').attr('data-status')));
	$('#editTaskCount').val($(row).children(':nth-child(3)').children('.editCount').attr('data-editcount'));
	resetEditTaskError();
	$('#editTaskModal').modal('show');
}

function updateTask(){
	if (!editTaskVerification()) return;
	var action = "index/updateTask";
	var vardata = "id="+$('#editTaskId').val()+"&user="+$('#editUserName').val()+"&email="+$('#editUserEmail').val()+"&task="+$('#editTextTask').val() +"&status="+$('#editStatus').prop('checked')+"&editCount="+$('#editTaskCount').val();
	sendData(action,vardata);
}

function successAddTask(){
	$('#addTaskModal').modal('hide');
	$('#successAddModal').modal('show');
}

function successEditTask(changeList){
	$('#editTaskModal').modal('hide');

	$('#changesList').html('');
	$.each(changeList, function(){
		newLi = $('<li>').text(this);
		$('#changesList').append(newLi)
	})
	
	$('#successEditModal').modal('show');
}
/**
 * Функции обработки сортировки
 */
function sorted(){
	var sortedType = $('#sortedType option:selected').val();
	var action = "index/getContent";
	var vardata = "sortedType="+sortedType;
	sendData(action,vardata);
}

function previosPage(el){
	if ($('.activePage').text()==1) return;
	getElPage(-1).click();
	}
	
function nextPage(el){
	if ($('.activePage').text()==$('#countPage').text()) return; 
	getElPage(1).click();
	}
	
function getElPage(offset){
	var indexActivePage = $('nav a').index($('.activePage'));
	var navAList =  $('nav a');
	return $(navAList[indexActivePage+offset]);
}
function goPage(el){
	if ($(el).hasClass('activePage')) return;
	
	$('.activePage').toggleClass('activePage');
	$(el).toggleClass('activePage');
	
	var page = $(el).text();
	var action = "index/getContent";
	var vardata = "page="+page;
	sendData(action,vardata);	
}

/**
 * Программный клик на кнопку 
 *
 * @param {obj} el - объект кнопки
 */
function clickEl(el){
	$(el).click();
}

/**
 * Вызов функции из атрибута data-href
 *
 * @param {obj} el - объект кнопки
 */
function aClick(el){	 
	if ( $(el).is("[data-href]") ) {
		window[$(el).attr('data-href')](el);
		return 0;
	}
}

/**
 * Вывод в консоль
 *
 * @param {string} message - текст сообщения
 */
function consoleLog(message){
	if (!message.length) return 0;
	console.log(message);
}

