<br>
<div class="row">
	<div class="center">
		<h4 class="error">{DV="ERROR_REGISTRATION"}</h4>
		<form class="formRegistration"  method="post">
			Логин: <input type="text" name="login" required/><br />
			Пароль: <input type="password" name="password" required/><br />
			Ещё раз пароль: <input type="password" name="passwordRepeat" required/><br />
			E-mail: <input type="text" name="mail"/><br/>
			<div><p>E-mail необязателен, но необходим <br/> для востановление пороля</p></div>	
			Проверочный код:
			<br/>
			<img class="captcha" src = "captcha.php"/>
			<br/><input type = "text" name = "kapcha" required/>
			<br/>
			<input type="submit" name="submit" value="Отправить" />
		</form>
	</div>
</div>
