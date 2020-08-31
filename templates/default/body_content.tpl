<hr>
<div class="col  pb-3">
	<div class="row alert-dark">
	<div class="col">Имя пользователя</div>
	<div class="col">Email</div>
	<div class="col">Текст задачи</div>
	<div class="col">Статус</div>
	<div class="col"></div>
	</div>
</div>
<div id="contentTask" class="col">
<?php 
foreach($arg['taskList'] as $row){
?>
<div class="col">
	<div class="row h3em" id="task_<?php echo $row['id'];?>">
	<div class="col"><?php echo $row['user'];?></div>
	<div class="col"><?php echo $row['email'];?></div>
	<div class="col"><?php echo $row['text'];?></div>
	<div class="col"><?php echo $row['status'];?></div>
	<div class="col"><button id="editTaskButton_<?php echo $row['id'];?>" type="button" class="btn btn-sm btn-primary <?php echo (!isset($_SESSION['user'])? 'd-none': '');?>" onclick="editTask(this)">Редактировать</button></div>
	</div>
</div>
<?php
}
?>
</div>
<p></p>

