<div class="modal" id="successEditModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Редактирование задачи</h5>
      </div>
      <div class="modal-body">
        <form id="formSuccessEdit">
		<h1>Поздравлем!</h1>
		<p>Редактирование прошло успешно.</p>
		<hr>
		<p>Список изменений:</p>
		<ul id="changesList"></ul>
		<hr>
		<p>После закрытия этого окна страница будет обновлена.</p>
		</form>
		<p id="successError" class="alert-danger"></p>
      </div>
      <div class="modal-footer">
		<button type="button" onclick="pageReload()" class="btn btn-primary">Закрыть</button>
      </div>
    </div>
  </div>
</div>
