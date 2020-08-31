<div class="modal"  id="loginModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Вход в систему</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
		  <div class="form-group">
			<label for="login">Логин</label>
			<input type="text" class="form-control" id="login" aria-describedby="emailHelp">
		  </div>
		  <div class="form-group">
			<label for="loginPswd">Пароль</label>
			<input type="password" class="form-control" id="loginPswd">
		  </div>
		  <p id="loginError" class="alert-danger"></p>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        <button type="button" class="btn btn-primary" onclick="logIn()">Войти</button>
      </div>
    </div>
  </div>
</div>

<script>$('#loginModal').on('show.bs.modal', function (event) {clearLoginModal();})</script>