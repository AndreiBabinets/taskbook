<?php ?>
<body>
<div class="login-content">
<div class="login-form">
	<div class="login-form-title">Активация доступа</div>
		<div class="login-form-block">
			<div class="login-form-block-img"><img src="../img/hardware.png"></div>
			<div class="login-form-block-info">
				<p><input id="login" type="text" placeholder="Логин" autofocus required></p>
				<p><input id="pswd" type="password" placeholder="Пароль" required></p>
			</div>
		</div>
		<div class="ErrorLogin"><span id="ErrorLogin"></span></div>
		<hr>
		
	<div class="login-form-block-btn"><a data-href="verification" class="button">OK</a></div>
</div>

</div>
<script>
$("a").on('click',function(){aClick(this)} );
$(document).ready(function() {
  $('input').keydown(function(e) {
 if(e.keyCode === 13) {
 idEl = $(this).attr('id');
 if (idEl=="login") $('#pswd').focus();
 if (idEl=="pswd") verification();
 }
  });
});
</script> 

</body>