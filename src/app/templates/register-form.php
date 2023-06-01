<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
  <label for="username">Имя:</label>
  <input type="text" id="username" name="username"><br>

  <label for="password">Пароль:</label>
  <input type="password" id="password" name="password"><br>

  <label for="password2">Пароль еще раз:</label>
  <input type="password" id="password2" name="password2"><br>

  <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

  <input type="submit" value="Зарегистрироваться">
</form>