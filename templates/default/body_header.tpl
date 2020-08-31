<div class="col headerRow ">
	<div class="row  p-2 ">
		<div class="col-9">
			<h2>Задачник</h2>
		</div>
		<div class="col-1">
			<span id="user"><?php if(isset($_SESSION['user'])) echo $_SESSION['user'];?></span> 
		</div>	
		<div class="col-1">
			<button id="loginButton" type="button" class="btn btn-sm btn-primary <?php echo (isset($_SESSION['user'])? 'd-none': '');?>" data-toggle="modal" data-target="#loginModal">Вход</button>
			<button id="logoutButton" type="button" class="btn btn-sm btn-primary <?php echo (!isset($_SESSION['user'])? 'd-none': '');?>" onclick="logOut()">Выход</button>
		</div>
	</div>
</div>
<hr>
<div class="col">
	<div class="row"> 
		<div class="col-2">
		Сортировать по : 
		</div>
		<div class=col-8>
		<select id="sortedType">
			<option value="1">Имя пользователя по возрастанию</option>
			<option value="2">Имя пользователя по убыванию</option>
			<option value="3">Email пользователя по возрастанию</option>
			<option value="4">Email пользователя по убыванию</option>
			<option value="5">Статус задачи по возрастанию</option>
			<option value="6">Статус задачи  по убыванию</option>
		</select>
		<button type="button" class="btn btn-sm btn-primary" onclick="sorted()">Сортировать</button>
		</div>
		<div class="col-2">
			<button type="button" class="btn-sm btn-primary" data-toggle="modal" data-target="#addTaskModal">Добавить задачу</button>
		</div>
</div>

<script>
$("#sortedType").val(<?php echo $_SESSION['sortedOption'];?>);
</script>