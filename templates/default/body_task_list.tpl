<?php 
foreach($arg['taskList'] as $row){
?>
<div class="col">
	<div class="row h3em" id="task_<?php echo $row['id'];?>">
	<div class="col"><?php echo $row['user'];?></div>
	<div class="col"><?php echo $row['email'];?></div>
	<div class="col"><span class="textTask">
		<?php echo htmlspecialchars($row['text']); ?> 
		</span>
		<br />
		<span class="editCount" data-editCount="<?php echo $row['edit_count'];?>"><?php echo ($row['edit_count']>0? 'отредактировано '.$row['edit_count'].' раз(а)': ''); ?></span>
	</div>
	<div class="col" data-status="<?php echo $row['status'];?>"><?php echo ($row['status']==1? 'выполнено': '');?></div>
	<div class="col"><button id="editTaskButton_<?php echo $row['id'];?>" type="button" class="btn btn-sm btn-primary <?php echo (!isset($_SESSION['user'])? 'd-none': '');?>" onclick="editTask(this)">Редактировать</button></div>
	</div>
</div>
<hr>
<?php
}
?>