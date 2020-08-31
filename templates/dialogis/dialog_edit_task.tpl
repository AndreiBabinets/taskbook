<div class="modal" id="editTaskModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Редактирование задачи</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEditTask">
			<div class="form-group d-none">
				<label for="editTaskId">ID</label>
				<input type="text" class="form-control" id="editTaskId">
			  </div>
			  <div class="form-group">
				<label for="editUserName">Имя пользователя</label>
				<input type="text" class="form-control" id="editUserName">
			  </div>
			 <div class="form-group">
				<label for="editUserEmail">Email адрес</label>
				<input type="email" class="form-control" id="editUserEmail" aria-describedby="emailHelp">
			  </div>
			  <div class="form-group">
				<label class="form-check-label" for="editTextTask">Текст задачи</label>
				<textarea id="editTextTask"  class="form-control"></textarea>
			  </div>
			  <div class="form-group form-check">
				<input type="checkbox" class="form-check-input" id="editStatus">
				<label class="form-check-label" for="editStatus">Отметка о выполнении</label>
			  </div>
		</form>
		<p id="editTaskError" class="alert-danger"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        <button type="button" onclick="updateTask()" class="btn btn-primary">Сохранить</button>
      </div>
    </div>
  </div>
</div>
