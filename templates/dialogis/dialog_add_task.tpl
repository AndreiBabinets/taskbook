<div class="modal" id="addTaskModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Новая задача</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAddTask">
			  <div class="form-group">
				<label for="userName">Имя пользователя</label>
				<input type="text" class="form-control" id="userName">
			  </div>
			 <div class="form-group">
				<label for="userEmail">Email адрес</label>
				<input type="email" class="form-control" id="userEmail" aria-describedby="emailHelp">
			  </div>
			  <div class="form-group">
				<label class="form-check-label" for="textTask">Текст задачи</label>
				<textarea id="textTask"  class="form-control"></textarea>
			  </div>
		</form>
		<p id="taskError" class="alert-danger"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        <button type="button" onclick="addTask()" class="btn btn-primary">Добавить</button>
      </div>
    </div>
  </div>
</div>
<script>$('#addTaskModal').on('show.bs.modal', function (event) {clearTaskModal();})</script>